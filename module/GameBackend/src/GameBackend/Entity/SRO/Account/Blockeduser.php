<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blockeduser
 *
 * @ORM\Table(name="_BlockedUser")
 * @ORM\Entity
 */
class BlockedUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="UserJID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userjid;

    /**
     * @var string
     *
     * @ORM\Column(name="UserID", type="string", length=128, nullable=false)
     */
    private $userid;

    /**
     * @var integer
     *
     * @ORM\Column(name="Type", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="SerialNo", type="integer", nullable=false)
     */
    private $serialno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeBegin", type="datetime", nullable=false)
     */
    private $timebegin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeEnd", type="datetime", nullable=false)
     */
    private $timeend;

	/**
	 * @param int $serialno
	 *
	 * @return BlockedUser
	 */
	public function setSerialno( $serialno ) {
		$this->serialno = $serialno;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSerialno() {
		return $this->serialno;
	}

	/**
	 * @param \DateTime $timebegin
	 *
	 * @return BlockedUser
	 */
	public function setTimebegin( $timebegin ) {
		$this->timebegin = $timebegin;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getTimebegin() {
		return $this->timebegin;
	}

	/**
	 * @param \DateTime $timeend
	 *
	 * @return BlockedUser
	 */
	public function setTimeend( $timeend ) {
		$this->timeend = $timeend;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getTimeend() {
		return $this->timeend;
	}

	/**
	 * @param int $type
	 *
	 * @return BlockedUser
	 */
	public function setType( $type ) {
		$this->type = $type;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $userid
	 *
	 * @return BlockedUser
	 */
	public function setUserid( $userid ) {
		$this->userid = $userid;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUserid() {
		return $this->userid;
	}

	/**
	 * @param int $userjid
	 *
	 * @return BlockedUser
	 */
	public function setUserjid( $userjid ) {
		$this->userjid = $userjid;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getUserjid() {
		return $this->userjid;
	}


}
