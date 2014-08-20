<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 14.08.14
 * Time: 21:16
 */

namespace PServerCMS\Service;

use PServerCMS\Keys\Caching;
use PServerCMS\Keys\Entity;

class News extends InvokableBase {

	/**
	 * @return \PServerCMS\Entity\News[]
	 */
	public function getActiveNews(){

		$newsInfo = $this->getCachingHelperService()->getItem(Caching::News, function() {
			/** @var \PServerCMS\Entity\Repository\News $repository */
			$repository = $this->getEntityManager()->getRepository(Entity::News);
			return $repository->getActiveNews();
		});

		return $newsInfo;
	}

} 