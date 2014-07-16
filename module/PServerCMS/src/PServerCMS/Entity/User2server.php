<?php

namespace PServerCMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User2server
 *
 * @ORM\Table(name="user2Server", indexes={@ORM\Index(name="fk_user2Server_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity
 */
class User2server {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="users_usrId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $userid;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="backendId", type="integer", nullable=false)
	 */
	private $backendid;


	/**
	 * Get userid
	 *
	 * @return integer
	 */
	public function getUserId() {
		return $this->userid;
	}

	/**
	 * Set userid
	 *
	 * @return User2server
	 */
	public function setUserId( $iUserId ) {
		$this->userid = $iUserId;

		return $this;
	}

	/**
	 * Set backendid
	 *
	 * @param integer $backendId
	 *
	 * @return User2server
	 */
	public function setBackendId( $backendId ) {
		$this->backendid = $backendId;

		return $this;
	}

	/**
	 * Get backendid
	 *
	 * @return integer
	 */
	public function getBackendId() {
		return $this->backendid;
	}

}
