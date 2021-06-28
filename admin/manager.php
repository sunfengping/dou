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

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

$smarty->assign('rec', $rec);

/**
 * +----------------------------------------------------------
 * 管理员列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->assign('ur_here', $_LANG['manager']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['manager_add'],
        'href' => 'manager.php?rec=add'
    ));
    $type = isset($_REQUEST['type']) ? trim($_REQUEST['type']) : '';
    $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : '';
    $user_name = isset($_REQUEST['user_name']) ? trim($_REQUEST['user_name']) : '';
    $truename = isset($_REQUEST['truename']) ? trim($_REQUEST['truename']) : '';
    $mobile = isset($_REQUEST['mobile']) ? trim($_REQUEST['mobile']) : '';
    $stage = isset($_REQUEST['stage']) ? intval($_REQUEST['stage']) : '';


    $where=' where 1=1 ';
    if ($type!='') {
        $where = $where . " AND type = ".intval($type);
        $get .= '&type=' . $type;
        $smarty->assign('type', $type);
    }

    if ($stage!='') {

        if($stage==1)//未认证(线下签约的不认证)
        {
            $where = $where . " AND verify_status = 0 And fadadacontract_status<2";

        }
        else if($stage==2)//已认证未签约
        {
            $where = $where . " AND verify_status = 2 And fadadacontract_status<2  ";
         }
        else if($stage==3)//已签约
        {
            $where = $where . " AND  fadadacontract_status=2  ";
        }
        $get .= '&stage=' . $stage;
        $smarty->assign('stage', $stage);
    }

    if ($user_name!='') {
        $where = $where . " AND user_name like '%".$user_name."%' ";
        $get .= '&user_name=' . $user_name;
    }

    if ($truename!='') {
        $where = $where . " AND truename like '%".$truename."%' ";
        $get .= '&truename=' . $truename;
    }

    if ($truename!='') {
        $where = $where . " AND truename like '%".$truename."%' ";
        $get .= '&truename=' . $truename;
    }

    if ($mobile!='') {
        $where = $where . " AND mobile like '%".$mobile."%' ";
        $get .= '&mobile=' . $mobile;
    }


    if ($status!='') {
        $where = $where . " AND status = ".intval($status);
        $get .= '&status=' . $status;
        $smarty->assign('status', $status);
    }

    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('admin') . $where." ORDER BY user_id ASC";

    // 分页
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $page_url = 'manager.php';
    $limit = $dou->pager($sql, 15, $page, $page_url, $get);
    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $add_time = date("Y-m-d", $row['add_time']);
        $last_login = date("Y-m-d H:i:s", $row['last_login']);

        $row['stage']='';
        if($row['fadadacontract_status']==2)
        {
            $row['stage']='已签约';
        }
        if($row['fadadacontract_status']!=2&&$row['verify_status']==0)
        {
            $row['stage']='未实名认证';
        }
        if($row['fadadacontract_status']!=2&&$row['verify_status']==2)
        {
            $row['stage']='已实名认证';
        }


        $manager_list[] = array (
            "user_id" => $row['user_id'],
            "user_name" => $row['user_name'],
            "email" => $row['email'],
            "action_list" => $row['action_list'],
            "add_time" => $add_time,
            "type" =>$row['type'],
            "stage" =>$row['stage'],
            "mobile" =>$row['mobile'],
            "truename" =>$row['truename'],
            "card_id" =>$row['card_id'],
            "status" =>$row['status'],
            "amount" =>$row['amount'],
            "last_login" => $last_login
        );
    }
    // 赋值给模板
    $smarty->assign('cur', 'manager');
    $smarty->assign('manager_list', $manager_list);


    $smarty->assign('user_name', $user_name);

    $smarty->display('manager.htm');
}

/**
 * +----------------------------------------------------------
 * 管理员添加处理
 * +----------------------------------------------------------
 */
elseif ($rec == 'add') {
    if ($_USER['action_list'] != 'ALL') {
        $dou->dou_msg($_LANG['without'], 'manager.php');
    }
    $type = isset($_REQUEST['type']) ? intval($_REQUEST['type']) : 0;
    $smarty->assign('type',$type);
    $smarty->assign('ur_here', $_LANG['manager']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['manager_list'],
        'href' => 'manager.php'
    ));

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());

    $sql ="SELECT *   FROM " . $dou->table('company') . " WHERE 1=1"; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $company_list[] = array (
            "company" => $row['company']
        );
    }

    $sql = "SELECT * FROM " . $dou->table('product_category') . " WHERE parent_id = 0"; // 第一层
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $category_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $smarty->assign('category_list',$category_list);
    $smarty->assign('company_list', $company_list);

    $smarty->display('manager.htm');
}

