<?php

namespace Application\Helper;

/**
 * Class Ip
 * @package Application\Helper
 */
class Ip{

	/**
	 * @return string
	 */
	public static function getIp(){
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
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
