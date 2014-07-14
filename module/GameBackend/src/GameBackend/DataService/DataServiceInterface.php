<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 06.07.14
 * Time: 23:45
 */

namespace GameBackend\DataService;


use Application\Entity\Users;

interface DataServiceInterface {
	/**
	 * @param Users $oUser
	 * @param       $sPlainPassword
	 *
	 * @return Users
	 */
	public function setUser(Users $oUser, $sPlainPassword);

	/**
	 * @param Users $oUser
	 * @param       $iCoins
	 *
	 * @return boolean
	 */
	public function setCoins(Users $oUser, $iCoins);
} 