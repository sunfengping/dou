<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2013-2019 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douphp.com
 * ---------------
 * -----------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议: http://www.douphp.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2019-01-08
 */
define('IN_DOUCO', true);
$sub = 'login|login_post|register|register_post|tasktool|setinfo|setinfo_post|listinfo|taskcenterinfo|taskcenter|getcatchildlist|myorderinfo|edit|list|listdownload|myamount|uploadlist|userlist|companyinfo|del_pro|edit_post|password|password_post|password_reset|password_reset_post|logout|sendcode|getcitylist|myorder|transaction|order_list|order|order_cancel|sns|sns_link|pay_callback|read';
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
$no_login_array = explode('|', 'login|login_post|register|pay_callback|register_post|password_reset|password_reset_post|sns_link|sendcode|read');

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
        $smarty->assign('global_user', $_GLOBAL_USER);
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
     $smarty->display('usernew.dwt');
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
    
    $smarty->display('usernew.dwt');
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
        $dou->dou_msg($wrong_format,"/usernew.php?rec=register");
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
    $dou->dou_msg($_LANG['user_insert_success'],"/usernew.php?rec=login");
}

/**
 * +----------------------------------------------------------
 * 登录页
 * +----------------------------------------------------------
 */
elseif ($rec == 'login') {
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
    $smarty->display('usernew.dwt');
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
        $dou->dou_msg("请输入用户名", '/usernew.php?rec=login');
     $_POST['user_name'] = $check->is_username(trim($_POST['user_name'])) ? trim($_POST['user_name']) :  trim($_POST['user_name']) ;
    $_POST['password'] = $check->is_password(trim($_POST['password'])) ? trim($_POST['password']) : trim($_POST['password']);
    
    // 如果用户名存在则获取用户信息
    $user = $dou->get_row('admin', '*', "user_name = '$_POST[user_name]'");
     // 验证用户是否存在和密码是否正确
    if (!is_array($user)) {
        $dou->dou_msg($_LANG['user_login_wrong'],  '/usernew.php?rec=login');
    } elseif (md5($_POST['password']) != $user['password']) {
        $dou->dou_msg($_LANG['user_login_wrong'],  '/usernew.php?rec=login');
    }

    //验证状态
    if($user['status']==0)
    {
        $dou->dou_msg("该账号等待审核中，审核通过才能登陆",  '/usernew.php?rec=login');
    }
    //验证状态
    if($user['status']==-1)
    {
        $dou->dou_msg("该账号审核失败，请联系管理员进行处理",  '/usernew.php?rec=login');
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
     $dou->dou_msg($_LANG['user_login_success'], "/usernew.php?rec=list");
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

    $smarty->display('usernew.dwt');
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
                $dou->dou_msg($_LANG['captcha_wrong'],  '/usernew.php?rec=password_reset');
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

    $smarty->display('usernew.dwt');
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

    $smarty->display('usernew.dwt');
}


/**
 * +----------------------------------------------------------
 * 账号管理
 * +----------------------------------------------------------
 */
elseif ($rec == 'setinfo') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('setinfo'));

    $enterprise_info = $dou->get_row('enterprise', '*', "user_id =".$_GLOBAL_USER['user_id']);
    $_GLOBAL_USER['add_time']=date('Y-m-d H:i:s',$_GLOBAL_USER['add_time']);




    // 赋值给模板
    $smarty->assign('user_info', $_GLOBAL_USER);
    $smarty->assign('enterprise_info', $enterprise_info);
    $smarty->assign('page_title', '账号管理');
    $smarty->assign('head', '账号管理');
    $smarty->assign('ur_here', $dou->ur_here('usernew', 'setinfo'));
    $smarty->display('usernew.dwt');
}

/**
 * +----------------------------------------------------------
 * 账号信息修改
 * +----------------------------------------------------------
 */
elseif ($rec == 'setinfo_post') {
    //
    $user_name = $_POST['setuser_name'];
    $enterprise_name = $_POST['setenterprise_name'];

    // 验证用户名
    if (!$check->is_username($user_name)) {
        $wrong['user_name'] ="用户名请以字母开头，由字母数字下划线组成！";
    } elseif ($user_name!=$_GLOBAL_USER['user_name']&&$dou->value_exist('admin', 'user_name', $user_name)) {
        $wrong['user_name'] = "该用户名已存在";
    }

    if (!isset($enterprise_name) || $enterprise_name=='')
    {
        $wrong['user_name'] = "用户名称不能为空";
    }


    if ($wrong) {
        foreach ($wrong as $key => $value) {
            $wrong_format .= $wrong[$key] . '<br>';
        }
        $dou->dou_msg($wrong_format,"/usernew.php?rec=setinfo");
    }

    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'setinfo');

    $sql = "UPDATE " . $dou->table('admin') . " SET user_name = '" . $user_name . "' WHERE user_id = '$_GLOBAL_USER[user_id]'";
    $dou->query($sql);

    $sql = "UPDATE " . $dou->table('enterprise') . " SET enterprise_name = '" . $enterprise_name . "' WHERE user_id = '$_GLOBAL_USER[user_id]'";
    $dou->query($sql);

    $dou->dou_msg('编辑成功', '/usernew.php?rec=setinfo');
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
    
    $dou->dou_msg($_LANG['user_password_success'], '/usernew.php?rec=password');
}
/**
 * +----------------------------------------------------------
 * 我的任务
 * +----------------------------------------------------------
 */
elseif ($rec == 'list') {


    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]'";

    $user_info  = $dou->get_row('admin', '*', "user_id = '$_GLOBAL_USER[user_id]'");

    $cur_filter='0';
    $filter='';
    $smarty->assign('id', '');
    if(isset($_REQUEST['id'])&&$_REQUEST['id']!="")
    {
        $filter.="&id=".$_REQUEST['id'];
        $id = substr($_REQUEST['id'],6,strlen($_REQUEST['id'])-6);
         $where.=" and id=".intval($id);
        $smarty->assign('id', "T00000".$id);
    }

    if(isset($_REQUEST['pay_status']))
    {
        $filter.="&pay_status=".$_REQUEST['pay_status'];
        $where.=" and pay_status=".intval($_REQUEST['pay_status']);
    }

    if(isset($_REQUEST['name'])&&$_REQUEST['name']!="")
    {
        $filter.="&name=".$_REQUEST['name'];
        $where.=" and name like '%".trim($_REQUEST['name'])."%'";
    }


    if(isset($_REQUEST['status'])&&$_REQUEST['status']!="")
    {
        $filter.="&status=".$_REQUEST['status'];
        $where.=" and status=".intval($_REQUEST['status']);
    }

    if(isset($_REQUEST['add_time1'])&&$_REQUEST['add_time1']!="")
    {
        $filter.="&add_time1=".$_REQUEST['add_time1'];
        $where.=" and add_time>='".$_REQUEST['add_time1'].' 00:00:00'."'";
    }
    if(isset($_REQUEST['add_time2'])&&$_REQUEST['add_time2']!="")
    {
        $filter.="&add_time2=".$_REQUEST['add_time2'];
        $where.=" and add_time<='".$_REQUEST['add_time2'].' 23:59:59'."'";
    }

    if(isset($_REQUEST['end_time1'])&&$_REQUEST['end_time1']!="")
    {
        $filter.="&end_time1=".$_REQUEST['end_time1'];
        $where.=" and end_time>='".$_REQUEST['end_time1'].' 00:00:00'."'";
    }
    if(isset($_REQUEST['end_time2'])&&$_REQUEST['end_time2']!="")
    {
        $filter.="&end_time2=".$_REQUEST['end_time2'];
        $where.=" and end_time<='".$_REQUEST['end_time2'].' 23:59:59'."'";
    }


