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


require(dirname(__FILE__) . '/include/init.php');

$app_id = $_REQUEST['app_id'];
$v = $_REQUEST['v'];
$msg_digest = $_REQUEST['msg_digest'];
$timestamp = $_REQUEST['timestamp'];
$doc_title = $_REQUEST['doc_title'];
$template_id = $_REQUEST['template_id'];
$contract_id = $_REQUEST['contract_id'];
$font_size = $_REQUEST['font_size'];
$font_type = $_REQUEST['font_type'];
$parameter_map = $_REQUEST['parameter_map'];
$headers = $_REQUEST['headers'];


$jsonString = stripslashes($parameter_map);
//$parameter_map =json_decode($jsonString,true);

 //$datetime=date('YmdHis',time()); 
//$msg=base64_encode(strtoupper(sha1('402487'.strtoupper(md5($datetime).strtoupper(sha1('1tPmZcTQUMQ61Y4rnt6iF2Qa'.$template_id.$contract_id)).$parameter_map))));


$curl = curl_init();
//设置抓取的url
curl_setopt($curl, CURLOPT_URL, 'https://textapi.fadada.com/api2/api/generate_contract.api');
//设置头文件的信息作为数据流输出
curl_setopt($curl, CURLOPT_HEADER, 1);
//设置获取的信息以文件流的形式返回，而不是直接输出。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//设置post方式提交
curl_setopt($curl, CURLOPT_POST, 1);


//设置post数据
$post_data = array(
    "app_id" => $app_id,
    "timestamp" => $timestamp,
    "v" => $v,
    "msg_digest" => $msg_digest,
    "doc_title" => $doc_title,
    "template_id" => $template_id,
    "contract_id" => $contract_id,
    "font_size" => $font_size,
    "font_type" => $font_type,
    "parameter_map" => $jsonString,
    "headers" => $headers

);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
//执行命令
$data = curl_exec($curl);
$strs = explode('{', $data);
$data='';
for($i=1;$i<count($strs);$i++){
    $data=$data.'{'.$strs[$i];
}
 $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	
	$txt = $app_id."\n".$timestamp."\n".$v."\n".$msg_digest."\n".$doc_title."\n".$template_id."\n".$contract_id."\n".$font_size."\n".$font_type."\n".$jsonString."\n".$headers."\n";
	fwrite($myfile, $txt);
	fclose($myfile);
//关闭URL请求
curl_close($curl);


echo $data;


?>