elseif ($rec == 'insert') {
    if ($_USER['action_list'] != 'ALL') {
        $dou->dou_msg($_LANG['without'], 'manager.php');
    }

    // 验证用户名
//    if (!$check->is_username($_POST['user_name'])) {
//        $dou->dou_msg($_LANG['manager_username_cue']);
//    } else
    if ($dou->value_exist('admin', 'user_name', $_POST['user_name'])) {
        $dou->dou_msg($_LANG['manager_username_existed']);
    }

//    // 验证Email
//    if (!empty($_POST["email"]) && !$check->is_email($_POST['email'])) {
//        $dou->dou_msg($_LANG['manager_email_cue']);
//    } elseif ($dou->value_exist('admin', 'email', $_POST['email'])) {
//        $dou->dou_msg($_LANG['manager_email_existed']);
//    }

    // 验证手机号
//    if (empty($_POST["mobile"]) || !$check->is_telphone($_POST['mobile'])) {
//        $dou->dou_msg("手机号格式不正确");
//    }else
    if (!empty($_POST["mobile"])&&$dou->value_exist('admin', 'mobile', $_POST['mobile'])) {
        $dou->dou_msg("该手机号已存在");
    }

    // 验证身份证
//    if (empty($_POST["card_id"]) || !$check->is_cardId($_POST['card_id'])) {
//        $dou->dou_msg("身份证格式不正确");
//    }elseif ($dou->value_exist('admin', 'card_id', $_POST['card_id'])) {
//        $dou->dou_msg("该身份证已被注册");
//    }

    // 验证密码
    if (!$check->is_password($_POST['password']))
        $dou->dou_msg($_LANG['manager_password_cue']);

    // 验证确认密码
    if ($_POST['password_confirm'] !== $_POST['password'])
        $dou->dou_msg($_LANG['manager_password_confirm_cue']);

    $password = md5($_POST['password']);
    $add_time = time();

    $amount = floatval($_POST['amount']);

    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);
    $truename=$_POST['truename'];
    $jc=$_POST['jc'];
    $taxrat=floatval($_POST['taxrat']);
    $sql = "INSERT INTO " . $dou->table('admin') . " (user_id,amount,type,status,createpro, mobile,card_id,user_name, email, password, action_list, add_time,company,truename,fadadacontract_status,taxrat,jc,cat_ids)" . " VALUES (NULL, ".$amount.",".intval($_POST['type']).",".intval($_POST['status']).",".intval($_POST['createpro']).",'$_POST[mobile]','$_POST[card_id]','$_POST[user_name]', '$_POST[email]', '$password', 'ADMIN', '$add_time', '$_POST[company]','$truename',2,$taxrat,'$jc', '$_POST[cat_ids]')";
    $dou->query($sql);
    $id = $dou->insert_id();
    if($id)
    {
        $enterprise_name=$_POST['enterprise_name'];
        $credit_code=$_POST['credit_code'];
        $term_validity=$_POST['term_validity'];
        $enterprise_addr=$_POST['enterprise_addr'];
        $industry_type=$_POST['industry_type'];
        $scope_business=$_POST['scope_business'];
        $legal_person=$_POST['legal_person'];
        $card_type=$_POST['card_type'];
        $card_no=$_POST['card_no'];
        $card_time=$_POST['card_time'];
        $contacts_name=$_POST['contacts_name'];
        $contacts_email=$_POST['contacts_email'];
        $contacts_tel=$_POST['contacts_tel'];
        $open_bank=$_POST['open_bank'];
        $open_bank_city=$_POST['open_bank_city'];
        $branch_bank=$_POST['branch_bank'];
        $open_company=$_POST['open_company'];
        $bank_no=$_POST['bank_no'];




        $sql = "INSERT INTO " . $dou->table('enterprise') . " (id,user_id,enterprise_name,credit_code,term_validity,enterprise_addr,industry_type,scope_business,legal_person,card_type,card_no,card_time,contacts_name,contacts_email,contacts_tel,open_bank,open_bank_city,branch_bank,open_company,bank_no)" . " VALUES (NULL,$id, '$enterprise_name','$credit_code','$term_validity','$enterprise_addr','$industry_type','$scope_business','$legal_person','$card_type','$card_no','$card_time','$contacts_name','$contacts_email','$contacts_tel','$open_bank','$open_bank_city','$branch_bank','$open_company','$bank_no')";
        $dou->query($sql);
    }
    $dou->create_admin_log($_LANG['manager_add'] . ': ' . $_POST['user_name']);
    $dou->dou_msg($_LANG['manager_add_succes'], 'manager.php');
}