//    if($_REQUEST['pay_status']=='0')
//    {
//        $cur_filter='1';
//    }
//
//    if($_REQUEST['pay_status']=='1'&&$_REQUEST['status']=='0')
//    {
//        $cur_filter='2';
//    }
//
//    if($_REQUEST['status']=='1')
//    {
//        $cur_filter='3';
//    }


    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('product') . $where . " ORDER BY id DESC";



    $sql_count = "SELECT count(*) as count FROM " . $dou->table('product') . $where . " ORDER BY id DESC";
    $count =  $dou->get_one($sql_count);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, '/usernew.php?rec=list'.$filter);

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
        $price_str = "";
        if($row['price_type']==0)
        {
            $price_str=$row['price'];
        }
        else
        {
            $price_str=$row['price'].'-'.$row['price_to'];
        }

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
             "max" => $row['max'],
            "file1" => $row['file1']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file1]'"),
            "file2" => $row['file2']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file2]'"),
            "file3" =>$row['file3']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file3]'"),
            "file4" => $row['file4']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file4]'"),
            "file5" => $row['file5']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file5]'"),
             "jisuandw" => $row['jisuandw'],
             "upload_status" => $row['upload_status'],
             "upload_fail_reason" => $row['upload_fail_reason'],
             "price_str" => $price_str,
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
    $smarty->assign('add_time1', $add_time1);
    $smarty->assign('add_time2', $add_time2);
    $smarty->assign('end_time1', $end_time1);
    $smarty->assign('end_time2', $end_time2);
    $smarty->assign('status', $status);
    $smarty->assign('name', $name);
    $smarty->assign('createpro', $user_info['createpro']);

    $smarty->display('usernew.dwt');
}
/**
 * +----------------------------------------------------------
 * 附件下载
 * +----------------------------------------------------------
 */
elseif ($rec == 'listdownload') {


    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]'";

    $user_info  = $dou->get_row('admin', '*', "user_id = '$_GLOBAL_USER[user_id]'");

    $cur_filter='0';
    $filter='';
    $smarty->assign('id', '');
    if(isset($_REQUEST['id'])&&$_REQUEST['id']!="")
    {
        $filter.="&id=".$_REQUEST['id'];
        $id = substr($_REQUEST['id'],6,strlen($_REQUEST['id'])-6);
        $where.=" and id=".intval($id);
        $smarty->assign('id', "T00000".$id);
    }

    if(isset($_REQUEST['pay_status']))
    {
        $filter.="&pay_status=".$_REQUEST['pay_status'];
        $where.=" and pay_status=".intval($_REQUEST['pay_status']);
    }

    if(isset($_REQUEST['name'])&&$_REQUEST['name']!="")
    {
        $filter.="&name=".$_REQUEST['name'];
        $where.=" and name like '%".trim($_REQUEST['name'])."%'";
    }


    if(isset($_REQUEST['status'])&&$_REQUEST['status']!="")
    {
        $filter.="&status=".$_REQUEST['status'];
        $where.=" and status=".intval($_REQUEST['status']);
    }

    if(isset($_REQUEST['add_time1'])&&$_REQUEST['add_time1']!="")
    {
        $filter.="&add_time1=".$_REQUEST['add_time1'];
        $where.=" and add_time>='".$_REQUEST['add_time1'].' 00:00:00'."'";
    }
    if(isset($_REQUEST['add_time2'])&&$_REQUEST['add_time2']!="")
    {
        $filter.="&add_time2=".$_REQUEST['add_time2'];
        $where.=" and add_time<='".$_REQUEST['add_time2'].' 23:59:59'."'";
    }

    if(isset($_REQUEST['end_time1'])&&$_REQUEST['end_time1']!="")
    {
        $filter.="&end_time1=".$_REQUEST['end_time1'];
        $where.=" and end_time>='".$_REQUEST['end_time1'].' 00:00:00'."'";
    }
    if(isset($_REQUEST['end_time2'])&&$_REQUEST['end_time2']!="")
    {
        $filter.="&end_time2=".$_REQUEST['end_time2'];
        $where.=" and end_time<='".$_REQUEST['end_time2'].' 23:59:59'."'";
    }


//    if($_REQUEST['pay_status']=='0')
//    {
//        $cur_filter='1';
//    }
//
//    if($_REQUEST['pay_status']=='1'&&$_REQUEST['status']=='0')
//    {
//        $cur_filter='2';
//    }
//
//    if($_REQUEST['status']=='1')
//    {
//        $cur_filter='3';
//    }


    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('product') . $where . " ORDER BY id DESC";



    $sql_count = "SELECT count(*) as count FROM " . $dou->table('product') . $where . " ORDER BY id DESC";
    $count =  $dou->get_one($sql_count);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, '/usernew.php?rec=list'.$filter);

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
        $price_str = "";
        if($row['price_type']==0)
        {
            $price_str=$row['price'];
        }
        else
        {
            $price_str=$row['price'].'-'.$row['price_to'];
        }

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
            "max" => $row['max'],
            "file1" => $row['file1']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file1]'"),
            "file2" => $row['file2']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file2]'"),
            "file3" =>$row['file3']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file3]'"),
            "file4" => $row['file4']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file4]'"),
            "file5" => $row['file5']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file5]'"),
            "jisuandw" => $row['jisuandw'],
            "upload_status" => $row['upload_status'],
            "upload_fail_reason" => $row['upload_fail_reason'],
            "price_str" => $price_str,
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
    $smarty->assign('add_time1', $add_time1);
    $smarty->assign('add_time2', $add_time2);
    $smarty->assign('end_time1', $end_time1);
    $smarty->assign('end_time2', $end_time2);
    $smarty->assign('status', $status);
    $smarty->assign('name', $name);
    $smarty->assign('createpro', $user_info['createpro']);

    $smarty->display('usernew.dwt');
}


