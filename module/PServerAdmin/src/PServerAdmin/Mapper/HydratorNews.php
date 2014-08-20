<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 20.08.14
 * Time: 22:40
 */

namespace PServerAdmin\Mapper;

use PServerCMS\Entity\News;
use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;

class HydratorNews extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof News) {
			throw new Exception\InvalidArgumentException('$object must be an instance of News');
		}
		/* @var $object News */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return News
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof News) {
			throw new Exception\InvalidArgumentException('$object must be an instance of News');
		}
		return parent::hydrate($data, $object);
	}
} 