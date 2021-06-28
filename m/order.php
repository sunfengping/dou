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

$sub = 'cart|checkout|update|del|success|cashier|pay';
$subbox = array(
        "module" => 'order',
        "sub" => $sub
);

require (dirname(__FILE__) . '/include/init.php');

// 验证是否登录
if (!is_array($_GLOBAL_USER))
    $dou->dou_header($_URL['login']);

// 引入和实例化订单功能
include_once (ROOT_PATH . 'include/order.class.php');
$dou_order = new Order();

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'cart';

// 赋值给模板-meta和title信息
$smarty->assign('keywords', $_CFG['site_keywords']);
$smarty->assign('description', $_CFG['site_description']);

// 赋值给模板-导航栏
$smarty->assign('nav_top_list', $dou->get_nav('top'));
$smarty->assign('nav_middle_list', $dou->get_nav('middle', 0, 'order', 0));
$smarty->assign('nav_bottom_list', $dou->get_nav('bottom'));

// 赋值给模板-数据
$smarty->assign('rec', $rec);

/**
 * +----------------------------------------------------------
 * 购物车项目列表
 * +----------------------------------------------------------
 */
if ($rec == 'cart') {
    // 赋值给模板-数据
    $smarty->assign('cart', $dou_order->get_cart());
    $smarty->assign('page_title', $dou->page_title('order_cart'));
    $smarty->assign('head', $_LANG['order_cart']);

    $smarty->display('order.dwt');
}

/**
 * +----------------------------------------------------------
 * 项目加入购物车
 * +----------------------------------------------------------
 */
elseif ($rec == 'insert') {
    $module = $check->is_extend_id($_REQUEST['module']) ? $_REQUEST['module'] : 'product';
    $item_id = $check->is_number($_REQUEST['item_id']) ? $_REQUEST['item_id'] : '';
    $item_number = $check->is_number($_REQUEST['number']) ? $_REQUEST['number'] : 1;
    $user_id = $_GLOBAL_USER['user_id'];
 
    // 如果购物车中存在不同模块商品，则先清空购物车
    if ($dou->value_exist('order_cart', 'user_id', $user_id, "module != '$module'"))
        $dou_order->clear_cart();
 
    // 判断是否已经存在购物车中
    $cart_row = $dou->get_row('order_cart', 'id, item_number', "user_id = '$user_id' AND module = '$module' AND item_id = '$item_id'");
    if ($cart_row) {
        // 购物车信息 更新
        $item_number = $cart_row['item_number'] + $item_number;
        $dou->query("UPDATE " . $dou->table('order_cart') . " SET item_number = '$item_number' WHERE id = '$cart_row[id]'");
    } else {
        // 购物车信息 插入
        $dou->query("INSERT INTO " . $dou->table('order_cart') . " (id, user_id, module, item_id, item_number)" . " VALUES (NULL, '$user_id', '$module', '$item_id', '$item_number')");
    }

    $dou->dou_header($_URL['cart']);
}

/**
 * +----------------------------------------------------------
 * 更新购物车商品数量
 * +----------------------------------------------------------
 */
elseif ($rec == 'update') {
    $item_id = $check->is_number($_REQUEST['item_id']) ? $_REQUEST['item_id'] : '';
    $item_number = $check->is_number($_POST['number']) ? $_POST['number'] : 1;
    $user_id = $_GLOBAL_USER['user_id'];
 
    // 更新商品数量
    $dou->query("UPDATE " . $dou->table('order_cart') . " SET item_number = '$item_number' WHERE item_id = '$item_id' AND user_id = '$user_id'");

    // 获取购物车信息
    $cart = $dou_order->get_cart();
 
    // 格式化数据
    $item_price = $dou->get_one("SELECT price FROM " . $GLOBALS['dou']->table($cart['module']) . " WHERE id = '$item_id'");
    $subtotal = $item_price > 0 ? $dou->price_format($item_price * $_POST['number']) : $_LANG['price_discuss'];
    
    $order = array (
            "subtotal" => $subtotal,
            "total" => $cart['total'],
            "item_amount" => $dou->price_format($cart['item_amount'])
    );
    
    echo json_encode($order);
}

/**
 * +----------------------------------------------------------
 * 删除商品
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    $item_id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $user_id = $_GLOBAL_USER['user_id'];
    
    // 删除对应商品
    $GLOBALS['dou']->query("DELETE FROM " . $GLOBALS['dou']->table('order_cart') . " WHERE item_id = '$item_id' AND user_id = '$user_id'");

    $dou->dou_header($_URL['cart']);
}

/**
 * +----------------------------------------------------------
 * 结算页面
 * +----------------------------------------------------------
 */
