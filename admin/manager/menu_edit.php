<?php
/*
 * 后台菜单管理
 * Author: zhaosheng
 * Date: 2017-03-20
 */
require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';

checkPower(2,2);
$title = '菜单管理-编辑';

$db = DB::getInstance();
$db->use_db('man_write');
$menu_list = $db->select('menu_info', '*', '', 'menu_id desc');

if ($_GET['ajax'] == 'del') {
    if (!$_GET['ids']) {
        echo json_encode(array('code'=>1,'msg'=>'参数错误'));
        exit;
    }

    if ($db->del('menu_info', "menu_id in ({$_GET['ids']})")) {
        echo json_encode(array('code'=>0,'msg'=>'操作成功'));
    }
    else {
        echo json_encode(array('code'=>1,'msg'=>'操作失败'));
    }
    savelog('菜单管理',"{$_GET['ids']}-删除操作", $db->sql);
    exit;
}

if ($_POST['action'] == 'edit') {
    unset($_POST['action']);

    if ($_POST['menu_id']) {
        $res = $db->update('menu_info', $_POST, array('menu_id'=>$_POST['menu_id']));
        savelog('菜单管理',"{$_POST['menu_name']}-更新操作", $db->sql);
    }
    else {
        unset($_POST['menu_id']);
        $res = $db->insert('menu_info', $_POST);
        savelog('菜单管理',"{$_POST['menu_name']}-新增操作", $db->sql);
    }

    echo $res ? 0 : 1; //0成功 1失败
    exit;
}

if ($_GET['id']) {
    $info = $db->select('menu_info', '*', array('menu_id'=>$_GET['id']));
    $info = $info[0];
}

include_once SYSDIR_VIEW .'/manager/menu_edit.html';
