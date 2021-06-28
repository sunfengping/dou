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
$sub = 'login|login_post|check|checkpaypro|check_test|register|register_post|edit|list|userlist|del_pro|edit_post|password|password_post|password_reset|password_reset_post|logout|sendcode|order_list|order|order_cancel|sns|sns_link|pay_callback|read';
$subbox = array(
        "module" => 'user',
        "sub" => $sub
);
require (dirname(__FILE__) . '/include/init.php');
// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

//// 引入和实例化订单功能
if (file_exists($order_file = ROOT_PATH . 'include/order.class.php')) {
    include_once ($order_file);
    $dou_order = new Order();
}
// 设定不需要登录权限的页面
$no_login_array = explode('|', 'login|login_post|check|checkpaypro|check_test|register|pay_callback|register_post|password_reset|password_reset_post|sns_link|sendcode|read');

 // 需要登录且没有登录的情况
if (!in_array($rec, $no_login_array) && !is_array($_SESSION[DOU_ID])) {
    $dou->dou_header($_URL['login']);
}
 if(isset($_SESSION[DOU_ID])&&!empty($_SESSION[DOU_ID])&&!in_array($rec, $no_login_array))
{
     if(intval($_SESSION[DOU_ID]['user_id'])<=0)
    {
         $dou->dou_header($_URL['login']);
    }
    else
    {
        $user_info = $dou->get_row('admin', '*', "user_id = '" . $_SESSION[DOU_ID]['user_id'] . "'");
        $_GLOBAL_USER=$user_info;
    }
}

// 不需要登录却登录的情况
if (in_array($rec, $no_login_array) && is_array($_GLOBAL_USER)) 
    $dou->dou_header($_URL['user']);
// 赋值给模板-meta和title信息
$smarty->assign('keywords', $_CFG['site_keywords']);
$smarty->assign('description', $_CFG['site_description']);
// 赋值给模板-导航栏
$smarty->assign('nav_top_list', $dou->get_nav('top'));
$smarty->assign('nav_middle_list', $dou->get_nav('middle', 0, 'user', 0));
$smarty->assign('nav_bottom_list', $dou->get_nav('bottom'));

// 赋值给模板-数据
$smarty->assign('rec', $rec);
$cur_filter='0';
$smarty->assign('cur_filter', $cur_filter);

//$smarty->assign('link_user_center', $dou_user->link_user_center());
$smarty->assign('if_connect_plugin', $dou->value_exist('plugin', 'plugin_group', 'connect'));
/**
 * +----------------------------------------------------------
 * 会员中心
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
 	   // 获取会员信息
	   $user_info = $dou->get_row('admin', '*', "user_id = '" . $_GLOBAL_USER['user_id'] . "'");
	
	// 格式化数据
	//$user_info['avatar'] = $user_info['avatar'] ? $dou->dou_file($user_info['avatar']) : ROOT_URL . 'images/avatar/..empty.png';
    $user_info['last_login'] = date("Y-m-d H:i", $dou->get_first_log($user_info['last_login']));
    //$user_info['last_ip'] = $dou->get_first_log($user_info['last_ip']);
     $smarty->assign('page_title', $dou->page_title('user'));
     $smarty->assign('ur_here', $dou->ur_here('user'));
     $smarty->assign('head', $_LANG['user']);
     $smarty->assign('user_info', $user_info);
     //$smarty->assign('welcome', $dou_user->welcome());
     $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 登录注册页面
 * +----------------------------------------------------------
 */
elseif ($rec == 'register') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('user_register'));
    
    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'user_register'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_register'));
    $smarty->assign('head', $_LANG['user_register']);
	$smarty->assign('sns_token', $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '');
    
    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 注册提交
 * +----------------------------------------------------------
 */
