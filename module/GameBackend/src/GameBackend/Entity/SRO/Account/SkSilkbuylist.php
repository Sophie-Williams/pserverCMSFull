<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkSilkBuyList
 *
 * @ORM\Table(name="SK_SilkBuyList")
 * @ORM\Entity
 */
class SkSilkBuyList
{
    /**
     * @var integer
     *
     * @ORM\Column(name="BuyID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $buyid;

    /**
     * @var integer
     *
     * @ORM\Column(name="BuyNo", type="integer", nullable=false)
     */
    private $buyno;

    /**
     * @var integer
     *
     * @ORM\Column(name="UserJID", type="integer", nullable=false)
     */
    private $userjid;

    /**
     * @var integer
     *
     * @ORM\Column(name="Silk_Type", type="smallint", nullable=false)
     */
    private $silkType;

    /**
     * @var integer
     *
     * @ORM\Column(name="Silk_Reason", type="smallint", nullable=false)
     */
    private $silkReason;

    /**
     * @var integer
     *
     * @ORM\Column(name="Silk_Offset", type="integer", nullable=false)
     */
    private $silkOffset;

    /**
     * @var integer
     *
     * @ORM\Column(name="Silk_Remain", type="integer", nullable=false)
     */
    private $silkRemain;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="BuyQuantity", type="integer", nullable=false)
     */
    private $buyquantity;

    /**
     * @var string
     *
     * @ORM\Column(name="OrderNumber", type="string", length=30, nullable=false)
     */
    private $ordernumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="PGCompany", type="smallint", nullable=true)
     */
    private $pgcompany;

    /**
     * @var integer
     *
     * @ORM\Column(name="PayMethod", type="smallint", nullable=true)
     */
    private $paymethod;

    /**
     * @var string
     *
     * @ORM\Column(name="PGUniqueNo", type="string", length=20, nullable=true)
     */
    private $pguniqueno;

    /**
     * @var string
     *
     * @ORM\Column(name="AuthNumber", type="string", length=14, nullable=true)
     */
    private $authnumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="AuthDate", type="datetime", nullable=true)
     */
    private $authdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="SubJID", type="integer", nullable=true)
     */
    private $subjid;

    /**
     * @var string
     *
     * @ORM\Column(name="srID", type="string", length=25, nullable=true)
     */
    private $srid;

    /**
     * @var string
     *
     * @ORM\Column(name="SlipPaper", type="string", length=128, nullable=false)
     */
    private $slippaper;

    /**
     * @var integer
     *
     * @ORM\Column(name="MngID", type="integer", nullable=true)
     */
    private $mngid;

    /**
     * @var string
     *
     * @ORM\Column(name="IP", type="string", length=16, nullable=true)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="RegDate", type="datetime", nullable=false)
     */
    private $regdate;

	/**
	 * @param \DateTime $authdate
	 *
	 * @return SkSilkBuyList
	 */
	public function setAuthdate( $authdate ) {
		$this->authdate = $authdate;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getAuthdate() {
		return $this->authdate;
	}

	/**
	 * @param string $authnumber
	 *
	 * @return SkSilkBuyList
	 */
	public function setAuthnumber( $authnumber ) {
		$this->authnumber = $authnumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAuthnumber() {
		return $this->authnumber;
	}

	/**
	 * @param int $buyid
	 *
	 * @return SkSilkBuyList
	 */
	public function setBuyid( $buyid ) {
		$this->buyid = $buyid;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getBuyid() {
		return $this->buyid;
	}

	/**
	 * @param int $buyno
	 *
	 * @return SkSilkBuyList
	 */
	public function setBuyno( $buyno ) {
		$this->buyno = $buyno;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getBuyno() {
		return $this->buyno;
	}

	/**
	 * @param int $buyquantity
	 *
	 * @return SkSilkBuyList
	 */
	public function setBuyquantity( $buyquantity ) {
		$this->buyquantity = $buyquantity;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getBuyquantity() {
		return $this->buyquantity;
	}

	/**
	 * @param int $id
	 *
	 * @return SkSilkBuyList
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
	 * @param string $ip
	 *
	 * @return SkSilkBuyList
	 */
	public function setIp( $ip ) {
		$this->ip = $ip;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * @param int $mngid
	 *
	 * @return SkSilkBuyList
	 */
	public function setMngid( $mngid ) {
		$this->mngid = $mngid;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getMngid() {
		return $this->mngid;
	}

	/**
	 * @param string $ordernumber
	 *
	 * @return SkSilkBuyList
	 */
	public function setOrdernumber( $ordernumber ) {
		$this->ordernumber = $ordernumber;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrdernumber() {
		return $this->ordernumber;
	}

	/**
	 * @param int $paymethod
	 *
	 * @return SkSilkBuyList
	 */
	public function setPaymethod( $paymethod ) {
		$this->paymethod = $paymethod;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getPaymethod() {
		return $this->paymethod;
	}

	/**
	 * @param int $pgcompany
	 *
	 * @return SkSilkBuyList
	 */
	public function setPgcompany( $pgcompany ) {
		$this->pgcompany = $pgcompany;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getPgcompany() {
		return $this->pgcompany;
	}

	/**
	 * @param string $pguniqueno
	 *
	 * @return SkSilkBuyList
	 */
	public function setPguniqueno( $pguniqueno ) {
		$this->pguniqueno = $pguniqueno;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPguniqueno() {
		return $this->pguniqueno;
	}

	/**
	 * @param \DateTime $regdate
	 *
	 * @return SkSilkBuyList
	 */
	public function setRegdate( $regdate ) {
		$this->regdate = $regdate;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getRegdate() {
		return $this->regdate;
	}

	/**
	 * @param int $silkOffset
	 *
	 * @return SkSilkBuyList
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
	 * @param int $silkReason
	 *
	 * @return SkSilkBuyList
	 */
	public function setSilkReason( $silkReason ) {
		$this->silkReason = $silkReason;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilkReason() {
		return $this->silkReason;
	}

	/**
	 * @param int $silkRemain
	 *
	 * @return SkSilkBuyList
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
	 * @return SkSilkBuyList
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

	/**
	 * @param string $slippaper
	 *
	 * @return SkSilkBuyList
	 */
	public function setSlippaper( $slippaper ) {
		$this->slippaper = $slippaper;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSlippaper() {
		return $this->slippaper;
	}

	/**
	 * @param string $srid
	 *
	 * @return SkSilkBuyList
	 */
	public function setSrid( $srid ) {
		$this->srid = $srid;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSrid() {
		return $this->srid;
	}

	/**
	 * @param int $subjid
	 *
	 * @return SkSilkBuyList
	 */
	public function setSubjid( $subjid ) {
		$this->subjid = $subjid;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSubjid() {
		return $this->subjid;
	}

	/**
	 * @param int $userjid
	 *
	 * @return SkSilkBuyList
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
