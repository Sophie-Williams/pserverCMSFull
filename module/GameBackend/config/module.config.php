<?php

return array(
	'doctrine' => array(
		'driver' => array(
			'sro_account_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/GameBackend/Entity/SRO/Account')
			),
			'sro_shard_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/GameBackend/Entity/SRO/Shard')
			),
			'sro_log_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/GameBackend/Entity/SRO/Log')
			),
			'orm_sro_account' => array(
				'drivers' => array(
					'GameBackend\Entity\SRO\Account' => 'sro_account_entities'
				),
			),
			'orm_sro_shard' => array(
				'drivers' => array(
					'GameBackend\Entity\SRO\Shard' => 'sro_shard_entities'
				),
			),
			'orm_sro_log' => array(
				'drivers' => array(
					'GameBackend\Entity\SRO\Log' => 'sro_log_entities'
				),
			),
		),
	),
);
