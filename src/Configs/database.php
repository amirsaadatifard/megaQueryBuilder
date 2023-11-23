<?php

return [

    'pdo'   => [
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'db_name'   => 'bug',
        'db_username' => 'root',
        'db_password' => '',
        'default_fetch' => PDO::FETCH_OBJ,
    ],
    'mysqli'   => [
        'driver'    => '',
        'host'      => 'localhost',
        'db_name'   => 'bug',
        'db_username' => 'root',
        'db_password' => '',
        'default_fetch' => MYSQLI_ASSOC,
    ],

];