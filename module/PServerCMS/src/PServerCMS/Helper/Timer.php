<?php

namespace PServerCMS\Helper;

class Timer{

	/**
	 * @param array $aHour
	 * @param       $iMinute
	 *
	 * @return int
	 */
	public static function getNextTime( array $aHour, $iMinute ){
		return self::nextFight( $aHour, $iMinute );
	}

	/**
	 * @param array $aHours
	 * @param       $iM
	 *
	 * @return int
	 */
	protected static function nextFight( array $aHours, $iM ){
		sort($aHours);
		foreach($aHours as $iHour){
			if( ( $iTime = mktime( $iHour , $iM, 0, date("n") , date("j") , date("Y") ) ) >= time() ){
				return $iTime;
			}
		}
		foreach($aHours as $iHour){
			if( ( $iTime = mktime( $iHour , $iM, 0, date("n") , date('j', strtotime( '+1 day' )) , date("Y") ) ) >= time() ){
				return $iTime;
			}
		}
		foreach($aHours as $iHour){
			if( ( $iTime = mktime( $iHour , $iM, 0, date("m")+1 , 1 , date("Y") ) ) >= time() ){
				return $iTime;
			}
		}
	}
}