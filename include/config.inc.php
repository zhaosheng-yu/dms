<?php
/*
 * 设计思路:将数据库读操作,和数据库写操作,完全分离开来,
 * 使用不同的连接参数,可以分别连到不同服务器上的数据库。
 * 数据库连接函数,根据参数数组,依次尝试连接数据库,
 * 直到某个连接成功为止,或者全部失败。
 */
$DB_CONFIG = array(
    'man_write' => array(
        array(
            'dbms' => 'mysql',
            'host' => 'localhost',
            'user' => 'man_write',
            'password' => '',
            'port' => 3306,
            'dbname' => 'man',
            'charset' => 'utf8'
        )
    ),
    //更多数据库在这里填写
);

/****** REDIS配置 ***********/
$REDIS_CONFIG = array(
    'user_write' => array(
        array(
            'host' => '192.168.234.128',
            'port' => '6379',
            'password' => '',
            'dbN' => 1,
        ),
    ),
    'user_read' => array(
        array(
            'host' => '192.168.234.128',
            'port' => '6379',
            'password' => '',
        ),
    ),
);

/********* SESSION配置,  use_config 表示使用files or memcache ******/
$SESSION_CONFIG = array(
    'use_config' => 'files',
    'memcache' =>
        array(
            'domain' => '.guopan.cn',
            'type' => 'memcache',
            'session_name' => 'sessionid',
            'save_path' => 'tcp://192.168.20.144:11211',
            'cache_expire' => 7200,  //minutes
        ),
    'files' =>
        array(
            'domain' => '.guopan.cn',
            'type' => 'files',
            'session_name' => 'sessionid',
            'save_path' => SYSDIR_CACHE . '/sessions',
            'cache_expire' => 180,  //minutes
        )
);

?>
