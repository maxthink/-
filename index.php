<?php



// 应用入口文件

session_start();

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require '../ThinkPHP3.1.3/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单