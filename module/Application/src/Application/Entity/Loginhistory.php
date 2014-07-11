<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Loginhistory
 *
 * @ORM\Table(name="loginHistory", indexes={@ORM\Index(name="fk_loginHistory_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity
 */
class Loginhistory {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="lId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $lid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ip", type="string", length=60, nullable=false)
	 */
	private $ip;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 */
	private $created;

	/**
	 * @var \Application\Entity\Users
	 *
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Users")
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="users_usrId", referencedColumnName="usrId")
	 * })
	 */
	private $usersUsrid;

	public function __construct( ) {
		$this->created = new \DateTime();
	}

	/**
	 * Get lid
	 *
	 * @return integer
	 */
	public function getLid() {
		return $this->lid;
	}

	/**
	 * Set ip
	 *
	 * @param string $ip
	 *
	 * @return Loginhistory
	 */
	public function setIp( $ip ) {
		$this->ip = $ip;

		return $this;
	}

	/**
	 * Get ip
	 *
	 * @return string
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * Set created
	 *
	 * @param \DateTime $created
	 *
	 * @return Loginhistory
	 */
	public function setCreated( $created ) {
		$this->created = $created;

		return $this;
	}

	/**
	 * Get created
	 *
	 * @return \DateTime
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Set usersUsrid
	 *
	 * @param \Application\Entity\Users $usersUsrid
	 *
	 * @return Loginhistory
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
