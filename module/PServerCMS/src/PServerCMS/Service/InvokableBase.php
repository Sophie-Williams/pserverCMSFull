<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 18.08.14
 * Time: 22:42
 */

namespace PServerCMS\Service;

use SmallUser\Service\InvokableBase as UserBase;

class InvokableBase extends UserBase {

	/** @var \Zend\Cache\Storage\StorageInterface */
	protected $cachingService;
	/** @var  CachingHelper */
	protected $cachingHelperService;
	/** @var array */
	private $aConfig;

	/**
	 * @return array
	 */
	protected function getConfigData(){
		if(!$this->aConfig){
			$this->aConfig = $this->getServiceManager()->get('Config');
		}
		return $this->aConfig;
	}

	/**
	 * @return \Zend\Cache\Storage\StorageInterface
	 */
	protected function getCachingService(){
		if (!$this->cachingService) {
			$this->cachingService = $this->getServiceManager()->get('pserver_caching_service');
		}

		return $this->cachingService;
	}

	/**
	 * @return CachingHelper
	 */
	protected function getCachingHelperService(){
		if (!$this->cachingHelperService) {
			$this->cachingHelperService = $this->getServiceManager()->get('pserver_cachinghelper_service');
		}

		return $this->cachingHelperService;
	}
} 