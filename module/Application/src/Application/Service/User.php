<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 02:43
 */

namespace Application\Service;


use Application\Entity\Users;
use Application\Helper\Ip;
use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class User implements ServiceManagerAwareInterface {

	/**
	 * @var ServiceManager
	 */
	protected $serviceManager;

	/**
	 * @var \Zend\Authentication\AuthenticationService
	 */
	protected $authService;

	/**
	 * @var \Application\Form\Register
	 */
	protected $registerForm;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $entityManager;

	public function register( array $aData ){

		$oForm = $this->getRegisterForm();


		$oForm->setHydrator( new \Application\Mapper\Hydrator() );
		$oForm->bind(new Users());
		$oForm->setData($aData);
		if(!$oForm->isValid()){
			return false;
		}

		$oObjectManager = $this->getEntityManager();
		/** @var Users $oUserEntity */
		$oUserEntity = $oForm->getData();
		$oUserEntity->setCreateip(Ip::getIp());

		$oBcrypt = new Bcrypt();
		$oUserEntity->setPassword($oBcrypt->create($oUserEntity->getPassword()));

		$oObjectManager->persist($oUserEntity);
		$oObjectManager->flush();

		// TODO Mail active

		return $oUserEntity;
	}

	/**
	 * @return ServiceManager
	 */
	public function getServiceManager(){
		return $this->serviceManager;
	}

	/**
	 * @param ServiceManager $oServiceManager
	 *
	 * @return $this
	 */
	public function setServiceManager( ServiceManager $oServiceManager ) {
		$this->serviceManager = $oServiceManager;

		return $this;
	}

	public function getEntityManager(){
		if (! $this->entityManager) {
			$this->entityManager = $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
		}

		return $this->entityManager;
	}


	/**
	 * @return \Zend\Authentication\AuthenticationService
	 */
	protected function getAuthService() {
		if (! $this->authService) {
			$this->authService = $this->getServiceManager()->get('user_auth_service');
		}

		return $this->authService;
	}

	/**
	 * @return \Application\Form\Register
	 */
	protected function getRegisterForm() {
		if (! $this->registerForm) {
			$this->registerForm = $this->getServiceManager()->get('pserver_user_register_form');
		}

		return $this->registerForm;
	}
}