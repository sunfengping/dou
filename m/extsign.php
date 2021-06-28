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
    
$transaction_id=$_POST['transaction_id'];
$contract_id=$_POST['contract_id'];
    $result_code=$_POST['result_code'];
    $result_desc=$_POST['result_desc'];
    $viewpdf_url=$_POST['viewpdf_url'];
	 
	$arr = $dou->query("INSERT INTO msg VALUES  ('".$result_code."','".$result_desc."','".$transaction_id."')"); 
    if($result_code==3000){
          $arr = $dou->query("UPDATE 58_admin SET fadadacontract_status = 2 ,contract_status = 1 WHERE user_name = '".$transaction_id."' or mobile='".$transaction_id."'"); 
		$product = $dou->query("UPDATE 58_list set status = 1,username='".$transaction_id."' ,user_id= (SELECT user_id from 58_admin where user_name='".$transaction_id."') WHERE card_id in (SELECT card_id from 58_admin where user_name='".$transaction_id."')");
			 $curl = curl_init();
    //设置抓取的url
      curl_setopt($curl, CURLOPT_URL, 'https://textapi.fadada.com/api2/contractFiling.api');
      //设置头文件的信息作为数据流输出
      curl_setopt($curl, CURLOPT_HEADER, 1);
      //设置获取的信息以文件流的形式返回，而不是直接输出。
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      //设置post方式提交
     curl_setopt($curl, CURLOPT_POST, 1);
	 $datetime=date('YmdHis',time()); 
	$msg=base64_encode(strtoupper(sha1('500027'.strtoupper(md5($datetime).strtoupper(sha1('TS3vgGOdn3LfUNJUyifJvVxv'.$contract_id))))));
     //设置post数据
     $post_data = array(
         "app_id" => "500027",
         "timestamp" => $datetime,
		 "v"=>"2.0",
		 "msg_digest"=>$msg,
		 "contract_id"=>$contract_id
         );
     curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
     //执行命令
     $data = curl_exec($curl);
     //关闭URL请求
     curl_close($curl);
	 
     //显示获得的数据
     print_r($data);
	 
		 
    }else{
        $arr = array('data'=>array('message'=>$result_desc,'msg'=>$result_code));
    }



if($arr!=null){
	echo '<div style="font-size:50px; font-weight:bold;">签署成功</div>';
}else{
	echo '<div style="font-size:50px; font-weight:bold;">签署失败</div>';
}



?>
