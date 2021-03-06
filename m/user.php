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

$sub = 'login|login_post|register|register_post|edit|edit_post|password|password_post|password_reset|password_reset_post|logout|order_list|order|order_cancel|sns|sns_link';
$subbox = array(
        "module" => 'user',
        "sub" => $sub
);

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 引入和实例化订单功能
if (file_exists($order_file = ROOT_PATH . 'include/order.class.php')) {
    include_once ($order_file);
    $dou_order = new Order();
}

// 设定不需要登录权限的页面
$no_login_array = explode('|', 'login|login_post|register|register_post|password_reset|password_reset_post|sns_link');

// 需要登录且没有登录的情况
if (!in_array($rec, $no_login_array) && !is_array($_GLOBAL_USER)) {
    $dou->dou_header($_URL['login']);
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
$smarty->assign('link_user_center', $dou_user->link_user_center());
$smarty->assign('if_connect_plugin', $dou->value_exist('plugin', 'plugin_group', 'connect'));

/**
 * +----------------------------------------------------------
 * 会员中心
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
	   // 获取会员信息
	   $user_info = $dou->get_row('user', '*', "user_id = '" . $_GLOBAL_USER['user_id'] . "'");
	
	   // 格式化数据
	   $user_info['avatar'] = $user_info['avatar'] ? $dou->dou_file($user_info['avatar']) : ROOT_URL . 'images/avatar/..empty.png';
    $user_info['last_login'] = date("Y-m-d H:i", $dou->get_first_log($user_info['last_login']));
    $user_info['last_ip'] = $dou->get_first_log($user_info['last_ip']);

    $smarty->assign('page_title', $dou->page_title('user'));
    $smarty->assign('ur_here', $dou->ur_here('user'));
    $smarty->assign('head', $_LANG['user']);
    $smarty->assign('user_info', $user_info);
    $smarty->assign('welcome', $dou_user->welcome());
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
    $_POST['email'] = $firewall->dou_foreground($_POST['email']);
    
    // 验证用户名
    if (!$check->is_email($_POST['email'])) {
        $wrong['email'] = $_LANG['user_email_cue'];
    } elseif ($dou->value_exist('user', 'email', $_POST['email'])) {
        $wrong['email'] = $_LANG['user_email_exists'];
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
        $dou->dou_msg($wrong_format, $_URL['user']);
    }
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'user_register');
    
    // 格式化数据
    $user_sn = $dou_user->rand_user_sn();
    $password = md5($_POST['password']);
    $add_time = time();
    
    $sql = "INSERT INTO " . $dou->table('user') . " (user_id, user_sn, email, password, add_time)" . " VALUES (NULL, '$user_sn', '$_POST[email]', '$password', '$add_time')";
    $dou->query($sql);
        
    // 注册成功后直接登录
    $user = $dou->get_row('user', '*', "email = '$_POST[email]'");
    
    // 将会员登录信息写入SESSION
    $_SESSION[DOU_ID]['user_id'] = $user['user_id'];
    $_SESSION[DOU_ID]['shell'] = md5($user['email'] . $user['password'] . DOU_SHELL);
    $_SESSION[DOU_ID]['ontime'] = time();
	
	   // 判断是否正在操作SNS绑定
	   $sns_token = $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '';
	   if (is_array($sns = $_SESSION[DOU_ID]['sns'][$sns_token])) {
					   $dou->query("INSERT INTO " . $dou->table('user_sns') . " (id, user_id, `group`, openid, add_time)" . " VALUES (NULL, '$user[user_id]', '$sns[group]', '$sns[openid]', '$add_time')");
					   $dou->query("UPDATE " . $dou->table('user') . " SET nickname = '$sns[nickname]', avatar = '$sns[avatar]', sex = '$sns[sex]' WHERE user_id = '$user[user_id]'");
				}
    
	   // 生成登录记录
    $last_login = time();
    $last_ip = $dou->get_ip();
    $login_count = $user['login_count'] + 1;
    $dou->query("update " . $dou->table('user') . " SET login_count = '$login_count', last_login = '$last_login', last_ip = '$last_ip' WHERE user_id = " . $user['user_id']);

    $dou->dou_msg($_LANG['user_insert_success'], $_URL['user']);
}

/**
 * +----------------------------------------------------------
 * 登录页
 * +----------------------------------------------------------
 */
elseif ($rec == 'login') {
	   // SNS登录
    $sns = $check->is_rec($_REQUEST['sns']) ? $_REQUEST['sns'] : '';
	   if ($sns)
					   $dou->dou_header(HOME_URL . 'include/plugin/' . $sns . '/login.php');
	   
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('user_login'));
    
    $return_url = $_REQUEST['return_url'] ? $_REQUEST['return_url'] : urlencode($_SERVER['HTTP_REFERER']);
    
    // 赋值给模板息
    $smarty->assign('page_title', $dou->page_title('user', 'user_login'));
    $smarty->assign('ur_here', $dou->ur_here('user', 'user_login'));
    $smarty->assign('head', $_LANG['user_login']);
    $smarty->assign('return_url', $return_url);
	   $smarty->assign('sns_token', $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '');
	   $smarty->assign('connect_plugin_list', $dou_user->connect_plugin_list());
    
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
	
    if (!$_POST['email'])
        $dou->dou_msg($_LANG['user_email_cue'], $_URL['login']);
    
    $_POST['email'] = $check->is_email(trim($_POST['email'])) ? trim($_POST['email']) : '';
    $_POST['password'] = $check->is_password(trim($_POST['password'])) ? trim($_POST['password']) : '';
    
    // 如果用户名存在则获取用户信息
    $user = $dou->get_row('user', '*', "email = '$_POST[email]'");
    
    // 验证用户是否存在和密码是否正确
    if (!is_array($user)) {
        $dou->dou_msg($_LANG['user_login_wrong'], $_URL['login']);
    } elseif (md5($_POST['password']) != $user['password']) {
        $dou->dou_msg($_LANG['user_login_wrong'], $_URL['login']);
    }
    
    // 会员登录信息验证成功则写入SESSION
    $_SESSION[DOU_ID]['user_id'] = $user['user_id'];
    $_SESSION[DOU_ID]['shell'] = md5($user['email'] . $user['password'] . DOU_SHELL);
    $_SESSION[DOU_ID]['ontime'] = time();
	
	   // 判断是否正在操作SNS绑定
	   $sns_token = $check->is_number($_REQUEST['sns_token']) ? trim($_REQUEST['sns_token']) : '';
	   if (is_array($sns = $_SESSION[DOU_ID]['sns'][$sns_token])) {
					   $add_time = time();
					   $dou->query("INSERT INTO " . $dou->table('user_sns') . " (id, user_id, `group`, openid, add_time)" . " VALUES (NULL, '$user[user_id]', '$sns[group]', '$sns[openid]', '$add_time')");
				}
    
	   // 更新登录记录
    $last_login = $dou_user->log_update($user['last_login'], time());
    $last_ip = $dou_user->log_update($user['last_ip'], $dou->get_ip());
    $login_count = $user['login_count'] + 1;
    
    $dou->query("UPDATE " . $dou->table('user') . " SET login_count = '$login_count', last_login = '$last_login', last_ip = '$last_ip' WHERE user_id = " . $user['user_id']);
    
    $dou->dou_msg($_LANG['user_login_success'], urldecode($_POST['return_url']));
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
        if (!$dou->value_exist('user', 'email', $_POST['email']))
            $dou->dou_msg($_LANG['user_email_no_exist'], $_URL['password_reset']);
    
        // 判断验证码
        if ($_CFG['captcha']) {
            $_POST['captcha'] = $check->is_captcha(trim($_POST['captcha'])) ? strtoupper(trim($_POST['captcha'])) : ''; // 判断验证码格式是否正确
            if (md5($_POST['captcha'] . DOU_SHELL) != $_SESSION['captcha']) // 判断验证码是否正确
                $dou->dou_msg($_LANG['captcha_wrong'], $_URL['password_reset']);
        }
        
        // CSRF防御令牌验证
        $firewall->check_token($_POST['token'], 'user_password_reset');
        
        // 生成密码找回码
        $user = $dou->get_row('user', '*', "email = '$_POST[email]'");
        $time = time();
        $code = substr(md5($user['email'] . $user['password'] . $time . $user['last_login'] . DOU_SHELL) , 0 , 16) . $time;
        $site_url = rtrim(ROOT_URL, '/');
        $mark = strpos($_URL['password_reset'], '?') !== false ? '&' : '?';
        
        $body = $user['email'] . $_LANG['user_password_reset_body_0'] . $_URL['password_reset'] . $mark . 'uid=' . $user['user_id'] . '&code=' . $code . $_LANG['user_password_reset_body_1'] . $_CFG['site_name'] . '. ' . $site_url;
        
        // 发送密码重置邮件
        if ($dou->send_mail($_POST['email'], $_LANG['user_password_reset_title'], $body)) {
            $dou->dou_msg($_LANG['user_password_mail_success'] . $user['email'], HOME_URL, 30);
        } else {
            $dou->dou_msg($_LANG['mail_send_fail'], $_URL['password_reset'], 30);
        }
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
            $sql = "UPDATE " . $dou->table('user') . " SET password = '" . md5($_POST['password']) . "' WHERE user_id = '$user_id'";
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
        $avatar_filename = $file_name ? $file_name : $dou_user->create_avatar_filename();
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
    $old_password = $dou->get_one("SELECT password FROM " . $dou->table('user') . " WHERE user_id = '$_GLOBAL_USER[user_id]'");

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
    
    $sql = "UPDATE " . $dou->table('user') . " SET password = '" . md5($_POST['password']) . "' WHERE user_id = '$_GLOBAL_USER[user_id]'";
    $dou->query($sql);
    
    $dou->dou_msg($_LANG['user_password_success'], $_URL['edit']);
}

/**
 * +----------------------------------------------------------
 * 退出登录
 * +----------------------------------------------------------
 */
elseif ($rec == 'logout') {
    unset($_SESSION[DOU_ID]);
    $dou->dou_header(HOME_URL);
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

?>