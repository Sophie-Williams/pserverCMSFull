<?php

namespace GameBackend\Entity\SRO\Account;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkSilk
 *
 * @ORM\Table(name="SK_Silk")
 * @ORM\Entity
 */
class SkSilk
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
     * @var integer
     *
     * @ORM\Column(name="silk_own", type="integer", nullable=false)
     */
    private $silkOwn = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="silk_gift", type="integer", nullable=false)
     */
    private $silkGift = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="silk_point", type="integer", nullable=false)
     */
    private $silkPoint = '0';

	/**
	 * @param int $jid
	 *
	 * @return SkSilk
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
	 * @param int $silkGift
	 *
	 * @return SkSilk
	 */
	public function setSilkGift( $silkGift ) {
		$this->silkGift = $silkGift;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilkGift() {
		return $this->silkGift;
	}

	/**
	 * @param int $silkOwn
	 *
	 * @return SkSilk
	 */
	public function setSilkOwn( $silkOwn ) {
		$this->silkOwn = $silkOwn;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilkOwn() {
		return $this->silkOwn;
	}

	/**
	 * @param int $silkPoint
	 *
	 * @return SkSilk
	 */
	public function setSilkPoint( $silkPoint ) {
		$this->silkPoint = $silkPoint;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getSilkPoint() {
		return $this->silkPoint;
	}


}
