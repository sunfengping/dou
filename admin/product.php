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

// 图片上传
include_once (ROOT_PATH . 'include/file.class.php');
$file = new File('images/product/'); // 实例化类文件(文件上传路径，结尾加斜杠)
// 赋值给模板
$smarty->assign('rec', $rec);
$smarty->assign('cur', 'product');

/**
 * +----------------------------------------------------------
 * 产品列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->assign('ur_here', $_LANG['product']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['product_add'],
        'href' => 'product.php?rec=add'
    ));

    // 获取参数
    $cat_id = $check->is_number($_REQUEST['cat_id']) ? $_REQUEST['cat_id'] : 0;
    $user_id = $check->is_number($_REQUEST['user_id']) ? $_REQUEST['user_id'] : 0;
    $keyword = isset($_REQUEST['keyword']) ? trim($_REQUEST['keyword']) : '';
    $enterprise_name = isset($_REQUEST['enterprise_name']) ? trim($_REQUEST['enterprise_name']) : '';
    $type = isset($_REQUEST['type']) ? trim($_REQUEST['type']) : '';
    $upload_status = isset($_REQUEST['upload_status']) ? trim($_REQUEST['upload_status']) : '';
    $pid = isset($_REQUEST['pid']) ? intval($_REQUEST['pid']) : '';
    $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : '';








    // 筛选条件
    $where = ' WHERE cat_id IN (' . $cat_id . $dou->dou_child_id('product_category', $cat_id) . ')';
    if ($keyword) {
        $where = $where . " AND name LIKE '%$keyword%'";
        $get = '&keyword=' . $keyword;
    }

    if ($type!='') {
        $where = $where . " AND type = ".intval($type);
        $get = '&type=' . $type;
        $smarty->assign('cur', 'product'.$type);
    }

    if ($user_id !=0) {
        $where = $where . " AND user_id  = ".intval($user_id );
        $get = '&user_id =' . $user_id ;
        $smarty->assign('cur', 'product'.$user_id );
    }


    if ($enterprise_name !='') {
        $sql = "SELECT * FROM " . $dou->table('enterprise') . " where  enterprise_name like '%".$enterprise_name."%' ORDER BY user_id DESC";
        $query = $dou->query($sql);
        $sql_insert = "";
        $name='';

        if($query->num_rows>0)
        {
            $sql_insert .= " AND user_id in ( ";
             while ($row = $dou->fetch_array($query)) {
                 $sql_insert.=$row['user_id'].',';
            }
            $sql_insert = substr($sql_insert,0,strlen($sql_insert)-1);
            $sql_insert.=" )  ";
        }
        $where = $where . $sql_insert;
        $get = '&enterprise=' . $enterprise;
     }

    if ($upload_status!='') {
        $where = $where . " AND upload_status = ".intval($upload_status);
        $get = '&upload_status=' . $upload_status;
        $smarty->assign('cur', 'product'.$upload_status);
    }
    if ($id!='') {
        $where = $where . " AND id = ".intval($id);
        $get = '&id=' . $id;
    }
    if(intval($type)==0)
    {
        if(intval($pid)!=0)
        {
            $where = $where . " AND pid = ".intval($pid);
            $get = '&pid=' . $pid;
        }

    }

    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('product') . $where . " ORDER BY id DESC";

    // 分页
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $page_url = 'product.php' . ($cat_id ? '?cat_id=' . $cat_id : '');
    $limit = $dou->pager($sql, 15, $page, $page_url, $get);

    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
      while ($row = $dou->fetch_array($query)) {
        $cat_name = $dou->get_one("SELECT cat_name FROM " . $dou->table('product_category') . " WHERE cat_id = '$row[cat_id]'");
        $add_time = date("Y-m-d", $row['add_time']);

        $file_path="";
        if( $row['upload_status']>0)
        {
            $file_path = $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[list_file]'");
        }
        $user_name="";
        if( $row['user_id']>0)
        {
            $user_name = $dou->get_one("SELECT user_name FROM " . $dou->table('admin') . " WHERE user_id = '$row[user_id]'");
            $enterprise_name = $dou->get_one("SELECT enterprise_name FROM " . $dou->table('enterprise') . " WHERE user_id = '$row[user_id]'");
        }
          $count = $dou->get_one("SELECT count(*) FROM " . $dou->table('amount_record') . " WHERE pid = '$row[id]'");


        $product_list[] = array (
            "id" => $row['id'],
            "user_id" => $row['user_id'],
            "user_name" => $user_name,
            "cat_id" => $row['cat_id'],
            "cat_name" => $cat_name,
            "enterprise_name" => $enterprise_name,
            "name" => $row['name'],
            "max" => $row['max'],
            "price" => $row['price'],
            "status" => $row['status'],
            "pay_status" => $row['pay_status'],
            "upload_status" => $row['upload_status'],
            "upload_fail_reason" => $row['upload_fail_reason'],
            "list_file" => $row['list_file'],
            "is_read" => $row['is_read'],
            "file1" => $row['file1']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file1]'"),
            "file2" => $row['file2']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file2]'"),
            "file3" =>$row['file3']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file3]'"),
            "file4" => $row['file4']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file4]'"),
            "file5" => $row['file5']==''?'':$dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$row[file5]'"),
            "file_path" => $file_path,
            "add_time" => $add_time,
            "count" => intval($count)
        );
    }

     // 首页显示商品数量限制框
    for($i = 1; $i <= $_CFG['home_display_product']; $i++) {
        $sort_bg .= "<li><em></em></li>";
    }

    //var_dump($product_list);exit;

    // 赋值给模板
    $smarty->assign('sort', $dou->get_sort('product', 'name'));
    $smarty->assign('cat_id', $cat_id);
    $smarty->assign('keyword', $keyword);
    $smarty->assign('type', $type);
    $smarty->assign('upload_status', $upload_status);
    $smarty->assign('pid', $pid);
    $smarty->assign('user_id', $user_id==0?'':$user_id);
    $smarty->assign('enterprise', $enterprise);
    $smarty->assign('product_category', $dou->get_category_nolevel('product_category'));
    $smarty->assign('product_list', $product_list);

    $smarty->display('product.htm');
}

/**
 * +----------------------------------------------------------
 * 产品添加
 * +----------------------------------------------------------
 */