elseif ($rec == 'register_post') {
    // 安全处理用户输入信息
    $_POST['user_name'] = $firewall->dou_foreground($_POST['user_name']);
    
    // 验证用户名
    if (!$check->is_username($_POST['user_name'])) {
        $wrong['user_name'] ="用户名请以字母开头，由字母数字下划线组成！";
    } elseif ($dou->value_exist('admin', 'user_name', $_POST['user_name'])) {
        $wrong['user_name'] = "该用户名已存在";
    }

    // 验证身份证
    if (!$check->is_cardId($_POST['card_id'])) {
        $wrong['card_id'] ="身份证格式错误！";
    } elseif ($dou->value_exist('admin', 'card_id', $_POST['card_id'])) {
        $wrong['card_id'] = "该身份证已存在";
    }
    // 验证手机号
    if (!$check->is_telphone($_POST['mobile'])) {
        $wrong['mobile'] ="手机号格式错误！";
    } elseif ($dou->value_exist('admin', 'mobile', $_POST['mobile'])) {
        $wrong['mobile'] = "该手机已存在";
    }
// 验证验证码

    if($_POST['mobile'].$_POST['vcode']!=$_SESSION[DOU_ID]['mobilevcode'])
    {
        $wrong['vcode'] ="验证码不正确！";
    }


    // 图片上传
    include_once (ROOT_PATH . 'include/file.class.php');
    $file = new File('images/cardID/', null, 'jpg,gif,png'); // 实例化类文件(文件上传路径，结尾加斜杠)
    $card_pic='';
    // 文件上传盒子
    if ($_FILES['card_idShow']['name'] != "") {
        $card_pic_filename = 'sfz_' . date('ymdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
        $card_pic = $file->box('admin', $_GLOBAL_USER['user_id'], 'card_idShow', 'main', $card_pic_filename, '', '', 'user_id');
     }
    $card_pic_back='';
    // 文件上传盒子
    if ($_FILES['card_idbackShow']['name'] != "") {
        $card_pic_back_filename = 'sfz_' . date('ymdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
        $card_pic_back = $file->box('admin', $_GLOBAL_USER['user_id'], 'card_idbackShow', 'main', $card_pic_back_filename, '', '', 'user_id');
     }
    // 验证密码
    if (!$check->is_password($_POST['password']))
        $wrong['password'] = $_LANG['user_password_cue'];
    
    // 验证确认密码
    if (!isset($wrong['password']) && ($_POST['password_confirm'] !== $_POST['password']))
        $wrong['password_confirm'] = $_LANG['user_password_confirm_cue'];


    // AJAX验证表单
    if ($_REQUEST['do'] == 'callback') {
        if ($wrong) {
            foreach ($_POST as $key => $value) {
                $wrong_json[$key] = $wrong[$key];
            }
            echo json_encode($wrong_json);
        }
        exit;
    }

    if ($wrong) {
        foreach ($wrong as $key => $value) {
            $wrong_format .= $wrong[$key] . '<br>';
        }
        $dou->dou_msg($wrong_format,"/user.php?rec=register");
    }
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'user_register');
    
    // 格式化数据
   // $user_sn = $dou_user->rand_user_sn();
    $password = md5($_POST['password']);
    $add_time = time();
    
    $sql = "INSERT INTO " . $dou->table('admin') . " (user_id, user_name,card_id, mobile,type, password, add_time,card_pic,card_pic_back)" . " VALUES (NULL, '$_POST[user_name]','$_POST[card_id]','$_POST[mobile]',1, '$password', '$add_time','$card_pic','$card_pic_back')";
    $dou->query($sql);
        
    // 注册成功后直接登录
    $user = $dou->get_row('admin', '*', "user_name = '$_POST[user_name]'");
    
    // 将会员登录信息写入SESSION
    $_SESSION[DOU_ID]['user_id'] = $user['user_id'];
    $_SESSION[DOU_ID]['shell'] = md5($user['user_name'] . $user['password'] . DOU_SHELL);
    $_SESSION[DOU_ID]['ontime'] = time();
	
//	   // 判断是否正在操作SNS绑定
//	   $sns_token = $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '';
//	   if (is_array($sns = $_SESSION[DOU_ID]['sns'][$sns_token])) {
//					   $dou->query("INSERT INTO " . $dou->table('user_sns') . " (id, user_id, `group`, openid, add_time)" . " VALUES (NULL, '$user[user_id]', '$sns[group]', '$sns[openid]', '$add_time')");
//					   $dou->query("UPDATE " . $dou->table('user') . " SET nickname = '$sns[nickname]', avatar = '$sns[avatar]', sex = '$sns[sex]' WHERE user_id = '$user[user_id]'");
//				}
    
	   // 生成登录记录
    $last_login = time();
    $last_ip = $dou->get_ip();
    $login_count = $user['login_count'] + 1;
    $dou->query("update " . $dou->table('admin') . " SET  last_login = '$last_login', last_ip = '$last_ip' WHERE user_id = " . $user['user_id']);
    $dou->dou_msg($_LANG['user_insert_success'],"/user.php?rec=login");
}
/**
 * +----------------------------------------------------------
 * 先下载再轮询解密验签
 * +----------------------------------------------------------
 */
elseif ($rec == 'check')
{

    file_put_contents('crontab.txt',date('Y-m-d H:i:s')."\r\n",FILE_APPEND);
    //下载文件
    $sql = "SELECT * FROM " . $dou->table('paylist') . " where status=0 ORDER BY id DESC";
    $query = $dou->query($sql);
    $download_result = array();

     if($query->num_rows>0) {
         $sftp_file = ROOT_PATH . ADMIN_PATH . '/include/sftp.class.php';
         include_once($sftp_file);
         //线上
         $config = array("host" => "sftp.yqb.com", "username" => "BZZYGX_1903259", "port" => "22", "password" => "bkot+695+WRU");
         try {
             $sftp = new \Sftp($config);
             while ($row = $dou->fetch_array($query)) {

                 $remote = "/Payment/out/".$row['filename'].".rpy";
                 $local = "/www/wwwroot/58/".$row['filename'].".rpy";
                 $result = $sftp->downftp($remote, $local);
                 if ($result) {
                     $dresult  = array();
                     $dresult['id'] = $row['id'];
                     $dresult['filename'] = $row['filename'];
                     array_push($download_result, $dresult);
                 }
             }
         } catch (\Exception $e) {
              $content =date('Y-m-d H:i:s')."---------------". $e->getMessage().'\r\n';
              file_put_contents('payresponse.txt',$content,FILE_APPEND);
             echo '操作失败' . $e->getMessage();
             exit;
         }
     }
     else
     {
         exit;
     }


    //读取并解密验签
    foreach($download_result as $key=>$value)
    {
        $file_path = $value['filename'].".rpy";
        $paylist_id=$value['id'];
        if(file_exists($file_path)){
            $fp = fopen($file_path,"r");
        }
        $str = fread($fp,filesize($file_path));
        //线上
        $private_key="CYT4tbrFGDABTSP8TyWRnw==";
        $result =  decrypt_pass($str,$private_key);
        //线上
        $public_key1="MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCAXJWK01msDjbu5aSjn+iE8oyG2cRt9MkHK2WmPwDaArVtIYlwNA0EPXo9wq2iPbu9bGa+Lw8UmIvPXBz/QE0asg+hfOxHNZLb3OISNk0ZznBcqESzFPcW5xrNnBKWFtboQ1/AKmX0nZEXUKtArAOiiySCgPFqAKu52Vr5Rv+VfwIDAQAB";
        $public_key1        = chunk_split($public_key1, 64, "\n");
        $public_key1 = "-----BEGIN PUBLIC KEY-----\n$public_key1-----END PUBLIC KEY-----\n";
        $result1=preg_replace('/\n/','***',$result);

        $lines = explode('***',$result1);


        $first_line_arr = explode('|',$lines[0]);
        $sign = $first_line_arr[12];
        $string='';
        for ($i=0; $i < strlen($sign)-1; $i+=2){
            $string .= chr(hexdec($sign[$i].$sign[$i+1]));
        }
        $sign=$string;
        $content2=str_replace(($lines[0]."\n"),'',$result);
        $detailDigest=strtoupper(hash('sha256',$content2));
        $str="merchantNo=".$first_line_arr[0]."&batchNo=".$first_line_arr[1]."&detailNo=".$first_line_arr[2]."&businessType=".$first_line_arr[3]."&fileStatus=".$first_line_arr[4]."&detailCounts=".$first_line_arr[5]."&detailAmounts=".$first_line_arr[6]."&currency=".$first_line_arr[7]."&sussCounts=".$first_line_arr[8]."&sussAmount=".$first_line_arr[9]."&sussCurrency=".$first_line_arr[10]."&signType=".$first_line_arr[11]."&detailDigest=".$detailDigest;
        $flag= openssl_verify($str,$sign,$public_key1,'SHA256');
        if($flag)
        {
            $sql="";
            //读取每行数据并将结果存入数据库中
            for($i=1;$i<count($lines);$i++)
            {
                $item_arr = explode('|',$lines[$i]);
                if(!empty($item_arr))
                {
                    $pay_msg = $item_arr[20]."-".$item_arr[21];
                    $pay_status=-1;
                    $status=4;
                    if($item_arr[20]=='00')
                    {
                        $pay_status=1;
                        $status=2;
                    }
                    $id = str_replace($first_line_arr[0],'',$item_arr[1]);
                    $times =date('Y-m-d H:i:s',time());
                    $sql.="UPDATE " . $dou->table('list') . " SET true_paytime='$times',  status=".$status.",pay_status=".$pay_status.",pay_msg='".$pay_msg."'  WHERE id =".intval($id).";";
                }
            }
            $sql.="UPDATE " . $dou->table('paylist') . " SET status = 2,response_time='".date('Y-m-d H:i:s',time())."' WHERE id =".$paylist_id.";";
            $dou->query_mutiple_update($sql);
        }
    }

    exit;

}
elseif ($rec == 'check_test')
{
    file_put_contents('crontab.txt',date('Y-m-d H:i:s')."\r\n",FILE_APPEND);
    //下载文件
    $sql = "SELECT * FROM " . $dou->table('paylist') . " where status=0 ORDER BY id DESC";
    $query = $dou->query($sql);
    $download_result = array();

    if($query->num_rows>0) {
        $sftp_file = ROOT_PATH . ADMIN_PATH . '/include/sftp.class.php';
        include_once($sftp_file);
        $config = array("host" => "test-sftp.stg.1qianbao.com", "username" => "BZZYGX_117791", "port" => "22", "password" => "BZZYGX_117791");
        try {
            $sftp = new \Sftp($config);
            while ($row = $dou->fetch_array($query)) {

                $remote = "/Payment/out/".$row['filename'].".rpy";
                $local = "/www/wwwroot/58/".$row['filename'].".rpy";
                $result = $sftp->downftp($remote, $local);
                if ($result) {
                    $dresult  = array();
                    $dresult['id'] = $row['id'];
                    $dresult['filename'] = $row['filename'];
                    array_push($download_result, $dresult);
                }
            }
        } catch (\Exception $e) {
            $content =date('Y-m-d H:i:s')."---------------". $e->getMessage().'\r\n';
            file_put_contents('payresponse.txt',$content,FILE_APPEND);
            echo '操作失败' . $e->getMessage();
            exit;
        }
    }

//    $download_result=array(
//        array(
//            'id'=>14,
//            'filename'=>'BZZYGX_B0006_900000117791_20190920152410_1.txt'
//            )
//    );


    //读取并解密验签
    foreach($download_result as $key=>$value)
    {
        $file_path = $value['filename'].".rpy";
        $paylist_id=$value['id'];
        if(file_exists($file_path)){
            $fp = fopen($file_path,"r");
        }
        $str = fread($fp,filesize($file_path));
        $private_key="5BMONVJg6Y4v3Bu6ToHJfg==";
        $result =  decrypt_pass($str,$private_key);
        $public_key1="MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBT1shue2r7wQhGFElwau+jLC5tKolDoRiO/ScdaYwyUzB5hIzgazHNwHqx0Pp44qOmkE15hlRjW/J19yKhyWFEFNI0qV3XAzbhJxIKIgZqSSZykKBu97cOEdzKQ3jTyyncPF5VRrDApQS5qzXj5myJvnSEw0huHwTUZWrLd3txQIDAQAB";
        $public_key1        = chunk_split($public_key1, 64, "\n");
        $public_key1 = "-----BEGIN PUBLIC KEY-----\n$public_key1-----END PUBLIC KEY-----\n";
        $result1=preg_replace('/\n/','***',$result);

        $lines = explode('***',$result1);


        $first_line_arr = explode('|',$lines[0]);
        $sign = $first_line_arr[12];
        $string='';
        for ($i=0; $i < strlen($sign)-1; $i+=2){
            $string .= chr(hexdec($sign[$i].$sign[$i+1]));
        }
        $sign=$string;
        $content2=str_replace(($lines[0]."\n"),'',$result);
        $detailDigest=strtoupper(hash('sha256',$content2));
        $str="merchantNo=".$first_line_arr[0]."&batchNo=".$first_line_arr[1]."&detailNo=".$first_line_arr[2]."&businessType=".$first_line_arr[3]."&fileStatus=".$first_line_arr[4]."&detailCounts=".$first_line_arr[5]."&detailAmounts=".$first_line_arr[6]."&currency=".$first_line_arr[7]."&sussCounts=".$first_line_arr[8]."&sussAmount=".$first_line_arr[9]."&sussCurrency=".$first_line_arr[10]."&signType=".$first_line_arr[11]."&detailDigest=".$detailDigest;
        $flag= openssl_verify($str,$sign,$public_key1,'SHA256');
        if($flag)
        {
            $sql="";
            //读取每行数据并将结果存入数据库中
            for($i=1;$i<count($lines);$i++)
            {
                $item_arr = explode('|',$lines[$i]);
                if(!empty($item_arr))
                {
                    $pay_msg = $item_arr[20]."-".$item_arr[21];
                    $pay_status=-1;
                    $status=4;
                    if($item_arr[20]=='00')
                    {
                        $pay_status=1;
                        $status=2;
                    }
                    $id = str_replace($first_line_arr[0],'',$item_arr[1]);
                    $times =date('Y-m-d H:i:s',time());
                    $sql.="UPDATE " . $dou->table('list') . " SET true_paytime='$times',  status=".$status.",pay_status=".$pay_status.",pay_msg='".$pay_msg."'  WHERE id =".intval($id).";";
                }
            }
            $dou->query_mutiple_update($sql);
            $dou->query("UPDATE " . $dou->table('paylist') . " SET status = 2,response_time='".date('Y-m-d H:i:s')."' WHERE id =".$paylist_id);
        }
    }

    exit;

}

/**
 * 1、遍历amount_record表把线下付给后台款，但是没有标记支付给工人的查找出来
 * 2、查找list，如果list支付成功总和>=打款金额，则该任务标记为已完成，并且不可再继续打款
 */
elseif ($rec == 'checkpaypro'){
    file_put_contents('crontabpro.txt',date('Y-m-d H:i:s')."\r\n",FILE_APPEND);
    $sql = "SELECT * FROM " . $dou->table('amount_record') . " where status=0 ORDER BY id DESC";
    $query = $dou->query($sql);
    $download_result = array();

    if($query->num_rows>0) {

        while ($row = $dou->fetch_array($query)) {

            $pid =$row['pid'];
            $total_amount = $dou->get_one("SELECT sum(pay_money_total) FROM " . $dou->table('list') . " WHERE status=2 and ppid = '$pid'");

             if($total_amount>=$row['amount']&&$row['amount']>0)
            {
                $pro_info = $dou->get_row('product', '*', "id = '".$pid."'");

                $sql = "INSERT INTO " . $dou->table('amount_record') . " (id,user_id,pid,amount ,add_time,add_user_id,des,status)" . " VALUES (NULL,".$pro_info['user_id'].", ".intval($pid).",".(0-$row['amount']).", '".date('Y-m-d H:i:s',time())."',0,'$desc',1)";
                $dou->query($sql);


                $sql="UPDATE " .$dou->table('product') . " SET  status=1,upload_status=4 WHERE id = ".$pid;
                $dou->query($sql);




                $sql = "update " . $dou->table('admin') . " SET amount = amount-".$row['amount']." WHERE user_id = '$pro_info[user_id]'";
                $dou->query($sql);


                $sql="UPDATE " .$dou->table('amount_record') . " SET  status=1 WHERE id = ".intval($row['id']);
                $dou->query($sql);

            }
        }


    }

}
/**
 * +----------------------------------------------------------
 * 登录页
 * +----------------------------------------------------------
 */
elseif ($rec == 'login') {

//    echo "111111111111111111111";
//    $private_key="5BMONVJg6Y4v3Bu6ToHJfg==";
//    // $result =  openssl_decrypt($str,'DES-ECB',$private_key);
//    $result =  encrypt_pass('abcd123',$private_key);
//    var_dump($result);exit;
//
//    $url = "https://testapi.fadada.com:8443/api/uploadtemplate.api";
//    $post_data = array(
//            'app_id'=>'402487',
//            'timestamp'=> '20190919173208',
//            'v'=> '2.0',
//            'msg_digest'=> 'NzlDNkRGNTlGRUJDNTgxN0U4REMxREQyQjAxOTZCMUYxNTY1ODI4OA==',
//            'template_id'=> 'test1',
//            //要上传的本地文件地址
//            "doc_url" => "/www/wwwroot/58/template.pdf"
// );
//$ch = curl_init();
//curl_setopt($ch , CURLOPT_URL , $url);
//curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch , CURLOPT_POST, 1);
//curl_setopt($ch , CURLOPT_POSTFIELDS, $post_data);
//$output = curl_exec($ch);
//curl_close($ch);
//    var_dump($output);exit;

//    $file="template.pdf";
//$url="https://testapi.fadada.com:8443/api/uploadtemplate.api";
//    $data = array(
//        // 还有一种打成数据流的方法.
//        'app_id'=>'402487',
//        'timestamp'=> '20190919173208',
//        'v'=> '2.0',
//        'msg_digest'=> 'NzlDNkRGNTlGRUJDNTgxN0U4REMxREQyQjAxOTZCMUYxNTY1ODI4OA==',
//        'template_id'=> 'test1',
//        'file'=>new CURLFile($file),
//    );
//
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POST, true );
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  //该curl_setopt可以向header写键值对
//    curl_setopt($ch, CURLOPT_HEADER, false); // 不返回头信息
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    $output = curl_exec($ch);
//    var_dump($output);
//
//    if ($output == false){
//        echo 'error:' . curl_error($ch);
//    }
//
//    curl_close($ch);
//    exit;




//    $file_path = "admin/images/BZZYGX_B0006_900000117791_20190920083419_1.txt";
//    if(file_exists($file_path)){
//        $fp = fopen($file_path,"r");
//    }
//    $str = fread($fp,filesize($file_path));
//   // $str=base64_decode($str);
//    $private_key="5BMONVJg6Y4v3Bu6ToHJfg==";
//   // $result =  openssl_decrypt($str,'DES-ECB',$private_key);
//    $result =  decrypt_pass($str,$private_key);
//    var_dump($result);exit;
//
//
//    $public_key1="MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBT1shue2r7wQhGFElwau+jLC5tKolDoRiO/ScdaYwyUzB5hIzgazHNwHqx0Pp44qOmkE15hlRjW/J19yKhyWFEFNI0qV3XAzbhJxIKIgZqSSZykKBu97cOEdzKQ3jTyyncPF5VRrDApQS5qzXj5myJvnSEw0huHwTUZWrLd3txQIDAQAB";
//    $public_key1        = chunk_split($public_key1, 64, "\n");
//    $public_key1 = "-----BEGIN PUBLIC KEY-----\n$public_key1-----END PUBLIC KEY-----\n";
//    $result1=preg_replace('/\n/','***',$result);
//    $lines = explode('***',$result1);
//
//    $first_line_arr = explode('|',$lines[0]);
//     $sign = $first_line_arr[9];
//     $string='';
//    for ($i=0; $i < strlen($sign)-1; $i+=2){
//        $string .= chr(hexdec($sign[$i].$sign[$i+1]));
//    }
//    $sign=$string;
//
//     $content2="";
//    for($i=1;$i<count($lines);$i++)
//    {
//        if(!empty($lines[$i]))
//        {
//            $content2.=$lines[$i]."\n";
//        }
//
//    }
//    $detailDigest=strtoupper(hash('sha256',$content2));
//    $str="merchantNo=".$first_line_arr[0]."&batchNo=".$first_line_arr[1]."&detailNo=".$first_line_arr[2]."&businessType=".$first_line_arr[3]."&detailCounts=".$first_line_arr[4]."&detailAmounts=".$first_line_arr[5]."&currency=".$first_line_arr[6]."&mcTransDateTime=".$first_line_arr[7]."&signType=".$first_line_arr[8]."&detailDigest=".$detailDigest;
//    $flag= openssl_verify($str,$sign,$public_key1,'SHA256');
//
//    var_dump($flag);exit;
//    $connection = ssh2_connect('47.103.78.30', 22);
//    ssh2_auth_password($connection, 'gbjdsftp', 'gbjdsftppass');
//    $sftp = ssh2_sftp($connection);
//
//
//
//
//    var_dump($sftp);exit;

//    $str = base64_encode(strtoupper(sha1(('402487'.strtoupper(md5('20190917143224')) . strtoupper(sha1('1tPmZcTQUMQ61Y4rnt6iF2Qa'.'1'.'18663829507')))) ));
//  echo $str;exit;



 	   // SNS登录
    $sns = $check->is_rec($_REQUEST['sns']) ? $_REQUEST['sns'] : '';
    if ($sns) $dou->dou_header(HOME_URL . 'include/plugin/' . $sns . '/login.php');

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('user_login'));

    $return_url = $_REQUEST['return_url'] ? $_REQUEST['return_url'] : urlencode($_SERVER['HTTP_REFERER']);
    // 赋值给模板息
    $smarty->assign('page_title', $dou->page_title('user', 'user_login'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_login'));
    $smarty->assign('head', $_LANG['user_login']);
    $smarty->assign('return_url', $return_url);
    $smarty->assign('sns_token', $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '');
   // $smarty->assign('connect_plugin_list', $dou_user->connect_plugin_list());
    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 登录提交
 * +----------------------------------------------------------
 */
elseif ($rec == 'login_post') {
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'user_login');
	
    if (!$_POST['user_name'])
        $dou->dou_msg("请输入用户名", $_URL['login']);
    
    $_POST['user_name'] = $check->is_username(trim($_POST['user_name'])) ? trim($_POST['user_name']) : '';
    $_POST['password'] = $check->is_password(trim($_POST['password'])) ? trim($_POST['password']) : '';
    
    // 如果用户名存在则获取用户信息
    $user = $dou->get_row('admin', '*', "user_name = '$_POST[user_name]'");
     // 验证用户是否存在和密码是否正确
    if (!is_array($user)) {
        $dou->dou_msg($_LANG['user_login_wrong'], $_URL['login']);
    } elseif (md5($_POST['password']) != $user['password']) {
        $dou->dou_msg($_LANG['user_login_wrong'], $_URL['login']);
    }

    //验证状态
    if($user['status']==0)
    {
        $dou->dou_msg("该账号等待审核中，审核通过才能登陆", $_URL['login']);
    }
    //验证状态
    if($user['status']==-1)
    {
        $dou->dou_msg("该账号审核失败，请联系管理员进行处理", $_URL['login']);
    }
     // 会员登录信息验证成功则写入SESSION
    $_SESSION[DOU_ID]['user_id'] = $user['user_id'];
    $_SESSION[DOU_ID]['shell'] = md5($user['user_name'] . $user['password'] . DOU_SHELL);
    $_SESSION[DOU_ID]['ontime'] = time();



	   // 判断是否正在操作SNS绑定
//	   $sns_token = $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '';
//	   if (is_array($sns = $_SESSION[DOU_ID]['sns'][$sns_token])) {
//					   $add_time = time();
//					   $dou->query("INSERT INTO " . $dou->table('user_sns') . " (id, user_id, `group`, openid, add_time)" . " VALUES (NULL, '$user[user_id]', '$sns[group]', '$sns[openid]', '$add_time')");
//				}
     $login_count = $user['login_count'] + 1;

     $dou->query("UPDATE " . $dou->table('admin') . " SET last_login = '$last_login', last_ip = '$last_ip' WHERE user_id = " . $user['user_id']);
     $dou->dou_msg($_LANG['user_login_success'], "/user.php?rec=list");
}

/**
 * +----------------------------------------------------------
 * 重置密码
 * +----------------------------------------------------------
 */
elseif ($rec == 'password_reset') {
    $user_id = $check->is_number($_REQUEST['uid']) ? $_REQUEST['uid'] : '';
    $code = preg_match("/^[a-zA-Z0-9]+$/", $_REQUEST['code']) ? $_REQUEST['code'] : '';

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('user_password_reset'));
    
    if ($user_id && $code) {
        if (!$dou_user->check_password_reset($user_id, $code)) {
            $dou->dou_msg($_LANG['user_password_reset_fail'], HOME_URL, 30);
        }
        $smarty->assign('user_id', $user_id);
        $smarty->assign('code', $code);
        $smarty->assign('action', 'reset');
    } else {
        $smarty->assign('action', 'default');
    }
    
    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'user_password_reset'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_password_reset'));
    $smarty->assign('head', $_LANG['user_password_reset']);

    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 重置密码提交
 * +----------------------------------------------------------
 */
elseif ($rec == 'password_reset_post') {
    $action = $_POST['action'] == 'reset' ? 'reset' : 'default';
    
    if ($action == 'default') {
        // 验证用户名
        if (!$dou->value_exist('admin', 'user_name', $_POST['user_name']))
            $dou->dou_msg("该用户名已存在", $_URL['password_reset']);
    
        // 判断验证码
        if ($_CFG['captcha']) {
            $_POST['captcha'] = $check->is_captcha(trim($_POST['captcha'])) ? strtoupper(trim($_POST['captcha'])) : ''; // 判断验证码格式是否正确
            if (md5($_POST['captcha'] . DOU_SHELL) != $_SESSION['captcha']) // 判断验证码是否正确
                $dou->dou_msg($_LANG['captcha_wrong'], $_URL['password_reset']);
        }
        
        // CSRF防御令牌验证
        $firewall->check_token($_POST['token'], 'user_password_reset');
        
        // 生成密码找回码
        $user = $dou->get_row('admin', '*', "user_name = '$_POST[user_name]'");
        $time = time();
        $code = substr(md5($user['user_name'] . $user['password'] . $time . $user['last_login'] . DOU_SHELL) , 0 , 16) . $time;
        $site_url = rtrim(ROOT_URL, '/');
        $mark = strpos($_URL['password_reset'], '?') !== false ? '&' : '?';
        
        $body = $user['user_name'] . $_LANG['user_password_reset_body_0'] . $_URL['password_reset'] . $mark . 'uid=' . $user['user_id'] . '&code=' . $code . $_LANG['user_password_reset_body_1'] . $_CFG['site_name'] . '. ' . $site_url;
        $dou->dou_msg("成功", HOME_URL, 30);
        // 发送密码重置邮件
//        if ($dou->send_mail($_POST['email'], $_LANG['user_password_reset_title'], $body)) {
//            $dou->dou_msg($_LANG['user_password_mail_success'] . $user['email'], HOME_URL, 30);
//        } else {
//            $dou->dou_msg($_LANG['mail_send_fail'], $_URL['password_reset'], 30);
//        }
    } elseif ($action == 'reset') {
        // 验证密码
        if (!$check->is_password($_POST['password'])) {
            $dou->dou_msg($_LANG['user_password_cue']);
        } elseif (($_POST['password_confirm'] !== $_POST['password'])) {
            $dou->dou_msg($_LANG['user_password_confirm_cue']);
        }

        $user_id = $check->is_number($_POST['user_id']) ? $_POST['user_id'] : '';
        $code = preg_match("/^[a-zA-Z0-9]+$/", $_POST['code']) ? $_POST['code'] : '';
        
        if ($dou_user->check_password_reset($user_id, $code)) {
            // 重置密码
            $sql = "UPDATE " . $dou->table('admin') . " SET password = '" . md5($_POST['password']) . "' WHERE user_id = '$user_id'";
            $dou->query($sql);
            $dou->dou_msg($_LANG['user_password_reset_success'], $_URL['login'], 15);
        } else {
            $dou->dou_msg($_LANG['user_password_reset_fail'], HOME_URL, 30);
        }
    }
}

/**
 * +----------------------------------------------------------
 * 会员信息编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
	   // 获取会员信息
	   $user_info = $dou->get_row('user', '*', "user_id = '" . $_GLOBAL_USER['user_id'] . "'");
	
	   // 格式化数据
	   $user_info['avatar'] = $user_info['avatar'] ? $dou->dou_file($user_info['avatar']) : ROOT_URL . 'images/avatar/..empty.png';

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('user_edit'));
    
    // 格式化自定义参数
    if ($_DEFINED['user'] || $user_info['defined']) {
        $defined = explode(',', $_DEFINED['user']);
        foreach ($defined as $row) {
            $defined_user .= $row . "：\n";
        }
        // 如果商品中已经写入自定义参数则调用已有的
        $user_info['defined'] = $user_info['defined'] ? str_replace(",", "\n", $user_info['defined']) : trim($defined_user);
        $user_info['defined_count'] = count(explode("\n", $user_info['defined'])) * 2;
    }

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'user_edit'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_edit'));
    $smarty->assign('head', $_LANG['user_edit']);
    $smarty->assign('user_info', $user_info);

    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 会员信息编辑提交
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit_post') {

     // 获取已有会员信息
    $user = $dou->get_row('user', '*', "user_id = '$_GLOBAL_USER[user_id]'");
 
    // 判断是否为空
    $wrong = $check->fn_empty('user', 'contact, telphone');
 
    // 判断是否含有非法字符
    $wrong = $check->fn_illegal_char('user', 'contact, telphone, address, postcode, nickname');
 
    // 验证手机
    if ($_CFG['language'] == 'zh_cn') {
        if (!$check->is_telphone($_POST['telphone']))
            $wrong['telphone'] = $_LANG['user_telphone_cue'];
    }

    // 验证昵称
    if ($_POST['nickname']) {
        if ($user['nickname'] != $_POST['nickname']) {
            if ($dou->value_exist('user', 'nickname', $_POST['nickname']))
                $wrong['nickname'] = $_LANG['user_nickname'] . $_LANG['value_exists'];
        }
    }

    // AJAX验证表单
    if ($_REQUEST['do'] == 'callback') {
        if ($wrong) {
            foreach ($_POST as $key => $value) {
                $wrong_json[$key] = $wrong[$key];
            }
            echo json_encode($wrong_json);
        }
        exit;
    }
    
    if ($wrong) {
        foreach ($wrong as $key => $value) {
            $wrong_format .= $wrong[$key] . '<br>';
        }
        $dou->dou_msg($wrong_format, $_URL['edit']);
    }
 
    // 图片上传
    include_once (ROOT_PATH . 'include/file.class.php');
    $file = new File('images/avatar/', null, 'jpg,gif,png', '100'); // 实例化类文件(文件上传路径，结尾加斜杠)


    // 文件上传盒子
    if ($_FILES['avatar']['name'] != "") {
        $file_name = $dou->get_file_name($dou->get_one("SELECT avatar FROM " . $dou->table('user') . " WHERE user_id = '$_GLOBAL_USER[user_id]'"));
        $avatar_filename =  'a_' . date('ymdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
        $avatar = $file->box('user', $_GLOBAL_USER['user_id'], 'avatar', 'main', $avatar_filename, '', '', 'user_id');
        $avatar = ", avatar = '" . $avatar . "'";
    }

    
    // 格式化自定义参数
    $_POST['defined'] = str_replace("\r\n", ',', $_POST['defined']);

    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'user_edit');
    
    // 安全处理用户输入信息
    $_POST = $firewall->dou_foreground($_POST);

    $sql = "UPDATE " . $dou->table('user') . " SET contact = '$_POST[contact]', telphone = '$_POST[telphone]', address = '$_POST[address]', postcode = '$_POST[postcode]', sex = '$_POST[sex]', nickname = '$_POST[nickname]'" . $avatar . ", defined = '$_POST[defined]' WHERE user_id = '$_GLOBAL_USER[user_id]'";

    echo $sql;exit;
    $dou->query($sql);
    
    $dou->dou_msg($_LANG['user_edit_success'], $_URL['edit']);
}

/**
 * +----------------------------------------------------------
 * 密码修改
 * +----------------------------------------------------------
 */
elseif ($rec == 'password') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('user_password'));

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'user_password_edit'));
    $smarty->assign('head', $_LANG['user_password_edit']);
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_password_edit'));

    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 密码修改提交
 * +----------------------------------------------------------
 */
