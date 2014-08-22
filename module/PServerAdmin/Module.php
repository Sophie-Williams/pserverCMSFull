<?php

namespace PServerAdmin;

use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ServiceProviderInterface {
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to
	 * seed such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getServiceConfig() {
		return array(
			'factories' => array(
				'pserver_admin_news_form' => function(){
					$form = new Form\News();
					$form->setInputFilter(new Form\NewsFilter());
					return $form;
				},
				'pserver_admin_page_info_form' => function(){
					$form = new Form\PageInfo();
					$form->setInputFilter(new Form\PageInfoFilter());
					return $form;
				},
				'pserver_admin_server_info_form' => function(){
					$form = new Form\ServerInfo();
					$form->setInputFilter(new Form\ServerInfoFilter());
					return $form;
				},
				'pserver_admin_download_form' => function(){
					$form = new Form\Download();
					$form->setInputFilter(new Form\DownloadFilter());
					return $form;
				},
			)
		);
	}
}
