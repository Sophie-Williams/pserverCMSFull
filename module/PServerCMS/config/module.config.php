<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'PServerCMS\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
			'auth' => array(
				'type' => 'segment',
				'options' => array(
					'route'    => '/auth/[:action][/:code]',
					'constraints' => array(
						'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
						'code'     => '[a-zA-Z0-9]*',
					),
					'defaults' => array(
						'controller'   => 'PServerCMS\Controller\Auth',
						'action'     => 'login',
					),
				),
			)
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /p-server-cms/:controller/:action
			/*
            'p-server-cms' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/p-server-cms',
                    'defaults' => array(
                        '__NAMESPACE__' => 'PServerCMS\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),*/
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
			'PServerCMS\Controller\Index' => 'PServerCMS\Controller\IndexController',
			'PServerCMS\Controller\Auth' => 'PServerCMS\Controller\AuthController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.twig',
            'p-server-cms/index/index' => __DIR__ . '/../view/p-server-cms/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),

	'doctrine' => array(
		'driver' => array(
			'application_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/PServerCMS/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					'PServerCMS\Entity' => 'application_entities'
				),
			),
		),
	),
	'authenticationadapter' => array(
		'odm_default' => array(
			'objectManager' => 'doctrine.documentmanager.odm_default',
			'identityClass' => 'PServerCMS\Entity\Users',
			'identityProperty' => 'username',
			'credentialProperty' => 'password',
			'credentialCallable' => 'PServerCMS\Entity\Users::hashPassword'
		),
	),
	'pserver' => array(
		'register' => array(
			'role' => 'user'
		),
		'mail' => array(
			'from' => 'abcd@example.com',
			'fromName' => 'team',
			'subject' => array(
				'register' => 'RegisterMail',
			),
			'basic' => array(
				'name' => 'localhost',
				'host' => 'smtp.example.com',
				'port'=> 587,
				'connection_class' => 'login',
				'connection_config' => array(
					'username' => 'put your username ',
					'password' => 'put your password',
					'ssl'=> 'tls',
				),
			),
		),
	),
);
