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

$phoneno=$_REQUEST['phoneno'];

$oldphone=$_REQUEST['oldphone'];

$user = $dou->fn_query("select * from 58_admin where user_name='".$phoneno."' ");
$flagphoneno = $dou->fn_query("select * from 58_admin where mobile =".$phoneno."");
if(count($user)>0){ 
	$arr = array('data'=>array('message'=>'已存在'));
}else{
	if(count($flagphoneno)>0){
		$arr = array('data'=>array('message'=>'手机号已存在'));
	}else{
	$product = $dou->fn_query("UPDATE 58_admin SET user_name = '".$phoneno."' , mobile = '".$phoneno."' WHERE mobile = '".$oldphone."'");
	  
	$arr = array('data'=>array('message'=>'ok')); 
	}
	 
}
echo json_encode($arr);



?>