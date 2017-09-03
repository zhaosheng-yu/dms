<?php
/*
 * 后台菜单管理
 * Author: zhaosheng
 * Date: 2017-03-20
 */

require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';

checkPower(2,1);
$title = '菜单管理';

$db = DB::getInstance();
$db->use_db('man_write');

$where = '1';
$where .= empty($_GET['menu_name']) ? '' : " AND menu_name LIKE '%{$_GET['menu_name']}%'";
$menu_list = $db->select('menu_info', '*', $where, 'menu_id desc');

include_once SYSDIR_VIEW .'/manager/menu.html';
