<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkSilkchangeByWeb
 *
 * @ORM\Table(name="SK_SilkChange_BY_Web")
 * @ORM\Entity
 */
class SkSilkchangeByWeb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="JID", type="integer", nullable=false)
     */
    private $jid;

    /**
     * @var integer
     *
     * @ORM\Column(name="silk_remain", type="integer", nullable=false)
     */
    private $silkRemain;

    /**
     * @var integer
     *
     * @ORM\Column(name="silk_offset", type="integer", nullable=false)
     */
    private $silkOffset;

    /**
     * @var integer
     *
     * @ORM\Column(name="silk_type", type="smallint", nullable=false)
     */
    private $silkType;

    /**
     * @var integer
     *
     * @ORM\Column(name="reason", type="smallint", nullable=false)
     */
    private $reason;

	/**
	 * @param int $id
	 *
	 * @return SkSilkchangeByWeb
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
	 * @param int $jid
	 *
	 * @return SkSilkchangeByWeb
	 */
	public function setJid( $jid ) {
		$this->jid = $jid;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getJid() {
		return $this->jid;
	}

	/**
	 * @param int $reason
	 *
	 * @return SkSilkchangeByWeb
	 */
	public function setReason( $reason ) {
		$this->reason = $reason;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getReason() {
		return $this->reason;
	}

	/**
	 * @param int $silkOffset
	 *
	 * @return SkSilkchangeByWeb
	 */
	public function setSilkOffset( $silkOffset ) {
		$this->silkOffset = $silkOffset;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilkOffset() {
		return $this->silkOffset;
	}

	/**
	 * @param int $silkRemain
	 *
	 * @return SkSilkchangeByWeb
	 */
	public function setSilkRemain( $silkRemain ) {
		$this->silkRemain = $silkRemain;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilkRemain() {
		return $this->silkRemain;
	}

	/**
	 * @param int $silkType
	 *
	 * @return SkSilkchangeByWeb
	 */
	public function setSilkType( $silkType ) {
		$this->silkType = $silkType;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilkType() {
		return $this->silkType;
	}


}
