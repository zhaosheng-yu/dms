<?php
/*
 * 权限管理
 * Author: zhaosheng
 * Date: 2017-08-31
 */
require_once dirname(dirname(dirname(__FILE__))) .'/include/init.php';

checkPower(4,1);
$title = '权限管理-编辑';

$db = DB::getInstance();
$db->use_db('man_write');

$admin_modle = new Admin();
$menus = $admin_modle->getAllMenu();

$admins = $db->select('admin_info', 'admin_id,admin_user_name,admin_real_name');

if ($_GET['admin_id']) {
    $admin = $db->select('admin_info', '*', array('admin_id'=>$_GET['admin_id']));
    $admin = $admin[0];
}

if ($_POST['action'] == 'edit') {

    checkPower(4,2);

    $db->query('start transaction');
    $flag = true;
    if (!$db->del('admin_menu',"admin_id={$_POST['admin_id']}")) {
        $flag = false;
    }
    foreach ($_POST['pers'] as $val) {
        $arr = explode('_', $val);
        $data['admin_id'] = $_POST['admin_id'];
        $data['menu_id'] = $arr[0];
        $data['menu_power_type'] = $arr[1];

        if (!$db->insert('admin_menu', $data)) {
            $flag = false;
        }
    }
    if ($flag) {
        $db->query('commit');
        savelog('权限管理',"{$_POST['admin_id']}", json_encode($_POST));
        echo 0;
    }
    else {
        $db->query('rollback');
        echo 1;
    }
    exit;
}

if ($_GET['id']) {
    $sql = "SELECT a.*,b.group_name FROM admin_info a inner join admin_group b on a.group_id=b.group_id where admin_id={$_GET['id']}";
    $info = $db->query($sql);
    $info = $info[0];
}

//获取分组
$groups = $db->select('admin_group', '*');

include_once SYSDIR_VIEW .'/manager/autys_edit.html';

function hasPower($admin_id, $menu_id, $menu_power_type=1) {
    $admin_model = new Admin();
    $data = array(
        'menu_id' => $menu_id,
        'admin_id' => $admin_id,
        'menu_power_type' => $menu_power_type
    );
    if ($admin_model->db->select('admin_menu', '*', $data)) {
        return true;
    }
    else {
        return false;
    }
}

