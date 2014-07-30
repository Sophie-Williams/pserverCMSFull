<?php

namespace PServerCMS\Controller;

use PServerCMS\Keys\Entity;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController {
	/** @var \Doctrine\ORM\EntityManager $entityManager */
	protected $entityManager;

	public function indexAction() {
		/** @var \PServerCMS\Entity\Repository\News $oRepositoryNews */
		$oRepositoryNews = $this->getEntityManager()->getRepository(Entity::News);

		return array(
			'aNews' => $oRepositoryNews->getActiveNews()
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