/**
 * +----------------------------------------------------------
 * 我的钱包
 * +----------------------------------------------------------
 */
elseif ($rec == 'myamount') {


    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]'";

    $cur_filter='0';
    $filter='';

    if(isset($_REQUEST['add_time'])&&$_REQUEST['add_time']!="")
    {
        $filter.="&add_time=".$_REQUEST['add_time'];
        $where.=" and add_time>='".$_REQUEST['add_time'].' 00:00:00'."'";
    }


    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('amount_record') . $where . " ORDER BY id DESC";



    $sql_count = "SELECT count(*) as count FROM " . $dou->table('amount_record') . $where . " ORDER BY id DESC";
    $count =  $dou->get_one($sql_count);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, '/usernew.php?rec=myamount'.$filter);

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = '$row[user_id]'");

        $desc =$row['amount']>=0?'充值打款':"支付扣款<a href=\"/usernew.php?ppid=T00000".$row['pid']."&rec=transaction\">查看详情</a>";
        $order_list[] = array (
            "id" => $row['id'],
            "user_name" => $user_name,
            "amount" =>  $row['amount'],
            "add_time" => $row['add_time'],
            "desc" => $desc

        );
    }

    $amount= $dou->get_one("SELECT amount FROM " . $dou->table('admin') . " WHERE user_id = '$_GLOBAL_USER[user_id]'");

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'myamount'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'myamount'));
    $smarty->assign('head', '我的钱包');
    $smarty->assign('order_list', $order_list);
    $smarty->assign('count', $count);
    $smarty->assign('cur_filter', $cur_filter);
    $smarty->assign('add_time', $add_time);
    $smarty->assign('amount', $amount);
    $smarty->display('usernew.dwt');
}


/**
 * +----------------------------------------------------------
 * 查看上传的表格信息
 * +----------------------------------------------------------
 */
elseif ($rec == 'showxlsform') {

$ppid=$_REQUEST['ppid'];

    $product_info=$dou->get_row('product', '*', "id = '".$ppid."'");
    $file= $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$product_info[list_file]'");
    $smarty->assign('ur_here', $dou->ur_here('usernew', 'uploadlist'));
    $smarty->assign('head', ' 查看上传的表格');
    $smarty->assign('ppid', $ppid);
    $smarty->assign('product_info', $product_info);
    $smarty->assign('file', $file);
    $smarty->display('usernew.dwt');
}
/**
 * +----------------------------------------------------------
 * 上传分发明细表格
 * +----------------------------------------------------------
 */
elseif ($rec == 'uploadlist') {

    $ppid=$_REQUEST['ppid'];

    $product_info=$dou->get_row('product', '*', "id = '".$ppid."'");

    $smarty->assign('ur_here', $dou->ur_here('usernew', 'uploadlist'));
    $smarty->assign('head', ' 上传分发明细表格');
    $smarty->assign('ppid', $ppid);
    $smarty->assign('product_info', $product_info);
    $smarty->display('usernew.dwt');
}

/**
 * +----------------------------------------------------------
 * 检测并保存上传的表格文件
 * +----------------------------------------------------------
 */
elseif ($rec == 'uploadlist_post') {

    $ppid = $check->is_number($_REQUEST['ppid']) ? $_REQUEST['ppid'] : '';
     $pro_info = $dou->get_row('product', '*', "id = '".$ppid."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误');
        exit;
    }
    include_once (ROOT_PATH . 'include/file.class.php');
    $file = new File('images/uploadList/', null, 'xls'); // 实例化类文件(文件上传路径，结尾加斜杠)
    // 文件上传盒子
    $image = $file->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);
    $sql = "UPDATE " . $dou->table('product') . " SET is_read = 1 , upload_status=1,list_file='$image' WHERE id = $ppid";
    $dou->query($sql);


    //读取文件并写入银行卡名称信息
    $file= $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$image'");
    readupdatexls($file,$ppid,$image);

    $dou->dou_msg('操作成功', '/usernew.php?rec=list');
}
/**
 * +----------------------------------------------------------
 * 上传分发明细表格
 * +----------------------------------------------------------
 */
elseif ($rec == 'uploadyspdf') {

    $ppid=$_REQUEST['ppid'];

    $product_info=$dou->get_row('product', '*', "id = '".$ppid."'");

    $smarty->assign('ur_here', $dou->ur_here('usernew', 'uploadyspdf'));
    $smarty->assign('head', ' 上传验收扫描件');
    $smarty->assign('ppid', $ppid);
    $smarty->assign('product_info', $product_info);
    $smarty->display('usernew.dwt');
}

/**
 * +----------------------------------------------------------
 * 检测并保存上传的表格文件
 * +----------------------------------------------------------
 */
elseif ($rec == 'uploadyspdf_post') {

    $ppid = $check->is_number($_REQUEST['ppid']) ? $_REQUEST['ppid'] : '';
    $pro_info = $dou->get_row('product', '*', "id = '".$ppid."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误');
        exit;
    }
    include_once (ROOT_PATH . 'include/file.class.php');
    $file = new File('images/product_pdf/', null); // 实例化类文件(文件上传路径，结尾加斜杠)
    // 文件上传盒子
    $image = $file->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);
    $sql = "UPDATE " . $dou->table('product') . " SET  file5='$image' WHERE id = $ppid";
    $dou->query($sql);

    $dou->dou_msg('操作成功', '/usernew.php?rec=list');
}

/**
 * +----------------------------------------------------------
 * 商户端确认打款，给该product产生的未付款list进行打款
 * +----------------------------------------------------------
 */
elseif ($rec == 'paylist') {

    $ppid = $check->is_number($_REQUEST['ppid']) ? $_REQUEST['ppid'] : '';
    $pro_info = $dou->get_row('product', '*', "id = '".$ppid."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误', '/admin/product.php?type=1');
        exit;
    }
    $sql = "UPDATE " . $dou->table('product') . " SET  upload_status=3 WHERE id = $ppid";
    $dou->query($sql);
    $dou->dou_msg('操作成功');
}





/**
 * +----------------------------------------------------------
 * 我的订单
 * +----------------------------------------------------------
 */
