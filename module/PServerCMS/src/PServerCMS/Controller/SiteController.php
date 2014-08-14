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
	/** @var \PServerCMS\Service\Download */
	protected $downloadService;

	/**
	 * DownloadPage
	 */
	public function downloadAction(){
		return array(
			'aDownloadList' => $this->getDownloadService()->getActiveList()
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
	 * @return \PServerCMS\Service\Download
	 */
	public function getDownloadService(){
		if (!$this->downloadService) {
			$this->downloadService = $this->getServiceLocator()->get('pserver_download_service');
		}

		return $this->downloadService;
	}
} 