<?php

namespace PServerCMS\Service;


class ConfigRead extends InvokableBase {

    /**
     * @var array
     */
    private $aConfig;

    /**
	 * Caching the Config String
     * @var array
     */
    private $aCache = array();

    /**
     * @param $sValue
     * @param bool $mDefault
     * @return mixed
     */
    public function get( $sValue, $mDefault = false ){

		// Check if we have a cache
        if(isset($this->aCache[$sValue])){
            return $this->aCache[$sValue];
        }

        $aValues = explode('.', $sValue);
        $mResult = $this->getConfigData();
        foreach($aValues as $sCurValue){
            if(!isset($mResult[$sCurValue])){
                $mResult = $mDefault;
                break;
            }
            $mResult = $mResult[$sCurValue];
        }

		// save @ cache
		$this->aCache[$sValue] = $mResult;

        return $mResult;
    }

	/**
	 * @return array
	 */
	protected function getConfigData(){
		if(!$this->aConfig){
			$this->aConfig = $this->getServiceManager()->get('Config');
		}
		return $this->aConfig;
	}
}