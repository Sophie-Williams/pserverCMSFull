<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * Punishment
 *
 * @ORM\Table(name="_Punishment", indexes={@ORM\Index(name="IX__Punishment", columns={"UserJID"})})
 * @ORM\Entity
 */
class Punishment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SerialNo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $serialno;

    /**
     * @var integer
     *
     * @ORM\Column(name="UserJID", type="integer", nullable=false)
     */
    private $userjid;

    /**
     * @var integer
     *
     * @ORM\Column(name="Type", type="smallint", nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Executor", type="string", length=128, nullable=false)
     */
    private $executor;

    /**
     * @var integer
     *
     * @ORM\Column(name="Shard", type="smallint", nullable=false)
     */
    private $shard;

    /**
     * @var string
     *
     * @ORM\Column(name="CharName", type="string", length=64, nullable=true)
     */
    private $charname;

    /**
     * @var string
     *
     * @ORM\Column(name="CharInfo", type="string", length=256, nullable=false)
     */
    private $charinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="PosInfo", type="string", length=64, nullable=false)
     */
    private $posinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="Guide", type="string", length=512, nullable=false)
     */
    private $guide;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=1024, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RaiseTime", type="datetime", nullable=false)
     */
    private $raisetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="BlockStartTime", type="datetime", nullable=false)
     */
    private $blockstarttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="BlockEndTime", type="datetime", nullable=false)
     */
    private $blockendtime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PunishTime", type="datetime", nullable=false)
     */
    private $punishtime;

    /**
     * @var integer
     *
     * @ORM\Column(name="Status", type="smallint", nullable=false)
     */
    private $status;

	/**
	 * @param \DateTime $blockendtime
	 *
	 * @return Punishment
	 */
	public function setBlockendtime( $blockendtime ) {
		$this->blockendtime = $blockendtime;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getBlockendtime() {
		return $this->blockendtime;
	}

	/**
	 * @param \DateTime $blockstarttime
	 *
	 * @return Punishment
	 */
	public function setBlockstarttime( $blockstarttime ) {
		$this->blockstarttime = $blockstarttime;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getBlockstarttime() {
		return $this->blockstarttime;
	}

	/**
	 * @param string $charinfo
	 *
	 * @return Punishment
	 */
	public function setCharinfo( $charinfo ) {
		$this->charinfo = $charinfo;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCharinfo() {
		return $this->charinfo;
	}

	/**
	 * @param string $charname
	 *
	 * @return Punishment
	 */
	public function setCharname( $charname ) {
		$this->charname = $charname;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCharname() {
		return $this->charname;
	}

	/**
	 * @param string $description
	 *
	 * @return Punishment
	 */
	public function setDescription( $description ) {
		$this->description = $description;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $executor
	 *
	 * @return Punishment
	 */
	public function setExecutor( $executor ) {
		$this->executor = $executor;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getExecutor() {
		return $this->executor;
	}

	/**
	 * @param string $guide
	 *
	 * @return Punishment
	 */
	public function setGuide( $guide ) {
		$this->guide = $guide;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getGuide() {
		return $this->guide;
	}

	/**
	 * @param string $posinfo
	 *
	 * @return Punishment
	 */
	public function setPosinfo( $posinfo ) {
		$this->posinfo = $posinfo;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPosinfo() {
		return $this->posinfo;
	}

	/**
	 * @param \DateTime $punishtime
	 *
	 * @return Punishment
	 */
	public function setPunishtime( $punishtime ) {
		$this->punishtime = $punishtime;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getPunishtime() {
		return $this->punishtime;
	}

	/**
	 * @param \DateTime $raisetime
	 *
	 * @return Punishment
	 */
	public function setRaisetime( $raisetime ) {
		$this->raisetime = $raisetime;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getRaisetime() {
		return $this->raisetime;
	}

	/**
	 * @param int $serialno
	 *
	 * @return Punishment
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
	 * @param int $shard
	 *
	 * @return Punishment
	 */
	public function setShard( $shard ) {
		$this->shard = $shard;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getShard() {
		return $this->shard;
	}

	/**
	 * @param int $status
	 *
	 * @return Punishment
	 */
	public function setStatus( $status ) {
		$this->status = $status;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param int $type
	 *
	 * @return Punishment
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
	 * @param int $userjid
	 *
	 * @return Punishment
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
