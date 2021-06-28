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
require (ROOT_PATH . 'include/sms.class.php');
$mobile=$_REQUEST['mobile'];
$vcode=$_REQUEST['vcode'];

if(!$check->is_telphone($mobile))
{
    $return =array(
        'status'=>0,
        'msg'=>'手机号格式不正确'
    );
    echo  json_encode($return);
    exit;
}
//$content = '验证码：'.$vcode;
$content='验证码：'.$vcode.'请勿告知他人，30分钟内有效。如非本人操作，请忽略此短信。';
$sms = new Sms();
$result =  $sms->sendNormal($mobile,$content);

$result = $result['res'];

$result_arr=explode('&',$result);

 if($result_arr[0]=='result=0')
{
    $return =array(
        'status'=>1,
        'msg'=>'发送成功'
     );
}
else
{
    $return =array(
        'status'=>1,
        'msg'=>'发送失败'
    );
}
echo json_encode($return);



?>