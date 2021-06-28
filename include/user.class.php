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

class DouUser {
    /**
     * +----------------------------------------------------------
     * 初始化会员功能全局变量
     * +----------------------------------------------------------
     */
    function global_user_info() {
        // 如果验证码会员已经登录则读取会员信息
        $row = $this->user_check($_SESSION[DOU_ID]['user_id'], $_SESSION[DOU_ID]['shell']);
        if (is_array($row)) {
            $user_name = $row['nickname'] ? $row['nickname'] : $row['email'];
									   $avatar = $row['avatar'] ? $GLOBALS['dou']->dou_file($row['avatar']) : ROOT_URL . 'images/avatar/..empty.png';

            $user = array (
                    'user_id' => $row['user_id'],
                    'user_name' => $user_name,
                    'avatar' => $avatar
            );
        }
        
        return $user;
    }
    
    /**
     * +----------------------------------------------------------
     * 用户权限判断
     * +----------------------------------------------------------
     * $user_id 会员ID
     * $shell 会员信息验证字符串
     * +----------------------------------------------------------
     */
    function user_check($user_id, $shell) {
        if ($row = $this->user_state($user_id, $shell)) {
            $this->user_ontime(10800);
            return $row;
        } else {
            return false;
        }
    }
    
    /**
     * +----------------------------------------------------------
     * 用户状态
     * +----------------------------------------------------------
     * $user_id 会员ID
     * $shell 会员信息验证字符串
     * +----------------------------------------------------------
     */
    function user_state($user_id, $shell) {
        $user = $GLOBALS['dou']->get_row('user', '*', "user_id = '$user_id'");
        
        // 如果$user则开始比对$shell值
        $check_shell = is_array($user) ? $shell == md5($user['email'] . $user['password'] . DOU_SHELL) : FALSE;
        
        // 如果比对$shell吻合，则返回会员信息，否则返回空
        return $check_shell ? $user : false;
    }
    
    /**
     * +----------------------------------------------------------
     * 登录超时默认为24小时(86400秒)
     * +----------------------------------------------------------
     * $timeout 超时时间
     * +----------------------------------------------------------
     */
    function user_ontime($timeout = 86400) {
        $ontime = $_SESSION[DOU_ID]['ontime'];
        $cur_time = time();
        if ($cur_time - $ontime > $timeout) {
            unset($_SESSION[DOU_ID]);
        } else {
            $_SESSION[DOU_ID]['ontime'] = time();
        }
    }

    /**
     * +----------------------------------------------------------
     * 日志更新（以逗号分隔的两条记录）
     * +----------------------------------------------------------
     * $log_old 旧的日志内容
     * $log_new 要插入的日志内容
     * +----------------------------------------------------------
     */
    function log_update($log_old, $log_new) {
        $log_array = explode(',', $log_old);
        $log_old = $log_array[1] ? $log_array[1] : $log_array[0];
        return $log_old . ',' . $log_new;
    }
    
    /**
     * +----------------------------------------------------------
     * 找回密码验证
     * +----------------------------------------------------------
     * $user_id 会员ID
     * $code 密码找回码
     * $timeout 默认为24小时(86400秒)
     * +----------------------------------------------------------
     */
    function check_password_reset($user_id, $code, $timeout = 86400) {
        if ($GLOBALS['dou']->value_exist('admin', 'user_id', $user_id)) {
            $user = $GLOBALS['dou']->get_row('admin', '*', "user_id = '$user_id'");
            
            // 初始化
            $get_code = substr($code , 0 , 16);
            $get_time = substr($code , 16 , 26);
            $code = substr(md5($user['user_name'] . $user['password'] . $get_time . $user['last_login'] . DOU_SHELL) , 0 , 16);
            
            // 验证链接有效性
            if (time() - $get_time < $timeout && $code == $get_code) return true;
        }
    }
 
    /**
     * +----------------------------------------------------------
     * 随机用户编号
     * +----------------------------------------------------------
     */
    function rand_user_sn() {
        $user_sn = $GLOBALS['dou']->create_rand_string('number', 4);
        if ($GLOBALS['dou']->value_exist('user', 'user_sn', $user_sn)) {
            $this->rand_user_sn();
        } else {
            return $user_sn;
        }
    }
 
    /**
     * +----------------------------------------------------------
     * 获取登录插件列表
     * +----------------------------------------------------------
     */
    function connect_plugin_list($user_id = '') {
        $plugin_array = $GLOBALS['dou']->fn_query("SELECT * FROM " . $GLOBALS['dou']->table('plugin') . " WHERE plugin_group = 'connect'");
					
					   foreach($plugin_array as $row) {
									   if ($user_id)
									       $linked = $GLOBALS['dou']->value_exist('user_sns', '`group`', $row['unique_id'], "user_id = '$user_id'");
									
									   $plugin_list[] = array (
                    "unique_id" => $row['unique_id'],
                    "name" => $row['name'],
													       "url" => $GLOBALS['dou']->param($GLOBALS['_URL']['login'] . '?sns=' . $row['unique_id']),
													       "icon" => ROOT_URL . 'include/plugin/' . $row['unique_id'] . '/icon.png',
                    "linked" => $linked ? 1 : 0
            );
								}
					   
					   return $plugin_list;
    }
 
    /**
     * +----------------------------------------------------------
     * 生成头像文件名
     * +----------------------------------------------------------
     */
    function create_avatar_filename() {
        // 随机生成头像文件名
        return $avatar_filename = 'a_' . date('ymdHis') . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
        
        if ($GLOBALS['dou']->value_exist('file', 'file', $avatar_filename)) {
            $this->create_avatar_filename();
        } else {
            return $avatar_filename;
        }
    }
	
	   /**
     * +----------------------------------------------------------
     * 关联会员中心
     * +----------------------------------------------------------
     */
    function link_user_center() {
					   foreach ($GLOBALS['_MODULE']['link_user_center'] as $value) {
												$user_tree[] = array (
																				"module" => $value,
																				"name" => $GLOBALS['_LANG'][$value . '_user_tree'],
																				"url" => $GLOBALS['dou']->rewrite_url($value)
												);
								}
					   $link_user_center['user_tree'] = $user_tree;
					
					   return $link_user_center;
    }
 
    /**
     * +----------------------------------------------------------
     * 根据时间段问好
     * +----------------------------------------------------------
     */
    function welcome() {
        $hour = date("H");
     
        if ($hour < 11) {
            $welcome = $GLOBALS['_LANG']['user_welcom_morning'];
        } elseif($hour < 13) {
            $welcome = $GLOBALS['_LANG']['user_welcom_noon'];
        } elseif($hour < 17) {
            $welcome = $GLOBALS['_LANG']['user_welcom_afternoon'];
        } else {
            $welcome = $GLOBALS['_LANG']['user_welcom_night'];
        }
        
        return $welcome;
    }
}
?>