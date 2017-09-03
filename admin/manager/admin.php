<?php
/*
 * 管理员管理
 * Author: zhaosheng
 * Date: 2017-08-30
 */

require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';

checkPower(3,1);
$title = '管理员列表';

$db = DB::getInstance();
$db->use_db('man_write');

$where = '1';
$where .= empty($_GET['admin_user_name']) ? '' : " AND admin_user_name LIKE '%{$_GET['admin_user_name']}%'";

$sql = "SELECT a.*,b.group_name FROM admin_info a inner join admin_group b on a.group_id=b.group_id where {$where}";

$data = $db->query($sql);

include_once SYSDIR_VIEW .'/manager/admin.html';