/**
 * +----------------------------------------------------------
 * 管理员编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    $smarty->assign('ur_here', $_LANG['manager']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['manager_list'],
        'href' => 'manager.php'
    ));

    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';

    $manager_info = $dou->get_row('admin', '*', "user_id = '$id'");

    $card_pic = $manager_info['card_pic'];
    $card_pic_file_info = $dou->get_row('file', '*', "number = '$card_pic'");
    $manager_info['card_pics']='';
    if(!empty($card_pic_file_info))
    {
        $manager_info['card_pics'] ='http://'.$_SERVER['SERVER_NAME'].'/'.$card_pic_file_info['file'];
    }

    $card_pic_back = $manager_info['card_pic_back'];
    $card_pic_back_file_info = $dou->get_row('file', '*', "number = '$card_pic_back'");
    $manager_info['card_pic_backs']='';
    if(!empty($card_pic_back_file_info))
    {
        $manager_info['card_pic_backs'] ='http://'.$_SERVER['SERVER_NAME'].'/'.$card_pic_back_file_info['file'];
    }

    if($manager_info['fadadacontract_status']==2)
    {
        $manager_info['stage']='已签约';
    }
    if($manager_info['fadadacontract_status']!=2&&$manager_info['verify_status']==0)
    {
        $manager_info['stage']='未实名认证';
    }
    if($manager_info['fadadacontract_status']!=2&&$manager_info['verify_status']==2)
    {
        $manager_info['stage']='已实名认证';
    }


    $enterprise_info = $dou->get_row('enterprise', '*', "user_id = '$id'");



    if ($_USER['action_list'] != 'ALL' && $manager_info['user_name'] != $_USER['user_name']) {
        $dou->dou_msg($_LANG['without'], 'manager.php');
    }

    // 超级管理员修改普通管理员信息无需旧密码
    if ($_USER['action_list'] == 'ALL' && $manager_info['user_name'] != $_USER['user_name']) {
        $if_check = false;
    } else {
        $if_check = true;
    }
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());

    $cat_ids = $manager_info["cat_ids"];
    $cat_ids_arr=explode(',',$cat_ids);
    $select_cat=array();
    foreach ($cat_ids_arr as $k=>$v)
    {
         if(!empty($v))
         {
             $cat_info = $dou->get_row('product_category', '*', "cat_id = '$v'");
             $item=array('id'=>$v,'name'=>$cat_info['cat_name']);
             array_push($select_cat,$item);
         }
    }


    $sql ="SELECT *   FROM " . $dou->table('company') . " WHERE 1=1"; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $company_list[] = array(
            "company" => $row['company']
        );
    }
    $smarty->assign('company_list', $company_list);

    $sql = "SELECT * FROM " . $dou->table('product_category') . " WHERE parent_id = 0"; // 第一层
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $category_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $smarty->assign('category_list',$category_list);
    $smarty->assign('select_cat',$select_cat);

    $smarty->assign('enterprise_info', $enterprise_info);
    $smarty->assign('if_check', $if_check);
    $smarty->assign('type', $manager_info['type']);
    $smarty->assign('manager_info', $manager_info);

    $smarty->display('manager.htm');
}

elseif ($rec == 'update') {
    // 验证并获取合法的ID
    $id = $check->is_number($_POST['id']) ? $_POST['id'] : '';

    $manager_info = $dou->get_row('admin', '*', "user_id = '$id'");

    // 验证用户名
//    if (!$check->is_username($_POST['user_name'])) {
//        $dou->dou_msg($_LANG['manager_username_cue']);
//    } elseif ($_POST['user_name'] != $manager_info['user_name'] && $dou->value_exist('admin', 'user_name', $_POST['user_name'])) {
//        $dou->dou_msg($_LANG['manager_username_existed']);
//    }

    if ($_POST['user_name'] != $manager_info['user_name'] && $dou->value_exist('admin', 'user_name', $_POST['user_name'])) {
        $dou->dou_msg($_LANG['manager_username_existed']);
    }

//    // 验证Email
//    if (!empty($_POST["email"]) && !$check->is_email($_POST['email'])) {
//        $dou->dou_msg($_LANG['manager_email_cue']);
//    } elseif ($_POST['email'] != $manager_info['email'] && $dou->value_exist('admin', 'email', $_POST['email'])) {
//        $dou->dou_msg($_LANG['manager_email_existed']);
//    }


    // 验证手机号
    if (!empty($_POST["mobile"]) && !$check->is_telphone($_POST['mobile'])) {
        $dou->dou_msg("手机号格式不正确");
    }elseif ($_POST['mobile'] != $manager_info['mobile'] &&$dou->value_exist('admin', 'mobile', $_POST['mobile'])) {
        $dou->dou_msg("该手机号已存在");
    }

    // 验证身份证
    if (!empty($_POST["card_id"]) && !$check->is_cardId($_POST['card_id'])) {
        $dou->dou_msg("身份证格式不正确");
    }elseif ($_POST['card_id'] != $manager_info['card_id'] &&$dou->value_exist('admin', 'card_id', $_POST['card_id'])) {
        $dou->dou_msg("该身份证已被注册");
    }

    // 超级管理员修改普通管理员信息无需旧密码
    if (!($_USER['action_list'] == 'ALL' && $manager_info['user_name'] != $_USER['user_name'])) {
        if (!$_POST['old_password']) {
            $dou->dou_msg($_LANG['manager_old_password_cue']);
        } elseif (md5($_POST['old_password']) != $manager_info['password']) {
            $dou->create_admin_log($_LANG['manager_edit'] . ': ' . $_POST['user_name'] . " ( " . $_LANG['manager_old_password_cue'] . " )");
            $dou->dou_msg($_LANG['manager_old_password_cue']);
        }
    }

    // 如果有输入新密码，则验证新密码
    if ($_POST['password']) {
        if (!$check->is_password($_POST['password'])) {
            $dou->dou_msg($_LANG['manager_password_cue']);
        } elseif ($_POST['password_confirm'] != $_POST['password']) {
            $dou->dou_msg($_LANG['manager_password_confirm_cue']);
        }

        $update_password = ", password = '" . md5($_POST['password']) . "'";
    }
    $amount = floatval($_POST['amount']);
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);
    $taxrat=floatval($_POST['taxrat']);
    $jc=$_POST['jc'];

    $amount_org = $dou->get_one("SELECT amount FROM " . $dou->table('admin') . "WHERE user_id = '$id'");

    $sql = "UPDATE " . $dou->table('admin') . " SET amount=".$amount.", user_name = '$_POST[user_name]',cat_ids = '$_POST[cat_ids]',truename = '$_POST[truename]',company = '$_POST[company]',type=".intval($_POST['type']).",status=".intval($_POST['status']).",createpro=".intval($_POST['createpro']).", mobile = '$_POST[mobile]',card_id = '$_POST[card_id]',  email = '$_POST[email]'" . $update_password . " , taxrat = ".$taxrat.",  jc = '$jc' WHERE user_id = '$id'";
    $dou->query($sql);

    if($amount_org!=$amount)
    {
        $create_time = time();
        $ip = $this->get_ip();
        $action = "用户管理：修改金额 由".$amount_org."改为".$amount;
        $sql = "INSERT INTO " . $dou->table('admin_log') . " (id, create_time, user_id, action ,ip)" . " VALUES (NULL, '$create_time', " . $_SESSION[DOU_ID]['user_id'] . ", '$action', '$ip')";
        $dou->query($sql);
    }




    $count = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('enterprise') . " WHERE user_id = '$id'");


    if($count==0)
    {
        $enterprise_name=$_POST['enterprise_name'];
        $credit_code=$_POST['credit_code'];
        $term_validity=$_POST['term_validity'];
        $enterprise_addr=$_POST['enterprise_addr'];
        $industry_type=$_POST['industry_type'];
        $scope_business=$_POST['scope_business'];
        $legal_person=$_POST['legal_person'];
        $card_type=$_POST['card_type'];
        $card_no=$_POST['card_no'];
        $card_time=$_POST['card_time'];
        $contacts_name=$_POST['contacts_name'];
        $contacts_email=$_POST['contacts_email'];
        $contacts_tel=$_POST['contacts_tel'];
        $open_bank=$_POST['open_bank'];
        $open_bank_city=$_POST['open_bank_city'];
        $branch_bank=$_POST['branch_bank'];
        $open_company=$_POST['open_company'];
        $bank_no=$_POST['bank_no'];

        $sql = "INSERT INTO " . $dou->table('enterprise') . " (id,user_id,enterprise_name,credit_code,term_validity,enterprise_addr,industry_type,scope_business,legal_person,card_type,card_no,card_time,contacts_name,contacts_email,contacts_tel,open_bank,open_bank_city,branch_bank,open_company,bank_no)" . " VALUES (NULL,$id, '$enterprise_name','$credit_code','$term_validity','$enterprise_addr','$industry_type','$scope_business','$legal_person','$card_type','$card_no','$card_time','$contacts_name','$contacts_email','$contacts_tel','$open_bank','$open_bank_city','$branch_bank','$open_company','$bank_no')";
        $dou->query($sql);
    }
    else
    {
        $sql = "UPDATE " . $dou->table('enterprise') . " SET enterprise_name = '$_POST[enterprise_name]', credit_code = '$_POST[credit_code]', term_validity = '$_POST[term_validity]', enterprise_addr = '$_POST[enterprise_addr]', industry_type = '$_POST[industry_type]', scope_business = '$_POST[scope_business]', legal_person = '$_POST[legal_person]', card_type = '$_POST[card_type]', card_no = '$_POST[card_no]', card_time = '$_POST[card_time]', contacts_name = '$_POST[contacts_name]', contacts_email = '$_POST[contacts_email]', contacts_tel = '$_POST[contacts_tel]', open_bank = '$_POST[open_bank]', open_bank_city = '$_POST[open_bank_city]', branch_bank = '$_POST[branch_bank]', open_company = '$_POST[open_company]', bank_no = '$_POST[bank_no]'   WHERE user_id = '$id'";
        $dou->query($sql);
    }

    $dou->create_admin_log($_LANG['manager_edit'] . ': ' . $_POST['user_name']);

    $dou->dou_msg($_LANG['manager_edit_succes'], 'manager.php');
}

/**
 * +----------------------------------------------------------
 * 管理员删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    if ($_USER['action_list'] != 'ALL') {
        $dou->dou_msg($_LANG['without'], 'manager.php');
    }

    // 验证并获取合法的ID
    $user_id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'manager.php');

    $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = '$user_id'");

    if ($user_name == $_USER['user_name'] || ($_USER['action_list'] != 'ALL' && $manager_info['user_name'] != $_USER['user_name'])) {
        $dou->dou_msg($_LANG['manager_del_wrong'], 'manager.php', '', '3');
    } else {
        if (isset($_POST['confirm'])) {
            $dou->create_admin_log($_LANG['manager_del'] . ': ' . $user_name);
            $dou->delete('admin', "user_id = $user_id", 'manager.php');
            $dou->delete('enterprise', "user_id = $user_id", 'manager.php');
        } else {
            $_LANG['del_check'] = preg_replace('/d%/Ums', $user_name, $_LANG['del_check']);
            $dou->dou_msg($_LANG['del_check'], 'manager.php', '', '30', "manager.php?rec=del&id=$user_id");
        }
    }
}
/**
 * +----------------------------------------------------------
 * 批量操作选择
 * +----------------------------------------------------------
 */
