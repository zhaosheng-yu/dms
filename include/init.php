<?php
/*
 * 系统初始化
 */
//if (1) error_reporting(E_ERROR | E_PARSE);
if (1) error_reporting(E_ALL);

if (!defined('IN_SYSTEM'))
    define('IN_SYSTEM', true);
if(!defined("SYSDIR_ROOT"))
    define("SYSDIR_ROOT", dirname(dirname(__FILE__)) );
if(!defined("SYSDIR_INCLUDE"))
    define("SYSDIR_INCLUDE", SYSDIR_ROOT. "/include" );
if(!defined("SYSDIR_ADMIN"))
    define("SYSDIR_ADMIN", SYSDIR_ROOT. "/admin" );
if(!defined("SYSDIR_CACHE"))
    define("SYSDIR_CACHE", SYSDIR_ROOT. "/cache" );
if(!defined("SYSDIR_STATICS"))
    define("SYSDIR_STATICS", SYSDIR_ROOT. "/statics" );
if(!defined("SYSDIR_MODEL"))
    define("SYSDIR_MODEL", SYSDIR_ROOT. "/model" );
if(!defined("SYSDIR_API"))
    define("SYSDIR_API", SYSDIR_ROOT. "/api" );
if(!defined("SYSDIR_VIEW"))
    define("SYSDIR_VIEW", SYSDIR_ROOT. "/view" );
	
if( file_exists(SYSDIR_INCLUDE. "/360safe/360webscan.php") ) {
    require_once SYSDIR_INCLUDE. "/360safe/360webscan.php";
}

include_once SYSDIR_INCLUDE. "/config.inc.php"; 
include_once SYSDIR_INCLUDE. "/mysqli.class.php"; 
include_once SYSDIR_INCLUDE. "/redis.class.php"; 
include_once SYSDIR_INCLUDE. "/func.utils.php";
include_once SYSDIR_INCLUDE. "/globals.php";

include_once SYSDIR_MODEL. "/admin.class.php";
include_once SYSDIR_INCLUDE. "/page.class.php";
include_once SYSDIR_INCLUDE. "/func.common.php";

session_save_path(SYSDIR_CACHE .'/sessions');
session_name('sessoinid');
session_start();

/* 其它全局配置 */
//huiadmin模板资源
if(!defined("SYSDIR_HUIADMIN"))
    define("SYSDIR_HUIADMIN", "/statics/huiadmin" );

$_GLOBALS['web_title'] = 'xx数据管理中心';
$_GLOBALS['web_name'] = '数据管理中心';

$unlogin_arr = array(
    '/admin/common/login.php',
    '/admin/common/validateCode.php'
);
//是否跳转到登录
if (!in_array($_SERVER['SCRIPT_NAME'], $unlogin_arr)) {
    if (!$_SESSION['admin_info']) {
        header('Location:/admin/common/login.php');
        exit;
    }
}
