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

class User extends InvokablesBase {

	/**
	 * @var \Zend\Authentication\AuthenticationService
	 */
	protected $authService;

	/**
	 * @var \Application\Form\Register
	 */
	protected $registerForm;

	/**
	 * @var \Application\Service\Mail
	 */
	protected $mailService;

	/**
	 * @var \Application\Service\UserCodes
	 */
	protected $userCodesService;

	public function register( array $aData ){

		$oForm = $this->getRegisterForm();

		$oForm->setHydrator( new \Application\Mapper\Hydrator() );
		$oForm->bind(new Users());
		$oForm->setData($aData);
		if(!$oForm->isValid()){
			return false;
		}

		$oEntityManager = $this->getEntityManager();
		/** @var Users $oUserEntity */
		$oUserEntity = $oForm->getData();
		$oUserEntity->setCreateip(Ip::getIp());

		$oBcrypt = new Bcrypt();
		$oUserEntity->setPassword($oBcrypt->create($oUserEntity->getPassword()));

		$oEntityManager->persist($oUserEntity);
		$oEntityManager->flush();

		$sCode = $this->getUserCodesService()->setCode4User($oUserEntity, \Application\Entity\Usercodes::Type_Register);

		$this->getMailService()->register($oUserEntity, $sCode);

		return $oUserEntity;
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

	/**
	 * @return \Application\Service\Mail
	 */
	protected function getMailService() {
		if (! $this->mailService) {
			$this->mailService = $this->getServiceManager()->get('pserver_mail_service');
		}

		return $this->mailService;
	}

	/**
	 * @return \Application\Service\UserCodes
	 */
	protected function getUserCodesService(){
		if (! $this->userCodesService) {
			$this->userCodesService = $this->getServiceManager()->get('pserver_usercodes_service');
		}

		return $this->userCodesService;
	}
}