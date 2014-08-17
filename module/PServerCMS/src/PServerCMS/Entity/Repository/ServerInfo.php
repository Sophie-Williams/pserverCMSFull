<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 17.08.14
 * Time: 16:41
 */

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ServerInfo extends EntityRepository {

	/**
	 * @return null|\PServerCMS\Entity\ServerInfo[]
	 */
	public function getActiveInfos() {
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.active = :active')
			->setParameter('active', '1')
			->orderBy('p.sortkey','asc')
			->getQuery();
		return $oQuery->getResult();
	}
} 