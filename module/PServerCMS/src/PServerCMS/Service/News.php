<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 14.08.14
 * Time: 21:16
 */

namespace PServerCMS\Service;

use PServerCMS\Keys\Entity;

class News extends InvokableBase {

	public function getActiveNews(){
		/** @var \PServerCMS\Entity\Repository\News $repositoryNews */
		$repositoryNews = $this->getEntityManager()->getRepository(Entity::News);
		return $repositoryNews->getActiveNews();
	}

} 