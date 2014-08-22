<?php

return array(
	'router' => array(
		'routes' => array(
			'admin_home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'    => '/admin.html',
					'defaults' => array(
						'controller' => 'PServerAdmin\Controller\Index',
						'action'     => 'index',
					),
				),
			),
			'admin_news' => array(
				'type' => 'segment',
				'options' => array(
					'route'			=> '/admin/news[/:action][-:id].html',
					'constraints'	=> array(
						'action'    => '[a-zA-Z]+',
						'id'     	=> '[0-9]+',
					),
					'defaults' => array(
						'controller'	=> 'PServerAdmin\Controller\News',
						'action'		=> 'index',
					),
				),
			),
			'admin_settings' => array(
				'type' => 'segment',
				'options' => array(
					'route'			=> '/admin/settings[/:action][-:type].html',
					'constraints'	=> array(
						'action'    => '[a-zA-Z]+',
						'id'     	=> '[a-zA-Z0-9]+',
					),
					'defaults' => array(
						'controller'	=> 'PServerAdmin\Controller\Settings',
						'action'		=> 'index',
					),
				),
			),
			'admin_download' => array(
				'type' => 'segment',
				'options' => array(
					'route'			=> '/admin/download[/:action][-:id].html',
					'constraints'	=> array(
						'action'    => '[a-zA-Z]+',
						'id'     	=> '[0-9]+',
					),
					'defaults' => array(
						'controller'	=> 'PServerAdmin\Controller\Download',
						'action'		=> 'index',
					),
				),
			),
			'admin_server_info' => array(
				'type' => 'segment',
				'options' => array(
					'route'			=> '/admin/server-info[/:action][-:id].html',
					'constraints'	=> array(
						'action'    => '[a-zA-Z]+',
						'id'     	=> '[0-9]+',
					),
					'defaults' => array(
						'controller'	=> 'PServerAdmin\Controller\ServerInfo',
						'action'		=> 'index',
					),
				),
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'PServerAdmin\Controller\Index' => 'PServerAdmin\Controller\IndexController',
			'PServerAdmin\Controller\News' => 'PServerAdmin\Controller\NewsController',
			'PServerAdmin\Controller\Settings' => 'PServerAdmin\Controller\SettingsController',
			'PServerAdmin\Controller\Download' => 'PServerAdmin\Controller\DownloadController',
			'PServerAdmin\Controller\ServerInfo' => 'PServerAdmin\Controller\ServerInfoController',
		),
	),
	'view_manager' => array(
		'template_map' => array(
			'layout/admin'					=> __DIR__ . '/../view/layout/admin.twig',
		),
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);
