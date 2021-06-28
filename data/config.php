<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2014-2015 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douphp.com
 * --------------------------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议: http://www.douphp.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2015-06-10
 */

// database host
$dbhost   = "127.0.0.1";

// database name
$dbname   = "dou";

// database username
$dbuser   = "douroot";

// database password
$dbpass   = "%_&Og_Dou_2016&_%";

// table prefix
$prefix   = "58_";

// charset
define('DOU_CHARSET', 'utf-8');

// system sign
define('SYSTEM_SIGN', 'company');

// administrator path
define('ADMIN_PATH', isset($admining) ? $admining : 'admin');

// mobile path
define('M_PATH', 'm');

// miniprogram path
define('MINIPROGRAM_PATH', 'miniprogram');

?>