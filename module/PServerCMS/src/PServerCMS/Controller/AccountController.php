<?php
/**
 * Created by PhpStorm.
 * User: †KôKšPfLâÑzè®
 * Date: 24.07.14
 * Time: 21:53
 */

namespace PServerCMS\Controller;

use PServerCMS\Service;

class AccountController extends \SmallUser\Controller\AuthController{

	public function indexAction(){

        /** @var \PServerCMS\Entity\Users $user */
        $user = $this->getUserService()->getAuthService()->getStorage()->read();

        $form = $this->getUserService()->getChangePwdForm();
        $elements = $form->getElements();
        foreach ($elements as $element) {
            if ($element instanceof \Zend\Form\Element) {
                $element->setValue('');
            }
        }
        $form1 = clone $form;
        $formChangeWebPwd = $form1->setWhich('web');
        $form2 = clone $form;
        $formChangeIngamePwd = $form2->setWhich('ingame');

        $oRequest = $this->getRequest();
        if(!$oRequest->isPost()){
            return array('changeWebPwdForm' => $formChangeWebPwd, 'changeIngamePwdForm' => $formChangeIngamePwd,'messages' => $this->flashmessenger()->getMessagesFromNamespace('success'), 'errors' => $this->flashmessenger()->getMessagesFromNamespace(self::ErrorNameSpace));

        }

        $method = $this->params()->fromPost('which') == 'ingame'?'changeIngamePwd':'changeWebPwd';
        if($this->getUserService()->$method($this->params()->fromPost(), $user)){
            $this->flashMessenger()->setNamespace('success')->addMessage('Success, password changed.');
        }
        return $this->redirect()->toUrl($this->url()->fromRoute('user'));
	}

    /**
     * @return \PServerCMS\Service\User
     */
    protected function getUserService(){
        return parent::getUserService();
    }
}