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
$id=$_REQUEST['id'];
$user_id=$_REQUEST['userid']; 
$end_time = $dou->fn_query("SELECT end_time from 58_product where id =".$id."");
 
	 if($end_time[0]["end_time"]>=date('Y-m-d H:i:s',time())){
		$arr = $dou->query("UPDATE 58_list set status=1  ,finish_time =NOW() where user_id=".$user_id." and pid=".$id."");
	
			if($arr){
				$arr = array('data'=>array('message'=>'ok')); 
			}else{
				$arr = array('data'=>array('message'=>'error'),'user'=>'');
			}
		}
		else{
			$arr = array('data'=>array('message'=>'超出任务截止时间'),'user'=>'');
		}
	 

	 echo json_encode($arr); 



?>