elseif ($rec == 'checkout') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->set_token('order_checkout'));
    
    // 获取默认配送方式信息
    $shipping = $dou->get_one("SELECT config FROM " . $GLOBALS['dou']->table('plugin') . " WHERE plugin_group = 'shipping'");
    $shipping = unserialize($shipping);
    
    // 获取购物车信息
    $cart = $dou_order->get_cart();
    
    // 免费额度
    if ($shipping['free'] && $cart['item_amount'] >= $shipping['free']) $shipping['fee'] = 0;
    
    // 获取订单信息
	   $order = $dou->get_row('user', 'contact, address, telphone, postcode', "user_id = '" . $_GLOBAL_USER['user_id'] . "'");
    $order['shipping_fee_format'] = $dou->price_format($shipping['fee']);
    $order['order_amount_format'] = $dou->price_format($cart['item_amount'] + $shipping['fee']);

    // 赋值给模板-数据
    $smarty->assign('page_title', $dou->page_title('order_checkout'));
    $smarty->assign('head', $_LANG['order_checkout']);
    $smarty->assign('cart', $cart);
    $smarty->assign('shipping_list', $dou_order->get_shipping_list());
    $smarty->assign('order', $order);
    $smarty->display('order.dwt');
}

/**
 * +----------------------------------------------------------
 * 更改运费和订单总额
 * +----------------------------------------------------------
 */
elseif ($rec == 'change_shipping') {
    $unique_id = preg_match("/^[A-Za-z0-9_-]+$/", $_REQUEST['unique_id']) ? $_REQUEST['unique_id'] : '';
    $shipping = $dou->get_one("SELECT config FROM " . $GLOBALS['dou']->table('plugin') . " WHERE unique_id = '$unique_id'");
    $shipping = unserialize($shipping);
    
    // 获取购物车信息
    $cart = $dou_order->get_cart();
    
    // 免费额度
    if ($shipping['free'] && $cart['item_amount'] >= $shipping['free']) $shipping['fee'] = 0;

    $order = array (
            "shipping_fee" => $dou->price_format($shipping['fee']),
            "order_amount" => $dou->price_format($cart['item_amount'] + $shipping['fee'])
    );
    
    echo json_encode($order);
}

/**
 * +----------------------------------------------------------
 * 完成订单操作，提交到数据库
 * +----------------------------------------------------------
 */
elseif ($rec == 'success') {
    // 判断是否为空
    $wrong = $check->fn_empty('user', 'contact, telphone, address');
 
    // 判断是否含有非法字符
    $wrong = $check->fn_illegal_char('user', 'contact, telphone, address, postcode');
 
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

    // 验证是否登录
    if (!is_array($_GLOBAL_USER)) {
        $dou->dou_header($_URL['login']);
    }

    // CSRF防御令牌验证
    $firewall->check_token($_POST['token'], 'order_checkout');
    
    // 获取购物车信息
    $cart = $dou_order->get_cart();
 
    // 检查购物车是否有商品
    if (!is_array($cart)) {
        $dou->dou_msg($_LANG['order_cart_empty'], HOME_URL);
    }

    // 获取和格式化数据
    $order_sn = $dou_order->create_order_sn();
    $module = $cart['module'];
    $add_time = time();
	   $shipping_id = preg_match("/^[A-Za-z0-9_-]+$/", $_REQUEST['shipping_id']) ? $_REQUEST['shipping_id'] : 0;
    
    // 配送方式信息
    $shipping = $dou->get_plugin($shipping_id);
    $shipping_fee = $shipping['config']['fee'];

    // 免费额度
    if ($shipping['config']['free'] && $cart['item_amount'] >= $shipping['config']['free']) $shipping_fee = 0;

    // 计算运费和订单总额
    $order_amount = $cart['item_amount'] + $shipping_fee;
    
    // 安全处理用户输入信息
    $_POST = $firewall->dou_foreground($_POST);

    // 订单信息插入
    $dou->query("INSERT INTO " . $dou->table('order') . " (order_id, order_sn, user_id, module, telphone, contact, address, postcode, shipping_id, item_amount, shipping_fee, order_amount, add_time)" . " VALUES (NULL, '$order_sn', '$_GLOBAL_USER[user_id]', '$module', '$_POST[telphone]', '$_POST[contact]', '$_POST[address]', '$_POST[postcode]', '$shipping_id', '$cart[item_amount]', '$shipping_fee', '$order_amount', '$add_time')");

    // 订单商品插入
    $order_id = $dou->insert_id();
    foreach ($cart['list'] as $item) {
        $dou->query("INSERT INTO " . $dou->table('order_item') . " (id, order_id, module, item_id, name, price, item_number, defined)" . " VALUES (NULL, '$order_id', '$module', '$item[id]', '$item[name]', '$item[price_normal]', '$item[number]', '$item[defined]')");
    }

    if ($_POST['update_user_information']) {
        $dou->query("UPDATE " . $dou->table('user') . " SET telphone = '$_POST[telphone]', contact = '$_POST[contact]', address = '$_POST[address]', postcode = '$_POST[postcode]' WHERE user_id = '$_GLOBAL_USER[user_id]'");
    }
    
    // 显示订单信息
    $order['order_sn'] = $order_sn;
    $order['order_amount'] = $order_amount;
    $order['order_amount_format'] = $dou->price_format($order_amount);

    // 订单完成，清空购物车
    $dou_order->clear_cart();
	
    // 如果设置了支付方式，则跳转到收银台
    if ($GLOBALS['dou']->value_exist('plugin', 'plugin_group', 'payment')) {
					   $cashier_url = $dou->param($_URL['cashier'] . '&order_sn=' . $order['order_sn']);
        $dou->dou_header($cashier_url);
    } else { // 如果没有支付方式就直接将订单状态标记为已完成
					   $dou->query("UPDATE " . $dou->table('order') . " SET status = '1' WHERE order_sn = '$order[order_sn]'");
				}

    $smarty->assign('page_title', $dou->page_title('order_success'));
    $smarty->assign('order', $order);
    
    $smarty->display('order.dwt');
}

