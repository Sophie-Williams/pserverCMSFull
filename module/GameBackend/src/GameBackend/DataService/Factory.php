<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 06.07.14
 * Time: 23:44
 */

namespace GameBackend\DataService;

use Zend\ServiceManager\ServiceLocatorInterface;


class Factory {
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 *
	 * @return \GameBackend\DataService\DataServiceInterface
	 */
	public static function getInstance( ServiceLocatorInterface $serviceLocator ) {
		$config = $serviceLocator->get( 'Configuration' );

		return new SRO();
	}
} 