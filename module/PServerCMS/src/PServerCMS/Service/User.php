<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 02:43
 */

namespace PServerCMS\Service;


use PServerCMS\Entity\Usercodes;
use PServerCMS\Entity\Users;
use PServerCMS\Entity\AvailableCountries;
use PServerCMS\Entity\Repository\AvailableCountries as RepositoryAvailableCountries;
use PServerCMS\Entity\Repository\CountryList;
use PServerCMS\Helper\DateTimer;
use PServerCMS\Helper\Ip;
use PServerCMS\Keys\Entity;
use PServerCMS\Mapper\HydratorUser;
use Zend\Crypt\Password\Bcrypt;

class User extends InvokableBase {
	const ErrorNameSpace = 'user-auth';
	/** @var \Zend\Authentication\AuthenticationService */
	protected $authService;
	/** @var \PServerCMS\Form\Login */
	protected $loginForm;
	/** @var \PServerCMS\Form\Register */
	protected $registerForm;
	/** @var \PServerCMS\Service\Mail */
	protected $mailService;
	/** @var \PServerCMS\Service\UserCodes */
	protected $userCodesService;
	/** @var \PServerCMS\Form\Password */
	protected $passwordForm;
	/** @var \GameBackend\DataService\DataServiceInterface */
	protected $gameBackendService;
	/** @var \PServerCMS\Form\PwLost */
	protected $passwordLostForm;
	/** @var string */
	private $failedLoginMessage = 'Authentication failed. Please try again.';

    /**
     * @param array $aData
     * @return bool
     */
    public function login( array $aData ){

		$oForm = $this->getLoginForm();
		$oForm->setHydrator( new HydratorUser() );
		$oForm->bind( new Users() );
		$oForm->setData($aData);

		$this->getFlashMessenger()->setNamespace(self::ErrorNameSpace)->addMessage($this->getFailedLoginMessage());
		if(!$oForm->isValid()){
			return false;
		}
        if(!$this->isIpAllowed()){
            return false;
        }
		/** @var \PServerCMS\Entity\Users $oUser */
		$oUser = $oForm->getData();
		$oAuthService = $this->getAuthService();
        $oResult = $this->getAuthResult($oAuthService,$oUser);
		if($oResult->isValid()){
			/** @var \PServerCMS\Entity\Users $oUser */
			$oUser = $oResult->getIdentity();
            if($this->isValidLogin($oUser)){
                $this->doLogin($oUser);
				return true;
			}else{
				// Login correct but not active or blocked or smth else
				$oAuthService->clearIdentity();
				$oAuthService->getStorage()->clear();
			}
		}else{
            $this->handleInvalidLogin($oUser);
		}
		return false;
	}

	/**
	 *	TODO TEST
	 */
	public function doAuthentication( \PServerCMS\Entity\Users $oUser ){
		$oAuthService = $this->getAuthService();
		// FIX: no roles after register
		$oUser->getRoles();
		$oAuthService->getStorage()->write($oUser);
	}

	/**
	 * @param array $aData
	 *
	 * @return Users|bool
	 */
	public function register( array $aData ){

		$oForm = $this->getRegisterForm();
		$oForm->setHydrator( new HydratorUser() );
		$oForm->bind( new Users() );
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

		$oForm = $this->getPasswordForm();

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
        /** user have already a backendId, so better to set it there */
        $oEntityManager->persist($oUser);
        $oEntityManager->flush();

        /** @var CountryList $oCountryList */
        $oCountryList = $oEntityManager->getRepository(Entity::CountryList);
        $oAvailableCountries = new AvailableCountries();
        $oAvailableCountries->setActive('1');
        $oAvailableCountries->setUsersUsrid($oUser);
        $oAvailableCountries->setCntry($oCountryList->getCountryCode4Ip(Ip::getIp()));

		$oRepositoryRole = $oEntityManager->getRepository(Entity::UserRole);
		$sRole = $this->getConfigService()->get('pserver.register.role','user');
		$oRole = $oRepositoryRole->findOneBy(array('roleId' => $sRole));

		// add the ROLE + Remove the Key
		$oUser->addUserRole($oRole);
		$oRole->addUsersUsrid($oUser);
		$oEntityManager->persist($oUser);
		$oEntityManager->persist($oRole);
        $oEntityManager->persist($oAvailableCountries);
		$oEntityManager->remove($oUserCodes);
		$oEntityManager->flush();

		return $oUser;
	}

