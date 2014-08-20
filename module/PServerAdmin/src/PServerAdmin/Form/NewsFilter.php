<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 20.08.14
 * Time: 22:20
 */

namespace PServerAdmin\Form;


use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class NewsFilter extends ProvidesEventsInputFilter {

	public function __construct() {

		$this->add(array(
			'name'       => 'title',
			'required'   => true,
			'filters'    => array(array('name' => 'StringTrim')),
			'validators' => array(
				array(
					'name'    => 'StringLength',
					'options' => array(
						'min' => 1,
						'max' => 200,
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
	}
}