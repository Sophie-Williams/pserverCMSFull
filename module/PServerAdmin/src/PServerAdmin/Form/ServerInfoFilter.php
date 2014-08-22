<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 22.08.14
 * Time: 22:10
 */

namespace PServerAdmin\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class ServerInfoFilter extends ProvidesEventsInputFilter {

	public function __construct() {

		$this->add(array(
			'name'       => 'icon',
			'required'   => false,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'max' => 50,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'label',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 1,
						'max' => 50,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'memo',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 1,
						'max' => 50,
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'active',
			'required'   => true,
			'validators' => array(
				array(
					'name'    => 'InArray',
					'options' => array(
						'haystack' => array(0,1),
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'sortkey',
			'required'   => false,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'Digits'
				),
			),
		));
	}
} 