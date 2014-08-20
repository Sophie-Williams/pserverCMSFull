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
		),
	),
	'controllers' => array(
		'invokables' => array(
			'PServerAdmin\Controller\Index' => 'PServerAdmin\Controller\IndexController',
			'PServerAdmin\Controller\News' => 'PServerAdmin\Controller\NewsController',
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
