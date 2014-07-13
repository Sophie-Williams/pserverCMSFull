<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController {
	const ErrorNameSpace = 'user-auth';
	private $authservice;
	private $failedLoginMessage = 'Authentication failed. Please try again.';

	public function loginAction() {

		//if already login, redirect to success page
		if ($this->getAuthService()->hasIdentity()){
			return $this->redirect()->toRoute('home');
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
			return $this->redirect()->toRoute('home');
		}

		$this->flashMessenger()->setNamespace(self::ErrorNameSpace)->addMessage($this->failedLoginMessage);
		return $this->redirect()->toUrl($this->url()->fromRoute('auth'));
	}

	public function registerAction(){

		//if already login, redirect to success page
		if ($this->getAuthService()->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}

		return new ViewModel();
	}

	/**
	 * @return \Zend\Authentication\AuthenticationService
	 */
	protected function getAuthService() {
		if (! $this->authservice) {
			$this->authservice = $this->getServiceLocator()->get('user_auth_service');
		}

		return $this->authservice;
	}
}
