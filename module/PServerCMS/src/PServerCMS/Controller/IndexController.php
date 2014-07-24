<?php

namespace PServerCMS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use PServerCMS\Helper;

class IndexController extends AbstractActionController {
	public function indexAction() {

		return new ViewModel();
	}
}
