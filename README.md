#man
#密码规则
1.admin_info->admin_pwd 规则md5(md5($pwd))
#数据库驱动
mysqli.class.php -> update/insert 方法已做防注入过滤，
                 -> query 方法未做安全过滤
#数据库配置文件
include/config.inc.php
#目录结构说明#
man/admin 控制器业务逻辑目录
man/model 数据模型
man/view 模板视图
man/cache 缓存目录
man/include 配置文件或公共类等
man/include/init.php 初始化文件
man/statics 静态资源文件images/css/js
man/api 给外部调用接口

#初始化文件
include/init.php
#全局变量定义
include/globals.php
#工具函数
include/func.utils.php
#公共函数
include/func.commmon.php

#数据库导入包
man.sql

#注意cache/sessions存放当前会话，应忽略git
