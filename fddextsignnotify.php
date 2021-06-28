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
$mobile=$_REQUEST['transaction_id'];
 $contract_id=$_REQUEST['contract_id'];
    $result_code=$_REQUEST['result_code'];
    $result_desc=$_REQUEST['result_desc'];
    $viewpdf_url=$_REQUEST['viewpdf_url'];
    if($result_code==3000){
          $arr = $dou->query("UPDATE 58_admin SET fadadacontract_status = 2 ,viewpdf_url=".$viewpdf_url." WHERE user_name = ".$username." or mobile=".$username." ");
    }else{
        $arr = array('data'=>array('message'=>$result_desc));
    }



if($product!=null){
	$arr = array('data'=>array('message'=>'ok'),'list'=>$product);
}else{
	$arr = array('data'=>array('message'=>'error'));
}
echo json_encode($arr);



?>
