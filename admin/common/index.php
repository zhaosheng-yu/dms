<?php
/*
 * 首页
 * Author: zhaosheng
 * Date: 2017-02-25
 */

require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';
require_once SYSDIR_MODEL .'/admin.class.php'; 

$admin_obj = new Admin();
$menu = $admin_obj->getMenuList();

include_once SYSDIR_VIEW .'/common/index.html';
