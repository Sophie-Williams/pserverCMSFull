<?php

namespace Application\Entity;

use BjyAuthorize\Provider\Role\ProviderInterface;
use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Password\Bcrypt;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"})})
 * @ORM\Entity
 */
class Users implements ProviderInterface {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="usrId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $usrid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="username", type="string", length=45, nullable=false)
	 */
	private $username = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="password", type="string", length=60, nullable=false)
	 */
	private $password = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=255, nullable=false)
	 */
	private $email = '';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="createIP", type="string", length=60, nullable=false)
	 */
	private $createip = '127.0.0.1';

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 */
	private $created;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="Application\Entity\UserRole", mappedBy="usersUsrid")
	 */
	private $userRole;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->userRole = new \Doctrine\Common\Collections\ArrayCollection();
		$this->created = new \DateTime();
	}


	/**
	 * Get usrid
	 *
	 * @return integer
	 */
	public function getUsrid() {
		return $this->usrid;
	}

	/**
	 * Set username
	 *
	 * @param string $username
	 *
	 * @return Users
	 */
	public function setUsername( $username ) {
		$this->username = $username;

		return $this;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 *
	 * @return Users
	 */
	public function setPassword( $password ) {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 *
	 * @return Users
	 */
	public function setEmail( $email ) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set createip
	 *
	 * @param string $createip
	 *
	 * @return Users
	 */
	public function setCreateip( $createip ) {
		$this->createip = $createip;

		return $this;
	}

	/**
	 * Get createip
	 *
	 * @return string
	 */
	public function getCreateip() {
		return $this->createip;
	}

	/**
	 * Set created
	 *
	 * @param \DateTime $created
	 *
	 * @return Users
	 */
	public function setCreated( $created ) {
		$this->created = $created;

		return $this;
	}

	/**
	 * Get created
	 *
	 * @return \DateTime
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * Add userRole
	 *
	 * @param \Application\Entity\UserRole $userRole
	 *
	 * @return Users
	 */
	public function addUserRole( \Application\Entity\UserRole $userRole ) {
		$this->userRole[] = $userRole;

		return $this;
	}

	/**
	 * Remove userRole
	 *
	 * @param \Application\Entity\UserRole $userRole
	 */
	public function removeUserRole( \Application\Entity\UserRole $userRole ) {
		$this->userRole->removeElement( $userRole );
	}

	/**
	 * Get userRole
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getUserRole() {
		return $this->userRole;
	}

	/**
	 * @param Users $oEntity
	 * @param       $plaintext
	 *
	 * @return bool
	 */
	public static function hashPassword(Users $oEntity, $plaintext){
		$oBcrypt = new Bcrypt();
		return $oBcrypt->verify($plaintext, $oEntity->getPassword());
	}

	/**
	 * @return \Zend\Permissions\Acl\Role\RoleInterface[]
	 */
	public function getRoles() {
		return $this->userRole->getValues();
	}
}
