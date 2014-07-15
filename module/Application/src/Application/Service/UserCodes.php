<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 18:46
 */

namespace Application\Service;


use Application\Entity\Users;
use Application\Helper\Format;
use Application\Keys\Entity;

class UserCodes extends InvokablesBase {

	/**
	 * @var \Doctrine\Common\Persistence\ObjectRepository
	 */
	protected $repositoryManager;

	public function setCode4User( Users $oUserEntity, $sType, $iExpire = 0 ){
		$oEntityManager = $this->getEntityManager();
		do{
			$bFound = false;
			$sCode = Format::getCode();
			if($this->getRepositoryManager()->findOneBy(array('code' => $sCode))){
				$bFound = true;
			}
		}while($bFound);

		$oUserCodesEntity = new \Application\Entity\Usercodes();
		$oUserCodesEntity
			->setCode($sCode)
			->setUsersUsrid($oUserEntity)
			->setType($sType);

		if($iExpire){
			$oDateTime = new \DateTime();
			$oUserCodesEntity->setExpire($oDateTime->setTimestamp(time()+$iExpire));
		}

		$oEntityManager->persist($oUserCodesEntity);
		$oEntityManager->flush();

		return $sCode;
	}

	/**
	 * @return \Doctrine\Common\Persistence\ObjectRepository
	 */
	protected function getRepositoryManager(){
		if( !$this->repositoryManager ){
			$this->repositoryManager = $this->getEntityManager()->getRepository(Entity::UserCodes);
		}
		return $this->repositoryManager;
	}

}