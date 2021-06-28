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
$card_id=$_REQUEST['card_id'];
 

	

	$product = $dou->query("UPDATE 58_admin SET contract_status = 1 WHERE user_name = '".$username."' ");
		if($product){
			$product = $dou->query("UPDATE 58_list set status = 1,username='".$username."' ,user_id= (SELECT user_id from 58_admin where user_name='".$username."') WHERE card_id = '".$card_id."' ");
			 
			if($product){
				$arr = array('data'=>array('message'=>'ok'));
			}else{
				$arr = array('data'=>array('message'=>'error'));
			}
		}else{
			$arr = array('data'=>array('message'=>'error'));
		}

echo json_encode($arr);



?>