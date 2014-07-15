<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AuthController extends AbstractActionController {
	const ErrorNameSpace = 'user-auth';
	const RouteLoggedIn = 'home';

	private $failedLoginMessage = 'Authentication failed. Please try again.';

	protected $userService;
	protected $authService;
	protected $registerForm;

	public function loginAction() {

		//if already login, redirect to success page
		if ($this->getAuthService()->hasIdentity()){
			return $this->redirect()->toRoute(self::RouteLoggedIn);
		}

		$oRequest = $this->getRequest();

		if (!$oRequest->isPost()){
			return array('aErrorMessages'  => $this->flashmessenger()->getMessagesFromNamespace(self::ErrorNameSpace));
		}

		$oAuthService = $this->getAuthService();
		/** @var \DoctrineModule\Authentication\Adapter\ObjectRepository $oAdapter */
		$oAdapter = $oAuthService->getAdapter();
		$oAdapter->setIdentity($oRequest->getPost('username',''));
		$oAdapter->setCredential($oRequest->getPost('password',''));
		$oResult = $oAuthService->authenticate($oAdapter);


		if($oResult->isValid()){
			$bSuccess = true;
			/** @var \Application\Entity\Users $oUser */
			$oUser = $oResult->getIdentity();
			if(!(bool) $oUser->getUserRole()->getKeys()){
				$bSuccess = false;
				$this->setFailedLoginMessage('Your Account is not active, please confirm your email');
			}else{
				// TODO check country
			//}else{
				// TODO check if blocked
			}

			if($bSuccess){
				return $this->redirect()->toRoute(self::RouteLoggedIn);
			}else{
				// Login correct but not active or blocked or smth else
				$oAuthService->clearIdentity();
				$oAuthService->getStorage()->clear();
			}
		}

		$this->flashMessenger()->setNamespace(self::ErrorNameSpace)->addMessage($this->getFailedLoginMessage());
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

	/**
	 * @return \Zend\Authentication\AuthenticationService
	 */
	protected function getAuthService() {
		if (! $this->authService) {
			$this->authService = $this->getServiceLocator()->get('user_auth_service');
		}

		return $this->authService;
	}

	/**
	 * @return \Application\Form\Register
	 */
	protected function getRegisterForm() {
		if (! $this->registerForm) {
			$this->registerForm = $this->getServiceLocator()->get('pserver_user_register_form');
		}

		return $this->registerForm;
	}

	/**
	 * @return \Application\Service\User
	 */
	protected function getUserService(){
		if (! $this->userService) {
			$this->userService = $this->getServiceLocator()->get('pserver_user_service');
		}

		return $this->userService;
	}

	protected function setFailedLoginMessage( $sMessage ){
		$this->failedLoginMessage = $sMessage;
	}

	protected function getFailedLoginMessage(){
		return $this->failedLoginMessage;
	}
}