elseif ($rec == 'password_post') {
     // 获取旧密码
    $old_password = $dou->get_one("SELECT password FROM " . $dou->table('admin') . " WHERE user_id = '$_GLOBAL_USER[user_id]'");

    // 验证原始密码密码
    if (md5($_POST['old_password']) != $old_password)
        $dou->dou_msg($_LANG['user_old_password_cue'], $_URL['password']);

    // 验证密码
    if (!$check->is_password($_POST['password']))
        $dou->dou_msg($_LANG['user_password_cue'], $_URL['password']);
    
    // 验证确认密码
    if (!isset($wrong['password']) && ($_POST['password_confirm'] !== $_POST['password']))
        $dou->dou_msg($_LANG['user_password_confirm_cue'], $_URL['password']);
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'user_password');
    
    $sql = "UPDATE " . $dou->table('admin') . " SET password = '" . md5($_POST['password']) . "' WHERE user_id = '$_GLOBAL_USER[user_id]'";
    $dou->query($sql);
    
    $dou->dou_msg($_LANG['user_password_success'], $_URL['password']);
}
/**
 * +----------------------------------------------------------
 * 我的任务
 * +----------------------------------------------------------
 */
elseif ($rec == 'list') {


    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]'";

    $cur_filter='0';

    if(isset($_REQUEST['pay_status']))
    {
        $where.=" and pay_status=".intval($_REQUEST['pay_status']);
    }
    if(isset($_REQUEST['id']))
    {
        $where.=" and id=".intval($_REQUEST['id']);
    }

    if(isset($_REQUEST['status']))
    {
        $where.=" and status=".intval($_REQUEST['status']);
    }

    if($_REQUEST['pay_status']=='0')
    {
        $cur_filter='1';
    }

    if($_REQUEST['pay_status']=='1'&&$_REQUEST['status']=='0')
    {
        $cur_filter='2';
    }

    if($_REQUEST['status']=='1')
    {
        $cur_filter='3';
    }


    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('product') . $where . " ORDER BY id DESC";


    $sql_count = "SELECT count(*) as count FROM " . $dou->table('product') . $where . " ORDER BY id DESC";
    $count =  $dou->get_one($sql_count);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, $_URL['list']);

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = '$row[user_id]'");
        $add_time = date("Y-m-d H:i:s", $row['add_time']);
        $status_format = $_LANG['list_status_' . $row['status']];
        $order_amount_format = $dou->price_format($row['price']);
       // $item_list = $dou_order->get_order_item($row['order_id']);

        // 有开启支付方式的情况才显示付款按钮