elseif ($rec == 'add') {
    $smarty->assign('ur_here', $_LANG['product_add']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['product'],
        'href' => 'product.php'
    ));

    // 格式化自定义参数，并存到数组$product，商品编辑页面中调用商品详情也是用数组$product，
    if ($_DEFINED['product']) {
        $defined = explode(',', $_DEFINED['product']);
        foreach ($defined as $row) {
            $defined_product .= $row . "：\n";
        }
        $product['defined'] = trim($defined_product);
        $product['defined_count'] = count(explode("\n", $product['defined'])) * 2;
    }

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());

    $sql = "SELECT * FROM " . $dou->table('product_category') . " WHERE parent_id = 0"; // 第一层
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $category_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $smarty->assign('category_list',$category_list);

    // 赋值给模板
    $smarty->assign('form_action', 'insert');
    $smarty->assign('product_category', $dou->get_category_nolevel('product_category'));
    $smarty->assign('item_id', $dou->auto_id('product'));
    $smarty->assign('product', $product);
    $smarty->display('product.htm');
}
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
elseif ($rec == 'insert') {
    // 数据验证
    if (empty($_POST['name'])) $dou->dou_msg($_LANG['name'] . $_LANG['is_empty']);
    if (!$check->is_price($_POST['price'] = trim($_POST['price']))) $dou->dou_msg($_LANG['price_wrong']);
    if (!$check->is_price($_POST['price_to'] = trim($_POST['price_to']))) $_POST['price_to']=0;

    // 文件上传盒子
    $image = $file->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);

    if (empty($_POST['max'])) $_POST['max']=0;
    if (empty($_POST['status'])) $_POST['status']=0;
    if (empty($_POST['type'])) $_POST['type']=1;
    if (empty($_POST['pid'])) $_POST['pid']=0;
    if (empty($_POST['jisuandw'])) $_POST['jisuandw']='';
    if (empty($_POST['city'])) $_POST['city']='';
    if (empty($_POST['tax_type'])) $_POST['tax_type']='';
    if (empty($_POST['price_type'])) $_POST['price_type']=0;
    if (empty($_POST['user_id'])) $_POST['user_id']=0;
    if (empty($_POST['company'])) $_POST['company']='';
    $stop_time=empty($_POST['stop_time'])?'':$_POST['stop_time'].' 23:59:59';
    $start_time=empty($_POST['start_time'])?'':$_POST['start_time'].' 00:00:00';
    $end_time=empty($_POST['end_time'])?'':$_POST['end_time'].' 23:59:59';
    if(intval( $_POST['type'])==0)
    {
        $_POST['bind_mobile'] = trim($_POST['bind_mobile']);
        $_POST['pid']=intval($_POST['pid']);
        if($_POST['pid']==0)
        {
            $dou->dou_msg("请给该分包任务绑定商户任务id");
        }
//        $pro_info = $dou->get_row('product', '*', "id = '". $_POST['pid']."'");
//        $stop_time=$pro_info['stop_time'];
//        $start_time=$pro_info['start_time'];
//        $end_time=$pro_info['end_time'];
    }
    else
    {
        $_POST['bind_mobile'] ='';
        $_POST['pid']=0;
    }



    // 数据格式化
    $add_time = time();
    $_POST['defined'] = str_replace("\r\n", ',', $_POST['defined']);

    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);

    $sql = "INSERT INTO " . $dou->table('product') . " (id,pid,max,status,type,bind_mobile, cat_id, name, price, defined, content, image ,keywords, description, add_time,stop_time,start_time,end_time,jisuandw,city,tax_type,price_type,price_to,company,user_id)" . " VALUES (NULL,".intval($_POST[pid]).", ".intval($_POST[max]).",".intval($_POST[status]).", ".intval($_POST[type]).",'$_POST[bind_mobile]','$_POST[cat_id]', '$_POST[name]', '$_POST[price]', '$_POST[defined]', '$_POST[content]', '$image', '$_POST[keywords]', '$_POST[description]', '$add_time','$stop_time','$start_time','$end_time','$_POST[jisuandw]','$_POST[city]','$_POST[tax_type]', ".intval($_POST[price_type]).",'$_POST[price_to]','$_POST[company]','$_POST[user_id]')";
    $dou->query($sql);

    $dou->create_admin_log($_LANG['product_add'] . ': ' . $_POST['name']);
    $dou->dou_msg($_LANG['product_add_succes'], 'product.php');
}
/**
 * +----------------------------------------------------------
 * 上传总包模板
 * +----------------------------------------------------------
 */
