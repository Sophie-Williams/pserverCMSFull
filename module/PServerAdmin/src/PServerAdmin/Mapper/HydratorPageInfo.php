<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 21.08.14
 * Time: 22:19
 */

namespace PServerAdmin\Mapper;

use PServerCMS\Entity\PageInfo;
use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;

class HydratorPageInfo extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof PageInfo) {
			throw new Exception\InvalidArgumentException('$object must be an instance of PageInfo');
		}
		/* @var $object PageInfo */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return PageInfo
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof PageInfo) {
			throw new Exception\InvalidArgumentException('$object must be an instance of PageInfo');
		}
		return parent::hydrate($data, $object);
	}
} 