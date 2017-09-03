<?php
/*
 * welcome page
 * Author: zhaosheng
 * Date: 2017-02-27
 */

require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';
echo 'Hi,'. $_SESSION['admin_info']['admin_user_name']. ' Welcome To '. $GLOBALS['web']['title'] .'!';
