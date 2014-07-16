<?php

namespace PServerCMS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use PServerCMS\Helper;
use Zend\Debug\Debug;

class IndexController extends AbstractActionController {
	public function indexAction() {
        //Debug::dump(Helper\ConfigRead::get('test.configtest'));

		/** @var $oRepositoryUser \Doctrine\Common\Persistence\ObjectRepository */
		//$oRepositoryUser = $this->getServiceLocator()->get('doctrine.entitymanager.orm_sro_account')->getRepository('GameBackend\Entity\SRO\Account\TbUser');
		//\Zend\Debug\Debug::dump($oRepositoryUser->findBy(array('struserid' => 'fantans')));
	//	\Zend\Debug\Debug::dump($oRepositoryUser->findBy(array()));

		//\Zend\Debug\Debug::dump($this->getServiceLocator()->get('dataservice')->getRandomNumber());

	//	$oObjectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
/*
		$oEntityUser = new \PServerCMS\Entity\Users();
		$oEntityUser->setUsername('UserZend'.rand(0,999));


		$oObjectManager->persist($oEntityUser);
		$oObjectManager->flush();
*/
		/** @var $oRepositoryUser \Doctrine\Common\Persistence\ObjectRepository */
	//	$oRepositoryUser = $oObjectManager->getRepository('PServerCMS\Entity\Users');

		//\Zend\Debug\Debug::dump($oRepositoryUser->findBy(array('StrUserID' => 'fantans')));
	//	\Zend\Debug\Debug::dump($oRepositoryUser->findBy(array()));

		return new ViewModel();
	}
}