elseif ($rec == 'myorder') {


    // 公用SQL查询条件，分页中也使用
    $where = " WHERE is_del=0 and p_userid = '$_GLOBAL_USER[user_id]'";

    $cur_filter='0';
    $filter='';
    $smarty->assign('id', '');
    if(isset($_REQUEST['id'])&&$_REQUEST['id']!="")
    {
        $filter.="&id=".$_REQUEST['id'];
        $id_str = substr($_REQUEST['id'],6,strlen($_REQUEST['id'])-6);
        $id_arr=explode('_',$id_str);
        $id=$id_arr[1];
        $where.=" and id=".intval($id);
        $smarty->assign('id', $_REQUEST['id']);
    }
    $smarty->assign('ppid', '');
    if(isset($_REQUEST['ppid'])&&$_REQUEST['ppid']!="")
    {
        $filter.="&ppid=".$_REQUEST['ppid'];
        $ppid = substr($_REQUEST['ppid'],6,strlen($_REQUEST['ppid'])-6);
        $where.=" and ppid=".intval($ppid);
        $smarty->assign('ppid',$_REQUEST['ppid']);
    }



    if(isset($_REQUEST['p_name'])&&$_REQUEST['p_name']!="")
    {
        $filter.="&p_name=".$_REQUEST['p_name'];
        $where.=" and p_name like '%".trim($_REQUEST['p_name'])."%'";
    }
    $smarty->assign('p_name', $_REQUEST['p_name']);


    if(isset($_REQUEST['truename'])&&$_REQUEST['truename']!="")
    {
        $filter.="&truename=".$_REQUEST['truename'];
        $where.=" and truename like '%".trim($_REQUEST['truename'])."%'";
    }
    $smarty->assign('truename', $_REQUEST['truename']);

    $smarty->assign('status', '');
    if(isset($_REQUEST['status'])&&$_REQUEST['status']!="")
    {
        $filter.="&status=".$_REQUEST['status'];
        $where.=" and status=".intval($_REQUEST['status']);
        $smarty->assign('status', $_REQUEST['status']);
    }


//    if(isset($_REQUEST['add_time1'])&&$_REQUEST['add_time1']!="")
//    {
//        $where.=" and add_time>='".$_REQUEST['add_time1'].' 00:00:00'."'";
//    }
//    if(isset($_REQUEST['add_time2'])&&$_REQUEST['add_time2']!="")
//    {
//        $where.=" and add_time<='".$_REQUEST['add_time2'].' 23:59:59'."'";
//    }
//
//    if(isset($_REQUEST['end_time1'])&&$_REQUEST['end_time1']!="")
//    {
//        $where.=" and end_time>='".$_REQUEST['end_time1'].' 00:00:00'."'";
//    }
//    if(isset($_REQUEST['end_time2'])&&$_REQUEST['end_time2']!="")
//    {
//        $where.=" and end_time<='".$_REQUEST['end_time2'].' 23:59:59'."'";
//    }


//    if($_REQUEST['pay_status']=='0')
//    {
//        $cur_filter='1';
//    }
//
//    if($_REQUEST['pay_status']=='1'&&$_REQUEST['status']=='0')
//    {
//        $cur_filter='2';
//    }
//
//    if($_REQUEST['status']=='1')
//    {
//        $cur_filter='3';
//    }


    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('list') . $where . " ORDER BY id DESC";



    $sql_count = "SELECT count(*) as count FROM " . $dou->table('list') . $where . " ORDER BY id DESC";
    $count =  $dou->get_one($sql_count);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, '/usernew.php?rec=myorder'.$filter);

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $product_info =  $dou->get_row('product', '*', "id =".$row['ppid']);
        $p_catname = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') ." where cat_id=".$product_info['cat_id']);

        $price_str = "";
        if($product_info['price_type']==0)
        {
            $price_str=$product_info['price'];
        }
        else
        {
            $price_str=$product_info['price'].'-'.$product_info['price_to'];
        }
        $status_k="";
        switch($row['status'])
        {
            case 0:
                $status_k="已领取";
                break;
            case 1:
                $status_k="已完成";
                break;
            case 2:
                $status_k="已验收";
                break;
        }

        $order_list[] = array (
            "id" => $row['id'],
            "ppid" => $row['ppid'],
            "p_name" => $row['p_name'],
            "p_price" => $price_str,
            "truename" => $row['truename'],
            "add_time" => $row['add_time'],
            "p_city" => $product_info['city'],
            "p_catname" => $p_catname,
            "add_time" => $row['add_time'],
            "p_add_time" => $product_info['add_time'],
            "status" => $status_k,
        );


    }

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'order_my'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'order_my'));
    $smarty->assign('head', '我的任务');
    $smarty->assign('order_list', $order_list);
    $smarty->assign('count', $count);
    $smarty->assign('cur_filter', $cur_filter);
    $smarty->assign('name', $name);

    $smarty->display('usernew.dwt');
}

/**
 * +----------------------------------------------------------
 * 我的订单
 * +----------------------------------------------------------
 */
elseif ($rec == 'companyinfo') {

    $enterprise_info =  $dou->get_row('enterprise', '*', "user_id ='$_GLOBAL_USER[user_id]'");
    $smarty->assign('enterprise_info', $enterprise_info);
    $smarty->display('usernew.dwt');
}

/**
 * +----------------------------------------------------------
 * 待办事务
 * +----------------------------------------------------------
 */
elseif ($rec == 'tasktool') {
    $where = " WHERE is_del=0 and p_userid = '$_GLOBAL_USER[user_id]'";

    //待中标

    //审核未通过


    //待验收（待支付订单）
    $where1=$where." and status=1 ";
    $sql_count = "SELECT count(*) as count FROM " . $dou->table('list') . $where1 . " ORDER BY id DESC";

    $dys =  $dou->get_one($sql_count);


    $smarty->assign('dys', $dys);
    $smarty->display('usernew.dwt');
}
/**
 * +----------------------------------------------------------
 * 任务详情
 * +----------------------------------------------------------
 */
elseif ($rec == 'listinfo') {
    $enterprise_name = $dou->get_one("SELECT enterprise_name FROM " . $dou->table('enterprise') . " WHERE user_id = '$_GLOBAL_USER[user_id]'");
    $product_info =  $dou->get_row('product', '*', "id =".$_REQUEST['id']);
    $product_info['request_name']=$enterprise_name;
    $p_catname = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') ." where cat_id=".$product_info['cat_id']);

    $status_k="";
    switch($product_info['status'])
    {
        case 0:
            $status_k="进行中";
            break;
        case 1:
            $status_k="已完成";
            break;
        case 2:
            $status_k="已验收";
            break;
    }

    $price_str = "";
    if($product_info['price_type']==0)
    {
        $price_str=$product_info['price'];
    }
    else
    {
        $price_str=$product_info['price'].'-'.$product_info['price_to'];
    }
    $product_info['price_str']=$price_str;
    $product_info['cat_name']=$p_catname;
    $product_info['add_time']=date('Y-m-d H:i:s',$product_info['add_time']);
    $product_info['status_str']=$status_k;

    $smarty->assign('company', $product_info);
    $smarty->display('usernew.dwt');
}


