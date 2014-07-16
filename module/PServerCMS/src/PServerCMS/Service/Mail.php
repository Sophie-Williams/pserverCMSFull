<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 15.07.14
 * Time: 03:42
 */

namespace PServerCMS\Service;


use PServerCMS\Entity\Users;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Part;
use Zend\Mime\Message as MimeMessage;
use Zend\View\Model\ViewModel;

class Mail extends InvokableBase {

	const SubjectKeyRegister = 'register';
	const SubjectKeyPasswordLost = 'password';

	/**
	 * @var \Zend\View\Renderer\PhpRenderer
	 */
	protected $viewRenderer;

	/**
	 * TODO Option
	 * @var array
	 */
	protected $mailConfig;

	/**
	 * @var SmtpOptions
	 */
	protected $mailSMTPOptions;

	/**
	 * RegisterMail
	 *
	 * @param Users $oUserEntity
	 * @param       $sCode
	 */
	public function register( Users $oUserEntity, $sCode ){

		$aParams = array(
			'user' => $oUserEntity,
			'code' => $sCode
		);

		$this->send(static::SubjectKeyRegister, $oUserEntity->getEmail(), $aParams);
	}

	/**
	 * @param $sSubjectKey
	 * @param $sReceiverMail
	 */
	protected function send($sSubjectKey, $sReceiverMail, $aParams){
		// TODO TwigTemplateEngine
		$oRenderer = $this->getViewRenderer();
		/** @var \ZfcTwig\View\TwigResolver $oResolver */
		//$oResolver = $this->getServiceManager()->get('ZfcTwig\View\TwigResolver');
		//$oResolver->resolve(__DIR__ . '/../../../view');
		//$oRenderer->setResolver($oResolver);

		//$oRenderer->setVars($aParams);
		$oViewModel = new ViewModel();
		$oViewModel->setTemplate( 'email/tpl/'.$sSubjectKey );
		$oViewModel->setVariables($aParams);

		$sBody = $oRenderer->render($oViewModel);

		$sSubject = $this->getSubject4Key($sSubjectKey);

		try{
			set_time_limit(30);
			// make a header as html
			$oHtml = new Part($sBody);
			$oHtml->type = "text/html";
			$oBody = new MimeMessage();
			$oBody->setParts(array($oHtml));

			$oMail = new \Zend\Mail\Message();
			$oMail->setBody($oBody);
			$aConfig = $this->getMailConfig();
			$oMail->setFrom($aConfig['from'], $aConfig['fromName']);
			$oMail->setTo($sReceiverMail);
			$oMail->setSubject($sSubject);

			$transport = new Smtp($this->getSMTPOptions());
			$transport->send($oMail);
		}catch (\Exception $e){
			// TODO Log in DB
			\Zend\Debug\Debug::dump($e);
			\Zend\Debug\Debug::dump($sBody);die();
		}
	}

	/**
	 * @return \Zend\View\Renderer\PhpRenderer
	 */
	public function getViewRenderer(){
		if (! $this->viewRenderer) {
			$this->viewRenderer = $this->getServiceManager()->get('ViewRenderer');
		}

		return $this->viewRenderer;
	}

	/**
	 * @return array
	 */
	protected function getMailConfig() {
		if (! $this->mailConfig) {
			$aConfig = $this->getServiceManager()->get('Config');
			$this->mailConfig = $aConfig['pserver']['mail'];
		}

		return $this->mailConfig;
	}

	/**
	 * @return SmtpOptions
	 */
	public function getSMTPOptions(){
		if (! $this->mailSMTPOptions) {
			$aConfig = $this->getMailConfig();
			$this->mailSMTPOptions = new SmtpOptions($aConfig['basic']);
		}

		return $this->mailSMTPOptions;
	}

	/**
	 * @param $sKey
	 *
	 * @return string
	 */
	public function getSubject4Key($sKey){
		$aConfig = $this->getMailConfig();
		return $aConfig['subject'][$sKey];
	}
}