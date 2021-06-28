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
$name=$_REQUEST['account'];
$password=$_REQUEST['password'];
$phoneno=$_REQUEST['phoneno'];

$password=md5($password); 
$user = $dou->fn_query("select * from 58_admin where user_name='".$name."' ");
$flagphoneno = $dou->fn_query("select * from 58_admin where mobile =".$phoneno."");
if(count($user)>0){ 
	$arr = array('data'=>array('message'=>'已存在'));
}else{
	if(count($flagphoneno)>0){
		$arr = array('data'=>array('message'=>'手机号已存在'));
	}else{
	$product = $dou->fn_query("INSERT INTO 58_admin (user_name,email,`password`,action_list,add_time,last_login,last_ip,type,card_id,mobile,`status`,truename,bankno) VALUES ('".$name."', ' ', '".$password."',' ',unix_timestamp(now()),0,'','2','','".$phoneno."',0,'','')");
	  
	$arr = array('data'=>array('message'=>'ok')); 
	}
	 
}
echo json_encode($arr);



?>