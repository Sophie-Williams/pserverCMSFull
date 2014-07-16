<?php

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Usercodes
 */
class Usercodes extends EntityRepository {

	/**
	 * @param $sCode
	 * @param $sType
	 *
	 * @return null|\PServerCMS\Entity\Usercodes
	 */
	public function getData4CodeType($sCode, $sType){
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.code = :code')
			->setParameter('code', $sCode)
			->andWhere('p.expire >= :expire')
			->setParameter('expire', new \DateTime())
			->andWhere('p.type = :type')
			->setParameter('type', $sType)
			->getQuery();
		return $oQuery->getOneOrNullResult();
	}
}