//        if ($dou->value_exist('plugin', 'plugin_group', 'payment')) {
//            $cashier_url = $dou->param($dou->rewrite_url('order', 'cashier') . '&order_sn=' . $row['order_sn']);
//        }

        $order_list[] = array (
            "id" => $row['id'],
            "user_name" => $user_name,
            "name" =>  $row['name'],
            "status_format" => $status_format,
            "order_amount_format" => $order_amount_format,
            "keywords" => $row['keywords'],
            "telphone" => $row['telphone'],
             "status" => $row['status'],
             "pay_status" => $row['pay_status'],
             "city" => $row['city'],
             "stop_time" => $row['stop_time'],
             "start_time" => $row['start_time'],
             "end_time" => $row['end_time'],
             "bind_mobile" => $row['bind_mobile'],
             "zhouqi" => $row['zhouqi'],
             "add_time" => $add_time
         );
    }

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'order_my'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'order_my'));
    $smarty->assign('head', '我的任务');
    $smarty->assign('order_list', $order_list);
    $smarty->assign('count', $count);
    $smarty->assign('cur_filter', $cur_filter);
    $smarty->display('user.dwt');
}
/**
 * +----------------------------------------------------------
 * 任务删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del_pro') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';

    // 获取订单信息
    $order = $dou->get_row('product', 'id, pay_status', "id = '$id' AND user_id = '$_GLOBAL_USER[user_id]'");

    if (!$order || $order['pay_status'] != 0)
        $dou->dou_msg("数据有误，操作失败", $_URL['list']);

    // 取消订单
    $dou->query("DELETE FROM  " . $dou->table('product') . "  where id=".$id);
    $dou->dou_header($_URL['list']);
}
/**
 * +----------------------------------------------------------
 * 已经领取我任务的用户列表
 * +----------------------------------------------------------
 */