elseif ($rec == 'upload') {

    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $smarty->assign('id', $id);
    $smarty->display('product.htm');
}
elseif ($rec == 'upload_post') {
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $pro_info = $dou->get_row('product', '*', "id = '".$id."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误', '/admin/product.php?type=1');
        exit;
    }

    // 文件上传盒子
    $image = $file->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);

    $sql = "update " . $dou->table('product') . " SET dic_form = '$image' WHERE id = '$id'";
    $dou->query($sql);
    //生成成暗线表
    $file= $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$image'");
    $sql = createDicForm($file,$id,$image);
    $dou->query_mutiple_update($sql);
    $dou->dou_msg('操作成功', '/admin/product.php?rec=showdicform&id='.$id);
}


/**
 * +----------------------------------------------------------
 * 添加商户线下打款记录
 * +----------------------------------------------------------
 */
elseif ($rec == 'addamount') {

    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';

    $count = $dou->get_one("SELECT count(*) FROM " . $dou->table('amount_record') . " WHERE pid = '$id'");
    if($count>0)
    {
        $rc_info =$pro_info = $dou->get_row('amount_record', '*', "pid = '".$id."'");
    }

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());
    $smarty->assign('id', $id);
    $smarty->assign('rc_info', $rc_info);
    $smarty->assign('count', $count);
    $smarty->display('product.htm');
}

elseif ($rec == 'addamount_post') {
    $id = $check->is_number($_REQUEST['pid']) ? $_REQUEST['pid'] : '';
    $amount = floatval($_REQUEST['amount']);
    $desc = $_REQUEST['desc'] ? $_REQUEST['desc'] : '';
    $pro_info = $dou->get_row('product', '*', "id = '".$id."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误', '/admin/product.php?type=1');
        exit;
    }

    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);

    $count =  $dou->get_one("SELECT count(*) FROM " . $dou->table('amount_record') . " WHERE pid = '$id'");

    if($count>0)
    {
        $sql = "update " . $dou->table('amount_record') . " SET amount = ".$amount." WHERE pid = '$id'";
        $dou->query($sql);
    }
    else
    {
        $sql = "INSERT INTO " . $dou->table('amount_record') . " (id,user_id,pid,amount ,add_time,add_user_id,des)" . " VALUES (NULL,".$pro_info['user_id'].", ".intval($id).",".$amount.", '".date('Y-m-d H:i:s',time())."',".$_SESSION[DOU_ID]['user_id'].",'$desc')";
        $dou->query($sql);
    }


    $sql = "update " . $dou->table('product') . " SET pay_status = 1,status=1,pay_time='".date('Y-m-d H:i:s',time())."' WHERE id = '$id'";
    $dou->query($sql);


    $sql = "update " . $dou->table('admin') . " SET amount = amount+".$amount." WHERE user_id = '$pro_info[user_id]'";
    $dou->query($sql);


    $dou->dou_msg('操作成功', '/admin/product.php?type=1');
}



/**
 * +----------------------------------------------------------
 * 上传总包模板
 * +----------------------------------------------------------
 */
