<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 17.07.14
 * Time: 10:22
 */

namespace PServerCMS\View\Helper;


use Zend\Form\View\Helper\AbstractHelper;
use Zend\View\Model\ViewModel;

class SideBarWidget extends AbstractHelper {


	public function __invoke(){
		$oViewModel = new ViewModel();
		$oViewModel->setTemplate('helper/sidebarWidget');
		return $this->getView()->render($oViewModel);
	}

}