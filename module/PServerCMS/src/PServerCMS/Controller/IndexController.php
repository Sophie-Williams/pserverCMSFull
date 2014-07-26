<?php

namespace PServerCMS\Controller;

use PServerCMS\Keys\Entity;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
	/** @var \Doctrine\ORM\EntityManager $entityManager */
	protected $entityManager;

	public function indexAction() {
		return array(
			'aNews' => $this->getEntityManager()->getRepository(Entity::News)->getActiveNews()
		);
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
