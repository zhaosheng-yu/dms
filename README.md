极简后台基础管理系统; 采用mvc模型，纯php原生操作无模板引擎; 响应式前端框架huiadmin套用，扁平化风格，兼容移动端;

包括：

1、登录验证
2、用户管理
3、权限管理
4、系统日志
5、菜单管理

#目录结构说明#
man/admin 控制器业务逻辑目录
man/model 数据模型
man/view 模板视图
man/cache 缓存目录
man/include 配置文件或公共类等
man/include/init.php 初始化文件
man/statics 静态资源文件images/css/js
man/api 给外部调用接口

#数据库配置文件
include/config.inc.php
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

#demo地址：http://www.yuzhaosheng.site/
账号：admin 密码：123456

#联系作者111ssdfss：yzs901224@qq.com

1
fds