<?php
header('Content-Type:text/html;charset=utf-8');
return [
    'db'=>[//保存数据库信息
        'host'=>'127.0.0.1',
        'username'=>'root',
        'password'=>'root',
        'dbname'=>'meifa',
        'port'=>3306,
        'charset'=>'utf8',
        'prefix'=>''
    ],
    'default'=>[//url默认参数
        'default_platform'=>'Admin',
        'default_controller'=>'Index',
        'default_action'=>'index',
    ]
];