elseif ($rec == 'action') {
    if (is_array($_POST['checkbox'])) {
        if ($_POST['action'] == 'del_all') {
             // 批量商品删除
            $dou->del_all('admin', $_POST['checkbox'], 'user_id', '', true);
        }
        else {
            $dou->dou_msg($_LANG['select_empty']);
        }
    } else {
        $dou->dou_msg("未选择要操作的项");
    }
}

/**
 * +----------------------------------------------------------
 * 操作记录
 * +----------------------------------------------------------
 */
elseif ($rec == 'manager_log') {
    $smarty->assign('ur_here', $_LANG['manager_log']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['manager_list'],
        'href' => 'manager.php'
    ));
    $smarty->assign('cur', 'manager_log');

    // 筛选条件
    if ($_USER['action_list'] != 'ALL')
        $where = " WHERE user_id = '" . $_USER['user_id'] . "'";

    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('admin_log') . $where . " ORDER BY id DESC" . $limit;

    // 验证并获取合法的分页ID
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $limit = $dou->pager($sql, 15, $page, 'manager.php?rec=manager_log');

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $create_time = date("Y-m-d H:i:s", $row['create_time']);
        $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = " . $row['user_id']);

        $log_list[] = array (
            "id" => $row['id'],
            "create_time" => $create_time,
            "user_name" => $user_name,
            "action" => $row['action'],
            "ip" => $row['ip']
        );
    }

    // 赋值给模板
    $smarty->assign('log_list', $log_list);

    $smarty->display('manager.htm');
}


