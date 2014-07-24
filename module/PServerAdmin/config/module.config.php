<?php

return array(
	'router' => array(
		'routes' => array(
			'admin_home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'    => '/admin',
					'defaults' => array(
						'controller' => 'PServerAdmin\Controller\Index',
						'action'     => 'index',
					),
				),
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'PServerAdmin\Controller\Index' => 'PServerAdmin\Controller\IndexController',
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
