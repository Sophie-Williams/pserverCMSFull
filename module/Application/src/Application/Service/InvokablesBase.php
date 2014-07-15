<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 18:52
 */

namespace Application\Service;


use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class InvokablesBase implements ServiceManagerAwareInterface {

	/**
	 * @var ServiceManager
	 */
	protected $serviceManager;

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $entityManager;


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


	public function getEntityManager(){
		if (! $this->entityManager) {
			$this->entityManager = $this->getServiceManager()->get('Doctrine\ORM\EntityManager');
		}

		return $this->entityManager;
	}
}