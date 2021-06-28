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


$product = $dou->fn_query("SELECT p.id,p.name,p.content,p.max,p.price ,p.stop_time,p.city,p.jisuandw,(SELECT cat_name FROM 58_product_category where cat_id=p.cat_id) as cat_name,COUNT(l.username) as countuser,l.status,l.bmtype ,p.price_to,p.price_type from 58_product p LEFT JOIN 58_list l on p.id=l.ppid where l.is_del=0 and l.username='".$username."' GROUP BY p.id");

if($product!=null){
	$arr = array('data'=>array('message'=>'ok'),'list'=>$product);
}else{
	$arr = array('data'=>array('message'=>'error'));
}
echo json_encode($arr);



?>