<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donatelog
 *
 * @ORM\Table(name="donateLog", indexes={@ORM\Index(name="fk_donateLog_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity
 */
class Donatelog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $did;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="success", type="string", nullable=false)
     */
    private $success;

    /**
     * @var integer
     *
     * @ORM\Column(name="coins", type="integer", nullable=false)
     */
    private $coins;

    /**
     * @var string
     *
     * @ORM\Column(name="desc", type="text", nullable=false)
     */
    private $desc;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=60, nullable=false)
     */
    private $ip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \Application\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="users_usrId", referencedColumnName="usrId")
     * })
     */
    private $usersUsrid;



    /**
     * Get did
     *
     * @return integer 
     */
    public function getDid()
    {
        return $this->did;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Donatelog
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set success
     *
     * @param string $success
     * @return Donatelog
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * Get success
     *
     * @return string 
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set coins
     *
     * @param integer $coins
     * @return Donatelog
     */
    public function setCoins($coins)
    {
        $this->coins = $coins;

        return $this;
    }

    /**
     * Get coins
     *
     * @return integer 
     */
    public function getCoins()
    {
        return $this->coins;
    }

    /**
     * Set desc
     *
     * @param string $desc
     * @return Donatelog
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * Get desc
     *
     * @return string 
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Donatelog
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Donatelog
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set usersUsrid
     *
     * @param \Application\Entity\Users $usersUsrid
     * @return Donatelog
     */
    public function setUsersUsrid(\Application\Entity\Users $usersUsrid = null)
    {
        $this->usersUsrid = $usersUsrid;

        return $this;
    }

    /**
     * Get usersUsrid
     *
     * @return \Application\Entity\Users 
     */
    public function getUsersUsrid()
    {
        return $this->usersUsrid;
    }
}
