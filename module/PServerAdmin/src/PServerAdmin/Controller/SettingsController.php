<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 21.08.14
 * Time: 22:04
 */

namespace PServerAdmin\Controller;

use PServerAdmin\Mapper\HydratorPageInfo;
use Zend\Mvc\Controller\AbstractActionController;

class SettingsController extends AbstractActionController {

	protected $pageInfoTypes = array('faq','rules','guides','events');
	protected $pageInfoService;

	public function pageInfoAction(){
		$type = $this->params()->fromRoute('type');
		if(!in_array($type, $this->pageInfoTypes)){
			return $this->redirect()->toRoute('admin_home');
		}

		$form = $this->getPageInfoService()->getPageInfoForm();

		$this->getPageInfoService()->getPage4Type($type);
		$request = $this->getRequest();
		if($request->isPost()){
			if($this->getPageInfoService()->pageInfo($this->params()->fromPost(), $type)){
				return $this->redirect()->toRoute('admin_settings', array('action' => 'pageInfo', 'type' => $type));
			}
		}else{
			$pageInfo = $this->getPageInfoService()->getPage4Type($type);
			if($pageInfo){
				$pageInfoHydrator = new HydratorPageInfo();
				$form->setData($pageInfoHydrator->extract($pageInfo));
			}
		}
		return array(
			'form' => $form
		);

	}

	/**
	 * @return \PServerCMS\Service\PageInfo
	 */
	protected function getPageInfoService(){
		if (!$this->pageInfoService) {
			$this->pageInfoService = $this->getServiceLocator()->get('pserver_pageinfo_service');
		}

		return $this->pageInfoService;
	}
} 