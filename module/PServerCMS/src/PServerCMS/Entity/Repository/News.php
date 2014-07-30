<?php

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * News
 */
class News extends EntityRepository {

	/**
	 * @return null|\PServerCMS\Entity\News[]
	 */
	public function getActiveNews() {
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.active = :active')
			->setParameter('active', '1')
			->orderBy('p.created','desc')
			->setMaxResults(5)
			->getQuery();
		return $oQuery->getResult();
	}
}