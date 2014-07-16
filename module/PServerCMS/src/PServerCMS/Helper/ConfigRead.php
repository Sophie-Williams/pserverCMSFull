<?php

namespace PServerCMS\Helper;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Debug\Debug;

class ConfigRead{

    /**
	 * ServiceLocatorConfig
     * @var array
     */
    private static $aConfig = array();

    /**
	 * Caching the Config String
     * @var array
     */
    private static $aCache = array();

    /**
     * @param ServiceLocatorInterface $oServiceLocator
     */
    public function __construct( ServiceLocatorInterface $oServiceLocator ){
        if(!(bool) self::$aConfig){
            self::$aConfig =  $oServiceLocator->get('Config');
        }
    }

    /**
     * @param $sValue
     * @param bool $mDefault
     * @return mixed
     */
    public static function get( $sValue, $mDefault = false ){

		// Check if we have a cache
        if(isset(self::$aCache[$sValue])){
            return self::$aCache[$sValue];
        }

        $aValues = explode('.', $sValue);
        $mResult = self::$aConfig;
        foreach($aValues as $sCurValue){
            if(!isset($mResult[$sCurValue])){
                $mResult = $mDefault;
                break;
            }
            $mResult = $mResult[$sCurValue];
        }

		// save @ cache
        self::$aCache[$sValue] = $mResult;

        return $mResult;
    }
}