/**
 * +----------------------------------------------------------
 * 收银台，必须要设置了支付方式才会跳转到该页面
 * +----------------------------------------------------------
 */
elseif ($rec == 'cashier') {
    // 验证是否登录
    if (!is_array($_GLOBAL_USER))
        $dou->dou_header($_URL['login']);

	   // 获取订单信息
    $order_sn = $check->is_number($_REQUEST['order_sn']) ? $_REQUEST['order_sn'] : '';
    $order = $dou->get_row('order', '*', "order_sn = '$order_sn' AND status = '0' AND user_id = '$_GLOBAL_USER[user_id]'");
    if (!$order) {
					   $dou->dou_header($_URL['user']);
				} else {
					   $order['pay_url'] = $dou->param($_URL['pay'] . '&order_sn=' . $order['order_sn']);
        $order['order_amount_format'] = $dou->price_format($order['order_amount']);
				}
	
	   // 赋值给模板-数据
    $smarty->assign('page_title', $dou->page_title('order_cashier'));
    $smarty->assign('head', $_LANG['order_cashier']);
    $smarty->assign('order', $order);
    $smarty->assign('payment_list', $dou_order->get_payment_list());
    
    $smarty->display('order.dwt');
}

/**
 * +----------------------------------------------------------
 * 收银台 支付
 * +----------------------------------------------------------
 */
elseif ($rec == 'pay') {
    // 验证是否登录
    if (!is_array($_GLOBAL_USER))
        $dou->dou_header($_URL['login']);

	   // 获取订单信息
    $order_sn = $check->is_number($_REQUEST['order_sn']) ? $_REQUEST['order_sn'] : '';
    $order = $dou->get_row('order', '*', "order_sn = '$order_sn' AND status = '0' AND user_id = '$_GLOBAL_USER[user_id]'");
    if (!$order) {
					   $dou->dou_header($_URL['user']);
				} else {
        $order['order_amount_format'] = $dou->price_format($order['order_amount']);
					   $order['cashier_url'] = $dou->param($_URL['cashier'] . '&order_sn=' . $order['order_sn']);
				}
	   
    // 获取和格式化数据
	   $pay_id = preg_match("/^[a-z_-]+$/", $_REQUEST['pay_id']) ? $_REQUEST['pay_id'] : 0;
	   if (!$_GET['pay_id']) {
					   $build_url = $dou->param($_URL['pay'] . '&order_sn=' . $order['order_sn'] . '&pay_id=' . $_POST['pay_id']);
					   $dou->dou_header($build_url);
				}
	
    // 生成支付操作
	   $pay_name = $dou->get_one("SELECT name FROM " . $dou->table('plugin') . " WHERE unique_id = '$pay_id'");
    if ($pay_name) {
        include_once (ROOT_PATH . 'include/plugin/' . $pay_id . '/work.plugin.php');
        $plugin = new Plugin($order['order_sn'], $order['order_amount']);
        
        // 生成支付按钮
        $smarty->assign('payment', $plugin->work());
    } else {
					   $dou->dou_header($order['cashier_url']);
				}
	
	   // 赋值给模板-数据
    $smarty->assign('page_title', $dou->page_title('page', '', $pay_name));
    $smarty->assign('head', $pay_name);
    $smarty->assign('order', $order);
    
    $smarty->display('order.dwt');
}

?>