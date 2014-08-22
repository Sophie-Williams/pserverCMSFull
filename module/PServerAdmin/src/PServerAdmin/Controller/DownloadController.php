<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 22.08.14
 * Time: 21:18
 */

namespace PServerAdmin\Controller;

use PServerAdmin\Mapper\HydratorDownload;
use Zend\Mvc\Controller\AbstractActionController;

class DownloadController extends AbstractActionController {

	/** @var \PServerCMS\Service\Download */
	protected $downloadService;

	public function indexAction(){
		return array(
			'download' => $this->getDownloadService()->getDownloadList()
		);
	}

	public function newAction(){
		$form = $this->getDownloadService()->getDownloadForm();

		$request = $this->getRequest();
		if($request->isPost()){
			$news = $this->getDownloadService()->download($this->params()->fromPost());
			if($news){
				return $this->redirect()->toRoute('admin_download');
			}
		}

		return array(
			'form' => $form
		);
	}

	public function detailAction(){
		$id = $this->params()->fromRoute('id');
		$download = $this->getDownloadService()->getDownload4Id($id);
		if(!$download){
			return $this->redirect()->toRoute('admin_download');
		}

		$form = $this->getDownloadService()->getDownloadForm();

		$request = $this->getRequest();
		if($request->isPost()){
			if($this->getDownloadService()->download($this->params()->fromPost(), $download)){
				return $this->redirect()->toRoute('admin_download');
			}
		}else{
			$downloadHydrator = new HydratorDownload();
			$form->setData($downloadHydrator->extract($download));
		}
		return array(
			'form' => $form
		);
	}

	/**
	 * @return \PServerCMS\Service\Download
	 */
	protected function getDownloadService(){
		if (!$this->downloadService) {
			$this->downloadService = $this->getServiceLocator()->get('pserver_download_service');
		}

		return $this->downloadService;
	}
} 