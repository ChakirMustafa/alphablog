<?php 

return[
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'user'      => 'root',
    'password'  => '19881206',
    'database'  => 'alphablog',
    'dsn'       =>'mysql:host=localhost;dbname=alphablog;charset=utf8',
    'options'   => [
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ]
];