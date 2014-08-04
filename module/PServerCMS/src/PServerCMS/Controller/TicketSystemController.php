<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 04.08.14
 * Time: 22:36
 */

namespace PServerCMS\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class TicketSystemController extends AbstractActionController {
	/** @var \PServerCMS\Form\TicketSystem */
	protected $ticketSystemNewForm;

	public function indexAction(){

	}

	public function newAction(){
		return array('form' => $this->getTicketSystemNewForm());
	}

	public function detailAction(){

	}

	/**
	 * @return \PServerCMS\Form\TicketSystem
	 */
	protected function getTicketSystemNewForm(){
		if (!$this->ticketSystemNewForm) {
			$this->ticketSystemNewForm = $this->getServiceLocator()->get('pserver_ticketsystem_new_form');
		}

		return $this->ticketSystemNewForm;
	}
} 