elseif ($rec == 'uploadnew') {

    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $smarty->assign('id', $id);
    $smarty->display('product.htm');
}
elseif ($rec == 'uploadnew_post') {
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $pro_info = $dou->get_row('product', '*', "id = '".$id."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误', '/admin/product.php?type=1');
        exit;
    }

    // 文件上传盒子
    $image = $file->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);

    $sql = "update " . $dou->table('product') . " SET dic_form = '$image' WHERE id = '$id'";
    $dou->query($sql);

    $product_info= $dou->get_row('product', '*', "id = '$id'");

    //生成成暗线表
    $file= $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$image'");
    $datas = createDicFormNew($file,$id,$image);

    $sql = "SELECT name FROM " . $dou->table('bank') .  " where 1=1 ";
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $bank_list[] = $row['name'];

    }

    //根据身份证判断是否签约过，签约了则自动生成已完成的任务，该处注意时间
    //未签约则生成未签约任务，给用户发短信，小程序签约后将任务修改为有效任务并完成
    $sms_mobiles ="";
    $sql="";
    $wrong_bank="";
    foreach($datas as $k=>$v)
    {

        if(!in_array(trim($v['bankinfo']),$bank_list))
        {
            $wrong_bank.=$v['bankinfo'].",";
            continue;
        }
        $start_time=strtotime($product_info['start_time']);//报名开始时间
        $stop_time=strtotime($product_info['stop_time']);//报名截止时间
        $end_time = strtotime($product_info['end_time']);//任务截止时间

        $bankinfo=$v['bankinfo'];
        $bankcode = $dou->get_one("SELECT code FROM " . $dou->table('bank') . " WHERE name = '".trim($bankinfo)."'");

        if(!$bankcode)
        {
            $bankcode="";
        }
        //添加任务时间要在报名开始时间和报名截止时间之内
        $add_time_int = mt_rand($start_time,$stop_time);
        $add_time=date('Y-m-d H:i:s',$add_time_int);//报名时间

        //任务完成时间在报名时间和任务截止时间之间
        $finish_time = date('Y-m-d H:i:s', mt_rand($add_time_int,$end_time));

        //支付时间在完成时间和任务截止时间之间
        $pay_time =  date('Y-m-d H:i:s', mt_rand(strtotime($finish_time),$end_time));

        $admin_info = $dou->get_row('admin', '*', "card_id ='$v[card_id]' and  fadadacontract_status=2");
        if(count($admin_info)==0)
        {
            $status=-1;
            $sms_mobiles.=$v['mobile'].",";
            $sql.="INSERT INTO 58_list (id, add_time,status,pay_money,finish_time,card_id,ppid,bankno,truename,p_userid,p_name,bankinfo,mobile,bankcode,pay_time)"  . " VALUES (NULL,'$add_time',$status, ".floatval($v['pay_money']).",'$finish_time','$v[card_id]',".intval($v['ppid']).",'$v[bankno]','$v[truename]',".intval($product_info['user_id']).",'$product_info[name]','$v[bankinfo]','$v[mobile]','$bankcode','$pay_time');";
        }
        else
        {
            $status=1;
            $sql.="INSERT INTO 58_list (id, username,user_id, add_time,status,pay_money,finish_time,card_id,ppid,bankno,truename,p_userid,p_name,bankinfo,mobile,bankcode,pay_time)" . " VALUES (NULL, '$admin_info[user_name]',".intval($admin_info[user_id]).",'$add_time',$status, ".floatval($v['pay_money']).",'$finish_time','$v[card_id]',".intval($v['ppid']).",'$v[bankno]','$v[truename]',".intval($product_info['user_id']).",'$product_info[name]','$v[bankinfo]','$v[mobile]','$bankcode','$pay_time');";
        }

    }
    if($wrong_bank!="")
    {
        $dou->dou_msg('开户银行名称有误:'.$wrong_bank, '/admin/list.php?ppid='.$id,60);
    }
    else
    {
        $dou->query_mutiple_update($sql);
    }


    include_once (ROOT_PATH . 'include/sms.class.php');
    $sms = new Sms();
    $content="提醒您：您有一份新的任务需要承接，请尽快登陆小程序处理。承接位置：共包极丁小程序→消息→合同签署。";
    $sms_mobiles = substr($sms_mobiles,0,strlen($sms_mobiles)-1);
    $result =  $sms->sendNormal($sms_mobiles,$content);
    $dou->dou_msg('操作成功', '/admin/list.php?ppid='.$id);
}
/**
 * +----------------------------------------------------------
 * 显示总包生成任务列表
 * +----------------------------------------------------------
 */
elseif ($rec == 'showdicform') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $sql = "SELECT * FROM " . $dou->table('dif_form') . " where  pid=".$id." and status=0 ORDER BY id DESC";
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $product_list[] = array (
            "id" => $row['id'],
            "cat_name" =>  $row['cat_name'],
            "price" => $row['price'],
            "mobile" => $row['mobile'],
            "count" => $row['count']
        );
    }
    $smarty->assign('product_list', $product_list);
    $smarty->assign('id',  $id);
    $smarty->display('product.htm');
}
/**
 * +----------------------------------------------------------
 * 根据总包生成任务列表批量生成分任务
 * +----------------------------------------------------------
 */

elseif ($rec == 'createpro') {
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $pro_info = $dou->get_row('product', '*', "id = '".$id."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误', '/admin/product.php?rec=showdicform&id='.$id);
        exit;
    }
    $pro_dic_names=array('市场推广','信息咨询','技术支持服务');

    $product_info =  $dou->get_row('product', '*', "id = '$id'");
    $sql = "SELECT * FROM " . $dou->table('dif_form') . " where  pid=".$id." and status=0 ORDER BY id DESC";
    $query = $dou->query($sql);
    $sql_insert = "";
    $name='';
    $in_sql = "where id in ( ";
    while ($row = $dou->fetch_array($query)) {

        $rndKey = array_rand($pro_dic_names);
        $name = $pro_dic_names[$rndKey];
        $cat_id =  $dou->get_one("SELECT cat_id FROM " . $dou->table('product_category') . " WHERE cat_name = '$row[cat_name]'");

        if(!$cat_id)
        {
            $sql_inserts.="INSERT INTO " . $dou->table('product_category') . " (cat_id, cat_name)" . " VALUES (NULL, '$row[cat_name]');";
            $dou->query($sql_inserts);
            $cat_id =  $dou->get_one("SELECT cat_id FROM " . $dou->table('product_category') . " WHERE cat_name = '$row[cat_name]'");
        }
        $sql_insert .= "INSERT INTO " . $dou->table('product') . " (id,pid,max,bind_mobile, cat_id, name, price,  keywords,   add_time,stop_time,start_time,end_time)" . " VALUES (NULL,".intval($id).", ".intval($row[count]).", '$row[mobile]','$cat_id', '$name', ".floatval($row['price']).",  '$product_info[keywords]',   '$product_info[add_time]','$product_info[stop_time]','$product_info[start_time]','$product_info[end_time]');";
        $in_sql.=$row['id'].',';
    }
    $in_sql = substr($in_sql,0,strlen($in_sql)-1);
    $in_sql.=" ); ";

    if($sql_insert!='')
    {
        $sql_insert.="update ".$dou->table('dif_form') . " set status=1 ".$in_sql;
    }
    // echo $sql_insert;exit;
    $dou->query_mutiple_update($sql_insert);
    $dou->dou_msg($_LANG['product_add_succes'], 'product.php?rec=showdicform&id='.$id);
}

