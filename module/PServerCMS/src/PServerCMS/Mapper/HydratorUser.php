<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 01:33
 */

namespace PServerCMS\Mapper;

use PServerCMS\Keys\Entity;
use ZfcUser\Mapper\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;
use PServerCMS\Entity\Users;

class HydratorUser extends ClassMethods {

	/**
	 * Extract values from an object
	 *
	 * @param  object $object
	 * @return array
	 * @throws Exception\InvalidArgumentException
	 */
	public function extract($object) {
		if (!$object instanceof Users) {
			throw new Exception\InvalidArgumentException('$object must be an instance of '.Entity::Users);
		}
		/* @var $object Users */
		$data = parent::extract($object);
		return $data;
	}

	/**
	 * Hydrate $object with the provided $data.
	 *
	 * @param  array $data
	 * @param  object $object
	 * @return Users
	 * @throws Exception\InvalidArgumentException
	 */
	public function hydrate(array $data, $object) {
		if (!$object instanceof Users) {
			throw new Exception\InvalidArgumentException('$object must be an instance of '.Entity::Users);
		}
		return parent::hydrate($data, $object);
	}

	protected function mapField($keyFrom, $keyTo, array $aArray) {
		if(!isset($aArray[$keyFrom])){
			return $aArray;
		}
		$aArray[$keyTo] = $aArray[$keyFrom];
		unset($aArray[$keyFrom]);
		return $aArray;
	}
}