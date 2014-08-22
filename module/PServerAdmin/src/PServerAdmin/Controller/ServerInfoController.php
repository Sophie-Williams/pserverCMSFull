<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 22.08.14
 * Time: 21:18
 */

namespace PServerAdmin\Controller;

use PServerAdmin\Mapper\HydratorServerInfo;
use Zend\Mvc\Controller\AbstractActionController;

class ServerInfoController extends AbstractActionController {

	/** @var \PServerCMS\Service\ServerInfo */
	protected $serverInfoService;

	public function indexAction(){
		return array(
			'serverInfo' => $this->getServerInfoService()->getAllServerInfo()
		);
	}

	public function newAction(){
		$form = $this->getServerInfoService()->getServerInfoForm();

		$request = $this->getRequest();
		if($request->isPost()){
			$news = $this->getServerInfoService()->serverInfo($this->params()->fromPost());
			if($news){
				return $this->redirect()->toRoute('admin_server_info');
			}
		}

		return array(
			'form' => $form
		);
	}

	public function detailAction(){
		$id = $this->params()->fromRoute('id');
		$info = $this->getServerInfoService()->getServerInfo4Id($id);
		if(!$info){
			return $this->redirect()->toRoute('admin_server_info');
		}

		$form = $this->getServerInfoService()->getServerInfoForm();

		$request = $this->getRequest();
		if($request->isPost()){
			if($this->getServerInfoService()->serverInfo($this->params()->fromPost(), $info)){
				return $this->redirect()->toRoute('admin_server_info');
			}
		}else{
			$infoHydrator = new HydratorServerInfo();
			$form->setData($infoHydrator->extract($info));
		}
		return array(
			'form' => $form
		);
	}


	/**
	 * @return \PServerCMS\Service\ServerInfo
	 */
	protected function getServerInfoService(){
		if (!$this->serverInfoService) {
			$this->serverInfoService = $this->getServiceLocator()->get('pserver_server_info_service');
		}

		return $this->serverInfoService;
	}
} 