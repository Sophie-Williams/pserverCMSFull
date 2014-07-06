<?php

namespace Application\Entity\Frontend;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class User {
	/**
	 * integer
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/**
	 * string
	 * @ORM\Column(type="string")
	 */
	protected $fullName;


	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $fullName
	 */
	public function setFullName( $fullName ) {
		$this->fullName = $fullName;
	}

	/**
	 * @return mixed
	 */
	public function getFullName() {
		return $this->fullName;
	}
}