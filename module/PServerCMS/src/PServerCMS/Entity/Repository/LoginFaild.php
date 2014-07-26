<?php

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LoginFaild
 */
class LoginFaild extends EntityRepository {

    /**
     * @return boolean
     */
    public function getNumberOfFailLogins4Ip( $sIP ){
        $oDateTime = new \DateTime();
        $oDateTime = $oDateTime->setTimestamp(time()-900);
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
