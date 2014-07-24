<?php
return array(
	'bjyauthorize' => array(

		// set the 'guest' role as default (must be defined in a role provider)
		'default_role' => 'guest',

		/* this module uses a meta-role that inherits from any roles that should
		 * be applied to the active user. the identity provider tells us which
		 * roles the "identity role" should inherit from.
		 *
		 * for ZfcUser, this will be your default identity provider
		 */
		'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',

		/* If you only have a default role and an authenticated role, you can
		 * use the 'AuthenticationIdentityProvider' to allow/restrict access
		 * with the guards based on the state 'logged in' and 'not logged in'.
		 *
		 * 'default_role'       => 'guest',         // not authenticated
		 * 'authenticated_role' => 'user',          // authenticated
		 * 'identity_provider'  => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
		 */

		/* role providers simply provide a list of roles that should be inserted
		 * into the Zend\Acl instance. the module comes with two providers, one
		 * to specify roles in a config file and one to load roles using a
		 * Zend\Db adapter.
		 */
		'role_providers' => array(
			// this will load roles from
			// the 'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' service
			'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
				// class name of the entity representing the role
				'role_entity_class' => 'PServerCMS\Entity\UserRole',
				// service name of the object manager
				'object_manager'    => 'doctrine.entitymanager.orm_default',
			),
		),

		// resource providers provide a list of resources that will be tracked
		// in the ACL. like roles, they can be hierarchical
		'resource_providers' => array(
			'BjyAuthorize\Provider\Resource\Config' => array(
				'auth' => array(),
				'user' => array(),
				'admin_home' => array(),
			),
		),


		/* rules can be specified here with the format:
		 * array(roles (array), resource, [privilege (array|string), assertion])
		 * assertions will be loaded using the service manager and must implement
		 * Zend\Acl\Assertion\AssertionInterface.
		 * *if you use assertions, define them using the service manager!*
		 */
		'rule_providers' => array(
			'BjyAuthorize\Provider\Rule\Config' => array(
				'allow' => array(
					// allow guests and users (and admins, through inheritance)
					// the "wear" privilege on the resource "pants"
					array('guest', 'auth', 'index'),
					array(array(), 'auth', 'logout'),
					array(array('user', 'admin'), 'user'),
					array(array('admin'), 'admin_home'),
				),

				// Don't mix allow/deny rules if you are using role inheritance.
				// There are some weird bugs.
				'deny' => array(
					array('guest', 'auth', 'logout'),
				),
			),
		),


		/* Currently, only controller and route guards exist
		 *
		 * Consider enabling either the controller or the route guard depending on your needs.
		 */
		'guards' => array(
			/* If this guard is specified here (i.e. it is enabled), it will block
			 * access to all controllers and actions unless they are specified here.
			 * You may omit the 'action' index to allow access to the entire controller
			 */
			'BjyAuthorize\Guard\Controller' => array(
				/*array('controller' => 'index', 'roles' => array('guest')),
				array('controller' => 'site', 'roles' => array('guest')),
				// You can also specify an array of actions or an array of controllers (or both)
				// allow "guest" and "admin" to access actions "list" and "manage" on these "index",
				// "static" and "console" controllers
				array(
					'controller' => array('index', 'static', 'console'),
					'action' => array('list', 'manage'),
					'roles' => array('guest', 'admin')
				),
				array(
					'controller' => array('search', 'administration'),
					'roles' => array('admin')
				),
				array('controller' => 'zfcuser', 'roles' => array()),
				 */
				// Below is the default index action used by the ZendSkeletonApplication
				array('controller' => 'PServerCMS\Controller\Index', 'roles' => array()),
				array('controller' => 'PServerCMS\Controller\Auth', 'roles' => array('guest')),
				array('controller' => 'PServerCMS\Controller\Auth', 'roles' => array(), 'action' => array('logout')),
				array('controller' => 'PServerCMS\Controller\Site', 'roles' => array()),
				array('controller' => 'PServerCMS\Controller\Account', 'roles' => array('user','admin')),
				array('controller' => 'PServerAdmin\Controller\Index', 'roles' => array('admin')),
			),

			/* If this guard is specified here (i.e. it is enabled), it will block
			 * access to all routes unless they are specified here.
			'BjyAuthorize\Guard\Route' => array(
				array('route' => 'zfcuser', 'roles' => array('user')),
				array('route' => 'zfcuser/logout', 'roles' => array('user')),
				array('route' => 'zfcuser/login', 'roles' => array('guest')),
				array('route' => 'zfcuser/register', 'roles' => array('guest')),
				// Below is the default index action used by the ZendSkeletonApplication
				array('route' => 'home', 'roles' => array('guest', 'user')),
			),
			 */
		),
		// strategy service name for the strategy listener to be used when permission-related errors are detected
		'unauthorized_strategy' => 'BjyAuthorize\View\UnauthorizedStrategy',

		// Template name for the unauthorized strategy
		'template'              => 'error/403',

		// cache options have to be compatible with Zend\Cache\StorageFactory::factory
		'cache_options'         => array(
			'adapter'   => array(
				'name' => 'memory',
			),
			'plugins'   => array(
				'serializer',
			)
		),

		// Key used by the cache for caching the acl
		'cache_key'             => 'bjyauthorize_acl'
	),
);