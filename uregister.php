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



require (dirname(__FILE__) . '/include/init.php');
$name=$_REQUEST['username'];
$password=$_REQUEST['password'];
$truename=$_REQUEST['truename'];
 
$phoneno=$_REQUEST['phone'];
$taxnum=$_REQUEST['taxnum'];
$password=md5($password); 
$user = $dou->fn_query("select * from 58_u_admin where username='".$name."' ");

if(count($user)>0){ 
	$arr = array('data'=>array('message'=>'已存在'));
}else{
 
	$product = $dou->fn_query("INSERT INTO 58_u_admin (username,password,name,phone,taxnum) VALUES ('".$name."','".$password."','".$truename."','".$phoneno."','".$taxnum."')");
	$arr = array('data'=>array('message'=>'ok')); 
	
	 
}
echo json_encode($arr);



?>