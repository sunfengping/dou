<?php

/**

 * DouPHP

 * --------------------------------------------------------------------------------------------------

 * 版权所有 2013-2019 漳州豆壳网络科技有限公司，并保留所有权利。

 * 网站地址: http://www.douphp.com

 * --------------------------------------------------------------------------------------------------

 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发

布。

 * 授权协议: http://www.douphp.com/license.html

 * --------------------------------------------------------------------------------------------------

 * Author: DouCo

 * Release Date: 2019-01-08

 */

define('IN_DOUCO', true);



require (dirname(__FILE__) . '/include/init.php');
$truename=$_REQUEST['truename'];
$bankno=$_REQUEST['bankno'];
$username=$_REQUEST['username'];
$cardid=$_REQUEST['cardid'];
$carddate=$_REQUEST['carddate'];
$email=$_REQUEST['email']; 
$bankinfo=$_REQUEST['bankinfo'];
$khcity=$_REQUEST['khcity'];
$product = $dou->query("UPDATE 58_admin SET truename = '".$truename."',bankno='".$bankno."' ,card_id='".$cardid."' , carddate= '".$carddate."' ,email='".$email."',bankinfo='".$bankinfo."',khcity='".$khcity."' WHERE user_name = '".$username."' ");
	if($product){
		$arr = array('data'=>array('message'=>'ok'));
	}else{
	$arr = array('data'=>array('message'=>'error'));
}
echo json_encode($arr);



?>
