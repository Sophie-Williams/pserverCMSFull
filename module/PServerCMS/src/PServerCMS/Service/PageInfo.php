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

		$pageInfo = $this->getCachingHelperService()->getItem($cachingKey, function() use ($type) {
			/** @var \PServerCMS\Entity\Repository\PageInfo $repository */
			$repository = $this->getEntityManager()->getRepository(Entity::PageInfo);
			return $repository->getPageData4Type($type);
		});

		return $pageInfo;
	}

} 