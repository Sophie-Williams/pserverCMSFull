<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 14.08.14
 * Time: 21:06
 */

namespace PServerCMS\Service;

use PServerCMS\Keys\Entity;

class Download extends InvokableBase {

	public function getActiveList(){
		/** @var \PServerCMS\Entity\Repository\DownloadList $repositoryDownload */
		$repositoryDownload = $this->getEntityManager()->getRepository(Entity::DownloadList);

		return $repositoryDownload->getActiveDownloadList();
	}

} 