<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 06.07.14
 * Time: 23:46
 */

namespace GameBackend\DataService;


use PServerCMS\Entity\Users;
use GameBackend\Entity\SRO\Keys\Account;

class SRO extends InvokableBase implements DataServiceInterface {

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $accountEntityManager;

	/**
	 * @param Users $oUser
	 * @param       $sPlainPassword
	 *
	 * @return int
	 */
	public function setUser( Users $oUser, $sPlainPassword ) {
		$class = Account::TbUser;
		$accEntityManager = $this->getAccountEntityManager();

		if((bool) $oUser->getBackendId()){
			$iJID = $oUser->getBackendId();

			$repoTbUser = $accEntityManager->getRepository($class);
			/** @var \GameBackend\Entity\SRO\Account\TbUser $tbUser */
			$tbUser = $repoTbUser->findOneBy(array('jid' => $iJID));
		}else{
			/** @var \GameBackend\Entity\SRO\Account\TbUser $tbUser */
			$tbUser = new $class();
			$tbUser->setStruserid($oUser->getUsername());
			$tbUser->setEmail($oUser->getEmail());
			$tbUser->setRegIp($oUser->getCreateip());
		}

		$tbUser->setPassword(md5($sPlainPassword));
		$accEntityManager->persist($tbUser);
		$accEntityManager->flush();

		return $tbUser->getJid();
	}

	/**
	 * @param Users $oUser
	 * @param       $iCoins
	 *
	 * @return boolean
	 */
	public function setCoins( Users $oUser, $iCoins ) {
		$class = Account::SkSilk;
		$accEntityManager = $this->getAccountEntityManager();
		$repository = $accEntityManager->getRepository($class);

		/** @var \GameBackend\Entity\SRO\Account\SkSilk $skSilk */
		$skSilk = $repository->findOneBy(array('jid' => $oUser->getBackendId()));
		if(!$skSilk){
			$skSilk = new $class;
			$skSilk->setJid($oUser->getBackendId());
		}

		$skSilk->setSilkOwn($skSilk->getSilkOwn() + $iCoins);
		if($skSilk->getSilkOwn() < 0){
			return false;
		}

		$class = Account::SkSilkChangeByWeb;
		/** @var \GameBackend\Entity\SRO\Account\SkSilkChangeByWeb $skSilkChangeByWeb */
		$skSilkChangeByWeb = new $class;
		$skSilkChangeByWeb->setJid($oUser->getBackendId());
		$skSilkChangeByWeb->setSilkRemain($skSilk->getSilkOwn());
		$skSilkChangeByWeb->setSilkOffset(abs($iCoins));
		// 0 => normal silk, 1 => gift, 2 => points
		$skSilkChangeByWeb->setSilkType(0);
		// 0 => add silk, 3 => remove silk, 4 => add points, 5 => remove points
		$skSilkChangeByWeb->setReason($iCoins>0?0:3);

		$accEntityManager->persist($skSilk);
		$accEntityManager->persist($skSilkChangeByWeb);
		$accEntityManager->flush();

		return true;
	}

	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
	protected function getAccountEntityManager(){
		if(!$this->accountEntityManager){
			$this->accountEntityManager = $this->getServiceManager()->get('doctrine.entitymanager.orm_sro_account');
		}
		return $this->accountEntityManager;
	}

}