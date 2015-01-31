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
	'zfctwig' => [
		'environment_loader' => 'ZfcTwigLoaderChain',
		'environment_options' => [],
		'loader_chain' => [
			'ZfcTwigLoaderTemplateMap',
			'ZfcTwigLoaderTemplatePathStack'
		],
		'extensions' => [
			'zfctwig' => 'ZfcTwigExtension'
		],
		'suffix' => 'twig',
		'enable_fallback_functions' => true,
		'disable_zf_model' => true,
	],
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
	'pserver' => [
		'timer' => [
			[
				'name' => 'CTF',
				'hours' => [
					0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23
				],
				'min' => 30,
				'icon' => 'fa fa-cubes'
			],
			[
				'name' => 'Medusa',
				'hours' => [
					1,22,23
				],
				'min' => 14,
				'icon' => 'fa fa-digg'
			],
			//'Sunday' | 'Monday' | 'Tuesday' | 'Wednesday' | 'Thursday' | 'Friday' | 'Saturday'
			[
				'name' => 'Fortresswar',
				'days' => [
					'Wednesday','Monday'
				],
				'hour' => 8,
				'min' => 14,
				'icon' => 'fa fa-bomb'
			],
			[
				'name' => 'Register',
				'type' => 'static',
				'time' => 'Saturday 12:00 - 23:00',
				'icon' => 'fa fa-digg'
			],
		],
	],
	'zfc-ticket-system' => [
		'auth_service' => 'small_user_auth_service'
	]
];