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
		'disable_zf_model' => true
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
);
