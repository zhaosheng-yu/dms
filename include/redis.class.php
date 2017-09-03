<?php
/*
 * reids类，支持多库配置
 * Author: zhaosheng
 */
class MyRedis
{
    private $all_conn = array(); //已连接的redis对象数组
    private static $_instance = NULL; //单例模式
    public $ttl = 10;
    public $redis = NULL; //当前使用redis对象
    public $redis_config = array(); //redis配置
    public  $debug = true;

    /*
     * 单例模式需private
     * */
    private function __construct($redis_config) {
        $this->redis_config = $redis_config;
    }

    /*
     * 单例实现
     * */
    public static function getInstance($redis_config = array()) {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($redis_config);
        }
        return self::$_instance;
    }

    /*
     * 单例模式禁止clone
     * */
    public function __clone() {
        throw new Exception('Clone is not allow' ,E_USER_ERROR);
    }

    /*
     * redis的pconnect是基于host+port的 我们的配置文件是基于host+port+dbN的 所以改为connect
     */
    function use_redis($conn_name) {
        if (isset($this->all_conn[$conn_name])) {
            $this->redis = $this->all_conn[$conn_name];
        }
        else {
            $REDIS_CONFIG = $this->redis_config;
            if (!isset($REDIS_CONFIG[$conn_name])) {
                if ($this->debug) {
                    throw new Exception("redis {$conn_name} config name not exist !");
                }
            }
            $config = $REDIS_CONFIG[$conn_name];
            $config_count = count($config);
            if ($config_count > 1) { //一般是多个从库的情况，这里简单地采用随机连一个数据库
                $config = $config[rand(0, $config_count - 1)];
            }
            else {
                $config = $config[0];
            }
            $this->redis = new Redis();
            $conn_result = $this->redis->connect( $config['host'], $config['port'], $this->ttl);
            if ($conn_result===false) {
                if ($this->debug) {
                    throw new Exception("redis {$conn_name} config connect fail !");
                }
            }
            if ($config['password']) {
                $auth_result = $this->redis->auth( $config['password'] );
                if (!$auth_result) {
                    if ($this->debug) {
                        throw new Exception("{$conn_name} redis auth fail !");
                    }
                }
            }
            if (isset($config['dbN'])) {
                $this->redis->select( $config['dbN'] );
            }
            else {
                $this->redis->select( 0 );
            }
            $this->all_conn[$conn_name] = $this->redis;
        }
    }

    /*
     * 释放redis资源
     * */
    function __destruct() {
        if ($this->redis) {
            $this->redis->close();
        }
        if ($this->all_conn) {
            foreach ($this->all_conn as $_redis) {
                $_redis->close();
            }
        }
    }
}
$redis = MyRedis::getInstance($REDIS_CONFIG);
