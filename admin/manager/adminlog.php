<?php
/*
 * 日志查看
 * Author: zhaosheng
 * Date: 2017-09-03
 */

require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';

checkPower(5,1);
$title = '日志查看';

$db = DB::getInstance();
$db->use_db('man_write');

$where = '1';
$where .= empty($_GET['menu_name']) ? '' : " AND menu LIKE '%{$_GET['menu_name']}%'";
$where .= empty($_GET['oper']) ? '' : " AND oper LIKE '%{$_GET['oper']}%'";
$where .= empty($_GET['admin']) ? '' : " AND admin LIKE '%{$_GET['admin']}%'";

$p = intval($_GET['p']) ? intval($_GET['p']) : 1;
$limit = ($p - 1) * $GLOBALS['web']['page_size'] .','. $GLOBALS['web']['page_size'];
$total = $db->select('admin_log', 'count(*) as num', $where);
$page = new Page();
$pagestr = $page->get($_SERVER['REQUEST_URI'], $total[0]['num'], $p, $GLOBALS['web']['page_size']);

$records = $db->select('admin_log', '*', $where, 'id desc', $limit);

include_once SYSDIR_VIEW .'/manager/adminlog.html';
