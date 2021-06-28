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
 $card_id=$_REQUEST['card_id'];
//$product = $dou->fn_query("SELECT p.id,p.name,p.jisuandw,(SELECT user_name from 58_admin where user_id=(SELECT user_id from 58_product where id=(SELECT pid from 58_product where id=".$id.")))as user_name,p.content,p.max,p.price ,COUNT(l.username) as countuser,p.city ,p.add_time,stop_time,start_time,end_time from 58_product p LEFT JOIN 58_list l on p.id=l.pid where p.id=".$id." GROUP BY p.id");
$product = $dou->fn_query("SELECT p.id,p.name,p.jisuandw,('华煌信息科技（山东）有限公司')as user_name,p.content,p.max,p.price ,COUNT(l.username) as countuser,p.city ,p.add_time,stop_time,start_time,end_time,p.pid,l.bmtype,p.price_to,p.price_type  from 58_product p LEFT JOIN 58_list l on p.id=l.ppid where p.id=".$id." and l.card_id='".$card_id."' GROUP BY p.id");

if($product!=null){
	$arr = array('data'=>array('message'=>'ok'),'list'=>$product);
}else{
	$arr = array('data'=>array('message'=>'error'));
}
echo json_encode($arr);



?>