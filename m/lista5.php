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
 $searchtext=$_REQUEST['searchtext'];
  $sortindex=$_REQUEST['sortindex'];
$catid=$_REQUEST['catid'];
//$product = $dou->fn_query("SELECT p.id,(SELECT cat_name FROM 58_product_category where cat_id=p.cat_id) as cat_name,p.name ,p.max,p.price ,COUNT(l.username) as countuser,p.stop_time,p.city from 58_product p LEFT JOIN 58_list l on p.id=l.pid where p.bind_mobile like '%".$mobile."%'  and p.end_time>= date(now()) and type=0 GROUP BY p.id");
	//if($product==null||$mobile==""||mobile==null){
		$sql="SELECT p.id,p.jisuandw,(SELECT cat_name FROM 58_product_category where cat_id=p.cat_id) as cat_name,p.name,p.max,p.price ,COUNT(l.username) as countuser,p.stop_time,p.city ,p.price_to ,p.price_type from 58_product p LEFT JOIN 58_list l on p.id=l.pid where  type=1 and p.end_time>= date(now()) and p.pid=0";
		if($searchtext!=null&&$searchtext!=""){
			$sql=$sql." and name like '%".$searchtext."%'";
		}
		if($catid!=null&&$catid!=""&&$catid!="0"){
			$sql=$sql." and  cat_id in (select cat_id from 58_product_category where parent_id=".$catid.")";
		}
		$sql=$sql." GROUP BY p.id";
		if($sortindex!=null&&$sortindex!=""){
			if($sortindex==0){
				
			}else if($sortindex==1){
				$sql=$sql."  ORDER BY p.add_time ";
			}else if($sortindex==2){
				$sql=$sql."  ORDER BY p.stop_time ";
			}else if($sortindex==3){
				$sql=$sql." ORDER BY p.price_to";
			}else if($sortindex==11){
				$sql=$sql." ORDER BY p.add_time desc";
			}else if($sortindex==22){
				$sql=$sql." ORDER BY p.stop_time desc";
			}else if($sortindex==33){
				$sql=$sql." ORDER BY p.price_to desc";
			}
		
		}
		
		$product = $dou->fn_query($sql);
	//} 

if($product!=null){
	$arr = array('data'=>array('message'=>'ok'),'list'=>$product);
}else{
	$arr = array('data'=>array('message'=>'error'));
}
echo json_encode($arr);



?>