elseif ($rec == 'userlist') {

    // 验证并获取合法的ID
    $ppid = $check->is_number($_REQUEST['ppid']) ? $_REQUEST['ppid'] : '';
    // 公用SQL查询条件，分页中也使用
    $where = " WHERE ppid = ".intval($ppid);

    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('list') . $where . " ORDER BY add_time DESC";

    $sql_count = "SELECT count(*) as total FROM " . $dou->table('list') . $where . " ORDER BY add_time DESC";
    $total =  $dou->get_one($sql_count);
    $total = floatval($total);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, $_URL['userlist']);

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $user_name = $dou->get_one("SELECT truename FROM " . $dou->table('admin') . " WHERE user_id = '$row[user_id]'");
        $order_amount_format = $dou->price_format($row['pay_money']);
        $status_format="";
        switch (intval($row['status'])) {
            case 0 :
                $status_format="已领取";
                break;
            case 1 :
                $status_format="已完成";
                break;
            case 2 :
                $status_format="已付款";
                break;
            default	:
                $status_format="";
               break;
        }
        $user_list[] = array (
            "id" => $row['id'],
            "user_name" => $user_name,
            "status_format" => $status_format,
            "order_amount_format" => $order_amount_format,
            "add_time" => $row['add_time'],
            "pay_time" => $row['pay_time'],
            "finish_time" => $row['finish_time']
        );
    }

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', '领任务列表'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'userlist'));
    $smarty->assign('head', '领任务列表');
    $smarty->assign('user_list', $user_list);
    $smarty->assign('total', $total);
    $smarty->display('user.dwt');
}
/**
 * +----------------------------------------------------------
 * 我的资金
 * +----------------------------------------------------------
 */