	public function lostPw( array $aData ){

		$oForm = $this->getPasswordLostForm();

		$oForm->setData($aData);
		if(!$oForm->isValid()){
			return false;
		}

		$aData = $oForm->getData();

		$oEntityManager = $this->getEntityManager();
		$oUser = $oEntityManager->getRepository(Entity::Users)->findOneBy(array('username' => $aData['username']));


		$sCode = $this->getUserCodesService()->setCode4User($oUser, \PServerCMS\Entity\Usercodes::Type_LostPassword);

		$this->getMailService()->lostPw($oUser, $sCode);

		return $oUser;
	}

	public function lostPwConfirm( array $aData, Usercodes $oUserCodes ){

		$oForm = $this->getPasswordForm();

		$oForm->setData($aData);
		if(!$oForm->isValid()){
			return false;
		}

		$aData = $oForm->getData();
		$sPlainPassword = $aData['password'];

		$oEntityManager = $this->getEntityManager();
		/** @var Users $oUserEntity */
		$oUserEntity = $oUserCodes->getUsersUsrid();

		$oBcrypt = new Bcrypt();
		$oUserEntity->setPassword($oBcrypt->create($sPlainPassword));

		$oEntityManager->persist($oUserEntity);
		$oEntityManager->remove($oUserCodes);
		$oEntityManager->flush();

		return $oUserEntity;
	}

