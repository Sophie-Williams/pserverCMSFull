<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 17.07.14
 * Time: 10:54
 */

namespace PServerCMS\Controller;


use PServerCMS\Keys\Entity;
use Zend\Mvc\Controller\AbstractActionController;

class SiteController extends AbstractActionController {
	/** @var \Doctrine\ORM\EntityManager $entityManager */
	protected $entityManager;

	/**
	 * DownloadPage
	 */
	public function downloadAction(){
		/** @var \PServerCMS\Entity\Repository\DownloadList $oRepositoryDownload */
		$oRepositoryDownload = $this->getEntityManager()->getRepository(Entity::DownloadList);

		return array(
			'aDownloadList' => $oRepositoryDownload->getActiveDownloadList()
		);
	}

	/**
	 * FAQPage
	 */
	public function faqAction(){
		return array();
	}

	/**
	 * RulesPage
	 */
	public function rulesAction(){
		return array();
	}

	/**
	 * GuidesPage
	 */
	public function guidesAction(){
		return array();
	}

	/**
	 * EventsPage
	 */
	public function eventsAction(){
		return array();
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