elseif ($rec == 'money') {


    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]' and pay_status=1";

    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('product') . $where . " ORDER BY pay_time DESC";


    $sql_count = "SELECT sum(price) as total FROM " . $dou->table('product') . $where . " ORDER BY id DESC";
    $total =  $dou->get_one($sql_count);
   $total = floatval($total);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, $_URL['money']);

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = '$row[user_id]'");
        $add_time = date("Y-m-d H:i:s", $row['add_time']);
        $status_format = $_LANG['list_status_' . $row['status']];
        $order_amount_format = $dou->price_format($row['price']);
        $order_list[] = array (
            "id" => $row['id'],
            "user_name" => $user_name,
            "status_format" => $status_format,
            "order_amount_format" => $order_amount_format,
            "keywords" => $row['keywords'],
            "telphone" => $row['telphone'],
            "status" => $row['status'],
            "pay_status" => $row['pay_status'],
            "city" => $row['city'],
            "name" => $row['name'],
            "stop_time" => $row['stop_time'],
            "pay_time" => $row['pay_time'],
            "start_time" => $row['start_time'],
            "end_time" => $row['end_time'],
            "bind_mobile" => $row['bind_mobile'],
            "add_time" => $add_time
        );
    }

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'order_my'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'order_my'));
    $smarty->assign('head', '我的任务');
    $smarty->assign('order_list', $order_list);
    $smarty->assign('total', $total);
     $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 添加任务
 * +----------------------------------------------------------
 */
elseif ($rec == 'addlist') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('addlist'));

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'user_password_edit'));
    $smarty->assign('head',"添加任务");
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_password_edit'));

    $smarty->display('user.dwt');
}
/**
 * +----------------------------------------------------------
 * 添加任务
 * +----------------------------------------------------------
 */
