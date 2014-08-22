<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 22.08.14
 * Time: 22:41
 */

namespace PServerAdmin\Mapper;

use PServerCMS\Entity\Downloadlist;
use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;

class HydratorDownload extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof Downloadlist) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Downloadlist');
		}
		/* @var $object Downloadlist */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return Downloadlist
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof Downloadlist) {
			throw new Exception\InvalidArgumentException('$object must be an instance of Downloadlist');
		}
		return parent::hydrate($data, $object);
	}
} 