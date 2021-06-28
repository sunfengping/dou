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
if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}
class Order {
    /**
     * +----------------------------------------------------------
     * 用户权限判断
     * +----------------------------------------------------------
     * $session_cart session储存的商品信息
     * +----------------------------------------------------------
     */
    function get_cart($user_id = '') {
        $user_id = $user_id ? $user_id : $GLOBALS['_GLOBAL_USER']['user_id'];
        
        /* 获取产品列表 */
        $query = $GLOBALS['dou']->query("SELECT * FROM " . $GLOBALS['dou']->table('order_cart') . " WHERE user_id = '$user_id' ORDER BY id DESC");
        while ($row = $GLOBALS['dou']->fetch_array($query)) {
            $item = $GLOBALS['dou']->get_row($row['module'], '*', "id = '$row[item_id]'");
             
            $price = $item['price'] > 0 ? $GLOBALS['dou']->price_format($item['price']) : $GLOBALS['_LANG']['price_discuss'];
            $url = $GLOBALS['dou']->rewrite_url($row['module'], $item['id']);
            $subtotal = $item['price'] > 0 ? $GLOBALS['dou']->price_format($item['price'] * $row['item_number']) : $GLOBALS['_LANG']['price_discuss'];
            
            $cart['list'][] = array (
                    "id" => $item['id'],
                    "name" => $item['name'],
                    "price_normal" => $item['price'],
                    "price" => $price,
                    "url" => $url,
                    "thumb" => $GLOBALS['dou']->dou_file($item['image'], true),
                    "defined" => $item['defined'],
                    "subtotal" => $subtotal,
                    "number" => $row['item_number']
            );
         
            // 所属模块
            $cart['module'] = $row['module'];
         
            // 商品总数量
            $cart['total'] += $row['item_number'];

            // 商品总金额
            $cart['item_amount'] += ($item['price'] * $row['item_number']);
            $cart['item_amount_format'] = $GLOBALS['dou']->price_format($cart['item_amount']);
        }
            
        return $cart;
    }
    
    /**
     * +----------------------------------------------------------
     * 清空会员购物车
     * +----------------------------------------------------------
     */
    function clear_cart($user_id = '') {
        if ($user_id = ($user_id ? $user_id : $GLOBALS['_GLOBAL_USER']['user_id']))
            $GLOBALS['dou']->query("DELETE FROM " . $GLOBALS['dou']->table('order_cart') . " WHERE user_id = '$user_id'");
    }
    
