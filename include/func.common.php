<?php
/*
 * 菜单权限验证
 * $menu_id 菜单id
 * $menu_power_type 操作类型(1:查看 2:编辑)
 * return true or exit
 */
function checkPower($menu_id, $menu_power_type=1) {
    $admin_model = new Admin();
    if (!$admin_model->checkPower($menu_id, $menu_power_type)) {
        echo '无操作权限，请联系管理员!';
        exit;
    }
    return true;
}


/*
 * 后台操作日志保存
 * @param $menu string 管理菜单
 * @param $oper string 操作类型说明
 * @param $remark string 备注
 */
function savelog($menu, $oper = '', $remark ='') {
    if (!$menu) return false;
    $data['menu'] = $menu;
    $data['oper'] = $oper;
    $data['remark'] = $remark;
    $data['ip'] = getIp();
    $data['admin'] = $_SESSION['admin_info']['admin_user_name'] ."[{$_SESSION['admin_info']['admin_real_name']}]";
    $db = DB::getInstance();
    $db->use_db('man_write');
    $db->insert('admin_log', $data);
}