    public function countryConfirm( Usercodes $oUserCodes ){
        $oEntityManager = $this->getEntityManager();

        /** @var Users $oUserEntity */
        $oUserEntity = $oUserCodes->getUsersUsrid();

		/** @var CountryList $oCountryList */
		$oCountryList = $oEntityManager->getRepository(Entity::CountryList);
		$sCountry = $oCountryList->getCountryCode4Ip(Ip::getIp());

		/** @var AvailableCountries $oAvailableCountries */
		$class = Entity::AvailableCountries;
        $oAvailableCountries = new $class();
        $oAvailableCountries->setCntry($sCountry);
        $oAvailableCountries->setUsersUsrid($oUserEntity);

        $oEntityManager->persist($oAvailableCountries);
        $oEntityManager->remove($oUserCodes);
        $oEntityManager->flush();

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
	 * @return \PServerCMS\Form\Login
	 */
	protected function getLoginForm() {
		if (! $this->loginForm) {
			$this->loginForm = $this->getServiceManager()->get('pserver_user_login_form');
		}

		return $this->loginForm;
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
	 * @return \PServerCMS\Form\Password
	 */
	protected function getPasswordForm() {
		if (! $this->passwordForm) {
			$this->passwordForm = $this->getServiceManager()->get('pserver_user_password_form');
		}

		return $this->passwordForm;
	}

	/**
	 * @return \PServerCMS\Form\PwLost
	 */
	protected function getPasswordLostForm() {
		if (! $this->passwordLostForm) {
			$this->passwordLostForm = $this->getServiceManager()->get('pserver_user_pwlost_form');
		}

		return $this->passwordLostForm;
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
	protected function getUserCodesService() {
		if (! $this->userCodesService) {
			$this->userCodesService = $this->getServiceManager()->get('pserver_usercodes_service');
		}

		return $this->userCodesService;
	}

	/**
	 * @return \GameBackend\DataService\DataServiceInterface
	 */
	protected function getGameBackendService() {
		if (! $this->gameBackendService) {
			$this->gameBackendService = $this->getServiceManager()->get('gamebackend_dataservice');
		}

		return $this->gameBackendService;
	}

	/**
	 * @param $sMessage
	 */
	protected function setFailedLoginMessage( $sMessage ){
		$this->failedLoginMessage = $sMessage;
	}

	/**
	 * @return string
	 */
	protected function getFailedLoginMessage() {
		return $this->failedLoginMessage;
	}

    /**
     * @param Users $oUser
     * @return bool
     */
    protected function isValidLogin(Users $oUser) {
        if (!(bool)$oUser->getUserRole()->getKeys()) {
            $this->setFailedLoginMessage('Your Account is not active, please confirm your email');
            return false;
        }
        if(!$this->isCountryAllowed($oUser)){
            return false;
        }
        if($this->isUserBlocked($oUser)){
            return false;
        }
        return true;
    }

    /**
     * @param Users $oUser
     * @return bool
     */
    protected function isCountryAllowed(Users $oUser) {
        $oEntityManager = $this->getEntityManager();

        /** @var CountryList $oCountryList */
        $oCountryList = $oEntityManager->getRepository(Entity::CountryList);
        $sCountry = $oCountryList->getCountryCode4Ip(Ip::getIp());
        /** @var RepositoryAvailableCountries $oAvailableCountries */
        $oAvailableCountries = $oEntityManager->getRepository(Entity::AvailableCountries);
        if(!$oAvailableCountries->isCountryAllowedForUser($oUser->getUsrid(), $sCountry)){
            $sCode = $this->getUserCodesService()->setCode4User($oUser, \PServerCMS\Entity\Usercodes::Type_ConfirmCountry);
            $this->getMailService()->confirmCountry($oUser, $sCode);
            $this->getFlashMessenger()->setNamespace(self::ErrorNameSpace)->addMessage('Please confirm your new ip with your email');
            return false;
        }
		return true;
    }

    /**
     * @param Users $oUser
     * @return bool
     */
    protected function isUserBlocked(Users $oUser) {
        $oEntityManager = $this->getEntityManager();
        /** @var \PServerCMS\Entity\Repository\UserBlock $RepositoryUserBlock */
        $RepositoryUserBlock = $oEntityManager->getRepository(Entity::UserBlock);
        $oIsUserBlocked = $RepositoryUserBlock->isUserAllowed( $oUser->getUsrid() );
        if($oIsUserBlocked){
            $this->getFlashMessenger()->setNamespace(self::ErrorNameSpace)->addMessage('You are blocked because '.$oIsUserBlocked->getReason().' !, try it again '.$oIsUserBlocked->getExpire()->format('H:i:s'));
            return true;
        }
        return false;
    }

    /**
     * @param Users $oUser
     */
    protected function doLogin(Users $oUser) {
        $this->getFlashMessenger()->clearCurrentMessagesFromNamespace(self::ErrorNameSpace);
        $oEntityManager = $this->getEntityManager();
        /**
         * Set LoginHistory
         */
        $class = Entity::LoginHistory;
        /** @var \PServerCMS\Entity\LoginHistory $oLoginHistory */
        $oLoginHistory = new $class();
        $oLoginHistory->setUsersUsrid($oUser);
        $oLoginHistory->setIp(Ip::getIp());
        $oEntityManager->persist($oLoginHistory);
        $oEntityManager->flush();
    }

    protected function handleInvalidLogin(Users $oUser) {
        $iMaxTries = $this->getConfigService()->get('pserver.login.exploit.try');
        if(!$iMaxTries){
            return false;
        }

        $oEntityManager = $this->getEntityManager();
        /**
         * Set LoginHistory
         */
        $class = Entity::LoginFailed;
        /** @var \PServerCMS\Entity\Loginfaild $oLoginFailed */
        $oLoginFailed = new $class();
        $oLoginFailed->setUsername($oUser->getUsername());
        $oLoginFailed->setIp(Ip::getIp());
        $oEntityManager->persist($oLoginFailed);
        $oEntityManager->flush();

        $iTime = $this->getConfigService()->get('pserver.login.exploit.time');

        /** @var \PServerCMS\Entity\Repository\LoginFaild $oRepositoryLoginFailed */
        $oRepositoryLoginFailed = $oEntityManager->getRepository($class);
        if($oRepositoryLoginFailed->getNumberOfFailLogins4Ip(Ip::getIp(), $iTime) >= $iMaxTries){
            $class = Entity::IpBlock;
            /** @var \PServerCMS\Entity\Ipblock $oIPBlock */
            $oIPBlock = new $class();
            $oIPBlock->setExpire(DateTimer::getDateTime4TimeStamp(time()+$iTime));
            $oIPBlock->setIp(Ip::getIp());
            $oEntityManager->persist($oIPBlock);
            $oEntityManager->flush();
        }
    }

    /**
     * @param \Zend\Authentication\AuthenticationService $oAuthService
     * @param Users $oUser
     * @return \Zend\Authentication\Result
     */
    protected function getAuthResult(\Zend\Authentication\AuthenticationService $oAuthService,Users $oUser){
        /** @var \DoctrineModule\Authentication\Adapter\ObjectRepository $oAdapter */
        $oAdapter = $oAuthService->getAdapter();
        $oAdapter->setIdentity($oUser->getUsername());
        $oAdapter->setCredential($oUser->getPassword());
        return $oAuthService->authenticate($oAdapter);
    }

    /**
     * @return bool
     */
    protected function isIpAllowed(){
        $oEntityManager = $this->getEntityManager();
        /** @var \PServerCMS\Entity\Repository\IPBlock $RepositoryIPBlock */
        $RepositoryIPBlock = $oEntityManager->getRepository(Entity::IpBlock);
        $oIsIpAllowed = $RepositoryIPBlock->isIPAllowed( Ip::getIp() );
        if($oIsIpAllowed){
            $this->getFlashMessenger()->setNamespace(self::ErrorNameSpace)->addMessage('Your IP is blocked!, try it again '.$oIsIpAllowed->getExpire()->format('H:i:s'));
            return false;
        }
        return true;
    }
}