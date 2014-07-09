<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dtproperties
 *
 * @ORM\Table(name="dtproperties")
 * @ORM\Entity
 */
class Dtproperties
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="property", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $property;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectid", type="integer", nullable=true)
     */
    private $objectid;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="uvalue", type="string", length=255, nullable=true)
     */
    private $uvalue;

    /**
     * @var string
     *
     * @ORM\Column(name="lvalue", type="text", length=16, nullable=true)
     */
    private $lvalue;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '0';

	/**
	 * @param int $id
	 *
	 * @return Dtproperties
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
	 * @param string $lvalue
	 *
	 * @return Dtproperties
	 */
	public function setLvalue( $lvalue ) {
		$this->lvalue = $lvalue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLvalue() {
		return $this->lvalue;
	}

	/**
	 * @param int $objectid
	 *
	 * @return Dtproperties
	 */
	public function setObjectid( $objectid ) {
		$this->objectid = $objectid;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getObjectid() {
		return $this->objectid;
	}

	/**
	 * @param string $property
	 *
	 * @return Dtproperties
	 */
	public function setProperty( $property ) {
		$this->property = $property;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getProperty() {
		return $this->property;
	}

	/**
	 * @param string $uvalue
	 *
	 * @return Dtproperties
	 */
	public function setUvalue( $uvalue ) {
		$this->uvalue = $uvalue;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUvalue() {
		return $this->uvalue;
	}

	/**
	 * @param string $value
	 *
	 * @return Dtproperties
	 */
	public function setValue( $value ) {
		$this->value = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param int $version
	 *
	 * @return Dtproperties
	 */
	public function setVersion( $version ) {
		$this->version = $version;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getVersion() {
		return $this->version;
	}


}
