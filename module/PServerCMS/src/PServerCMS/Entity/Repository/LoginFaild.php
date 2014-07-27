<?php

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LoginFaild
 */
class LoginFaild extends EntityRepository {

	/**
	 * @param $sIP
	 * @param $iTimeInterVal
	 *
	 * @return int
	 */
	public function getNumberOfFailLogins4Ip( $sIP, $iTimeInterVal ){
        $oDateTime = new \DateTime();
        $oDateTime = $oDateTime->setTimestamp(time()-$iTimeInterVal);
        $oQuery = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.ip = :ipString')
            ->setParameter('ipString', $sIP)
            ->andWhere('p.created >= :expireTime')
            ->setParameter('expireTime', $oDateTime)
            ->getQuery();
        /**
         * TODO remove count
         */
        return count($oQuery->getArrayResult());
    }
}
