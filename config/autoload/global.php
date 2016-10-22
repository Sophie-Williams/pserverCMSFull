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

return [
	'zenddevelopertools' => [
		/**
		 * General Profiler settings
		 */
		'profiler' => [
			'enabled' => false,
			'strict' => true,
			'flush_early' => true,
			'cache_dir' => 'data/cache',
			'matcher' => [],
			'collectors' => [],
		],
		/**
		 * General Toolbar settings
		 */
		'toolbar' => [
			'enabled' => false,
			'auto_hide' => true,
			'position' => 'bottom',
			'version_check' => true,
			'entries' => [],
		],
	],
	'zfc-ticket-system' => [
		'auth_service' => 'small_user_auth_service'
	],
    'view_manager' => [
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
    ],
];