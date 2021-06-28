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
$account_type = $_REQUEST['account_type'];
$open_id = $_REQUEST['open_id'];

$curl = curl_init();
//设置抓取的url
curl_setopt($curl, CURLOPT_URL, 'https://textapi.fadada.com/api2/account_register.api');
//设置头文件的信息作为数据流输出
curl_setopt($curl, CURLOPT_HEADER, 1);
//设置获取的信息以文件流的形式返回，而不是直接输出。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//设置post方式提交
curl_setopt($curl, CURLOPT_POST, 1);

//$datetime=date('YmdHis',time());
//$msg=base64_encode(strtoupper(sha1('500027'.strtoupper(md5($datetime).strtoupper(sha1('TS3vgGOdn3LfUNJUyifJvVxv'.'1'.$open_id))))));
//设置post数据
$post_data = array(
    "app_id" => $app_id,
    "timestamp" => $timestamp,
    "v" => $v,
    "msg_digest" => $msg_digest,
    "account_type" => $account_type,
    "open_id" => $open_id
);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
//执行命令
$data = curl_exec($curl);
$strs = explode('{', $data);
$data = '';
for ($i = 1; $i < count($strs); $i++) {
    $data = $data . '{' . $strs[$i];
}

//关闭URL请求
curl_close($curl);


echo $data;


?>