elseif ($rec == 'addlist_post') {

    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $keywords = $_POST['keywords'];
    $city= $_POST['city'];
    $max= intval($_POST['max']);
    $bind_mobile= $_POST['bind_mobile'];
    $start_time= $_POST['start_time']." 00:00:00";
    $stop_time= $_POST['stop_time']." 23:59:59";
    $end_time= $_POST['end_time']." 23:59:59";
    $zhouqi= $_POST['zhouqi'];
    $check_sta= $_POST['check_sta'];
    $add_time=time();


    // 图片上传
    include_once (ROOT_PATH . 'include/file.class.php');
    $file = new File('images/dis_form/', null, 'xls'); // 实例化类文件(文件上传路径，结尾加斜杠)
    $card_pic='';
    // 文件上传盒子
    if ($_FILES['dis_formShow']['name'] != "") {
        $card_pic_filename = 'disf_' . date('ymdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
        $card_pic = $file->box('admin', $_GLOBAL_USER['user_id'], 'dis_formShow', 'main', $card_pic_filename, '', '', 'user_id');
    }

    $sql = "INSERT INTO " . $dou->table('product') . " (id,name, price,keywords, add_time,max,type,user_id,bind_mobile,stop_time,start_time,end_time,city,zhouqi,check_sta,dic_form)" . " VALUES (NULL, '$name',$price,'$keywords','$add_time',$max,1,'$_GLOBAL_USER[user_id]','$bind_mobile','$stop_time','$start_time','$end_time','$city','$zhouqi','$check_sta','$card_pic')";
    $dou->query($sql);

    //解析xls存入暗线表格中


    $dou->dou_msg('添加成功', $_URL['list']);
}

elseif ($rec == 'withdraw') {
    require (ROOT_PATH . 'include/pay.class.php');
    $payment=new Pay();
    $payment->sendMoney(1,'oIBnWwAfb_PS45LJcibKM4c0gD8g','xxxx测试');
}

/**
 * +----------------------------------------------------------
 * 发送验证码
 * +----------------------------------------------------------
 */
elseif ($rec == 'sendcode') {
     require (ROOT_PATH . 'include/sms.class.php');
    $sms = new Sms();
    $mobile = $_POST['mobile'];
     if(!$check->is_telphone($mobile))
    {
        $return =array(
            'status'=>0,
            'msg'=>'手机号格式不正确'
        );
        echo  json_encode($return);
        exit;
    }
    $rand = mt_rand(1000,9999);
    $content = '验证码：'.$rand;
    $result =  $sms->sendNormal($mobile,$content);
     if($result['status']==1)
    {
        $_SESSION[DOU_ID]['mobilevcode']=$mobile.$rand;
        $return =array(
            'status'=>1,
            'msg'=>'发送成功'.$rand,
            'code'=>$rand
        );
    }
    else
    {
        $return =array(
            'status'=>0,
            'msg'=>'发送失败.'
        );
    }
    echo json_encode($return);
}

/**
 * +----------------------------------------------------------
 * 发送验证码
 * +----------------------------------------------------------
 */
//elseif ($rec == 'sendcode') {
//    require (ROOT_PATH . 'include/sms.class.php');
//    $sms = new Sms();
//    $mobile = $_POST['mobile'];
//    if(!$check->is_telphone($mobile))
//    {
//        $return =array(
//            'status'=>0,
//            'msg'=>'手机号格式不正确'
//        );
//        echo  json_encode($return);
//        exit;
//    }
//    $rand = mt_rand(1000,9999);
//    $content = '验证码：'.$rand;
//    $result =  $sms->sendNormal($mobile,$content);
//    if($result['returnstatus']=='Success')
//    {
//        $_SESSION['mobilevcode']=$mobile.$rand;
//
//        $return =array(
//            'status'=>1,
//            'msg'=>'发送成功',
//            'code'=>$rand
//        );
//    }
//    else
//    {
//        $return =array(
//            'status'=>1,
//            'msg'=>'发送失败'
//        );
//    }
//    echo json_encode($return);
//}

/**
 * +----------------------------------------------------------
 * 退出登录
 * +----------------------------------------------------------
 */
elseif ($rec == 'logout') {
    unset($_SESSION[DOU_ID]);
    $dou->dou_header($_URL['login']);
}

/**
 * +----------------------------------------------------------
 * 我的订单
 * +----------------------------------------------------------
 */
elseif ($rec == 'order_list') {
    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]'";
 
    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('order') . $where . " ORDER BY order_id DESC";

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, $_URL['order_list']);
    
    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $email = $dou->get_one("SELECT email FROM " . $dou->table('user') . " WHERE user_id = '$row[user_id]'");
        $add_time = date("Y-m-d H:i:s", $row['add_time']);
        $status_format = $_LANG['order_status_' . $row['status']];
        $order_amount_format = $dou->price_format($row['order_amount']);
        $item_list = $dou_order->get_order_item($row['order_id']);
					   
					   // 有开启支付方式的情况才显示付款按钮
					   if ($dou->value_exist('plugin', 'plugin_group', 'payment')) {
												$cashier_url = $dou->param($dou->rewrite_url('order', 'cashier') . '&order_sn=' . $row['order_sn']);
								}

        $order_list[] = array (
                "order_id" => $row['order_id'],
                "order_sn" => $row['order_sn'],
                "email" => $email,
                "contact" => $row['contact'],
                "telphone" => $row['telphone'],
                "order_amount" => $row['order_amount'],
                "order_amount_format" => $order_amount_format,
                "status" => $row['status'],
                "status_format" => $status_format,
                "cashier_url" => $cashier_url,
                "add_time" => $add_time,
                "item_list" => $item_list
        );
    }

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'order_my'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'order_my'));
    $smarty->assign('head', $_LANG['order_my']);
    $smarty->assign('order_list', $order_list);

    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 订单详情
 * +----------------------------------------------------------
 */
elseif ($rec == 'order') {
    // 验证并获取合法的ID
    $order_sn = $check->is_number($_REQUEST['order_sn']) ? $_REQUEST['order_sn'] : '';
    
    $order = $dou->get_row('order', '*', "order_sn = '$order_sn' AND user_id = '$_GLOBAL_USER[user_id]'");
    
    // 判断订单是否存在
    if (!$order) $dou->dou_header($_URL['order_list']);
    
    // 格式化订单信息
    $order['pay_name'] = $dou->get_one("SELECT name FROM " . $dou->table('plugin') . " WHERE unique_id = '$order[pay_id]'");
    $order['shipping_name'] = $dou->get_one("SELECT name FROM " . $dou->table('plugin') . " WHERE unique_id = '$order[shipping_id]'");
    $order['item_amount_format'] = $dou->price_format($order['item_amount']);
    $order['shipping_fee_format'] = $dou->price_format($order['shipping_fee']);
    $order['order_amount_format'] = $dou->price_format($order['order_amount']);
    $order['email'] = $dou->get_one("SELECT email FROM " . $dou->table('user') . " WHERE user_id = '$order[user_id]'");
    $order['add_time'] = date("Y-m-d H:i:s", $order['add_time']);
    $order['status_format'] = $_LANG['order_status_' . $order['status']];
    $order['item_list'] = $dou_order->get_order_item($order['order_id']);
	   
				// 有开启支付方式的情况才显示付款按钮
				if ($dou->value_exist('plugin', 'plugin_group', 'payment')) {
								$order['cashier_url'] = $dou->param($dou->rewrite_url('order', 'cashier') . '&order_sn=' . $order['order_sn']);
				}

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'order_view'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'order_view'));
    $smarty->assign('head', $_LANG['order_view']);
    $smarty->assign('order', $order);

    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 订单删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'order_cancel') {
    // 验证并获取合法的ID
    $order_sn = $check->is_number($_REQUEST['order_sn']) ? $_REQUEST['order_sn'] : '';

    // 获取订单信息
    $order = $dou->get_row('order', 'order_sn, status', "order_sn = '$order_sn' AND user_id = '$_GLOBAL_USER[user_id]'");

    if (!$order || $order['status'] != 0)
        $dou->dou_msg($_LANG['order_cancel_wrong'], $_URL['order_list']);
    
    // 取消订单
    $dou->query("UPDATE " . $dou->table('order') . " SET status = '-1' WHERE order_sn = '$order_sn' AND user_id = '$_GLOBAL_USER[user_id]'");
    $dou->dou_header($_URL['order_list']);
}

/**
 * +----------------------------------------------------------
 * 社交软件
 * +----------------------------------------------------------
 */
