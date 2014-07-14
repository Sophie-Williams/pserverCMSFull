<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
	'zfctwig' => array(
		'environment_loader' => 'ZfcTwigLoaderChain',
		'environment_options' => array(),
		'loader_chain' => array(
			'ZfcTwigLoaderTemplateMap',
			'ZfcTwigLoaderTemplatePathStack'
		),
		'extensions' => array(
			'zfctwig' => 'ZfcTwigExtension'
		),
		'suffix' => 'twig',
		'enable_fallback_functions' => true,
		'disable_zf_model' => true,
	),
	'zenddevelopertools' => array(
		/**
		 * General Profiler settings
		 */
		'profiler' => array(
			'enabled' => false,
			'strict' => true,
			'flush_early' => true,
			'cache_dir' => 'data/cache',
			'matcher' => array(),
			'collectors' => array(),
		),
		/**
		 * General Toolbar settings
		 */
		'toolbar' => array(
			'enabled' => false,
			'auto_hide' => true,
			'position' => 'bottom',
			'version_check' => true,
			'entries' => array(),
		),
	),

	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host'     => 'localhost',
					'port'     => '3306',
					'user'     => 'username',
					'password' => 'password',
					'dbname'   => 'dbname',
				),
				'doctrine_type_mappings' => array(
					'enum' => 'string'
				),
			),
			'orm_sro_account' => array(
				'driverClass' => 'PDODblibModule\Doctrine\DBAL\Driver\PDODblib\Driver',
				'params' => array(
					'host'     => 'localhost',
					'port'     => '1433',
					'user'     => 'username',
					'password' => 'password',
					'dbname'   => 'dbname',
				),
			),
			'orm_sro_shard' => array(
				'driverClass' => 'PDODblibModule\Doctrine\DBAL\Driver\PDODblib\Driver',
				'params' => array(
					'host'     => 'localhost',
					'port'     => '1433',
					'user'     => 'username',
					'password' => 'password',
					'dbname'   => 'dbname',
				),
			),
			'orm_sro_log' => array(
				'driverClass' => 'PDODblibModule\Doctrine\DBAL\Driver\PDODblib\Driver',
				'params' => array(
					'host'     => 'localhost',
					'port'     => '1433',
					'user'     => 'username',
					'password' => 'password',
					'dbname'   => 'dbname',
				),
			),
		),
		'entitymanager' => array(
			'orm_default' => array(
				'connection'    => 'orm_default',
				'configuration' => 'orm_default'
			),
			'orm_sro_account' => array(
				'connection'    => 'orm_sro_account',
				'configuration' => 'orm_sro_account'
			),
			'orm_sro_shard' => array(
				'connection'    => 'orm_sro_shard',
				'configuration' => 'orm_sro_shard'
			),
			'orm_sro_log' => array(
				'connection'    => 'orm_sro_log',
				'configuration' => 'orm_sro_log'
			)
		),
		'configuration' => array(
			'orm_sro_account' => array(
				'metadata_cache'    => 'array',
				'query_cache'       => 'array',
				'result_cache'      => 'array',
				'driver'            => 'sro_account_entities', // This driver will be defined later
				'generate_proxies'  => true,
				'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
				'proxy_namespace'   => 'DoctrineORMModule\Proxy',
				'filters'           => array()
			),
			'orm_sro_shard' => array(
				'metadata_cache'    => 'array',
				'query_cache'       => 'array',
				'result_cache'      => 'array',
				'driver'            => 'sro_shard_entities', // This driver will be defined later
				'generate_proxies'  => true,
				'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
				'proxy_namespace'   => 'DoctrineORMModule\Proxy',
				'filters'           => array()
			),
			'orm_sro_log' => array(
				'metadata_cache'    => 'array',
				'query_cache'       => 'array',
				'result_cache'      => 'array',
				'driver'            => 'sro_log_entities', // This driver will be defined later
				'generate_proxies'  => true,
				'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
				'proxy_namespace'   => 'DoctrineORMModule\Proxy',
				'filters'           => array()
			)
		),
	),
);