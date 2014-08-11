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
	'pserver' => array(
		'timer' => array(
			array(
				'name' => 'CTF',
				'hours' => array(
					0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23
				),
				'min' => 30,
				'icon' => 'fa fa-cubes'
			),
			array(
				'name' => 'Medusa',
				'hours' => array(
					1,22,23
				),
				'min' => 14,
				'icon' => 'fa fa-digg'
			),
			//'Sunday' | 'Monday' | 'Tuesday' | 'Wednesday' | 'Thursday' | 'Friday' | 'Saturday'
			array(
				'name' => 'Fortresswar',
				'days' => array(
					'Wednesday','Monday'
				),
				'hour' => 8,
				'min' => 14,
				'icon' => 'fa fa-bomb'
			),
			array(
				'name' => 'Register',
				'type' => 'static',
				'time' => 'Saturday 12:00 - 23:00',
				'icon' => 'fa fa-digg'
			),
		),
	),
	'zfc-ticket-system' => array(
		'auth_service' => 'small_user_auth_service'
	)
);