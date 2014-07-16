<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 18:52
 */

namespace GameBackend\DataService;


use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class InvokableBase implements ServiceManagerAwareInterface {

	/**
	 * @var ServiceManager
	 */
	protected $serviceManager;

	/**
	 * @var array
	 */
	protected $config;

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

	/**
	 * @return array
	 */
	public function getConfig(){
		if(!$this->config){
			$aConfig = $this->getServiceManager()->get('Config');
			$this->config = $aConfig['pserver'];
		}

		return $this->config;
	}
}