/**
 * +----------------------------------------------------------
 * 产品编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    $smarty->assign('ur_here', $_LANG['product_edit']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['product'],
        'href' => 'product.php'
    ));

    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';

    $product = $dou->get_row('product', '*', "id = '$id'");

    // 格式化数据
    $product['image'] = $dou->dou_file($product['image']);

    // 格式化自定义参数
    if ($_DEFINED['product'] || $product['defined']) {
        $defined = explode(',', $_DEFINED['product']);
        foreach ($defined as $row) {
            $defined_product .= $row . "：\n";
        }
        // 如果商品中已经写入自定义参数则调用已有的
        $product['defined'] = $product['defined'] ? str_replace(",", "\n", $product['defined']) : trim($defined_product);
        $product['defined_count'] = count(explode("\n", $product['defined'])) * 2;
    }

    $product['start_time']=date('Y-m-d',strtotime($product['start_time']));
    $product['stop_time']=date('Y-m-d',strtotime($product['stop_time']));
    $product['end_time']=date('Y-m-d',strtotime($product['end_time']));

    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());

    $sql = "SELECT * FROM " . $dou->table('product_category') . " WHERE parent_id = 0"; // 第一层
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $category_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $smarty->assign('category_list',$category_list);

    $parent_cat_info = $dou->get_row('product_category', '*', "cat_id = '$product[cat_id]'");


    $sql = "SELECT * FROM " . $dou->table('product_category') . " WHERE parent_id = ".$parent_cat_info['parent_id']; // 第一层
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {

        $child_category_list[] = array (
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $smarty->assign('child_category_list',$child_category_list);


    // 赋值给模板
    $smarty->assign('form_action', 'update');
    $smarty->assign('parent_cat_info', $parent_cat_info);
    $smarty->assign('product_category', $dou->get_category_nolevel('product_category'));
    $smarty->assign('item_id', $id);
    $smarty->assign('product', $product);

    $smarty->display('product.htm');
}

elseif ($rec == 'update') {
    // 验证并获取合法的ID
    $id = $check->is_number($_POST['id']) ? $_POST['id'] : '';

    // 数据验证
    if (empty($_POST['name'])) $dou->dou_msg($_LANG['name'] . $_LANG['is_empty']);
    if (!$check->is_price($_POST['price'] = trim($_POST['price']))) $dou->dou_msg($_LANG['price_wrong']);
    if (!$check->is_price($_POST['price_to'] = trim($_POST['price_to']))) $_POST['price_to']=0;
    if (empty($_POST['max'])) $_POST['max']=0;
    if (empty($_POST['status'])) $_POST['status']=0;
    if (empty($_POST['pay_status'])) $_POST['pay_status']=0;
    if (empty($_POST['type'])) $_POST['type']=0;
    if (empty($_POST['pid'])) $_POST['pid']=0;
    if (empty($_POST['jisuandw'])) $_POST['jisuandw']='';
    if (empty($_POST['city'])) $_POST['city']='';
    if (empty($_POST['tax_type'])) $_POST['tax_type']='';
    if (empty($_POST['price_type'])) $_POST['price_type']=0;
    if (empty($_POST['company'])) $_POST['company']='';
    if (empty($_POST['user_id'])) $_POST['user_id']=0;
    $stop_time=empty($_POST['stop_time'])?'':$_POST['stop_time'].' 23:59:59';
    $start_time=empty($_POST['start_time'])?'':$_POST['start_time'].' 00:00:00';
    $end_time=empty($_POST['end_time'])?'':$_POST['end_time'].' 23:59:59';
    if(intval( $_POST['type'])==0)
    {
        $_POST['bind_mobile'] = trim($_POST['bind_mobile']);
        $_POST['pid']=intval($_POST['pid']);
        if($_POST['pid']==0)
        {
            $dou->dou_msg("请给该分包任务绑定商户任务id");
        }
    }
    else
    {
        $_POST['bind_mobile'] ='';
        $_POST['pid']=0;
    }

    // 文件上传盒子
    $image = $file->box('product', $id, 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);
    $image = $image ? ", image = '" . $image . "'" : '';

    // 格式化自定义参数
    $_POST['defined'] = str_replace("\r\n", ',', $_POST['defined']);

    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);

    $sql = "update " . $dou->table('product') . " SET stop_time='$stop_time',start_time='$start_time',end_time='$end_time', max=".intval($_POST['max']).",price_type=".intval($_POST['price_type']).",pid=".intval($_POST['pid']).",pay_status=".intval($_POST['pay_status']).",status=".intval($_POST['status']).",bind_mobile = '$_POST[bind_mobile]',company = '$_POST[company]', cat_id = '$_POST[cat_id]',type=".intval($_POST['type']).", name = '$_POST[name]', price = '$_POST[price]',  price_to = '$_POST[price_to]',defined = '$_POST[defined]' ,content = '$_POST[content]'" . $image . ", keywords = '$_POST[keywords]', description = '$_POST[description]', jisuandw = '$_POST[jisuandw]',city = '$_POST[city]',tax_type = '$_POST[tax_type]',user_id='$_POST[user_id]' WHERE id = '$id'";
    $dou->query($sql);

    $dou->create_admin_log($_LANG['product_edit'] . ': ' . $_POST['name']);
    $dou->dou_msg($_LANG['product_edit_succes'], 'product.php');
}

/**
 * +----------------------------------------------------------
 * 重新生成产品图片
 * +----------------------------------------------------------
 */