/**
 * +----------------------------------------------------------
 * 任务大厅
 * +----------------------------------------------------------
 */
elseif ($rec == 'taskcenter') {

    $where=" where type=1 ";

    $cur_filter='';

    // 公用SQL查询条件，分页中也使用
     if(isset($_REQUEST['status'])&&$_REQUEST['status']!="")
    {
        $cur_filter.="&status=".$_REQUEST['status'];

        $where .=" and status=".intval($_REQUEST['status']);
        $smarty->assign('status', $_REQUEST['status']);
    }
    else
    {
        $where .= " and status = 0";
        $smarty->assign('status', '0');
    }

    if(isset($_REQUEST['keyword'])&&$_REQUEST['keyword']!="")
    {
        $cur_filter.="&keyword=".$_REQUEST['keyword'];
        $where .= " and name like '%".$_REQUEST['keyword']."%'";
        $smarty->assign('keyword', $_REQUEST['keyword']);
    }



    if(isset($_REQUEST['city'])&&$_REQUEST['city']!=""&&$_REQUEST['city']!="all")
    {
        $cur_filter.="&city=".$_REQUEST['city'];
        $where .= " and city like '%".$_REQUEST['city']."%'";

    }
    $smarty->assign('city', $_REQUEST['city']);

    $smarty->assign('province', $_REQUEST['province']);


    if(isset($_REQUEST['price'])&&$_REQUEST['price']!=""&&$_REQUEST['price']!="all")
    {
        $cur_filter.="&price=".$_REQUEST['price'];
        $price =$_REQUEST['price'];
        $price_arr=explode('-',$price);

        $where .= " and price >=".floatval($price_arr[0]);

        if($price_arr[1]!='0')
        {
            $where .= " and price_to<=".floatval($price_arr[1]);
        }
    }
    $smarty->assign('price', $_REQUEST['price']);


    if(isset($_REQUEST['cat_id'])&&$_REQUEST['cat_id']!=""&&$_REQUEST['cat_id']!="all")
    {
         // $cur_filter.="&cat_id=".$_REQUEST['cat_id'];
        $cat_id =$_REQUEST['cat_id'];
       // $where .= " and cat_id =".intval($cat_id);


        if($_REQUEST['cat_id2']=="")
        {
            $cur_filter.="&cat_id=".$_REQUEST['cat_id'];
            $where .= " and cat_id =".intval($cat_id);
        }
    }
    $smarty->assign('cat_id', $_REQUEST['cat_id']);

    if(isset($_REQUEST['cat_id2'])&&$_REQUEST['cat_id2']!=""&&$_REQUEST['cat_id2']!="all")
    {
        $cur_filter.="&cat_id=".$_REQUEST['cat_id2'];
        $cat_id2 =$_REQUEST['cat_id2'];
        $where .= " and cat_id =".intval($cat_id2);
    }
    $smarty->assign('cat_id2', $_REQUEST['cat_id2']);




    if(isset($_REQUEST['add_time'])&&$_REQUEST['add_time']!=""&&$_REQUEST['add_time']!="all")
    {
        $cur_filter.="&add_time=".$_REQUEST['add_time'];
        $add_time =$_REQUEST['add_time'];
        if($add_time=='today')
        {
            $where .= " and add_time>=".time();
        }
        else if($add_time=='three')
        {
            $where .= " and add_time>=".strtotime("-3 day");
        }
        else if($add_time=='week')
        {
            $where .= " and add_time>=".strtotime("-1 week");
        }
        else if($add_time=='month')
        {
            $where .= " and add_time>=".strtotime("-1 month");
        }
    }
    $smarty->assign('add_time', $_REQUEST['add_time']);



    if(isset($_REQUEST['end_time'])&&$_REQUEST['end_time']!=""&&$_REQUEST['end_time']!="all")
    {
        $cur_filter.="&end_time=".$_REQUEST['end_time'];
        $end_time =$_REQUEST['end_time'];
        if($end_time=='today')
        {
            $where .= " and end_time>='".date('Y-m-d',time())." 00:00:00' and end_time<='".date('Y-m-d',time())." 23:59:59'";
        }
        else if($end_time=='three')
        {
            $where .= " and end_time>='".date('Y-m-d H:i:s',strtotime("-3 day"))."' and end_time<='".date('Y-m-d H:i:s',time())."'";
        }
        else if($end_time=='week')
        {
            $where .= " and end_time>='".date('Y-m-d H:i:s',strtotime("-1 week"))."' and end_time<='".date('Y-m-d H:i:s',time())."'";
        }
        else if($end_time=='month')
        {
            $where .= " and end_time>='".date('Y-m-d H:i:s',strtotime("-1 month"))."' and end_time<='".date('Y-m-d H:i:s',time())."'";
        }
    }
    $smarty->assign('end_time', $_REQUEST['end_time']);


    if(isset($_REQUEST['order'])&&$_REQUEST['order']!=""&&$_REQUEST['order']!="declear"&&$_REQUEST['order']!="default")
    {
        $order=" ORDER BY ".$_REQUEST['order']." ".$_REQUEST['order_value'];

    }
    else
    {
        $_REQUEST['order']="default";
        $order=" ORDER BY id DESC ";
        $_REQUEST['order_value']="desc";
    }
    $smarty->assign('order_value', $_REQUEST['order_value']);
    $smarty->assign('order', $_REQUEST['order']);





    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('product') . $where . $order;
   // echo $sql;exit;
     $sql_count = "SELECT count(*) as count FROM " . $dou->table('product') . $where . " ORDER BY id DESC";
    $count =  $dou->get_one($sql_count);
    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;


    $limit = $dou->pager($sql, 15, $page, '/usernew.php?rec=taskcenter'.$cur_filter);
    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $p_catname = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') ." where cat_id=".$row['cat_id']);

        $price_str = "";
        if($row['price_type']==0)
        {
            $price_str=$row['price'];
        }
        else
        {
            $price_str=$row['price'].'-'.$row['price_to'];
        }

        $endtime = strtotime($row['end_time']);
        $starttime=$row['add_time'];
        $timediff = $endtime-$starttime;
        $days = intval($timediff/86400);

        $order_list[] = array (
            "id" => $row['id'],
            "name" => $row['name'],
            "cat_name" =>  $p_catname,
            "price_str" =>  $price_str,
            "max" => $row['max'],
            "city" => $row['city'],
            "end_time" => $row['end_time'],
            "add_time" => date('Y-m-d',$row['add_time']),
            "status" => $row['status'],
            "days" => $days,
        );

    }
    //任务分类列表
  //  $where_cat = " where parent_id>0 ";
    $where_cat = " where parent_id=0 ";
    $sql = "SELECT * FROM " . $dou->table('product_category') . $where_cat . " ORDER BY cat_id DESC";
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query))
    {
        $cat_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name'],
        );
    }


    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]'";

    $user_info  = $dou->get_row('admin', '*', "user_id = '$_GLOBAL_USER[user_id]'");

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('usernew', 'taskcenter'));
    $smarty->assign('ur_here', $dou->ur_here('usernew', 'taskcenter'));
    $smarty->assign('head', '任务大厅');
    $smarty->assign('order_list', $order_list);
    $smarty->assign('cat_list', $cat_list);
    $smarty->assign('count', $count);
    $smarty->assign('createpro', $user_info['createpro']);
    $smarty->assign('cur_filter', $cur_filter);
    $smarty->display('usernew.dwt');
}


