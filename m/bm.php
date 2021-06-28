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
$name=$_REQUEST['userName'];
$userid=$_REQUEST['userid'];
$cardid=$_REQUEST['cardid'];
$money=$_REQUEST['money'];
$addtime=$_REQUEST['addtime'];
$pid=$_REQUEST['pid'];
if($pid==null){
	$pid=0;
}
$product = $dou->fn_query("SELECT max from 58_product where id=".$id." ");
$counts = $dou->fn_query("SELECT COUNT(*) as counts from 58_list where pid=".$id." ");
$flag = $dou->fn_query("SELECT *   from 58_list where pid=".$id." and username='".$name."'");
$stop_time = $dou->fn_query("SELECT stop_time from 58_product where id =".$id."");
$productflag = $dou->fn_query("SELECT id from 58_product where  id=".$id." and  bind_mobile like  CONCAT('%', (SELECT `mobile` FROM 58_admin WHERE user_id=".$userid."), '%')");
$contract_status = $dou->fn_query("SELECT contract_status from 58_admin WHERE user_id=".$userid."");
$userinfo = $dou->fn_query("SELECT * from 58_admin WHERE user_id=".$userid."");
 

if(count($flag)>0){
	$arr = array('data'=>array('message'=>'已经报名，请勿重复报名'),'user'=>'');
}else{ 
	if($userinfo[0]["truename"]!=null&&$userinfo[0]["truename"]!="null"&&$userinfo[0]["truename"]!=""&&$userinfo[0]["bankno"]!=null&&$userinfo[0]["bankno"]!="null"&&$userinfo[0]["bankno"]!=""&&$userinfo[0]["card_id"]!=null&&$userinfo[0]["card_id"]!="null"&&$userinfo[0]["card_id"]!=""){
		
	
	if($contract_status[0]["contract_status"]!=null&&$contract_status[0]["contract_status"]='null'){
		if($productflag!=null&&$productflag='null'){
			if((int)$product[0]["max"]>(int)$counts[0]["counts"]){
				 if($stop_time[0]["stop_time"]>=date('Y-m-d H:i:s',time())){
					 
					$arr = $dou->query("INSERT INTO 58_list (username,pid,user_id,add_time,status,pay_money,card_id,ppid)VALUES ('".$name."',".$id.",".$userid.",'".$addtime."',0,".$money.",'".$cardid."',".$pid.")");
				 
						if($arr){
							$arr = array('data'=>array('message'=>'ok'),'user'=>$product); 
						}else{
							$arr = array('data'=>array('message'=>'error'),'user'=>'');
						}
					}
					else{
						$arr = array('data'=>array('message'=>'超出任务截止时间'),'user'=>'');
					}
			}else{
				$arr = array('data'=>array('message'=>'error'),'user'=>'');
			}
		 
		}else{
			$arr = array('data'=>array('message'=>'该任务为特定任务，您无法领取该任务'));
		}
	}else{
			$arr = array('data'=>array('message'=>'领取任务前请前往在消息中心签署协议'));
	}
	}else{
		$arr = array('data'=>array('message'=>'请在个人中心完善个人信息'));
	}
}
echo json_encode($arr);
	 



?>