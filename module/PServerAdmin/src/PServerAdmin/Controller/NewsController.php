<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 20.08.14
 * Time: 20:31
 */

namespace PServerAdmin\Controller;

use PServerAdmin\Mapper\HydratorNews;
use Zend\Mvc\Controller\AbstractActionController;

class NewsController extends AbstractActionController {
	/** @var \PServerCMS\Service\News */
	protected $newsService;
	protected $authService;

	public function indexAction(){
		return array(
			'news' => $this->getNewsService()->getNews()
		);
	}

	public function detailAction(){
		$id = $this->params()->fromRoute('id');
		$news = $this->getNewsService()->getNews4Id($id);
		if(!$news){
			return $this->redirect()->toRoute('admin_news');
		}

		$form = $this->getNewsService()->getNewsForm();

		$request = $this->getRequest();
		if($request->isPost()){
			if($this->getNewsService()->newsEdit($this->params()->fromPost(), $news)){
				return $this->redirect()->toRoute('admin_news');
			}
		}else{
			$newsHydrator = new HydratorNews();
			$form->setData($newsHydrator->extract($news));
		}
		return array(
			'form' => $form
		);
	}

	public function newAction(){
		$form = $this->getNewsService()->getNewsForm();

		$request = $this->getRequest();
		if($request->isPost()){
			$news = $this->getNewsService()->news($this->params()->fromPost(), $this->getAuthService()->getIdentity());
			if($news){
				return $this->redirect()->toRoute('admin_news');
			}
		}

		return array(
			'form' => $form
		);
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

	/**
	 * @return \Zend\Authentication\AuthenticationService
	 */
	protected function getAuthService() {
		if (!$this->authService) {
			$this->authService = $this->getServiceLocator()->get('small_user_auth_service');
		}

		return $this->authService;
	}

} 