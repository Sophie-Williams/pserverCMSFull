<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbUser
 *
 * @ORM\Table(name="TB_User")
 * @ORM\Entity
 */
class TbUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="JID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jid;

    /**
     * @var string
     *
     * @ORM\Column(name="StrUserID", type="string", length=25, nullable=false)
     */
    private $struserid;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="Status", type="smallint", nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="GMrank", type="smallint", nullable=true)
     */
    private $gmrank;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=2, nullable=true)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="certificate_num", type="string", length=30, nullable=true)
     */
    private $certificateNum;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=10, nullable=true)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=20, nullable=true)
     */
    private $mobile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="regtime", type="datetime", nullable=true)
     */
    private $regtime;

    /**
     * @var string
     *
     * @ORM\Column(name="reg_ip", type="string", length=25, nullable=true)
     */
    private $regIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Time_log", type="datetime", nullable=true)
     */
    private $timeLog;

    /**
     * @var integer
     *
     * @ORM\Column(name="freetime", type="integer", nullable=true)
     */
    private $freetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="sec_primary", type="smallint", nullable=false)
     */
    private $secPrimary = '3';

    /**
     * @var integer
     *
     * @ORM\Column(name="sec_content", type="smallint", nullable=false)
     */
    private $secContent = '3';

    /**
     * @var integer
     *
     * @ORM\Column(name="AccPlayTime", type="integer", nullable=false)
     */
    private $accplaytime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="LatestUpdateTime_ToPlayTime", type="integer", nullable=false)
     */
    private $latestupdatetimeToplaytime = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="Play123Time", type="integer", nullable=false)
     */
    private $play123time = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="OnlineTimee", type="integer", nullable=true)
     */
    private $onlinetimee;

	/**
	 * @param int $accplaytime
	 *
	 * @return TbUser
	 */
	public function setAccplaytime( $accplaytime ) {
		$this->accplaytime = $accplaytime;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getAccplaytime() {
		return $this->accplaytime;
	}

	/**
	 * @param string $address
	 *
	 * @return TbUser
	 */
	public function setAddress( $address ) {
		$this->address = $address;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param string $certificateNum
	 *
	 * @return TbUser
	 */
	public function setCertificateNum( $certificateNum ) {
		$this->certificateNum = $certificateNum;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCertificateNum() {
		return $this->certificateNum;
	}

	/**
	 * @param string $email
	 *
	 * @return TbUser
	 */
	public function setEmail( $email ) {
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param int $freetime
	 *
	 * @return TbUser
	 */
	public function setFreetime( $freetime ) {
		$this->freetime = $freetime;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getFreetime() {
		return $this->freetime;
	}

	/**
	 * @param int $gmrank
	 *
	 * @return TbUser
	 */
	public function setGmrank( $gmrank ) {
		$this->gmrank = $gmrank;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getGmrank() {
		return $this->gmrank;
	}

	/**
	 * @param int $jid
	 *
	 * @return TbUser
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
	 * @param int $latestupdatetimeToplaytime
	 *
	 * @return TbUser
	 */
	public function setLatestupdatetimeToplaytime( $latestupdatetimeToplaytime ) {
		$this->latestupdatetimeToplaytime = $latestupdatetimeToplaytime;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getLatestupdatetimeToplaytime() {
		return $this->latestupdatetimeToplaytime;
	}

	/**
	 * @param string $mobile
	 *
	 * @return TbUser
	 */
	public function setMobile( $mobile ) {
		$this->mobile = $mobile;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * @param string $name
	 *
	 * @return TbUser
	 */
	public function setName( $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param int $onlinetimee
	 *
	 * @return TbUser
	 */
	public function setOnlinetimee( $onlinetimee ) {
		$this->onlinetimee = $onlinetimee;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getOnlinetimee() {
		return $this->onlinetimee;
	}

	/**
	 * @param string $password
	 *
	 * @return TbUser
	 */
	public function setPassword( $password ) {
		$this->password = $password;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param string $phone
	 *
	 * @return TbUser
	 */
	public function setPhone( $phone ) {
		$this->phone = $phone;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @param int $play123time
	 *
	 * @return TbUser
	 */
	public function setPlay123time( $play123time ) {
		$this->play123time = $play123time;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getPlay123time() {
		return $this->play123time;
	}

	/**
	 * @param string $postcode
	 *
	 * @return TbUser
	 */
	public function setPostcode( $postcode ) {
		$this->postcode = $postcode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPostcode() {
		return $this->postcode;
	}

	/**
	 * @param string $regIp
	 *
	 * @return TbUser
	 */
	public function setRegIp( $regIp ) {
		$this->regIp = $regIp;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getRegIp() {
		return $this->regIp;
	}

	/**
	 * @param \DateTime $regtime
	 *
	 * @return TbUser
	 */
	public function setRegtime( $regtime ) {
		$this->regtime = $regtime;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getRegtime() {
		return $this->regtime;
	}

	/**
	 * @param int $secContent
	 *
	 * @return TbUser
	 */
	public function setSecContent( $secContent ) {
		$this->secContent = $secContent;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSecContent() {
		return $this->secContent;
	}

	/**
	 * @param int $secPrimary
	 *
	 * @return TbUser
	 */
	public function setSecPrimary( $secPrimary ) {
		$this->secPrimary = $secPrimary;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSecPrimary() {
		return $this->secPrimary;
	}

	/**
	 * @param string $sex
	 *
	 * @return TbUser
	 */
	public function setSex( $sex ) {
		$this->sex = $sex;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSex() {
		return $this->sex;
	}

	/**
	 * @param int $status
	 *
	 * @return TbUser
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
	 * @param string $struserid
	 *
	 * @return TbUser
	 */
	public function setStruserid( $struserid ) {
		$this->struserid = $struserid;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getStruserid() {
		return $this->struserid;
	}

	/**
	 * @param \DateTime $timeLog
	 *
	 * @return TbUser
	 */
	public function setTimeLog( $timeLog ) {
		$this->timeLog = $timeLog;

		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getTimeLog() {
		return $this->timeLog;
	}


}