elseif ($rec == 'thumb') {
    $smarty->assign('ur_here', $_LANG['product_thumb']);
    $smarty->assign('action_link', array (
        'text' => $_LANG['product'],
        'href' => 'product.php'
    ));

    $sql = "SELECT file FROM " . $dou->table('file') . " WHERE module = 'product' AND thumb_size > 0 ORDER BY id ASC";
    $count = $dou->num_rows($query = $dou->query($sql));
    $mask['count'] = preg_replace('/d%/Ums', $count, $_LANG['product_thumb_count']);
    $mask_tag = '<i></i>';
    $mask['confirm'] = isset($_POST['confirm']) ? $_POST['confirm'] : '';

    for($i = 1; $i <= $count; $i++)
        $mask['bg'] .= $mask_tag;

    $smarty->assign('mask', $mask);
    $smarty->display('product.htm');

    if (isset($_POST['confirm'])) {
        echo ' ';
        while ($row = $dou->fetch_array($query)) {
            $file->thumb(basename($row['file']), $_CFG['thumb_width'], $_CFG['thumb_height']);
            echo "<script type=\"text/javascript\">mask('" . $mask_tag . "');</script>";
            flush();
            ob_flush();
        }
        echo "<script type=\"text/javascript\">success();</script>\n</body>\n</html>";
    }
}

/**
 * +----------------------------------------------------------
 * 产品删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'product.php');

    $name = $dou->get_one("SELECT name FROM " . $dou->table('product') . " WHERE id = '$id'");

    if (isset($_POST['confirm'])) {
        // 删除相应图片
        $image = $dou->get_one("SELECT image FROM " . $dou->table('product') . " WHERE id = '$id'");
        $dou->del_file($image);

        $dou->create_admin_log($_LANG['product_del'] . ': ' . $name);
        $dou->delete('product', "id = '$id'", 'product.php');
    } else {
        $_LANG['del_check'] = preg_replace('/d%/Ums', $name, $_LANG['del_check']);
        $dou->dou_msg($_LANG['del_check'], 'product.php', '', '30', "product.php?rec=del&id=$id");
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
            $dou->del_all('product', $_POST['checkbox'], 'id', 'image', true);
        } elseif ($_POST['action'] == 'category_move') {
            // 批量移动分类
            $dou->category_move('product', $_POST['checkbox'], $_POST['new_cat_id']);
        } else {
            $dou->dou_msg($_LANG['select_empty']);
        }
    } else {
        $dou->dou_msg($_LANG['product_select_empty']);
    }
}

/**
 * +----------------------------------------------------------
 * 首页商品筛选
 * +----------------------------------------------------------
 */
elseif ($rec == 'sort') {
    // act操作项的初始化
    $act = $check->is_rec($_REQUEST['act']) ? $_REQUEST['act'] : '';

    $dou->sort_box('product', $act, $id);
    $dou->dou_header($_SERVER['HTTP_REFERER']); // 跳转到上一页面
}


/**
 * +----------------------------------------------------------
 * 查看上传的xls文件
 * +----------------------------------------------------------
 */
elseif ($rec == 'showxlsdetails') {
    // 赋值给模板
    // 验证并获取合法的ID

    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $product = $dou->get_row('product', '*', "id = '$id'");
    if(empty($product))
    {
        $dou->dou_msg('参数有误');
        exit;
    }
    $sql = "UPDATE " . $dou->table('product') . " SET  is_read=2  WHERE id = $id";
    $dou->query($sql);

    $file = $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$product[list_file]'");
    $smarty->assign('file', $file);
    $smarty->display('product.htm');
}


/**
 * +----------------------------------------------------------
 * 商户上传的xls通过审核
 * +----------------------------------------------------------
 */