/**
 * +----------------------------------------------------------
 * 批量添加线下签约的用户
 * +----------------------------------------------------------
 */
elseif ($rec == 'uploadworker') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $smarty->assign('id', $id);
    $smarty->display('manager.htm');
}
elseif ($rec == 'uploadworker_post') {
    // 图片上传
    include_once (ROOT_PATH . 'include/file.class.php');
    $file = new File('images/manager/'); // 实例化类文件(文件上传路径，结尾加斜杠)
    // 文件上传盒子
    $image = $file->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);

    //生成成暗线表
    $file= $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$image'");
    $result = createUserForm($file,$id,$image);

    if($result==0)
    {

        ob_start();
        $filename='../'.$file;
        $date=date("Ymd-H:i:m");
        $size=readfile($filename);
        header( "Content-type:  application/octet-stream ");
        header( "Accept-Ranges:  bytes ");
        header( "Content-Disposition:  attachment;  filename=".$filename);
        header( "Accept-Length: " .$size);
    }
    else
    {
        $sql="";
        foreach($result as $k=>$v)
        {
            $password = md5('123456');
            $time = time();
            $sql.="insert into " . $dou->table('admin') . "  (user_id,user_name,password,add_time,type,card_id,mobile,truename,fadadacontract_status,status,jc,company) values(NULL,'$v[user_name]','$password','$time',2,'$v[card_id]','$v[mobile]','$v[truename]',2,1,'$v[jc]','$v[company]');";
        }
       // echo $sql;exit;
        $dou->query_mutiple_update($sql);
        $dou->dou_msg('操作成功', '/admin/manager.php');
    }


}



