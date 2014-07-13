<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Helper;

class Module {
	public function onBootstrap( MvcEvent $e ) {
		$eventManager        = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach( $eventManager );
        new Helper\ConfigRead($e->getApplication()->getServiceManager());
	}

	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to
	 * seed such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getServiceConfig() {
		return array(
			'factories' => array(
				'user_auth_service' =>  function($sm){
						/* @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
					/** @var \DoctrineModule\Authentication\Adapter\ObjectRepository $adapter */
					$adapter = $sm->get('doctrine.authenticationadapter.odm_default');

// TODO read from Config
					$adapter->setOptions(
						array(
							'objectManager'=>$sm->get('Doctrine\ORM\EntityManager'),
							'identityClass'=>'Application\Entity\Users',
							'identityProperty'=>'username',
							'credentialProperty'=>'password',
							'credentialCallable' => 'Application\Entity\Users::hashPassword'
						)
					);
					$oAuthService = new \Zend\Authentication\AuthenticationService();
					return $oAuthService->setAdapter($adapter);

				}
			),
		);
	}

}