    /**
     * +----------------------------------------------------------
     * 生成唯一的订单编号
     * +----------------------------------------------------------
     */
    function create_order_sn() {
        $user_sn = $GLOBALS['_GLOBAL_USER']['user_sn'];
        
        // 随机生成订单号
        $order_sn = date('ymdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT) . $user_sn;
     
        return $order_sn;
    }

    /**
     * +----------------------------------------------------------
     * 格式化支付和配送方式
     * +----------------------------------------------------------
     */
    function payship_format($data) {
        if ($data) {
            foreach (explode("\r\n", $data) as $value) {
                $arr = explode('/', $value);
                $item['name'] = $arr['0'];
                $item['id'] = $arr['1'];
                $array[] = $item;
            }
        }
        
        return $array;
    }

    /**
     * +----------------------------------------------------------
     * 获取订单商品
     * +----------------------------------------------------------
     * $order_id 订单编号
     * +----------------------------------------------------------
     */
    function get_order_item($order_id) {
        /* 获取产品列表 */
        $query = $GLOBALS['dou']->query("SELECT * FROM " . $GLOBALS['dou']->table('order_item') . " WHERE order_id = '$order_id' ORDER BY id DESC");
    
        while ($row = $GLOBALS['dou']->fetch_array($query)) {
            // 格式化价格
            $price = $GLOBALS['dou']->price_format($row['price']);
            $image = $GLOBALS['dou']->get_one("SELECT image FROM " . $GLOBALS['dou']->table($row['module']) . " WHERE id = '$row[item_id]'");
            $url = $GLOBALS['dou']->rewrite_url($row['module'], $row['item_id']);
            
            $item_list[] = array (
                    "item_id" => $row['item_id'],
                    "name" => $row['name'],
                    "thumb" => $GLOBALS['dou']->dou_file($image, true),
                    "url" => $url,
                    "item_number" => $row['item_number'],
                    "name" => $row['name'],
                    "price" => $price,
                    "defined" => $defined
            );
        }
        
        return $item_list;
    }
    
    /**
     * +----------------------------------------------------------
     * 改变订单状态
     * +----------------------------------------------------------
     * $order_sn 订单编号
     * $status 由数字表示的订单状态
     * +----------------------------------------------------------
     */
    function change_status($order_sn, $status) {
        $GLOBALS['dou']->query("UPDATE " . $GLOBALS['dou']->table('order') . " SET status = '$status' WHERE order_sn = '$order_sn'");
    }
    
    /**
     * +----------------------------------------------------------
     * 支付成功，写入支付信息
     * +----------------------------------------------------------
     * $order_sn 订单编号
     * $pay_id 支付方式别名
     * +----------------------------------------------------------
     */
    function write_pay_id($order_sn, $pay_id) {
        $GLOBALS['dou']->query("UPDATE " . $GLOBALS['dou']->table('order') . " SET pay_id = '$pay_id' WHERE order_sn = '$order_sn'");
    }

    /**
     * +----------------------------------------------------------
     * 发送下单并付款成功通知邮件
     * +----------------------------------------------------------
     * $order_sn 订单编号
     * +----------------------------------------------------------
     */
    function send_order_success_email($order_sn) {
        // 订单成功邮件提醒
					   $order = $GLOBALS['dou']->get_row('order', '*', "order_sn = '$order_sn'");
        $order['add_time'] = date("Y-m-d H:i:s", $order['add_time']);
        
        $title = $GLOBALS['_LANG']['order_success'] . '：' . $order['order_sn'];
        $body  = $GLOBALS['_LANG']['order_add_time'] . '：' . $order['add_time'] . '<br/>';
        $body .= $GLOBALS['_LANG']['order_sn'] . '：' . $order['order_sn'] . '<br/>';
        $body .= $GLOBALS['_LANG']['order_order_amount'] . '：' . $order['order_amount'] . '<br/>';
        $body .= $GLOBALS['_LANG']['order_status'] . '：' . $GLOBALS['_LANG']['order_status_' . $order['status']] . '<br/>';
        $body .= $GLOBALS['_LANG']['order_contact'] . '：' . $order['contact'] . '<br/>';
        $body .= $GLOBALS['_LANG']['order_telphone'] . '：' . $order['telphone'] . '<br/>';
        $body .= $GLOBALS['_LANG']['order_address'] . '：' . $order['address'];
        
        $GLOBALS['dou']->send_mail($GLOBALS['_CFG']['email'], $title, $body);
    }
    
    /**
     * +----------------------------------------------------------
     * 批量取消订单
     * +----------------------------------------------------------
     */
    function cancel_all($checkbox) {
        $sql_in = $GLOBALS['dou']->create_sql_in($_POST['checkbox']);
        
        // 取消所选订单
        $GLOBALS['dou']->query("UPDATE " . $GLOBALS['dou']->table('order') . " SET status = '-1' WHERE order_id " . $sql_in);
        
        $GLOBALS['dou']->create_admin_log($GLOBALS['_LANG']['order_cancel'] . ': ' . strtoupper('order') . ' ' . addslashes($sql_in));
        $GLOBALS['dou']->dou_msg($GLOBALS['_LANG']['order_cancel_success'], 'order.php');
    }
    
    /**
     * +----------------------------------------------------------
     * 获取支付方式列表
     * +----------------------------------------------------------
     */
    function get_payment_list() {
					   if ($GLOBALS['dou']->table_exist('plugin')) {
												/* 获取支付方式列表 */
												$query = $GLOBALS['dou']->query("SELECT * FROM " . $GLOBALS['dou']->table('plugin') . " WHERE plugin_group = 'payment'");

            $i = 0;
												while ($row = $GLOBALS['dou']->fetch_array($query)) {
																$image = ROOT_URL . 'include/plugin/' . $row['unique_id'] . '/icon.gif';
																$payment_list[] = array (
																								"id" => $row['unique_id'],
																								"name" => $row['name'],
																								"image" => $image,
                        "checked" => $i == 0 ? true : false
																);
                $i++;
												}

												return $payment_list;
								}
    }
    
    /**
     * +----------------------------------------------------------
     * 获取配送方式列表
     * +----------------------------------------------------------
     */
    function get_shipping_list() {
					   if ($GLOBALS['dou']->table_exist('plugin')) {
												/* 获取配送方式列表 */
												$query = $GLOBALS['dou']->query("SELECT * FROM " . $GLOBALS['dou']->table('plugin') . " WHERE plugin_group = 'shipping'");

            $i = 0;
												while ($row = $GLOBALS['dou']->fetch_array($query)) {
																$config = unserialize($row['config']);
																$fee_format = $config['fee'] ? $GLOBALS['dou']->price_format($config['fee']) : $GLOBALS['_LANG']['order_shipping_free'];
																$free_format = preg_replace('/d%/Ums', $GLOBALS['dou']->price_format($config['free']), $GLOBALS['_LANG']['order_shipping_free_cue']);
																$shipping_list[] = array (
																								"unique_id" => $row['unique_id'],
																								"name" => $row['name'],
																								"description" => $row['other'],
																								"fee" => $config['fee'],
																								"fee_format" => $fee_format,
																								"free" => $config['free'],
																								"free_format" => $free_format,
                        "checked" => $i == 0 ? true : false
																);
                $i++;
												}

												return $shipping_list;
								}
    }
    

}
?>