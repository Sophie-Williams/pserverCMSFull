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
	 * TODO better without Factory and add to Module.php
	 *
	 *
	 * create service
	 *
	 * @param ServiceLocatorInterface $oServiceLocator
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public static function getInstance( ServiceLocatorInterface $oServiceLocator ) {
		$config = $oServiceLocator->get( 'Configuration' );

		//\Zend\Debug\Debug::dump($config);die();
		if(!class_exists($config['gamebackend']['game'])){
			throw new \Exception('GameBackend Game Class not exists!');
		}

		return new $config['gamebackend']['game']();
	}
} 