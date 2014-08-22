<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 22.08.14
 * Time: 22:08
 */

namespace PServerAdmin\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class DownloadFilter extends ProvidesEventsInputFilter {

	public function __construct() {

		$this->add(array(
			'name'       => 'hoster',
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
			'name'       => 'link',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 1
					),
				),
			),
		));

		$this->add(array(
			'name'       => 'memo',
			'required'   => false,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
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