<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TB_User")
 */
class User {
	/**
	 * integer
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $JID;

	/**
	 * string
	 * @ORM\Column(type="string")
	 */
	protected $StrUserID;

	/**
	 * string
	 * @ORM\Column(type="string")
	 */
	protected $Password;

	/**
	 * @param mixed $JID
	 */
	public function setJID( $JID ) {
		$this->JID = $JID;
	}

	/**
	 * @return mixed
	 */
	public function getJID() {
		return $this->JID;
	}

	/**
	 * @param mixed $Password
	 */
	public function setPassword( $Password ) {
		$this->Password = $Password;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->Password;
	}

	/**
	 * @param mixed $StrUserID
	 */
	public function setStrUserID( $StrUserID ) {
		$this->StrUserID = $StrUserID;
	}

	/**
	 * @return mixed
	 */
	public function getStrUserID() {
		return $this->StrUserID;
	}
}