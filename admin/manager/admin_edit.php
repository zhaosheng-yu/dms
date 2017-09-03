<?php
/*
 * 后台菜单管理
 * Author: zhaosheng
 * Date: 2017-03-20
 */
require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';

checkPower(3,2);
$title = '管理员管理-编辑';

$db = DB::getInstance();
$db->use_db('man_write');

if ($_GET['ajax'] == 'del') {
    if (!$_GET['ids']) {
        echo json_encode(array('code'=>1,'msg'=>'参数错误'));
        exit;
    }

    if ($db->del('admin_info', "admin_id in ({$_GET['ids']})")) {
        echo json_encode(array('code'=>0,'msg'=>'操作成功'));
    }
    else {
        echo json_encode(array('code'=>1,'msg'=>'操作失败'));
    }
    savelog('管理员管理',"{$_GET['ids']}-删除操作", $db->sql);
    exit;
}

if ($_POST['action'] == 'edit') {
    unset($_POST['action']);

    //更新
    if ($_POST['admin_id']) {
        if ($_POST['admin_pwd']) {
            if (preg_match('/^\w{6,20}$/', $_POST['admin_pwd'])) {
                $_POST['admin_pwd'] = md5(md5($_POST['admin_pwd']));
            }
            else {
                die("2"); //失败退出
            }
        }
        else {
            unset($_POST['admin_id']);
        }
        $res = $db->update('admin_info', $_POST, array('admin_id'=>$_POST['admin_id']));
        savelog('管理员管理',"{$_POST['admin_user_name']}-更新操作", $db->sql);
    }
    //新建
    else {
        unset($_POST['admin_id']);
        if (!preg_match('/^\w{6,20}$/', $_POST['admin_pwd'])) {
            die("1"); //失败退出
        }
        $_POST['admin_pwd'] = md5(md5($_POST['admin_pwd']));
        $res = $db->insert('admin_info', $_POST);
        savelog('管理员管理',"{$_POST['admin_user_name']}-新增操作", $db->sql);
    }
    echo $res ? 0 : 1; //0成功 1失败
    exit;
}

if ($_GET['id']) {
    $sql = "SELECT a.*,b.group_name FROM admin_info a inner join admin_group b on a.group_id=b.group_id where admin_id={$_GET['id']}";
    $info = $db->query($sql);
    $info = $info[0];
}

//获取分组
$groups = $db->select('admin_group', '*');

include_once SYSDIR_VIEW .'/manager/admin_edit.html';
