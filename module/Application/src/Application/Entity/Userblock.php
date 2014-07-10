<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userblock
 *
 * @ORM\Table(name="userBlock", indexes={@ORM\Index(name="fk_userBlock_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity
 */
class Userblock
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bid;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="text", nullable=false)
     */
    private $reason;

    /**
     * @var integer
     *
     * @ORM\Column(name="expire", type="integer", nullable=false)
     */
    private $expire;

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
     * Get bid
     *
     * @return integer 
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * Set reason
     *
     * @param string $reason
     * @return Userblock
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string 
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set expire
     *
     * @param integer $expire
     * @return Userblock
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;

        return $this;
    }

    /**
     * Get expire
     *
     * @return integer 
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Userblock
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
     * @return Userblock
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
