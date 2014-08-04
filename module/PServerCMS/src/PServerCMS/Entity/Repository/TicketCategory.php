<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 04.08.14
 * Time: 22:57
 */

namespace PServerCMS\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TicketCategory extends EntityRepository {
	/**
	 * @return \PServerCMS\Entity\Ticketcategory[]
	 */
	public function getActiveCategory(){
		$oQuery = $this->createQueryBuilder('p')
			->select('p')
			->where('p.active = :active')
			->setParameter('active', '1')
			->orderBy('p.sortkey','asc')
			->getQuery();
		return $oQuery->getResult();
	}
} 