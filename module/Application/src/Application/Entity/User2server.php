<?php

namespace Application\Entity;

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
	 * @ORM\Column(name="userServerId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $userserverid;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="backendId", type="integer", nullable=false)
	 */
	private $backendid;

	/**
	 * @var \Application\Entity\Users
	 *
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Users")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="users_usrId", referencedColumnName="usrId")
	 * })
	 */
	private $usersUsrid;


	/**
	 * Get userserverid
	 *
	 * @return integer
	 */
	public function getUserserverid() {
		return $this->userserverid;
	}

	/**
	 * Set backendid
	 *
	 * @param integer $backendid
	 *
	 * @return User2server
	 */
	public function setBackendid( $backendid ) {
		$this->backendid = $backendid;

		return $this;
	}

	/**
	 * Get backendid
	 *
	 * @return integer
	 */
	public function getBackendid() {
		return $this->backendid;
	}

	/**
	 * Set usersUsrid
	 *
	 * @param \Application\Entity\Users $usersUsrid
	 *
	 * @return User2server
	 */
	public function setUsersUsrid( \Application\Entity\Users $usersUsrid = null ) {
		$this->usersUsrid = $usersUsrid;

		return $this;
	}

	/**
	 * Get usersUsrid
	 *
	 * @return \Application\Entity\Users
	 */
	public function getUsersUsrid() {
		return $this->usersUsrid;
	}
}
