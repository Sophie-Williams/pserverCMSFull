<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news", indexes={@ORM\Index(name="fk_news_users1_idx", columns={"users_usrId"}), @ORM\Index(name="fk_news_newsType1_idx", columns={"newsType_tId"})})
 * @ORM\Entity
 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nid;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="memo", type="text", nullable=false)
     */
    private $memo;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", nullable=false)
     */
    private $active;

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
     * @var \Application\Entity\Newstype
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Newstype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="newsType_tId", referencedColumnName="tId")
     * })
     */
    private $newstypeTid;



    /**
     * Get nid
     *
     * @return integer 
     */
    public function getNid()
    {
        return $this->nid;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set memo
     *
     * @param string $memo
     * @return News
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Get memo
     *
     * @return string 
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return News
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return News
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
     * @return News
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

    /**
     * Set newstypeTid
     *
     * @param \Application\Entity\Newstype $newstypeTid
     * @return News
     */
    public function setNewstypeTid(\Application\Entity\Newstype $newstypeTid = null)
    {
        $this->newstypeTid = $newstypeTid;

        return $this;
    }

    /**
     * Get newstypeTid
     *
     * @return \Application\Entity\Newstype 
     */
    public function getNewstypeTid()
    {
        return $this->newstypeTid;
    }
}