elseif ($rec == 'xlspass') {
    // 赋值给模板
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $product_info=$product = $dou->get_row('product', '*', "id = '$id'");
    if(empty($product))
    {
        $dou->dou_msg('参数有误');
        exit;
    }

    //读取表格，将表格内容自动生成暗线
    $file = $dou->get_one("SELECT file FROM " . $dou->table('file') . " WHERE number = '$product[list_file]'");

     $datas = createDicFormNew2($file,$id,$image);



    $sql = "SELECT name FROM " . $dou->table('bank') .  " where 1=1 ";
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $bank_list[] = $row['name'];

    }

    //根据身份证判断是否签约过，签约了则自动生成已完成的任务，该处注意时间
    //未签约则生成未签约任务，给用户发短信，小程序签约后将任务修改为有效任务并完成
    $sms_mobiles ="";
    $sql="";
    $wrong_bank="";
    foreach($datas as $k=>$v)
    {

        if(!in_array(trim($v['bankinfo']),$bank_list))
        {
            $wrong_bank.=$v['bankinfo'].",";
            continue;
        }
        $start_time=strtotime($product_info['start_time']);//报名开始时间
        $stop_time=strtotime($product_info['stop_time']);//报名截止时间
        $end_time = strtotime($product_info['end_time']);//任务截止时间

        $bankinfo=$v['bankinfo'];
        $bankcode = $dou->get_one("SELECT code FROM " . $dou->table('bank') . " WHERE name = '".trim($bankinfo)."'");

        if(!$bankcode)
        {
            $bankcode="";
        }
        //添加任务时间要在报名开始时间和报名截止时间之内
        $add_time_int = mt_rand($start_time,$stop_time);
        $add_time=date('Y-m-d H:i:s',$add_time_int);//报名时间

        //任务完成时间在报名时间和任务截止时间之间
        $finish_time = date('Y-m-d H:i:s', mt_rand($add_time_int,$end_time));

        //支付时间在完成时间和任务截止时间之间
        $pay_time =  date('Y-m-d H:i:s', mt_rand(strtotime($finish_time),$end_time));

        $admin_info = $dou->get_row('admin', '*', "card_id ='$v[card_id]' and  fadadacontract_status=2");
        if(count($admin_info)==0)
        {
            $status=-1;
            $sms_mobiles.=$v['mobile'].",";
            $sql.="INSERT INTO 58_list (id, add_time,status,pay_money,finish_time,card_id,ppid,bankno,truename,p_userid,p_name,bankinfo,mobile,bankcode,pay_time,pay_money_total)"  . " VALUES (NULL,'$add_time',$status, ".floatval($v['pay_money']).",'$finish_time','$v[card_id]',".intval($v['ppid']).",'$v[bankno]','$v[truename]',".intval($product_info['user_id']).",'$product_info[name]','$v[bankinfo]','$v[mobile]','$bankcode','$pay_time', ".floatval($v['pay_money_total']).");";
        }
        else
        {
            $status=1;
            $sql.="INSERT INTO 58_list (id, username,user_id, add_time,status,pay_money,finish_time,card_id,ppid,bankno,truename,p_userid,p_name,bankinfo,mobile,bankcode,pay_time,pay_money_total)" . " VALUES (NULL, '$admin_info[user_name]',".intval($admin_info[user_id]).",'$add_time',$status, ".floatval($v['pay_money']).",'$finish_time','$v[card_id]',".intval($v['ppid']).",'$v[bankno]','$v[truename]',".intval($product_info['user_id']).",'$product_info[name]','$v[bankinfo]','$v[mobile]','$bankcode','$pay_time', ".floatval($v['pay_money_total']).");";
        }

    }
    if($wrong_bank!="")
    {
        $dou->dou_msg('开户银行名称有误:'.$wrong_bank, '/admin/list.php?ppid='.$id,60);
    }
    else
    {
        $sql_p = "UPDATE " . $dou->table('product') . " SET  upload_status=2  WHERE id = $id";
        $dou->query($sql_p);
        $dou->query_mutiple_update($sql);
    }




    include_once (ROOT_PATH . 'include/sms.class.php');
    $sms = new Sms();
    $content="提醒您：您有一份新的任务需要承接，请尽快登陆小程序处理。承接位置：共包极丁小程序→消息→合同签署。";
    $sms_mobiles = substr($sms_mobiles,0,strlen($sms_mobiles)-1);
    $result =  $sms->sendNormal($sms_mobiles,$content);

    $dou->dou_msg('操作成功');
    exit;
}



/**
 * +----------------------------------------------------------
 * 替换最新的上传xls版本
 * +----------------------------------------------------------
 */
elseif ($rec == 'xlsreplace') {

    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $smarty->assign('id', $id);
    $smarty->display('product.htm');
}
/**
 * +----------------------------------------------------------
 * 替换最新的上传xls版本 替换更新
 * 1、原始的备份
 * 2、现在的更新成最新的
 * +----------------------------------------------------------
 */
elseif ($rec == 'xlsreplace_post') {
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $pro_info = $dou->get_row('product', '*', "id = '".$id."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误', '/admin/product.php?type=1');
        exit;
    }
    $orignal =$pro_info['list_file_copy'].','. $pro_info['list_file'];

    // 文件上传盒子
    $image = $file->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);
    $sql = "update " . $dou->table('product') . " SET list_file = '$image',list_file_copy= '$orignal' WHERE id = '$id'";
    $dou->query($sql);
    $dou->dou_msg('操作成功');
}

