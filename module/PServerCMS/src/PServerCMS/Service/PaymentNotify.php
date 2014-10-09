<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 09.10.2014
 * Time: 21:58
 */

namespace PServerCMS\Service;

use PaymentAPI\Provider\Request;
use PaymentAPI\Service\LogInterface;
use PServerCMS\Entity\Donatelog;
use PServerCMS\Entity\Users;

class PaymentNotify extends InvokableBase implements LogInterface {

	/**
	 * Method the add the reward
	 *
	 * @param Request $request
	 *
	 * @return boolean
	 */
	public function success( Request $request ) {

		$user = $this->getUser4Id($request->getUserId());
		if(!$user){
			throw new \Exception('User not found');
		}

		// check if donate should add coins or remove
		$coins = $request->getStatus() == $request::StatusSuccess ? abs($request->getAmount()) : -$request->getAmount();

		// save the message if gamebackend-service is unavailable
		$errorMessage = '';
		try{
			$backend = $this->getGameBackendService();
			$backend->setCoins($user, $coins);
		} catch(\Exception $e) {
			$request->setStatus($request::StatusError);
			$errorMessage = $e->getMessage();
		}

		if($request->getStatus() == $request::StatusChargeBack){
			// TODO BanUser
		}

		$this->saveDonateLog($request, $user, $errorMessage);

		return true;
	}

	/**
	 * Method to log the error
	 *
	 * @param Request    $request
	 * @param \Exception $e
	 *
	 * @return bool
	 */
	public function error( Request $request, \Exception $e ) {
		$user = $this->getUser4Id($request->getUserId());



		$this->saveDonateLog($request, $user, $e->getMessage());
	}

	/**
	 * @param Request $request
	 * @param Users   $user
	 *
	 * @return Donatelog
	 */
	protected function getDonateLogEntity4Data( Request $request, $user, $errorMessage = '' ){

		$data = $request->toArray();
		if($errorMessage){
			$data['errorMessage'] = $errorMessage;
		}

		$success = $request->getStatus() == $request::StatusSuccess ? 1 : 0;
		$donateEntity = new Donatelog();
		$donateEntity->setTransactionId($request->getTransactionId())
			->setCoins($request->getAmount())
			->setIp($request->getIp())
			->setSuccess($success)
			->setType($this->mapPaymentProvider2DonateType($request->getProvider()))
			->setDesc(json_encode($data));

		if($user){
			$donateEntity->setUser($user);
		}

		return $donateEntity;
	}

	/**
	 * @param Request $request
	 * @param Users   $user
	 */
	protected function saveDonateLog( Request $request, $user, $errorMessage = '' ){
		$donateLog = $this->getDonateLogEntity4Data($request, $user, $errorMessage);
		$entityManager = $this->getEntityManager();
		$entityManager->persist($donateLog);
		$entityManager->flush();
	}

	/**
	 * Helper to map the PaymentProvider 2 DonateType
	 *
	 * @param $provider
	 *
	 * @return string
	 */
	protected function mapPaymentProvider2DonateType( $provider ){
		$result = '';
		switch ($provider) {
			case Request::ProviderPaymentWall:
				$result = Donatelog::TypePaymentWall;
				break;
			case Request::ProviderSuperReward:
				$result = Donatelog::TypeSuperReward;
				break;
		}
		return $result;
	}
}