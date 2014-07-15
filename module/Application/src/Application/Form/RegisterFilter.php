<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 14.07.14
 * Time: 23:21
 */

namespace Application\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;
use Application\Validator\AbstractRecord;

class RegisterFilter extends ProvidesEventsInputFilter {

	/**
	 * @var AbstractRecord
	 */
	protected $usernameValidator;


	public function __construct( AbstractRecord $usernameValidator ){
		$this->setUsernameValidator( $usernameValidator );

		$this->add(array(
			'name'       => 'username',
			'required'   => true,
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 3,
						'max' => 255,
					),
				),
				$this->getUsernameValidator(),
			),
		));

		$this->add(array(
			'name'       => 'email',
			'required'   => true,
			'validators' => array(
				array(
					'name' => 'EmailAddress'
				),
			),
		));

		$this->add(array(
			'name'       => 'emailVerify',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 6,
					),
				),
				array(
					'name'    => 'Identical',
					'options' => array(
						'token' => 'email',
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'password',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 6,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'passwordVerify',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 6,
					),
				),
				array(
					'name'    => 'Identical',
					'options' => array(
						'token' => 'password',
					),
				),
			),
		));
	}

	/**
	 * @return AbstractRecord
	 */
	public function getUsernameValidator()	{
		return $this->usernameValidator;
	}

	/**
	 * @param AbstractRecord $usernameValidator
	 *
	 * @return $this
	 */
	public function setUsernameValidator($usernameValidator) {
		$this->usernameValidator = $usernameValidator;
		return $this;
	}
} 