<?php

namespace Application;

use Application\Keys\Entity;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Helper;

class Module {
	public function onBootstrap( MvcEvent $e ) {
		$eventManager        = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach( $eventManager );

		// TODO to invokables
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
			'invokables' => array(
				'pserver_user_service'				=> 'Application\Service\User',
				'pserver_mail_service'				=> 'Application\Service\Mail',
				'pserver_usercodes_service'			=> 'Application\Service\UserCodes',
			),
			'factories' => array(
				'user_auth_service' => function($sm){
					/** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
					/** @var \DoctrineModule\Authentication\Adapter\ObjectRepository $oAdapter */
					$oAdapter = $sm->get('doctrine.authenticationadapter.odm_default');

					// In Config there is not EntityManager =(, so we have to add it now =)
					$aConfig = Helper\ConfigRead::get('authenticationadapter.odm_default', array());
					$aConfig['objectManager'] = $sm->get('Doctrine\ORM\EntityManager');
					$oAdapter->setOptions( $aConfig );

					$oAuthService = new \Zend\Authentication\AuthenticationService();
					return $oAuthService->setAdapter($oAdapter);
				},
				'pserver_user_register_form' => function($sm){
					/** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
					/** @var $oRepositoryUser \Doctrine\Common\Persistence\ObjectRepository */
					$oRepositoryUser = $sm->get('Doctrine\ORM\EntityManager')->getRepository(Entity::Users);
					$oForm = new Form\Register();
					$oForm->setInputFilter(new Form\RegisterFilter(
						new Validator\NoRecordExists( $oRepositoryUser, 'username' )
					));
					return $oForm;
				},
			),
		);
	}

}
