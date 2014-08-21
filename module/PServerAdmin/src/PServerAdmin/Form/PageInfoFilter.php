<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 21.08.14
 * Time: 22:23
 */

namespace PServerAdmin\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;

class PageInfoFilter extends ProvidesEventsInputFilter {

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
	}
} 