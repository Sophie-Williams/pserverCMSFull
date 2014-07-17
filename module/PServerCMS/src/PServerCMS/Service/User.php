<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 02:43
 */

namespace PServerCMS\Service;


use PServerCMS\Entity\User2server;
use PServerCMS\Entity\Usercodes;
use PServerCMS\Entity\Users;
use PServerCMS\Helper\ConfigRead;
use PServerCMS\Helper\Ip;
use PServerCMS\Keys\Entity;
use Zend\Crypt\Password\Bcrypt;

class User extends InvokableBase {

	/**
	 * @var \Zend\Authentication\AuthenticationService
	 */
	protected $authService;

	/**
	 * @var \PServerCMS\Form\Register
	 */
	protected $registerForm;

	/**
	 * @var \PServerCMS\Service\Mail
	 */
	protected $mailService;

	/**
	 * @var \PServerCMS\Service\UserCodes
	 */
	protected $userCodesService;

	/**
	 * @var \PServerCMS\Form\RegisterGame
	 */
	protected $registerGameForm;

	/**
	 * @var \GameBackend\DataService\DataServiceInterface
	 */
	protected $gameBackendService;

	/**
	 * @param array $aData
	 *
	 * @return Users|bool
	 */
	public function register( array $aData ){

		$oForm = $this->getRegisterForm();

		$oForm->setHydrator( new \PServerCMS\Mapper\Hydrator() );
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

		$sCode = $this->getUserCodesService()->setCode4User($oUserEntity, \PServerCMS\Entity\Usercodes::Type_Register);

		$this->getMailService()->register($oUserEntity, $sCode);

		return $oUserEntity;
	}

	/**
	 * @param array     $aData
	 * @param Usercodes $oUserCodes
	 *
	 * @return Users|bool
	 */
	public function registerGame( array $aData, Usercodes $oUserCodes ){

		$oForm = $this->getRegisterGameForm();

		$oForm->setData($aData);
		if(!$oForm->isValid()){
			return false;
		}

		$aData = $oForm->getData();
		$sPlainPassword = $aData['password'];

		$oGameBackend = $this->getGameBackendService();

		$oUser = $oUserCodes->getUsersUsrid();
		$iBackendId = $oGameBackend->setUser($oUser, $sPlainPassword);
		$oUser->setBackendId($iBackendId);

		$oEntityManager = $this->getEntityManager();
		$oRepositoryRole = $oEntityManager->getRepository(Entity::UserRole);
		$sRole = ConfigRead::get('pserver.register.role','user');
		$oRole = $oRepositoryRole->findOneBy(array('roleId' => $sRole));

		// add the ROLE + BackendId + Remove the Key
		$oUser->addUserRole($oRole);
		$oRole->addUsersUsrid($oUser);
		$oEntityManager->persist($oUser);
		$oEntityManager->persist($oRole);
		$oEntityManager->remove($oUserCodes);
		$oEntityManager->flush();

		return $oUser;
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
	 * @return \PServerCMS\Form\Register
	 */
	protected function getRegisterForm() {
		if (! $this->registerForm) {
			$this->registerForm = $this->getServiceManager()->get('pserver_user_register_form');
		}

		return $this->registerForm;
	}

	/**
	 * @return \PServerCMS\Form\RegisterGame
	 */
	protected function getRegisterGameForm() {
		if (! $this->registerGameForm) {
			$this->registerGameForm = $this->getServiceManager()->get('pserver_user_registergame_form');
		}

		return $this->registerGameForm;
	}

	/**
	 * @return \PServerCMS\Service\Mail
	 */
	protected function getMailService() {
		if (! $this->mailService) {
			$this->mailService = $this->getServiceManager()->get('pserver_mail_service');
		}

		return $this->mailService;
	}

	/**
	 * @return \PServerCMS\Service\UserCodes
	 */
	protected function getUserCodesService(){
		if (! $this->userCodesService) {
			$this->userCodesService = $this->getServiceManager()->get('pserver_usercodes_service');
		}

		return $this->userCodesService;
	}

	/**
	 * @return \GameBackend\DataService\DataServiceInterface
	 */
	protected function getGameBackendService(){
		if (! $this->gameBackendService) {
			$this->gameBackendService = $this->getServiceManager()->get('gamebackend_dataservice');
		}

		return $this->gameBackendService;
	}
}