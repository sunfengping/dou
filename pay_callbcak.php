<?php

/**

 * DouPHP

 * --------------------------------------------------------------------------------------------------

 * 版权所有 2013-2019 漳州豆壳网络科技有限公司，并保留所有权利。

 * 网站地址: http://www.douphp.com

 * --------------------------------------------------------------------------------------------------

 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。

 * 授权协议: http://www.douphp.com/license.html

 * --------------------------------------------------------------------------------------------------

 * Author: DouCo

 * Release Date: 2019-01-08

 */

define('IN_DOUCO', true);
echo "11111111111111111";exit;
require (dirname(__FILE__) . '/include/init.php');
$getpost = file_get_contents("php://input");
$post = json_decode($getpost,true);
var_dump($post);

$post=array(
    array(
        'exNo'=>'No2019081014594041',
        'result'=>1
    ),
    array(
        'exNo'=>'No2019081014594040',
        'result'=>0
    )
);

$jsons = json_encode($post);
var_dump($jsons);exit;






?>