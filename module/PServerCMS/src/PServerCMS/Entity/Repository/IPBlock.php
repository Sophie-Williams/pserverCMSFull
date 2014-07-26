<?php

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * IPBlock
 */
class IPBlock extends EntityRepository {

	/**
	 * @return boolean
	 */
	public function isIPAllowed( $sIP ){
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.ip = :ipString')
			->setParameter('ipString', $sIP)
			->andWhere('p.expire >= :expireTime')
			->setParameter('expireTime', new \DateTime())
			->getQuery();
//		\Zend\Debug\Debug::dump($oQuery->getParameters());die();

		return (bool) $oQuery->getOneOrNullResult();
	}
}