/**
 * +----------------------------------------------------------
 * 任务大厅详情页面
 * +----------------------------------------------------------
 */
elseif ($rec == 'taskcenterinfo') {


    $product_info =  $dou->get_row('product', '*', "id =".$_REQUEST['id']);
    $product_info['request_name']=$product_info['company'];
    $p_catname = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') ." where cat_id=".$product_info['cat_id']);

    $status_k="";
    switch($product_info['status'])
    {
        case 0:
            $status_k="报名中";
            break;
        case 1:
            $status_k="已完成";
            break;
        case 2:
            $status_k="已验收";
            break;
    }

    $price_str = "";
    if($product_info['price_type']==0)
    {
        $price_str=$product_info['price'];
    }
    else
    {
        $price_str=$product_info['price'].'-'.$product_info['price_to'];
    }
    $product_info['price_str']=$price_str;
    $product_info['cat_name']=$p_catname;
    $product_info['add_time']=date('Y-m-d H:i:s',$product_info['add_time']);
    $product_info['status_str']=$status_k;
    $smarty->assign('product', $product_info);
    $smarty->display('usernew.dwt');
}

/**
 * +----------------------------------------------------------
 * 我的订单详情页
 * +----------------------------------------------------------
 */
elseif ($rec == 'myorderinfo') {

    $order_info =  $dou->get_row('list', '*', "id =".$_REQUEST['id']);

    $product_info =  $dou->get_row('product', '*', "id =".$order_info['ppid']);
    $product_info['request_name']="山东和信会计师事务所(特殊普通合伙)上海分所";
    $p_catname = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') ." where cat_id=".$product_info['cat_id']);

    $status_k="";
    switch($product_info['status'])
    {
        case 0:
            $status_k="已领取";
            break;
        case 1:
            $status_k="已完成";
            break;
        case 2:
            $status_k="已验收";
            break;
    }

    $price_str = "";
    $price_type_str = "";
    if($product_info['price_type']==0)
    {
        $price_str=$product_info['price'];
        $price_type_str = "固定额";
    }
    else
    {
        $price_str=$product_info['price'].'-'.$product_info['price_to'];
        $price_type_str = "范围";
    }
    $product_info['price_str']=$price_str;
    $product_info['cat_name']=$p_catname;
    $product_info['add_time']=date('Y-m-d H:i:s',$product_info['add_time']);
    $product_info['status_str']=$status_k;
    $product_info['price_type_str']=$price_type_str;

    $smarty->assign('product', $product_info);
    $smarty->assign('order', $order_info);
    $smarty->display('usernew.dwt');
}



/**
 * +----------------------------------------------------------
 * 我的交易
 * +----------------------------------------------------------
 */
