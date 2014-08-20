<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 20.08.14
 * Time: 20:31
 */

namespace PServerAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class NewsController extends AbstractActionController {
	/** @var \PServerCMS\Service\News */
	protected $newsService;

	public function indexAction(){
		return array(
			'news' => $this->getNewsService()->getNews()
		);
	}

	public function detailAction(){

	}

	public function newAction(){

	}

	/**
	 * @return \PServerCMS\Service\News
	 */
	protected function getNewsService(){
		if (!$this->newsService) {
			$this->newsService = $this->getServiceLocator()->get('pserver_news_service');
		}

		return $this->newsService;
	}

} 