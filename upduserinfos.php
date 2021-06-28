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
$username=$_REQUEST['username'];
 

$product = $dou->fn_query("SELECT truename,bankno,card_id,bankinfo,email,carddate ,khcity from 58_admin where user_name='".$username."' or mobile='".$username."'");

	if($product[0]["truename"]==""&&$product[0]["bankno"]==""&&$product[0]["card_id"]==""){
		$product = $dou->fn_query("SELECT card_id ,truename,bankno, bankinfo from 58_list WHERE mobile='".$username."'");
		$arr = array('data'=>array('message'=>'ok'),'list'=>$product);
	}else{
		if($product!=null){
			$arr = array('data'=>array('message'=>'ok'),'list'=>$product);
		}else{
			$arr = array('data'=>array('message'=>'error'));
		}
	}

echo json_encode($arr);



?>
