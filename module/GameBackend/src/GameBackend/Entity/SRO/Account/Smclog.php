<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * Smclog
 *
 * @ORM\Table(name="_SMCLog", indexes={@ORM\Index(name="IX_SMCLog", columns={"dLogDate"})})
 * @ORM\Entity
 */
class Smclog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="szUserID", type="string", length=128, nullable=false)
     */
    private $szuserid;

    /**
     * @var integer
     *
     * @ORM\Column(name="Catagory", type="smallint", nullable=false)
     */
    private $catagory;

    /**
     * @var string
     *
     * @ORM\Column(name="szLog", type="string", length=256, nullable=false)
     */
    private $szlog;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dLogDate", type="datetime", nullable=false)
     */
    private $dlogdate = 'CURRENT_TIMESTAMP';

	/**
	 * @param int $catagory
	 *
	 * @return Smclog
	 */
	public function setCatagory( $catagory ) {
		$this->catagory = $catagory;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getCatagory() {
		return $this->catagory;
	}

	/**
	 * @param \DateTime $dlogdate
	 *
	 * @return Smclog
	 */
	public function setDlogdate( $dlogdate ) {
		$this->dlogdate = $dlogdate;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDlogdate() {
		return $this->dlogdate;
	}

	/**
	 * @param int $id
	 *
	 * @return Smclog
	 */
	public function setId( $id ) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $szlog
	 *
	 * @return Smclog
	 */
	public function setSzlog( $szlog ) {
		$this->szlog = $szlog;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSzlog() {
		return $this->szlog;
	}

	/**
	 * @param string $szuserid
	 *
	 * @return Smclog
	 */
	public function setSzuserid( $szuserid ) {
		$this->szuserid = $szuserid;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSzuserid() {
		return $this->szuserid;
	}


}