elseif ($rec == 'sns') {
	   $remove = $check->is_unique_id($_REQUEST['remove']) ? trim($_REQUEST['remove']) : '';
	   if ($remove) {
					   $dou->delete('user_sns', "`group` = '$remove' AND user_id = '" . $_GLOBAL_USER['user_id'] . "'");
					   //$dou->dou_header($_URL['sns']);
				}
	
	   // SNS登录
    $link = $check->is_rec($_REQUEST['link']) ? $_REQUEST['link'] : '';
	   if ($link) {
					   $dou->dou_header(HOME_URL . 'include/plugin/' . $link . '/login.php');
				}
	   
	   // 赋值给模板息
    $smarty->assign('page_title', $dou->page_title('user', 'user_sns'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_sns'));
    $smarty->assign('head', $_LANG['user_sns']);
	   $smarty->assign('plugin_list', $dou_user->connect_plugin_list($_GLOBAL_USER['user_id']));
    
    $smarty->display('user.dwt');
}

/**
 * +----------------------------------------------------------
 * 社交软件账号关联
 * +----------------------------------------------------------
 */
elseif ($rec == 'sns_link') {
	   $sns_token = $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '';
	
	   if (!$_SESSION[DOU_ID]['sns'][$sns_token])
					   $dou->dou_header($_URL['user']);
	
    // 赋值给模板息
    $smarty->assign('page_title', $dou->page_title('user', 'user_sns'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_sns'));
    $smarty->assign('head', $_LANG['user_sns']);
    $smarty->assign('sns', $_SESSION[DOU_ID]['sns'][$sns_token]);
    $smarty->assign('url_register', $dou->param($_URL['register'] . "?sns_token=$sns_token"));
    $smarty->assign('url_login', $dou->param($_URL['login'] . "?sns_token=$sns_token"));
    
    $smarty->display('user.dwt');
}
/**
 * +----------------------------------------------------------
 * 返回结果
 * +----------------------------------------------------------
 */
elseif ($rec == 'pay_callback') {
//
//$getpost = "{\"list\":[{\"exNo\":\"No2019081014594041\",\"result\":1},{\"exNo\":\"No2019081014594040\",\"result\":-1}],\"sign\":\"152b507671b1b27e52a46dc2561da8ab\"}";
$getpost = file_get_contents("php://input");
$post = json_decode($getpost,true);
 $list = $post['list'];
 $sign = $post['sign'];
 $check_param1 = substr($post['list'][0]['exNo'],0,16);
 file_put_contents($check_param1.'.txt',$getpost);
 $key='2cf61b5981a49a3bae6a5387c6ef0392';
 $sign = md5($check_param1.$key);
if($sign!=$post['sign'])
{
    $result = array(
        'status'=>0,
        'msg'=>'签名失败'
    );
    echo json_encode($result);exit;
}
$sql="";
$arr_ids=array();
foreach($list as $key=>$val)
{
 $item_id =  substr($val['exNo'],16,strlen($val['exNo'])-16);
 $status= intval($val['result'])==1?2:1;
 $pay_time = date('Y-m-d H:i:s',time());

    $ppid = $dou->get_one("SELECT ppid FROM " . $dou->table('list') . " WHERE id = ".intval($item_id));
    if(!in_array(intval($ppid),$arr_ids))
    {
        array_push($arr_ids,intval($ppid));
    }
 $sql.="UPDATE " . $dou->table('list') . " SET pay_status = '".intval($val['result'])."',status='$status',pay_msg='".$val['msg']."',pay_time='$pay_time',extra='$check_param1' WHERE id = '$item_id';";
}
 $res = $dou->query_mutiple_update($sql);
 if($res)
 {
     //商户总任务检查并设置为已完成
     $sqls = "";
    foreach($arr_ids as $k=>$v)
    {
        //判断是否有未支付的
        $count = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('list') . " WHERE status<2 and ppid = ".intval($val));
        if($count==0)
        {
            $sqls.="UPDATE " . $dou->table('product') . " SET  status=1 WHERE id = ".intval($v).";";

        }
    }

    if($sqls!="")
    {
       $dou->query_mutiple_update($sqls);
    }
     $result = array(
         'status'=>1,
         'msg'=>'操作成功'
     );
     echo json_encode($result);exit;
 }


}

elseif ($rec == 'read') {
     $excel_file = ROOT_PATH .'/include/PHPExcel/PHPExcel.php';
    include_once($excel_file);

    $file = 'images/dis_form/disf_19081208482087.xls';
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);


    if($type=='xlsx'){
        $type=   'Excel2007';
    }elseif($type=='csv'){
        $type='csv';
    }else{
        $type='Excel5';
    }

    $list=array();
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {     //遍历工作表
        //echo 'Worksheet - ' , $worksheet->getTitle() , PHP_EOL;
        foreach ($worksheet->getRowIterator() as $key=>$row) {       //遍历行
             // echo $row->getRowIndex()."<br/>";
            $list_item=array();
            if($row->getRowIndex()>=3)
            {
                $cellIterator = $row->getCellIterator();   //得到所有列
                $cellIterator->setIterateOnlyExistingCells( false); // Loop all cells, even if it is not set
                foreach ($cellIterator as $cell) {  //遍历列
                    if (!is_null($cell)) {  //如果列不给空就得到它的坐标和计算的值
                        $rows[$key][]=   $cell->getCalculatedValue();

                     }
                }
             }

        }
    }
    echo "<pre>";

    $result=array();
    $list=array();
    foreach($rows as $key=>$val)
    {
        if($val[10]!='')
        {
            $list[$val[10]][]=$val;
        }
    }
    $res=array();
    foreach($list as $key=>$val)
    {
         $list_a=array();
         foreach($val as $k=>$v)
        {
            if(!in_array($v[7],$list_a))
            {
                array_push($list_a,$v[7]);
            }
         }

        $res[$key][]=$list_a;
    }
//    var_dump($res);
   //var_dump($rows);
    $save_arr=array();
    foreach($res as $key=>$val)
    {
        foreach($val as $k=>$v)
        {
            foreach($v as $k1=>$v1)
            {
                $m = $v1.'';
                $save_arr[$key][$m]=array();
                $save_arr[$key][$m]['id']=1;
                $save_arr[$key][$m]['count']=0;
                $save_arr[$key][$m]['mobile']='';
                $save_arr[$key][$m]['cat_name']=$key;
                $save_arr[$key][$m]['price']=floatval($m);
            }

        }
    }

    foreach($save_arr as $key=>$val)
    {
        foreach($val as $k=>$v)
        {
             foreach($rows as $k1=>$v1)
            {
                if($v1[10]==$key && $v1[7].''==$k)
                {

                    $save_arr[$key][$k]['count']  +=1;
                    if($save_arr[$key][$k]['mobile']=='')
                    {
                        $str='';
                    }
                    else
                    {
                        $str=',';
                    }
                    $save_arr[$key][$k]['mobile']  .=$str.$v1[4];
                }
            }
        }
    }

    $res_arr=array();
    $sql="";
    $pid=0;
    foreach($save_arr as $key=>$val)
    {
        foreach($val as $k=>$v)
        {
            $sql .= "INSERT INTO " . $dou->table('dif_form') . " (id, cat_name,price, count,pid)" . " VALUES (NULL, '$v[cat_name]','$v[price]','$v[count]', $pid);";
            $dou->query($sql);
            array_push($res_arr,$v);
        }
    }
    echo $sql;exit;


}


function encrypt_pass($input,$key)
{
    $key=base64_decode($key);
    $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
    $input= pkcs5_pad($input,$size );
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128,'', MCRYPT_MODE_ECB,'');
    $iv ='0102030405060708';
    mcrypt_generic_init($td ,$key,$iv );
    $data = mcrypt_generic($td ,$input);
    mcrypt_generic_deinit($td );
    mcrypt_module_close($td );
    $data =base64_encode($data );
    return $data ;

}

// 解密
function decrypt_pass($sStr,$sKey)
{
    $iv='0102030405060708';
    $decrypted= mcrypt_decrypt(MCRYPT_RIJNDAEL_128,base64_decode($sKey),base64_decode($sStr),MCRYPT_MODE_ECB,$iv);
    $dec_s =strlen($decrypted);
    $padding = ord($decrypted[$dec_s -1]);
    $decrypted=substr($decrypted, 0, -$padding );
    return $decrypted;
}


//填充
function pkcs5_pad($text, $blocksize) {
    $pad=$blocksize-(strlen($text)%$blocksize);
    return $text.str_repeat(chr($pad),$pad);
}




?>