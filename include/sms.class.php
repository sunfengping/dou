<?php
/**
 * 沃动科技短信
 * Created by PhpStorm.
 * @author: YJC
 * @date: 2016/9/26
 * @link http://www.movek.net/
 */
class Sms
{
    private static $userid = '10748';	//企业id
    private static $account = 'SDK-A10748-10748';	//用户账号
    private static $password = '#DPVl!tC0';	//用户密码
    private static $http = 'http://api.movek.net:8513/sms/Api/Send.do';		//发送地址
     private static $sign = '【共包极丁】';	//短信签名


    /**
     * 发送内容短信
     * @param $mobile
     * @param $content 短信内容
     * @param $time 定时发送时间,为空表示立即发送
     * @return mixed
     */
    public function sendNormal($mobile, $content, $time='')
    {
        //判断是否为多个手机号即数组，数组转换成字符串，用,分割
        if(is_array($mobile)){
            $mobile = implode(',',$mobile);
        }

        $data = array(
            'SpCode'=>self::$userid,//企业ID
            'LoginName'=>self::$account,//用户帐号，由系统管理员
            'Password'=>self::$password,//用户账号对应的密码
            'UserNumber'=>$mobile,//发信发送的目的号码.多个号码之间用半角逗号隔开
            'MessageContent'=>self::$sign.$content,//短信的内容，内容需要UTF-8编码
            'SerialNumber'=>$time,//定时发送时间,为空表示立即发送，定时发送格式2010-10-24 09:08:10
            'ScheduleTime'=>''
        );
        return self::postSMS($data);
    }

    /**
     * 发送模板短信
     * @param $mobile
     * @param $temp_id
     * @return mixed
     */
    public function send($mobile, $temp_id)
    {
        return false;
    }

    /**
     * 发送语音短信
     * @param $mobile
     * @param $temp_id
     * @return mixed
     */
    public function sendVoice($mobile, $temp_id)
    {
        return false;
    }

    //短信下发接口
    private static function postSMS($data)
    {
        $post = http_build_query($data, '&');
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_HEADER ,0);
        curl_setopt($ch, CURLOPT_URL, self::$http);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded", "Content-length: " . strlen($post)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $result['res'] = curl_exec($ch);
        curl_close($ch);
        $result_arr=explode('&',$result['res']);

        //发送结果
        if(in_array('result=0',$result_arr)){
             $result['status'] = 1;
        }else{
             $result['status'] = 0;
        }

        return $result;
    }

    /**
     * 余额及已发送量查询接口
     * @return mixed
     */
    public static function checkBalance(){
        $data = array(
            'userid'=>self::$userid,//企业ID
            'account'=>self::$account,//用户帐号，由系统管理员
            'password'=>self::$password,//用户账号对应的密码
            'action'=>'overage',//发送任务命令,设置为固定的:send
        );

        $post = http_build_query($data, '&');
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_HEADER ,0);
        curl_setopt($ch, CURLOPT_URL, self::$http);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded", "Content-length: " . strlen($post)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $result['res'] = curl_exec($ch);
        /*$result['errno']   = curl_errno($ch);
        $result['errmsg']  = curl_error($ch);
        $result['header']  = curl_getinfo($ch);
        print_r($post);
        pr($result);
        exit;*/
        curl_close($ch);
        $result =  self::xml_to_array($result['res']);
        return $result['returnsms'];

    }


//xml转数组
    private static  function xml_to_array( $xml )
    {
        $reg = "/<(\\w+)[^>]*?>([\\x00-\\xFF]*?)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches))
        {
            $count = count($matches[0]);
            $arr = array();
            for($i = 0; $i < $count; $i++)
            {
                $key= $matches[1][$i];
                $val =  self::xml_to_array( $matches[2][$i] );  // 递归
                if(array_key_exists($key, $arr))
                {
                    if(is_array($arr[$key]))
                    {
                        if(!array_key_exists(0,$arr[$key]))
                        {
                            $arr[$key] = array($arr[$key]);
                        }
                    }else{
                        $arr[$key] = array($arr[$key]);
                    }
                    $arr[$key][] = $val;
                }else{
                    $arr[$key] = $val;
                }
            }
            return $arr;
        }else{
            return $xml;
        }
    }

}