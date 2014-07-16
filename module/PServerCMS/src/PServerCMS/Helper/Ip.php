<?php

namespace PServerCMS\Helper;

/**
 * Class Ip
 * @package PServerCMS\Helper
 */
class Ip{

	/**
	 * @return string
	 */
	public static function getIp(){
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$sResult = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$sResult = $_SERVER['REMOTE_ADDR'];
		}

		// Check if there smth like xxx.xxx.xxx.xxx[internal-network-ip], xxx.xxx.xxx.xxx[www-network-ip]
		if(strpos($sResult, ',') === true){
			$aResult = explode(',', $sResult);
			$sResult = trim($aResult[count($aResult)-1]);
		}

		return $sResult;
	}

	/**
	 * @param $sIp
	 *
	 * @return bool|int
	 */
	public static function getIp2Decimal($sIp){
		if(!filter_var($sIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
			return false;
		}
		$aIp = explode('.',$sIp);
		return ( (int) $aIp[3]) + ($aIp[2]*256) + ($aIp[1]*256*256) + ($aIp[0]*256*256*256);
	}
}
