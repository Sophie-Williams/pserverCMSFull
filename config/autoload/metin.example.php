<?php
return [
    /*
     * DEBUG HELPER
     *
        'zenddevelopertools' => [
            'profiler' => [
                'enabled' => true,
            ],
            'toolbar' => [
                'enabled' => true,
            ],
        ],
        'view_manager' => [
            'display_not_found_reason' => true,
            'display_exceptions'       => true,
        ],
    //*/
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                // mssql db @ windows  => 'GameBackend\DBAL\Driver\PDOSqlsrv\Driver'
                // mssql db @ linux  => 'GameBackend\DBAL\Driver\PDODblib\Driver',
                'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => '127.0.0.1',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'barr',
                    'dbname'   => 'pserverCMS2',
                ],
            ],
            'orm_metin_account' => [
                'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => '127.0.0.1',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'barr',
                    'dbname'   => 'account',
                ],
            ],
        ],
    ],
    'pserver' => [
        'mail' => [
            'from' => 'noreply@mail.com',
            'basic' => [
                'name' => 'mail.com',
                'host' => 'mail.com',
                'port' => 465,
                'connection_class' => 'login',
                'connection_config' => [
                    'username' => 'noreply@mail.com',
                    'password' => 'foobar',
                    'ssl'=> 'ssl',
                ],
            ],
        ],
        'password' => [
            /**
             * some games does not allowed so long password
             */
            'length' => [
                'min' => 6,
                'max' => 16
            ],
        ],
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

    'service_manager' => [
        'invokables' => [
            'gamebackend_dataservice' => 'GameBackend\DataService\Metin',
        ],
    ],
];