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




require ('aestest.php');



// if ($rec == 'auth') {

    if(isset($_REQUEST['mobile']))
    {
        $data['mobile']=$_REQUEST['mobile'];
    }
    if(isset($_REQUEST['taxnum']))
    {
        $data['taxnum']=$_REQUEST['taxnum'];
    }
    if(isset($_REQUEST['phone']))
    {
        $data['phone']=$_REQUEST['phone'];
    }
    if(isset($_REQUEST['name']))
    {
        $data['name']=$_REQUEST['name'];
    }
    if(isset($_REQUEST['thirdUserId']))
    {
        $data['thirdUserId']=$_REQUEST['thirdUserId'];
    }
    if(isset($_REQUEST['jumpUrl']))
    {
        $data['jumpUrl']=$_REQUEST['jumpUrl'];
    }
    $url = "http://auth.nuonuo.com/auth/v1/apply.do";//test
    $keyStr = '05d3bb05290e4578';
     
    $data=json_encode($data);
    $aes = new CryptAES();
    $aes->set_key($keyStr);
    $aes->require_pkcs5();
    $encText = $aes->encrypt($data);
    $encText=base64_encode($encText);
 
    $reuslt = curl_post($url,$encText);
 
    $dou->dou_msg($_LANG['user_insert_success'],$reuslt);


// }



 function curl_post($url,$data)
{
     $con = curl_init( $url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_POSTFIELDS, $data);
    curl_setopt($con, CURLOPT_POST,true);
    $header = array("content-type: text/plain","X-Nuonuo-authId:55005487");
    curl_setopt($con,CURLOPT_HTTPHEADER,$header);
    curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
    $result = curl_exec($con);
    return $result;

}


function curl_posts($url,$data)
{
    $chHandler = curl_init();
    curl_setopt($chHandler, CURLOPT_URL, $url);
    curl_setopt($chHandler, CURLOPT_FAILONERROR, true);
    curl_setopt($chHandler, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($chHandler, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
    curl_setopt($chHandler, CURLOPT_POST, true);
    $header = array("content-type:text/plain","X-Nuonuo-authId:");
    curl_setopt($chHandler, CURLOPT_HTTPHEADER, $header);
    curl_setopt($chHandler, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($chHandler, CURLOPT_POSTFIELDS, json_encode($data));
    $return = curl_exec($chHandler);
    if (curl_errno($chHandler)) {
        file_put_contents('error.txt',curl_error($chHandler));
        echo curl_error($chHandler);
    }
    curl_close($chHandler);
    return $return;

}



?>