<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 22.08.14
 * Time: 22:41
 */

namespace PServerAdmin\Mapper;

use PServerCMS\Entity\ServerInfo;
use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;

class HydratorServerInfo extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof ServerInfo) {
			throw new Exception\InvalidArgumentException('$object must be an instance of ServerInfo');
		}
		/* @var $object ServerInfo */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return ServerInfo
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof ServerInfo) {
			throw new Exception\InvalidArgumentException('$object must be an instance of ServerInfo');
		}
		return parent::hydrate($data, $object);
	}
} 