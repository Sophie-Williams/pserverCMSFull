<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 17.07.14
 * Time: 10:22
 */

namespace PServerCMS\View\Helper;


use PServerCMS\Helper\Timer;
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
	 * @var array
	 */
	protected $configService;

	/**
	 * @var array
	 */
	protected $timerService;

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
		$oViewModel = new ViewModel(array(
			'timer' => $this->getTimer()
		));
		$oViewModel->setTemplate('helper/sidebarWidget');
		return $sTemplate.$this->getView()->render($oViewModel);
	}

	/**
	 * @return ServiceLocatorInterface
	 */
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

	/**
	 * @return array
	 */
	protected function getConfigService(){
		if (!$this->configService) {
			$this->configService = $this->getServiceLocator()->get('Config');
		}

		return $this->configService;
	}

	protected function getTimer(){
		if(!$this->timerService){
			$aConfig = $this->getConfigService();
			$aTimerConfig = isset($aConfig['pserver']['timer'])?$aConfig['pserver']['timer']:array();
			foreach($aTimerConfig as $aCurData){
				$iTime = 0;
				$sText = '';
				if(!isset($aCurData['type'])){
					if(isset($aCurData['days'])){
						$iTime = Timer::getNextTimeDay( $aCurData['days'], $aCurData['hour'], $aCurData['min'] );
					}else{
						$iTime = Timer::getNextTime( $aCurData['hours'],$aCurData['min'] );
					}
				}else{
					$sText = $aCurData['time'];
				}
				$this->timerService[] = array('time' => $iTime, 'text' => $sText, 'name' => $aCurData['name'], 'icon' => $aCurData['icon']);
			}
		}

		return $this->timerService;
	}
}