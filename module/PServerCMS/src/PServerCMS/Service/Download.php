<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 14.08.14
 * Time: 21:06
 */

namespace PServerCMS\Service;

use PServerCMS\Keys\Caching;
use PServerCMS\Keys\Entity;

class Download extends InvokableBase {

	/**
	 * @return \PServerCMS\Entity\DownloadList[]
	 */
	public function getActiveList(){

		$downloadInfo = $this->getCachingHelperService()->getItem(Caching::Download, function() {
			/** @var \PServerCMS\Entity\Repository\DownloadList $repository */
			$repository = $this->getEntityManager()->getRepository(Entity::DownloadList);
			return $repository->getActiveDownloadList();
		});

		return $downloadInfo;
	}

} 