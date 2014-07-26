<?php

namespace PServerCMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ipblock
 *
 * @ORM\Table(name="ipBlock")
 * @ORM\Entity(repositoryClass="PServerCMS\Entity\Repository\IPBlock")
 */
class Ipblock {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="bId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $bid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ip", type="string", length=60, nullable=false)
	 */
	private $ip;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="expire", type="datetime", nullable=false)
	 */
	private $expire;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 */
	private $created;

	public function __construct( ) {
		$this->created = new \DateTime();
	}

	/**
	 * Get bid
	 *
	 * @return integer
	 */
	public function getBid() {
		return $this->bid;
	}

	/**
	 * Set ip
	 *
	 * @param string $ip
	 *
	 * @return Ipblock
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
	 * Set expire
	 *
	 * @param integer $expire
	 *
	 * @return Ipblock
	 */
	public function setExpire( $expire ) {
		$this->expire = $expire;

		return $this;
	}

	/**
	 * Get expire
	 *
	 * @return integer
	 */
	public function getExpire() {
		return $this->expire;
	}

	/**
	 * Set created
	 *
	 * @param integer $created
	 *
	 * @return Ipblock
	 */
	public function setCreated( $created ) {
		$this->created = $created;

		return $this;
	}

	/**
	 * Get created
	 *
	 * @return integer
	 */
	public function getCreated() {
		return $this->created;
	}
}
