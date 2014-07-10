<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Useralias
 *
 * @ORM\Table(name="userAlias", indexes={@ORM\Index(name="fk_userAlias_users1_idx", columns={"users_usrId"})})
 * @ORM\Entity
 */
class Useralias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aliasId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aliasid;

    /**
     * @var integer
     *
     * @ORM\Column(name="char_id", type="integer", nullable=false)
     */
    private $charId;

    /**
     * @var string
     *
     * @ORM\Column(name="charname", type="string", length=50, nullable=false)
     */
    private $charname;

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
     * Get aliasid
     *
     * @return integer 
     */
    public function getAliasid()
    {
        return $this->aliasid;
    }

    /**
     * Set charId
     *
     * @param integer $charId
     * @return Useralias
     */
    public function setCharId($charId)
    {
        $this->charId = $charId;

        return $this;
    }

    /**
     * Get charId
     *
     * @return integer 
     */
    public function getCharId()
    {
        return $this->charId;
    }

    /**
     * Set charname
     *
     * @param string $charname
     * @return Useralias
     */
    public function setCharname($charname)
    {
        $this->charname = $charname;

        return $this;
    }

    /**
     * Get charname
     *
     * @return string 
     */
    public function getCharname()
    {
        return $this->charname;
    }

    /**
     * Set usersUsrid
     *
     * @param \Application\Entity\Users $usersUsrid
     * @return Useralias
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
