<?php
/*
 * admin class
 * Author: zhaosheng
 * Date 2017-02-22
 */
class Admin{
    public $db = null;

    public function __construct() {
        $this->db = DB::getInstance();
    }

    /*
     * 管理员登录
     * $accoutn 账号
     * $pwd 密码，明文
     * $validate_code 图片验证码
     * return true
     *        -1 验证码错误
     *        -2 密码错误
     *        -3 账号不存在
     */
    public function login($account, $pwd, $validate_code) {
        if ($validate_code !== $_SESSION['validate']) {
            return -1;
        }
        $this->db->use_db('man_write');
        $res = $this->db->select('admin_info', '*', "admin_user_name='{$account}'");
        if ($res) {
            if ($res[0]['admin_pwd'] !== md5(md5($pwd))) {
                return -2;
            }
            else {
                $_SESSION['admin_info'] = $res[0];
                $group = $this->db->select('admin_group', '*', "group_id={$res[0]['group_id']}");
                $_SESSION['admin_info']['group_name'] = $group[0]['group_name'];
                $_SESSION['admin_info']['menu_list'] = $this->db->select('admin_menu', '*', "admin_id={$res[0]['admin_id']}");
                return true;
            }
        }
        else {
            return -3;
        }
    }

    /*
     * 菜单权限验证
     * $menu_id 菜单id
     * $menu_power_type 操作类型(1:查看 2:编辑)
     * return true or false
     */
    public function checkPower($menu_id, $menu_power_type=1) {
        if (!$_SESSION['admin_info']['menu_list']) {
            return false;
        }

        foreach ($_SESSION['admin_info']['menu_list'] as $key=>$val) {
            if ($menu_id == $val['menu_id'] && $val['menu_power_type'] == $menu_power_type) {
                return true;
            }
        }
        return false;
    }
    
    /*
     * 获取管理员菜单
     * return array
     */
    public function getMenuList() {
        if (!$_SESSION['admin_info']['admin_id']) {
            return array();
        }
        else {
            $this->db->use_db('man_write');

            $all_menu = $this->db->select('menu_info', '*', '', 'menu_order desc');
            $user_menu = array();
            //用户一级菜单
            foreach ($all_menu as $key=>$val) {
                if ($val['menu_level'] == 1) {
                    $user_menu[$val['menu_id']]['menu_name'] = $val['menu_name'];
                }
            }

            //用户二级菜单
            $all_user_menu = $this->db->select('admin_menu', 'menu_id,menu_power_type', "admin_id={$_SESSION['admin_info']['admin_id']}");
            $inarray = array();
            foreach ($all_menu as $key=>$val) {
                if ($val['menu_level'] == 1) {
                    continue;
                }
                foreach ($all_user_menu as $k=>$v) {
                    if ($v['menu_id'] == $val['menu_id']) {

                        if (in_array($v['menu_id'], $inarray)) continue;

                        $user_menu[$val['menu_par_id']]['list'][] = $val;

                        $inarray[] = $v['menu_id'];
                    }
                }
            }

            //去除为空的一级菜单
            foreach ($user_menu as $key=>$val) {
                if (!$val['list']) {
                    unset($user_menu[$key]);
                }
            }
            return $user_menu;
        }
    }

    /*
     * 获取所有菜单
     * return array
     */
    public function getAllMenu() {
            $this->db->use_db('man_write');

            //一级菜单
            $menus_level1 = $this->db->select('menu_info', '*', 'menu_level=1', 'menu_id desc');

            //二级菜单
            $menus_level2 = $this->db->select('menu_info', '*', 'menu_level=2', 'menu_id desc');

            foreach ($menus_level1 as $key=>$val) {
                foreach ($menus_level2 as $k=>$v) {
                    if ($v['menu_par_id'] == $val['menu_id']) {
                        $menus[$val['menu_name']][] = $v;
                    }
                }
            }
            return $menus;
        }

}
