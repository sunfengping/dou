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
$card_id=$_REQUEST['card_id']; 


$productids = $dou->fn_query("select cat_ids from 58_admin where card_id='".$card_id."'");
 	 
	$str=explode(',', $productids[0]["cat_ids"]); 
foreach ($str as $key => $value) {
	 
    if($value!=''){
	$data[]=$value; 
 
	}
} 
$yewu='';
foreach ($data as $key => $value) {
   $productname = $dou->fn_query("select cat_name from 58_product_category where cat_id =".$value);
	$yewu=$yewu." ".$productname[0]["cat_name"];
}


$product = $dou->fn_query("select c.company,c.contacts,c.phone,c.address,p.name as pname from 58_company c,58_product p,58_list l where l.card_id='".$card_id."' and p.id=l.ppid and p.company=c.company ");
if($product!=null){
	$arr = array('data'=>array('message'=>'ok'),'list'=>$product,'yewu'=>$yewu);
}else{
	$arr = array('data'=>array('message'=>'error'));
}
echo json_encode($arr);




?>