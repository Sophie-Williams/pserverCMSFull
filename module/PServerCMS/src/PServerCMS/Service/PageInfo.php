<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 18.08.14
 * Time: 22:41
 */

namespace PServerCMS\Service;

use PServerCMS\Keys\Caching;
use PServerCMS\Keys\Entity;

class PageInfo extends InvokableBase {

	public function getPage4Type( $type ){
		$cachingKey = Caching::PageInfo . '_' . $type;
		$pageInfo = $this->getCachingService()->getItem($cachingKey);

		if(!$pageInfo){
			/** @var \PServerCMS\Entity\Repository\PageInfo $repository */
			$repository = $this->getEntityManager()->getRepository(Entity::PageInfo);
			$pageInfo = $repository->getPageData4Type($type);

			$this->getCachingService()->setItem($cachingKey, $pageInfo);
		}

		return $pageInfo;
	}

} 