<?php

namespace PServerCMS\Controller;

use PServerCMS\Entity\Usercodes;
use PServerCMS\Keys\Entity;
use Zend\Mvc\Controller\AbstractActionController;

class AuthController extends AbstractActionController {
	const ErrorNameSpace = 'user-auth';
	const RouteLoggedIn = 'home';
	protected $passwordLostForm;

	private $failedLoginMessage = 'Authentication failed. Please try again.';

	protected $userService;
	protected $authService;
	protected $registerForm;
    protected $loginForm;
	protected $passwordForm;
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $entityManager;

	/**
	 * @return array|\Zend\Http\Response
	 */
	public function loginAction() {

		//if already login, redirect to success page
		if ($this->getAuthService()->hasIdentity()){
			return $this->redirect()->toRoute(self::RouteLoggedIn);
		}

		$oForm = $this->getLoginForm();
		$oRequest = $this->getRequest();

		if (!$oRequest->isPost()){
			return array(
				'aErrorMessages' => $this->flashmessenger()->getMessagesFromNamespace(self::ErrorNameSpace),
				//'aErrorMessages' => array('dfdsf'),
				'loginForm' => $oForm
			);
		}

		if($this->getUserService()->login($this->params()->fromPost())){
			return $this->redirect()->toRoute(self::RouteLoggedIn);
		}
		return $this->redirect()->toUrl($this->url()->fromRoute('auth'));
	}

	public function registerAction(){

		//if already login, redirect to success page
		if ($this->getAuthService()->hasIdentity()){
			return $this->redirect()->toRoute(self::RouteLoggedIn);
		}

		$oForm = $this->getRegisterForm();

		$oRequest = $this->getRequest();
		if($oRequest->isPost()){
			$oUser = $this->getUserService()->register($this->params()->fromPost());
			if($oUser){
				return $this->redirect()->toRoute('auth', array('action' => 'register-done'));
			}
		}

		return array('registerForm' => $oForm);
	}

	public function registerDoneAction(){
		return array();
	}

	public function registerConfirmAction(){
		$sCode = $this->params()->fromRoute('code');

		$oEntityManager = $this->getEntityManager();
		/** @var $oRepositoryCode \PServerCMS\Entity\Repository\Usercodes */
		$oRepositoryCode = $oEntityManager->getRepository(Entity::UserCodes);
		$oCode = $oRepositoryCode->getData4CodeType($sCode, Usercodes::Type_Register);

		if(!$oCode){
			return $this->forward()->dispatch('PServerCMS\Controller\Auth', array('action' => 'wrong-code'));
		}

		$oForm = $this->getPasswordForm();
		$oRequest = $this->getRequest();
		if($oRequest->isPost()){
			$oUser = $this->getUserService()->registerGame($this->params()->fromPost(), $oCode);
			if($oUser){
				$this->getUserService()->doAuthentication($oUser);
				return $this->redirect()->toRoute('home');
			}
		}

		return array('registerForm' => $oForm);
	}

	/**
	 * Logout and clear the identity + Redirect to fix the identity
	 */
	public function logoutAction(){

		$this->getAuthService()->getStorage()->clear();
		$this->getAuthService()->clearIdentity();

		return $this->redirect()->toRoute('auth', array('action' => 'logout-page'));
	}

	/**
	 * LogoutPage
	 */
	public function logoutPageAction(){
		return array();
	}

	public function pwLostAction(){

		$oForm = $this->getPasswordLostForm();

		$oRequest = $this->getRequest();
		if($oRequest->isPost()){
			$oUser = $this->getUserService()->lostPw($this->params()->fromPost());
			if($oUser){
				return $this->redirect()->toRoute('auth', array('action' => 'pw-lost-done'));
			}
		}

		return array('pwLostForm' => $oForm);
	}

	public function pwLostDoneAction(){
		return array();
	}

	public function pwLostConfirmAction(){
		$sCode = $this->params()->fromRoute('code');

		$oEntityManager = $this->getEntityManager();
		/** @var $oRepositoryCode \PServerCMS\Entity\Repository\Usercodes */
		$oRepositoryCode = $oEntityManager->getRepository(Entity::UserCodes);
		$oCode = $oRepositoryCode->getData4CodeType($sCode, Usercodes::Type_LostPassword);

		if(!$oCode){
			return $this->forward()->dispatch('PServerCMS\Controller\Auth', array('action' => 'wrong-code'));
		}

		$oForm = $this->getPasswordForm();
		$oRequest = $this->getRequest();
		if($oRequest->isPost()){
			$oUser = $this->getUserService()->lostPwConfirm($this->params()->fromPost(), $oCode);
			if($oUser){
				return $this->redirect()->toRoute('auth', array('action' => 'pw-lost-confirm-done'));
			}
		}

		return array('pwLostForm' => $oForm);
	}

	public function pwLostConfirmDoneAction(){
		return array();
	}

	public function wrongCodeAction(){
		return array();
	}

	/**
	 * @return \Zend\Authentication\AuthenticationService
	 */
	protected function getAuthService() {
		if (!$this->authService) {
			$this->authService = $this->getServiceLocator()->get('user_auth_service');
		}

		return $this->authService;
	}

    /**
     * @return \PServerCMS\Form\Login
     */
    protected function getLoginForm() {
        if (!$this->loginForm) {
            $this->loginForm = $this->getServiceLocator()->get('pserver_user_login_form');
        }

        return $this->loginForm;
    }

	/**
	 * @return \PServerCMS\Form\Register
	 */
	protected function getRegisterForm() {
		if (!$this->registerForm) {
			$this->registerForm = $this->getServiceLocator()->get('pserver_user_register_form');
		}

		return $this->registerForm;
	}

	/**
	 * @return \PServerCMS\Form\Password
	 */
	protected function getPasswordForm() {
		if (!$this->passwordForm) {
			$this->passwordForm = $this->getServiceLocator()->get('pserver_user_password_form');
		}

		return $this->passwordForm;
	}

	/**
	 * @return \PServerCMS\Form\PwLost
	 */
	protected function getPasswordLostForm() {
		if (!$this->passwordLostForm) {
			$this->passwordLostForm = $this->getServiceLocator()->get('pserver_user_pwlost_form');
		}

		return $this->passwordLostForm;
	}

	/**
	 * @return \PServerCMS\Service\User
	 */
	protected function getUserService(){
		if (!$this->userService) {
			$this->userService = $this->getServiceLocator()->get('pserver_user_service');
		}

		return $this->userService;
	}

	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function getEntityManager(){
		if (!$this->entityManager) {
			$this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}

		return $this->entityManager;
	}
}
