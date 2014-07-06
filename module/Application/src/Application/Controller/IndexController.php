<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
	public function indexAction() {

		$oObjectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

		$oEntityUser = new \Application\Entity\Frontend\User();
		$oEntityUser->setFullName('Test User');


		$oObjectManager->persist($oEntityUser);
		$oObjectManager->flush();

		\Zend\Debug\Debug::dump($oEntityUser);


		/** @var $oRepositoryUser \Doctrine\Common\Persistence\ObjectRepository */
		$oRepositoryUser = $oObjectManager->getRepository('Application\Entity\Frontend\User');

		\Zend\Debug\Debug::dump($oRepositoryUser->findBy(array('fullName' => 'Test User')));

		return new ViewModel();
	}
}
