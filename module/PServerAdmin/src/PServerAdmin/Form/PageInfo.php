<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 21.08.14
 * Time: 22:23
 */

namespace PServerAdmin\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class PageInfo extends ProvidesEventsForm {

	public function __construct() {
		parent::__construct();

		$this->add(array(
			'name' => 'title',
			'options' => array(
				'label' => 'Title',
			),
			'attributes' => array(
				'placeholder' => 'Title',
				'class' => 'form-control',
			),
		));

		$this->add(array(
			'name' => 'memo',
			'type' => 'Zend\Form\Element\Textarea',
			'options' => array(
				'label' => 'Memo',
			),
			'attributes' => array(
				'placeholder' => 'Memo',
				'class' => 'form-control',
			),
		));


		/*
		$this->add(array(
			'name' => 'security',
			'type' => 'Zend\Form\Element\Csrf'
		));
		*/

		$submitElement = new Element\Button('submit');
		$submitElement
			->setLabel('Submit')
			->setAttributes(array(
				'class' => 'btn btn-default',
				'type'  => 'submit',
			));

		$this->add($submitElement, array(
			'priority' => -100,
		));
		/**
		$csrf = new Element\Csrf('csrf');
		$this->add($csrf->getCsrfValidator());
		 */
	}
} 