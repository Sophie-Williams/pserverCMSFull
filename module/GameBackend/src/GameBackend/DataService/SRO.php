<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 06.07.14
 * Time: 23:46
 */

namespace GameBackend\DataService;


class SRO implements DataServiceInterface {
	/*
	 * ONLY TO TEST
	 */
	public function getRandomNumber(){
		return rand(0,123);
	}
}