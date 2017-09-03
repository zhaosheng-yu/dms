<?php
/*
 * 登录
 * Author: zhaosheng
 * Date: 2017-02-21
 */

require_once dirname(dirname(dirname(__FILE__))) . '/include/init.php';

if ($_POST) {  
    $admin_obj = new Admin();
    $login_res = $admin_obj->login($_POST['account'], $_POST['password'], $_POST['validate_code']);

    //登录成功
    if ($login_res === true) {
        savelog('登录操作', '登录成功');
        header('Location:/');
        exit;
    }
    //登录失败
    else {
        $login_map = array('-1'=>'验证码错误', '-2'=>'密码错误', '-3'=>'账号不存在');
        $login_str = $login_map[$login_res];
    }
}

include_once SYSDIR_VIEW .'/common/login.html';