/**
 * +----------------------------------------------------------
 * 商户上传的xls审核失败
 * +----------------------------------------------------------
 */
elseif ($rec == 'xlsfail') {
    // 赋值给模板
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $upload_fail_reason = $_REQUEST['upload_fail_reason'] ? $_REQUEST['upload_fail_reason'] : '';
    $product = $dou->get_row('product', '*', "id = '$id'");
    if(empty($product))
    {
        $dou->dou_msg('参数有误');
        exit;
    }
    if($upload_fail_reason=="")
    {
        $dou->dou_msg('请输入失败原因');
        exit;
    }
    $sql = "UPDATE " . $dou->table('product') . " SET  upload_status=-1, upload_fail_reason='$upload_fail_reason' WHERE id = $id";
    $dou->query($sql);
    $dou->dou_msg('操作成功');
    exit;
}



/**
 * +----------------------------------------------------------
 * 上传回单文件等
 * +----------------------------------------------------------
 */
elseif ($rec == 'uploadfile') {

    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $smarty->assign('id', $id);
    $smarty->assign('type', $_REQUEST['type']);
    $smarty->display('product.htm');
}
elseif ($rec == 'uploadfile_post') {
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    $type = $check->is_number($_REQUEST['type']) ? $_REQUEST['type'] : 0;
    $pro_info = $dou->get_row('product', '*', "id = '".$id."'");
    if(empty($pro_info))
    {
        $dou->dou_msg('参数有误1');
        exit;
    }

    if(intval($type)<=0)
    {
        $dou->dou_msg('参数有误2');
        exit;
    }

    $files = new File('images/product_pdf/');
    // 文件上传盒子
    $image = $files->box('product', $dou->auto_id('product'), 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);

    switch ($type) {
        case 1:
            $sql = "update " . $dou->table('product') . " SET file1 = '$image' WHERE id = '$id'";
            $dou->query($sql);
            break;
        case 2:
            $sql = "update " . $dou->table('product') . " SET file2 = '$image' WHERE id = '$id'";
            $dou->query($sql);
            break;
        case 3:
            $sql = "update " . $dou->table('product') . " SET file13 = '$image' WHERE id = '$id'";
            $dou->query($sql);
            break;
        case 4:
            $sql = "update " . $dou->table('product') . " SET file4 = '$image' WHERE id = '$id'";
            $dou->query($sql);
            break;
        case 5:
            $sql = "update " . $dou->table('product') . " SET file5 = '$image' WHERE id = '$id'";
            $dou->query($sql);
            break;
    }
    $dou->dou_msg('操作成功', '/admin/product.php?type=1');
}







function createDicForm($file,$pid,$file_attache)
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
    foreach($save_arr as $key=>$val)
    {
        foreach($val as $k=>$v)
        {
            $sql .= "INSERT INTO 58_dif_form (id, cat_name,price, count,pid,file,mobile)" . " VALUES (NULL, '$v[cat_name]','$v[price]','$v[count]', $pid,'$file_attache','$v[mobile]');";
            // $dou->query($sql);
            array_push($res_arr,$v);
        }
    }
    return $sql;
}

/**
 * 后台管理员提交的表格自动生成暗线list
 * @param $file
 * @param $pid
 * @param $file_attache
 * @return array
 */
function createDicFormNew($file,$pid,$file_attache)
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

    $list=array();
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {     //遍历工作表
        foreach ($worksheet->getRowIterator() as $key=>$row) {       //遍历行
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
    $result_arr=array();
    foreach($rows as $k=>$v)
    {
        if($v[1]!='')
        {
            $item = array(
                'truename'=>$v[1],
                'card_id'=>$v[2],
                'mobile'=>$v[4],
                'bankinfo'=>$v[5],
                'bankno'=>$v[6],
                'pay_money'=>$v[7],
                'ppid'=>$pid,
            );
            array_push($result_arr,$item);
        }
    }
    return $result_arr;

}


/**
 * 商户端提交的表格后台审核通过，进行表格读取，生成list
 * @param $file
 * @param $pid
 * @param $file_attache
 * @return array
 */
function createDicFormNew2($file,$pid,$file_attache)
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

    $list=array();
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
     foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {     //遍历工作表
        foreach ($worksheet->getRowIterator() as $key=>$row) {       //遍历行
            $list_item=array();
            if($row->getRowIndex()>=2)
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
    $result_arr=array();
    foreach($rows as $k=>$v)
    {
        if($v[1]!='')
        {
            $item = array(
                'truename'=>$v[1],
                'card_id'=>trim($v[2]),
                'mobile'=>$v[3],
                'bankinfo'=>$v[12],
                'bankno'=>$v[5],
                'pay_money'=>$v[8],
                'pay_money_total'=>$v[11],
                'ppid'=>$pid,
            );
            array_push($result_arr,$item);
        }
    }
    return $result_arr;

}

?>