elseif ($rec == 'transaction') {

    $enterprise_name = $dou->get_one("SELECT enterprise_name FROM " . $dou->table('enterprise') . " WHERE user_id = '$_GLOBAL_USER[user_id]'");



    // 公用SQL查询条件，分页中也使用
    $where = " WHERE is_del=0 and p_userid = '$_GLOBAL_USER[user_id]'";

    $cur_filter='0';
    $filter='';
    $smarty->assign('id', '');
    if(isset($_REQUEST['id'])&&$_REQUEST['id']!="")
    {
        $filter.="&id=".$_REQUEST['id'];
        $id_str = substr($_REQUEST['id'],6,strlen($_REQUEST['id'])-6);
        $id_arr=explode('_',$id_str);
        $id=$id_arr[1];
        $where.=" and id=".intval($id);
        $smarty->assign('id', $_REQUEST['id']);
    }
    $smarty->assign('ppid', '');
    if(isset($_REQUEST['ppid'])&&$_REQUEST['ppid']!="")
    {
        $filter.="&ppid=".$_REQUEST['ppid'];
        $ppid = substr($_REQUEST['ppid'],6,strlen($_REQUEST['ppid'])-6);
        $where.=" and ppid=".intval($ppid);
        $smarty->assign('ppid',$_REQUEST['ppid']);
    }



    if(isset($_REQUEST['p_name'])&&$_REQUEST['p_name']!="")
    {
        $filter.="&p_name=".$_REQUEST['p_name'];
        $where.=" and p_name like '%".trim($_REQUEST['p_name'])."%'";
    }
    $smarty->assign('p_name', $_REQUEST['p_name']);


    if(isset($_REQUEST['truename'])&&$_REQUEST['truename']!="")
    {
        $filter.="&truename=".$_REQUEST['truename'];
        $where.=" and truename like '%".trim($_REQUEST['truename'])."%'";
    }
    $smarty->assign('truename', $_REQUEST['truename']);

    $smarty->assign('status', '');
    if(isset($_REQUEST['status'])&&$_REQUEST['status']!="")
    {
        $filter.="&status=".$_REQUEST['status'];
        $where.=" and status=".intval($_REQUEST['status']);
        $smarty->assign('status', $_REQUEST['status']);
    }


    $smarty->assign('pay_status', '');
    if(isset($_REQUEST['pay_status'])&&$_REQUEST['pay_status']!="")
    {
        $filter.="&pay_status=".$_REQUEST['pay_status'];
        $where.=" and pay_status=".intval($_REQUEST['pay_status']);
        $smarty->assign('pay_status', $_REQUEST['pay_status']);
    }


//    if(isset($_REQUEST['add_time1'])&&$_REQUEST['add_time1']!="")
//    {
//        $where.=" and add_time>='".$_REQUEST['add_time1'].' 00:00:00'."'";
//    }
//    if(isset($_REQUEST['add_time2'])&&$_REQUEST['add_time2']!="")
//    {
//        $where.=" and add_time<='".$_REQUEST['add_time2'].' 23:59:59'."'";
//    }
//
//    if(isset($_REQUEST['end_time1'])&&$_REQUEST['end_time1']!="")
//    {
//        $where.=" and end_time>='".$_REQUEST['end_time1'].' 00:00:00'."'";
//    }
//    if(isset($_REQUEST['end_time2'])&&$_REQUEST['end_time2']!="")
//    {
//        $where.=" and end_time<='".$_REQUEST['end_time2'].' 23:59:59'."'";
//    }


//    if($_REQUEST['pay_status']=='0')
//    {
//        $cur_filter='1';
//    }
//
//    if($_REQUEST['pay_status']=='1'&&$_REQUEST['status']=='0')
//    {
//        $cur_filter='2';
//    }
//
//    if($_REQUEST['status']=='1')
//    {
//        $cur_filter='3';
//    }


    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('list') . $where . " ORDER BY id DESC";



    $sql_count = "SELECT count(*) as count FROM " . $dou->table('list') . $where . " ORDER BY id DESC";
    $count =  $dou->get_one($sql_count);

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, '/usernew.php?rec=transaction'.$filter);

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $product_info =  $dou->get_row('product', '*', "id =".$row['ppid']);
        $p_catname = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') ." where cat_id=".$product_info['cat_id']);

        $price_str = "";
        if($product_info['price_type']==0)
        {
            $price_str=$product_info['price'];
        }
        else
        {
            $price_str=$product_info['price'].'-'.$product_info['price_to'];
        }
        $status_k="";
        switch($row['status'])
        {
            case 0:
                $status_k="已接单";
                break;
            case 1:
                $status_k="待验收";
                break;
            case 2:
                $status_k="已验收";
                break;
        }

        $paystatus_k="";
        switch($row['pay_status'])
        {
            case 0:
                $paystatus_k="未支付";
                break;
            case 1:
                $paystatus_k="已支付";
                break;

        }

        $order_list[] = array (
            "id" => $row['id'],
            "ppid" => $row['ppid'],
            "p_name" => $row['p_name'],
            "pay_money" =>$row['pay_money'],
            "truename" => $row['truename'],
            "add_time" => $row['add_time'],
            "pay_time" => $row['pay_time'],
            "p_city" => $product_info['city'],
            "p_catname" => $p_catname,
            "add_time" => $row['add_time'],
            "p_add_time" => $product_info['add_time'],
            "request_name" => $enterprise_name,
            "service_name" => $product_info['company'],
            "p_add_time" => $product_info['add_time'],
            "status" => $status_k,
            "pay_status" => $paystatus_k,
        );


    }

    // 赋值给模板
    $smarty->assign('page_title', $dou->page_title('user', 'order_my'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'order_my'));
    $smarty->assign('head', '我的任务');
    $smarty->assign('order_list', $order_list);
    $smarty->assign('count', $count);
    $smarty->assign('cur_filter', $cur_filter);
    $smarty->assign('name', $name);

    $smarty->display('usernew.dwt');
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
    $where = " WHERE is_del=0 and ppid = ".intval($ppid);

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
    $smarty->display('usernew.dwt');
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
     $smarty->display('usernew.dwt');
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
    $smarty->assign('page_title', $dou->page_title('usernew', '发布任务'));
    $smarty->assign('head',"添加任务");
    $smarty->assign('ur_here', $dou->ur_here('usernew', 'addlist'));

    $sql = "SELECT * FROM " . $dou->table('product_category') . " WHERE parent_id = 0"; // 第一层
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $category_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    // 公用SQL查询条件，分页中也使用
    $where = " WHERE user_id = '$_GLOBAL_USER[user_id]'";

    $user_info  = $dou->get_row('admin', '*', "user_id = '$_GLOBAL_USER[user_id]'");

    $smarty->assign('createpro', $user_info['createpro']);
    $smarty->assign('category_list',$category_list);
    $smarty->display('usernew.dwt');
}
/**
 * +----------------------------------------------------------
 * 添加任务
 * +----------------------------------------------------------
 */
elseif ($rec == 'addlist_post') {


    $company = $dou->get_one("SELECT company FROM " . $dou->table('admin') . " WHERE user_id = '$_GLOBAL_USER[user_id]'");

    $name = $_POST['name'];

    $price = floatval($_POST['price']);
    $price_type = floatval($_POST['price_type']);
    $price_to=0;
    if($price_type=='1')
    {
        $price_to = floatval($_POST['price_to']);
    }
    $jisuandw = $_POST['jisuandw'];
    $tax_type = $_POST['tax_type'];
    $content = $_POST['content'];
    $city= $_POST['city'];
    $max= intval($_POST['max']);
    //$bind_mobile= $_POST['bind_mobile'];
    $start_time= $_POST['start_time']." 00:00:00";
    $stop_time= $_POST['stop_time']." 23:59:59";
    $end_time= $_POST['end_time']." 23:59:59";
   // $zhouqi= $_POST['zhouqi'];
     $add_time=time();

    $cat_name = $_POST['cat_name'];
    $cat_id=$dou->get_one("SELECT cat_id FROM " . $dou->table('product_category') . " WHERE cat_name = '$cat_name'");
    if($cat_id<=0)
    {
        $dou->dou_msg("任务分类不存在", "/usernew.php?rec=addlist");
    }


    // 图片上传
//    include_once (ROOT_PATH . 'include/file.class.php');
//    $file = new File('images/dis_form/', null, 'xls'); // 实例化类文件(文件上传路径，结尾加斜杠)
//    $card_pic='';
//    // 文件上传盒子
//    if ($_FILES['dis_formShow']['name'] != "") {
//        $card_pic_filename = 'disf_' . date('ymdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
//        $card_pic = $file->box('admin', $_GLOBAL_USER['user_id'], 'dis_formShow', 'main', $card_pic_filename, '', '', 'user_id');
//    }

//    $sql = "INSERT INTO " . $dou->table('product') . " (id,name, price,keywords, add_time,max,type,user_id,bind_mobile,stop_time,start_time,end_time,city,zhouqi,check_sta,dic_form)" . " VALUES (NULL, '$name',$price,'$keywords','$add_time',$max,1,'$_GLOBAL_USER[user_id]','$bind_mobile','$stop_time','$start_time','$end_time','$city','$zhouqi','$check_sta','$card_pic')";



    $sql = "INSERT INTO " . $dou->table('product') . " (id,name,cat_id,price_type, price,price_to,content, add_time,max,type,user_id,jisuandw,stop_time,start_time,end_time,city,tax_type,company)" . " VALUES (NULL, '$name',$cat_id,".intval($price_type).",$price,$price_to,'$content','$add_time',$max,1,'$_GLOBAL_USER[user_id]','$jisuandw','$stop_time','$start_time','$end_time','$city','$tax_type','$company')";
   // echo $sql;exit;
    $dou->query($sql);


    //解析xls存入暗线表格中


    $dou->dou_msg('添加成功', '/usernew.php?rec=list');
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
 * 获取城市列表
 * +----------------------------------------------------------
 */
elseif ($rec == 'getcitylist') {

    $province = $_POST['province'];

    $province_info =   $dou->get_row('area', '*', "areaName like '%".$province."%' and level=1 ");


    $where=" where level=2 and  parentId= ".$province_info['areaId'];
    $sql = "SELECT * FROM " . $dou->table('area') . $where . " ORDER BY areaId DESC";
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $row['areaName'] =  str_replace("市","",$row['areaName']);
        $row['areaName'] =  str_replace("区","",$row['areaName']);
        $row['areaName'] =  str_replace("城","",$row['areaName']);

        $city_list[] = array (
            "name" => $row['areaName']
        );

    }
    echo json_encode($city_list);
}
/**
 * +----------------------------------------------------------
 * 获取任务子分类
 * +----------------------------------------------------------
 */
