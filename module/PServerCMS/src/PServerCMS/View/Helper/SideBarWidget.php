<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 17.07.14
 * Time: 10:22
 */

namespace PServerCMS\View\Helper;


use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

class SideBarWidget extends AbstractHelper {

	/**
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;

	/**
	 * @var \Zend\Authentication\AuthenticationService
	 */
	protected $authService;

	/**
	 * @param ServiceLocatorInterface $serviceLocatorInterface
	 */
	public function __construct(ServiceLocatorInterface $serviceLocatorInterface){
		$this->setServiceLocator($serviceLocatorInterface);
	}

	public function __invoke(){
		$sTemplate = '';
		if($this->getAuthService()->getIdentity()){
			$oViewModel = new ViewModel(array(
				'user' => $this->getAuthService()->getIdentity()
			));
			$oViewModel->setTemplate('helper/sidebarLoggedInWidget');
			$sTemplate = $this->getView()->render($oViewModel);
		}
		$oViewModel = new ViewModel();
		$oViewModel->setTemplate('helper/sidebarWidget');
		return $sTemplate.$this->getView()->render($oViewModel);
	}

	public function getServiceLocator(){
		return $this->serviceLocator;
	}

	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 *
	 * @return $this
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocator = $serviceLocator;

		return $this;
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

}