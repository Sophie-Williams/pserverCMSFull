<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 14.07.14
 * Time: 22:51
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class Register extends ProvidesEventsForm {

	public function __construct() {
		parent::__construct();
		$this->add(array(
			'name' => 'username',
			'options' => array(
				'label' => 'Username',
			),
			'attributes' => array(
				'type' => 'text'
			),
		));

		$this->add(array(
			'name' => 'email',
			'options' => array(
				'label' => 'Email',
			),
			'attributes' => array(
				'type' => 'email'
			),
		));
		$this->add(array(
			'name' => 'emailVerify',
			'options' => array(
				'label' => 'Email Verify',
			),
			'attributes' => array(
				'type' => 'email'
			),
		));

		$this->add(array(
			'name' => 'password',
			'options' => array(
				'label' => 'Password',
			),
			'attributes' => array(
				'type' => 'password'
			),
		));

		$this->add(array(
			'name' => 'passwordVerify',
			'options' => array(
				'label' => 'Password Verify',
			),
			'attributes' => array(
				'type' => 'password'
			),
		));


		$submitElement = new Element\Button('submit');
		$submitElement
			->setLabel('Register')
			->setAttributes(array(
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