elseif ($rec == 'getcatchildlist') {

    $cat_id = $_POST['cat_id'];
    $where=" where parent_id= ".intval($cat_id);
    $sql = "SELECT * FROM " . $dou->table('product_category') . $where . " ORDER BY cat_id DESC";
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $cat_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );

    }

    echo json_encode($cat_list);
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
    $dou->dou_header('/usernew.php?rec=login');
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

    $smarty->display('usernew.dwt');
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

    $smarty->display('usernew.dwt');
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
    
    $smarty->display('usernew.dwt');
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
    
    $smarty->display('usernew.dwt');
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


/**
 *读取表格并根据银行卡号更新银行卡名称
 * @param $file
 * @param $pid
 * @param $file_attache
 * @return array
 */
function readupdatexls($file,$pid,$file_attache)
{
    $excel_file = ROOT_PATH.ADMIN_PATH.'/include/PHPExcel5/PHPExcel.php';
    include_once($excel_file);

    $file = ''.$file;
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);

    $user_id =  $GLOBALS['dou']->get_one("SELECT user_id FROM " .  $GLOBALS['dou']->table('product') . " WHERE id = ".$pid);
    $taxrat =  $GLOBALS['dou']->get_one("SELECT taxrat FROM " .  $GLOBALS['dou']->table('admin') . " WHERE user_id = ".$user_id);
    $taxrat=floatval($taxrat)/100;

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
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'K1', '费率');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'L1', '收款金额');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'M1', '银行名称');


    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {     //遍历工作表
        $lastrow= 1;
        $total_amount =0;//实发总额
        $total_sum_amount =0;//收款总额
        foreach ($worksheet->getRowIterator() as $key=>$row) {       //遍历行
            $list_item=array();
            if($row->getRowIndex()>=2)
            {

                $cellIterator = $row->getCellIterator();   //得到所有列
                $cellIterator->setIterateOnlyExistingCells( false); // Loop all cells, even if it is not set
                foreach ($cellIterator as $cellkey=>$cell) {  //遍历列

                    $val = $cell->getCalculatedValue();
                    if (!is_null($cell)&&$cellkey=='B'&&!empty($val)) {
                        $lastrow=$row->getRowIndex();
                    }
                     if (!is_null($cell)&&$cellkey=='F') {  //银行卡号列
                          $val = $cell->getCalculatedValue();
                          if(!empty($val))
                          {
                              $val=  str_replace(' ','',$val);
                              $val=  preg_replace('/\s+/', '', $val);
                              $val=preg_replace('/[(\xc2\xa0)|\s]+/','', $val);
                              $oldchar=array(" ","　","\t","\n","\r");
                              $newchar=array("","","","","");
                              $val= str_replace($oldchar,$newchar,$val);

                              //查找所属银行代码及名称
                              $url="https://ccdcapi.alipay.com/validateAndCacheCardInfo.json?_input_charset=utf-8&cardNo=".$val."&cardBinCheck=true";
                              $ch = curl_init();
                              curl_setopt($ch, CURLOPT_URL, $url);
                              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                              $dom = curl_exec($ch);
                              curl_close($ch);
                              $dom =  json_decode($dom);
                              $bankcode = $dom->bank;
                              $company =  $GLOBALS['dou']->get_one("SELECT name FROM " .  $GLOBALS['dou']->table('bank_api') . " WHERE code = '$bankcode'");

                              $count=$GLOBALS['dou']->get_one("SELECT count(*) FROM " .  $GLOBALS['dou']->table('banknew') . " WHERE name like '%$company%'");

                              if($count==0)
                              {
                                  $company=$company."-该银行不在支付数据库中，无法进行线上支付操作";
                              }
                              $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'M'.$row->getRowIndex(), $company);
                              ob_end_clean();//清除缓存区，解决乱码问题
                              $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                              $objWriter->save($file);

                          }
                      }
                     if (!is_null($cell)&&$cellkey=='I') {//实发金额列
                        $val = $cell->getCalculatedValue();

                        if(!empty($val))
                        {
                            $val=  str_replace(' ','',$val);
                            $val=  preg_replace('/\s+/', '', $val);
                            $val=preg_replace('/[(\xc2\xa0)|\s]+/','', $val);
                            $oldchar=array(" ","　","\t","\n","\r");
                            $newchar=array("","","","","");
                            $val= str_replace($oldchar,$newchar,$val);
                            $val= floatval($val);


                            $total_amount += $val;
                            $total_sum_amount += ($val*(1+$taxrat));
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'K'.$row->getRowIndex(), ($taxrat*100).'%');
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'L'.$row->getRowIndex(), ($val*(1+$taxrat)));
                            ob_end_clean();//清除缓存区，解决乱码问题
                            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                            $objWriter->save($file);

                        }

                    }//如果列不给空就得到它的坐标和计算的值


                }
            }


        }

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'A'.($lastrow+1),'合计');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'I'.($lastrow+1), $total_amount);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'L'.($lastrow+1), $total_sum_amount);
        ob_end_clean();//清除缓存区，解决乱码问题
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($file);
    }


}





?>