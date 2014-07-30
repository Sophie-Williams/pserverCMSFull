<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 27.07.14
 * Time: 22:18
 */

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class DownloadList extends EntityRepository {

	/**
	 * @return null|\PServerCMS\Entity\Downloadlist[]
	 */
	public function getActiveDownloadList() {
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.active = :active')
			->setParameter('active', '1')
			->orderBy('p.sortkey','asc')
			->getQuery();
		return $oQuery->getResult();
	}
}