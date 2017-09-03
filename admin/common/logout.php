<?php
/*
 * 退出
 * Author: zhaosheng
 * Date: 2017-02-27
 */

require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';
savelog('退出操作');
session_destroy();
header('Location:/');
