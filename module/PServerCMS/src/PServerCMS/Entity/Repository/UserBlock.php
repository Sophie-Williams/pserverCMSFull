<?php

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * IPBlock
 */
class UserBlock extends EntityRepository {

    /**
     * @param $iUserId
     * @return \PServerCMS\Entity\UserBlock
     */
    public function isUserAllowed( $iUserId ) {
        $oQuery = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.usersUsrid = :userId')
            ->setParameter('userId', $iUserId)
            ->andWhere('p.expire >= :expireTime')
            ->setParameter('expireTime', new \DateTime())
            ->orderBy('p.expire', 'desc')
            ->setMaxResults(1)
            ->getQuery();

        return $oQuery->getOneOrNullResult();
    }
}