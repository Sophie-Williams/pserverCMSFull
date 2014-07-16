<?php

namespace PServerCMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newstype
 *
 * @ORM\Table(name="newsType")
 * @ORM\Entity
 */
class Newstype {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="tId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $tid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=100, nullable=false)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="active", type="string", nullable=false)
	 */
	private $active;


	/**
	 * Get tid
	 *
	 * @return integer
	 */
	public function getTid() {
		return $this->tid;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Newstype
	 */
	public function setName( $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set active
	 *
	 * @param string $active
	 *
	 * @return Newstype
	 */
	public function setActive( $active ) {
		$this->active = $active;

		return $this;
	}

	/**
	 * Get active
	 *
	 * @return string
	 */
	public function getActive() {
		return $this->active;
	}
}