function createUserForm($file,$pid,$file_attache)
{
    $excel_file = ROOT_PATH.ADMIN_PATH.'/include/PHPExcel5/PHPExcel.php';
    include_once($excel_file);

    $file = '../'.$file;
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);


    if($type=='xlsx'){
        $type=   'Excel2007';
    }elseif($type=='csv'){
        $type='csv';
    }else{
        $type='Excel5';
    }

    $fail=0;
    $list=array();
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
     foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {     //遍历工作表
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'F1', '用户名');
        ob_end_clean();//清除缓存区，解决乱码问题
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($file);

        foreach ($worksheet->getRowIterator() as $key=>$row) {       //遍历行
            // echo $row->getRowIndex()."<br/>";
            $list_item=array();

            if($row->getRowIndex()>=2) {
                $cellIterator = $row->getCellIterator();   //得到所有列
                $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                foreach ($cellIterator as $cellkey => $cell) {  //遍历列
                    if (!is_null($cell)) {  //如果列不给空就得到它的坐标和计算的值
                        $rows[$key][]=   $cell->getCalculatedValue();

                    }
                    $val = $cell->getCalculatedValue();
                    $val=str_replace(" ",'',$val);

                    if (!is_null($cell)&&$cellkey=='D'&&!empty($val)) {
                        $count=$GLOBALS['dou']->get_one("SELECT count(*) FROM " .  $GLOBALS['dou']->table('admin') . " WHERE card_id ='$val'");
                        if($count>0)
                        {
                            $fail=1;
                            $val=$val."-身份证已存在";
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'D'.$row->getRowIndex(), $val);
                            ob_end_clean();//清除缓存区，解决乱码问题
                            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                            $objWriter->save($file);
                        }

                    }
                    if (!is_null($cell)&&$cellkey=='E'&&!empty($val)) {

                        $count=$GLOBALS['dou']->get_one("SELECT count(*) FROM " .  $GLOBALS['dou']->table('admin') . " WHERE mobile ='$val'");
                        if($count>0)
                        {
                            $fail=1;
                            $val=$val."-手机号已存在";
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue( 'E'.$row->getRowIndex(), $val);
                            ob_end_clean();//清除缓存区，解决乱码问题
                            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                            $objWriter->save($file);
                        }


                    }

                }
            }

        }
    }


    if($fail==1)
    {
        return 0;
    }
    else
    {

        $result_arr=array();
        foreach($rows as $k=>$v)
        {
            if($v[1]!='')
            {
                $item = array(
                    'jc'=>$v[1],
                    'user_name'=>($v[1].$v[4]),
                    'truename'=>$v[2],
                    'card_id'=>$v[3],
                    'mobile'=>$v[4],
                    'company'=>$v[5]

                );
                array_push($result_arr,$item);
            }
        }
      return $result_arr;
    }




}





?>