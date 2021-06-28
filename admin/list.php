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
$smarty->assign('cur', 'list');

/**
 * +----------------------------------------------------------
 * 领工明细列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->assign('ur_here', $_LANG['product']);
    $smarty->assign('action_link', array (
            'text' =>'添加任务明细',
            'href' => 'list.php?rec=add'
    ));
    
    // 获取参数
    $pid = isset($_REQUEST['pid']) ? trim($_REQUEST['pid']) : '';
    $ppid = isset($_REQUEST['ppid']) ? trim($_REQUEST['ppid']) : '';
    $status = isset($_REQUEST['status']) ? trim($_REQUEST['status']) : -1;
    $uname = isset($_REQUEST['uname']) ? trim($_REQUEST['uname']) : '';
    $truename = isset($_REQUEST['truename']) ? trim($_REQUEST['truename']) : '';
    $card_id = isset($_REQUEST['card_id']) ? trim($_REQUEST['card_id']) : '';
    $enterprise_name = isset($_REQUEST['enterprise_name']) ? trim($_REQUEST['enterprise_name']) : '';

    // 筛选条件
    $where = ' WHERE  is_del=0 ';
    $get="";

    if ($status!=''&&$status!='-1') {
        $where = $where . " AND status = ".intval($status);
        $get .= '&status=' . $status;
    }
    if ($pid!='') {
        $where = $where . " AND pid = ".intval($pid);
        $get .= '&pid=' . $pid;
    }
    if ($ppid!='') {
        $where = $where . " AND ppid = ".intval($ppid);
        $get .= '&ppid=' . $ppid;
    }

    if ($uname!='') {
        $where = $where . " AND username like '%".$uname."%'";
        $get .= '&uname=' . $uname;
    }
    if ($truename!='') {
        $where = $where . " AND truename like '%".$truename."%'";
        $get .= '&truename=' . $truename;
    }
    if ($card_id!='') {
        $where = $where . " AND card_id  like '%".$card_id."%'";
        $get .= '&card_id=' . $card_id;
    }

    if ($enterprise_name !='') {
        $sql = "SELECT * FROM " . $dou->table('enterprise') . " where  enterprise_name like '%".$enterprise_name."%' ORDER BY user_id DESC";
        $query = $dou->query($sql);
        $sql_insert = "";
        $name='';

        if($query->num_rows>0)
        {
            $sql_insert .= " AND p_userid in ( ";
            while ($row = $dou->fetch_array($query)) {
                $sql_insert.=$row['user_id'].',';
            }
            $sql_insert = substr($sql_insert,0,strlen($sql_insert)-1);
            $sql_insert.=" )  ";
        }
        $where = $where . $sql_insert;
        $get .= '&enterprise_name=' . $enterprise_name;
    }

    $total_amount =  $dou->get_one("SELECT sum(pay_money) FROM " . $dou->table('list')  . $where . " ORDER BY id DESC");

    // 未加入分页条件的SQL语句
    $sql = "SELECT * FROM " . $dou->table('list') . $where . " ORDER BY id DESC";


    // 分页
    $page = $check->is_number($_REQUEST['page']) ? $_REQUEST['page'] : 1;
    $page_url = 'list.php';
    $limit = $dou->pager($sql, 30, $page, $page_url, $get);
    
    $sql = $sql . $limit; // 加入分页条件的SQL语句
    $query = $dou->query($sql);
    while ($row = $dou->fetch_array($query)) {
        $pname = $dou->get_one("SELECT name FROM " . $dou->table('product') . " WHERE id = '$row[pid]'");

        $utruename = $dou->get_one("SELECT truename FROM " . $dou->table('admin') . " WHERE user_id = '$row[user_id]'");

        //商户端id

        $pcompany_name = $dou->get_one("SELECT enterprise_name FROM " . $dou->table('enterprise') . " WHERE user_id = '$row[p_userid]'");
       // $add_time = date("Y-m-d", $row['add_time']);

        $lists[] = array (
                "id" => $row['id'],
                "pid" =>$row['ppid'],
                "pname" => $row['p_name'],
                "truename" => $utruename,
                "username" => $row['username'],
                "pay_money" => $row['pay_money'],
                "card_id" => $row['card_id'],
                "pay_time" => $row['pay_time'],
                "remuneration" => $row['remuneration'],
                "status" => $row['status'],
                "add_time" => $row['add_time'],
                "pay_msg" => $row['pay_msg'],
                "pcompany_name" => $pcompany_name,
                "finish_time" => $row['finish_time'],
        );
    }
    
    // 首页显示商品数量限制框
    for($i = 1; $i <= $_CFG['home_display_product']; $i++) {
        $sort_bg .= "<li><em></em></li>";
    }
    //var_dump($status);exit;
    // 赋值给模板
    $smarty->assign('sort', $dou->get_sort('product', 'name'));
    $smarty->assign('total_amount', $total_amount);
    $smarty->assign('pid', $pid);
     $smarty->assign('ppid', $ppid);
     $smarty->assign('status', $status);
     $smarty->assign('uname', $uname);
     $smarty->assign('truename', $truename);
     $smarty->assign('card_id', $card_id);
    $smarty->assign('enterprise_name', $enterprise_name);
    $smarty->assign('product_category', $dou->get_category_nolevel('product_category'));
    $smarty->assign('lists', $lists);
    
    $smarty->display('list.htm');
} 

/**
 * +----------------------------------------------------------
 * 任务添加
 * +----------------------------------------------------------
 */
elseif ($rec == 'add') {
    $smarty->assign('ur_here', '添加任务');
    $smarty->assign('action_link', array (
            'text' => '添加任务',
            'href' => 'list.php'
    ));
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());
    // 赋值给模板
    $smarty->assign('form_action', 'insert');
    $smarty->display('list.htm');
} 

elseif ($rec == 'insert') {

    if (empty($_POST['pid'])) $_POST['pid']=0;
    if (empty($_POST['mobile'])) $_POST['mobile']='';
    $pinfo = $dou->get_row('product', '*', "id = ".intval($_POST['pid']));
     if(empty($pinfo))
     {
         $dou->dou_msg("任务不存在");
         exit;
     }
    $admin_info = $dou->get_row('admin', '*', "mobile = '".intval($_POST['mobile'])."'");
    if(empty($admin_info))
    {
        $dou->dou_msg("账号不存在");
        exit;
    }


    // 数据格式化
    $add_time = time();


    $sql = "INSERT INTO " . $dou->table('list') . " (id,username,pid,user_id,pay_money,card_id,add_time)" . " VALUES (NULL, '$admin_info[user_name]',".intval($_POST['pid']).", '$admin_info[user_id]', '$pinfo[price]','$admin_info[card_id]', '$add_time')";
    $dou->query($sql);
    
     $dou->dou_msg('添加成功', 'list.php');
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
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());
    
    // 赋值给模板
    $smarty->assign('form_action', 'update');
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
    if (empty($_POST['max'])) $_POST['max']=0;
    if (empty($_POST['status'])) $_POST['status']=0;
        
    // 文件上传盒子
    $image = $file->box('product', $id, 'image', 'main', null, $_CFG['thumb_width'], $_CFG['thumb_height']);
    $image = $image ? ", image = '" . $image . "'" : '';
    
    // 格式化自定义参数
    $_POST['defined'] = str_replace("\r\n", ',', $_POST['defined']);
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);
    
    $sql = "update " . $dou->table('product') . " SET max=".intval($_POST['max']).",status=".intval($_POST['status']).", cat_id = '$_POST[cat_id]', name = '$_POST[name]', price = '$_POST[price]', defined = '$_POST[defined]' ,content = '$_POST[content]'" . $image . ", keywords = '$_POST[keywords]', description = '$_POST[description]' WHERE id = '$id'";
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
 * 批量操作选择
 * +----------------------------------------------------------
 */
elseif ($rec == 'action') {
    if (is_array($_POST['checkbox'])) {
        if ($_POST['action'] == 'del_all') {
            // 批量商品删除
            $dou->del_all('list', $_POST['checkbox'], 'id', 'image', true);
        }
        if ($_POST['action'] == 'export') {

            $sql_in = $dou->create_sql_in($_POST['checkbox']);

            $count = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('list') . " WHERE id   ".$sql_in."  and status !=1");

             if($count>0)
            {
                $dou->dou_msg("列表中有未完成或者已支付的选项，请确保导出项均为待支付项");
                exit;
            }
            $excel_file = ROOT_PATH . ADMIN_PATH . '/include/phpexcel/excel.class.php';
            include_once($excel_file);

            $excel = new Excel();
             $excel->export_excel('user', excel_pay_list($_POST['checkbox']));
             exit;


        }
        if ($_POST['action'] == 'export2') {

            $sql_in = $dou->create_sql_in($_POST['checkbox']);
            $count = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('list') . " WHERE id ".$sql_in."   and status !=1");
            if($count>0)
            {
                $dou->dou_msg("列表中有未完成或者已支付的选项，请确保导出项均为待支付项");
                exit;
            }
            $excel_file = ROOT_PATH . ADMIN_PATH . '/include/phpexcel/excel.class.php';
            include_once($excel_file);

            $excel = new Excel();
            $excel->export_excel2('user', excel_tax_list($_POST['checkbox']));
            exit;


        }
        if ($_POST['action'] == 'export3') {

            //壹钱包 生成txt文件并sftp发送给对方
            $sql_in = $dou->create_sql_in($_POST['checkbox']);
            $counts = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('list') . " WHERE id ".$sql_in."   and status !=1 and status !=4");
            $count = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('list') . " WHERE id ".$sql_in);
            $total =$dou->get_one("SELECT sum(pay_money) as total FROM " . $dou->table('list') . " WHERE id ".$sql_in);

            $ppids=  $dou->query("SELECT DISTINCT(ppid)  FROM " . $dou->table('list') . " WHERE id ".$sql_in);
            if($ppids->num_rows>1)
            {
                $dou->dou_msg("选项中包含多个任务的打款明细！");
                exit;
            }
            // echo "SELECT sum(pay_money) as total FROM " . $dou->table('list') . " WHERE id ".$sql_in."   and status !=1";exit;
            if($counts>0)
            {
                $dou->dou_msg("列表中有未完成或者已支付的选项，请确保导出项均为待支付项");
                exit;
            }
            $ppid = $dou->get_one("SELECT ppid  FROM " . $dou->table('list') . " WHERE id ".$sql_in);
            $company = $dou->get_one("SELECT company  FROM " . $dou->table('product') . " WHERE id =$ppid");
            $merchantNo=$dou->get_one("SELECT merchantNo  FROM " . $dou->table('company') . " WHERE company ='$company'");
            if($merchantNo=='')
            {
                $dou->dou_msg("没有设置公司主体，不能支付");
                exit;
            }

            $datas = excel_tax_list($_POST['checkbox']);
            $batchNo = date('YmdHis');
            $detailNo=1;
            $businessType='BZZYGXBDF';
            $detailCounts=$count;
            $detailAmounts=floatval($total)*100;
            $currency='CNY';
            $mcTransDateTime=date('YmdHis');
            $signType="SHA256withRSA";
            $signature="";
            $name = 'BZZYGX_B0006_'.$merchantNo.'_'.$batchNo.'_'.$detailNo.'.txt';
            $content1=$merchantNo."|".$batchNo."|".$detailNo."|".$businessType."|".$detailCounts."|".$detailAmounts."|".$currency."|".$mcTransDateTime."|".$signType."|";
            $content2="";
            //线上
            $private_key1="MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBANye9V/JsWozHrjQ2wryGkjeUsmXSbwqte8cWWRu2VFnGWTc5gFbDR6X0zTxzYcUfRN1i7FR/SC7y6iQziRyKlA4we555oYb3zCta5NoG5ZUtPCfQ4gZc352rgAACdVWRXegzLw87U+PSfOYtRQrb45VI1a5nC2KN96ODxhXMYadAgMBAAECgYBC3NIUw7XHL9MBxBp+iL06lFaWzgkExBT7cKYO8CFgsFRb4y65/nRNb0oNY7McWzNE8Hzzspt6ji+82JYBKbB0q4PLKPA4Ye9xkzybqvpNHM8GBOEZRQCrZIQ3jtFEwkbbvC1JHuTT17kfTmF4sJ5eb8muqUyhQytq6vjOJFI4wQJBAPROeU6d1l/WJAP3KE7R3K1mqOG2zVvFX+rZDeL4PqBct2f+uct3kfC6PJ6bCSS1TGCX/PBxiy4zphYNhALoPlUCQQDnLkLd9VRgMOiJ0q0los/2fl7+ShDjpthJR0UHEczmyfjRFlNU80T4zBlaCXRAGG+1fXn4Pv3SZ8yiixBvZl8pAkAe/DT2e55M2WQH/LjoBkXu2C5jMkQpd4cKyiywtLt8q0W3st7tp2SjG3vEwfUO6s+dEKnL9Rqp6XMPKPetRrdhAkAO1/mTJt10D6/eqZhUgk+4FAUlbrwG4f+hNOJJwerWJsHDKxvOqJAVKYW3MkQ0mV0S2iuqtOC3UdLh3OwBOyGBAkEAsJ2tgQ+5mn2GEGsehWlMHzRkmgLuVyNxordIYoA9/KK6O9cm3vWYHWYsi2yONa+83y5L+wJSyso3bo3c677Fhw==";
            $private_key1        = chunk_split($private_key1, 64, "\n");
            $private_key1 = "-----BEGIN RSA PRIVATE KEY-----\n$private_key1-----END RSA PRIVATE KEY-----\n";
             foreach($datas['list'] as $k=>$v)
            {
                $order_id = $merchantNo.$batchNo.$v['order_id'];
                $item_id=$merchantNo.$v['order_id'];
                $content2.=($k+1).'|'.$item_id.'|'.$order_id.'||'.(floatval($v['money'])*100).'|CNY|0|||'.$v['bankno'].'|'.$v['user_name'].'||||'.$v['bankcode'].'|||{"bankRemark":"经营所得"}||01';
                if($k+1<count($datas['list']))
                {
                    $content2 .="\n";
                }
            }
            $detailDigest=strtoupper(hash('sha256',$content2));
            file_put_contents('d.txt',$content2);
            file_put_contents('e.txt',hash('sha256',$content2));
            file_put_contents('f.txt',$detailDigest);



             $str="merchantNo=".$merchantNo."&batchNo=".$batchNo."&detailNo=".$detailNo."&businessType=".$businessType."&detailCounts=".$detailCounts."&detailAmounts=".$detailAmounts."&currency=".$currency."&mcTransDateTime=".$mcTransDateTime."&signType=".$signType."&detailDigest=".$detailDigest;
             file_put_contents('a.txt',$str);
             openssl_sign($str,$binary_signature,$private_key1,'SHA256');
             file_put_contents('b.txt',$binary_signature);
             $binary_signature = bin2hex($binary_signature);
             file_put_contents('c.txt',$binary_signature);
             $content1.=$binary_signature."\n";

            $content = $content1.$content2;
           // echo $content;exit;


            file_put_contents('test2.txt',$content);
            //exit;

            //线上
            $private_key="CYT4tbrFGDABTSP8TyWRnw==";
            $content =  encrypt_pass($content,$private_key);
            file_put_contents('test3.txt',$content);

            $myfile = fopen("images/".$name, "w") or die("Unable to open file!");
            $txt = $content;
            fwrite($myfile, $txt);
            fclose($myfile);


            $sftp_file = ROOT_PATH . ADMIN_PATH . '/include/sftp.class.php';
            include_once($sftp_file);
            $config = array("host"=>"sftp.yqb.com","username"=>"BZZYGX_1903259","port"=>"22","password"=>"bkot+695+WRU");
            $localpath ="images/".$name;		//本地文件路径
            $realpath='/Payment/in';     //远程目录（需要上传到的目录）

            try {
                $sftp = new \Sftp($config);

                $re = $sftp->ssh2_dir_exits($realpath);
                //如果目录存在直接上传
                if($re){
                    $sftp->upftp("$localpath",$realpath.'/'.$name);
                }else{
                    $sftp->ssh2_sftp_mchkdir($realpath);
                    $sftp->upftp("$localpath",$realpath.'/'.$name);
                }
                //更新为付款中
                $dou->query("UPDATE " . $dou->table('list') . " SET status = 3 WHERE id ".$sql_in);
                $filename=$name;
                $send_time=date('Y-m-d H:i:s',time());
                $sql_in=str_replace('IN (','',$sql_in);
                $sql_in=str_replace(')','',$sql_in);
                $sql_in=str_replace('\'','',$sql_in);
                $sql = "INSERT INTO " . $dou->table('paylist') . " (id,filename,ids,send_time)" . " VALUES (NULL, '$filename','$sql_in','$send_time')";
                $dou->query($sql);

                 $msg="操作成功";
            } catch (\Exception $e) {
                $msg="操作失败".$e->getMessage();
             }
            $dou->dou_msg($msg,'list.php');


        }
        if ($_POST['action'] == 'export3_test') {

            //壹钱包 生成txt文件并sftp发送给对方
            $sql_in = $dou->create_sql_in($_POST['checkbox']);
            $counts = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('list') . " WHERE id ".$sql_in."   and status !=1 and status !=4");
            $count = $dou->get_one("SELECT count(*) as count FROM " . $dou->table('list') . " WHERE id ".$sql_in);
            $total =$dou->get_one("SELECT sum(pay_money) as total FROM " . $dou->table('list') . " WHERE id ".$sql_in);

            $ppids=  $dou->query("SELECT DISTINCT(ppid)  FROM " . $dou->table('list') . " WHERE id ".$sql_in);
            if($ppids->num_rows>1)
            {
                $dou->dou_msg("选项中包含多个任务的打款明细！");
                exit;
            }
            // echo "SELECT sum(pay_money) as total FROM " . $dou->table('list') . " WHERE id ".$sql_in."   and status !=1";exit;
            if($counts>0)
            {
                $dou->dou_msg("列表中有未完成或者已支付的选项，请确保导出项均为待支付项");
                exit;
            }
            $datas = excel_tax_list($_POST['checkbox']);
            $merchantNo = '900000117791';
            $batchNo = date('YmdHis');
            $detailNo=1;
            $businessType='BZZYGXBDF';
            $detailCounts=$count;
            $detailAmounts=floatval($total)*100;
            $currency='CNY';
            $mcTransDateTime=date('YmdHis');
            $signType="SHA256withRSA";
            $signature="";
            $name = 'BZZYGX_B0006_'.$merchantNo.'_'.$batchNo.'_'.$detailNo.'.txt';
            $content1=$merchantNo."|".$batchNo."|".$detailNo."|".$businessType."|".$detailCounts."|".$detailAmounts."|".$currency."|".$mcTransDateTime."|".$signType."|";
            $content2="";
            $private_key1="MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAMFPWyG57avvBCEYUSXBq76MsLm0qiUOhGI79Jx1pjDJTMHmEjOBrMc3AerHQ+njio6aQTXmGVGNb8nX3IqHJYUQU0jSpXdcDNuEnEgoiBmpJJnKQoG73tw4R3MpDeNPLKdw8XlVGsMClBLmrNePmbIm+dITDSG4fBNRlast3e3FAgMBAAECgYAF0pQWIfmMsjhXntni30CDDs3L6istzpAiPVgS1mBZG9caCAoITyGbJocCQVpEUzw7K15Hd1TP5gi19bCI46U3nW0krNqIOSa58bPUtsNumhgkWJfAbwvwY25At0+hz4auimNGa3UsoNV2rnUW0K1LVrXK8p2dGmM8bNytiDwGgQJBAOHvutZrZzoqx7Bav+wsCHR18QpWSXLWoZzb9/xHMpepmjXjR0pdXA8vQaCj2fqjqsxu1DMggbjD/Ik4jf9RmbECQQDbCD4ZYRaoX7sRfzVrSXmI4bLFGPVDiXgo9CatHrszbYPiX8r57u5Xf9rhbbieiypeSWo9ObHlOBz+sFI8F8ZVAkAbY92pquGbyp3kwkusDPaFb9rl3uoOkviKtJwOqG74teXtDH2TBVhoutjg6Zw+Z2MIX5M4E4PGa3QNCp8kSbcxAkBewJcUpZKGrjsf25cBXZys4W5To3NejxajKNOear/zBHpcMLJ/IqSKx62pfayzMWLXvQyvhcj2byrj5uT8SBCtAkEAnfooesRA63b7/tlVuOJA8G2uRwZc4dYV0jErkkH4S40/C6ING65JZx004ovKiW7syzqpgu/MCAvEdW1E2O4rsA==";

            $private_key1        = chunk_split($private_key1, 64, "\n");
            $private_key1 = "-----BEGIN RSA PRIVATE KEY-----\n$private_key1-----END RSA PRIVATE KEY-----\n";
            foreach($datas['list'] as $k=>$v)
            {
                $order_id = $merchantNo.$batchNo.$v['order_id'];
                $item_id=$merchantNo.$v['order_id'];
                $content2.=($k+1)."|".$item_id."|".$order_id."||".(floatval($v['money'])*100)."|CNY|0|||".$v['bankno']."|".$v['user_name']."||||".$v['bankcode']."|||||01"."\n";
            }
            $detailDigest=strtoupper(hash('sha256',$content2));
            file_put_contents('d.txt',$content2);
            file_put_contents('e.txt',hash('sha256',$content2));
            file_put_contents('f.txt',$detailDigest);



            $str="merchantNo=".$merchantNo."&batchNo=".$batchNo."&detailNo=".$detailNo."&businessType=".$businessType."&detailCounts=".$detailCounts."&detailAmounts=".$detailAmounts."&currency=".$currency."&mcTransDateTime=".$mcTransDateTime."&signType=".$signType."&detailDigest=".$detailDigest;
            file_put_contents('a.txt',$str);
            openssl_sign($str,$binary_signature,$private_key1,'SHA256');
            file_put_contents('b.txt',$binary_signature);
            $binary_signature = bin2hex($binary_signature);
            file_put_contents('c.txt',$binary_signature);
            $content1.=$binary_signature."\n";

            $content = $content1.$content2;


            file_put_contents('test2.txt',$content);


            $private_key="5BMONVJg6Y4v3Bu6ToHJfg==";
            $content =  encrypt_pass($content,$private_key);
            file_put_contents('test3.txt',$content);

            $myfile = fopen("images/".$name, "w") or die("Unable to open file!");
            $txt = $content;
            fwrite($myfile, $txt);
            fclose($myfile);


            $sftp_file = ROOT_PATH . ADMIN_PATH . '/include/sftp.class.php';
            include_once($sftp_file);
            $config = array("host"=>"test-sftp.stg.1qianbao.com","username"=>"BZZYGX_117791","port"=>"22","password"=>"BZZYGX_117791");
            $localpath ="images/".$name;		//本地文件路径
            $realpath='/Payment/in';     //远程目录（需要上传到的目录）

            try {
                $sftp = new \Sftp($config);

                $re = $sftp->ssh2_dir_exits($realpath);
                //如果目录存在直接上传
                if($re){
                    $sftp->upftp("$localpath",$realpath.'/'.$name);
                }else{
                    $sftp->ssh2_sftp_mchkdir($realpath);
                    $sftp->upftp("$localpath",$realpath.'/'.$name);
                }
                //更新为付款中
                $dou->query("UPDATE " . $dou->table('list') . " SET status = 3 WHERE id ".$sql_in);
                $filename=$name;
                $send_time=date('Y-m-d H:i:s',time());
                $sql_in=str_replace('IN (','',$sql_in);
                $sql_in=str_replace(')','',$sql_in);
                $sql_in=str_replace('\'','',$sql_in);
                $sql = "INSERT INTO " . $dou->table('paylist') . " (id,filename,ids,send_time)" . " VALUES (NULL, '$filename','$sql_in','$send_time')";
                $dou->query($sql);

                $msg="操作成功";
            } catch (\Exception $e) {
                $msg="操作失败".$e->getMessage();
            }
            $dou->dou_msg($msg,'list.php');


        }
        elseif ($_POST['action'] == 'category_move') {
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
 * 领工明细删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID

    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'list.php');
    $list_info = $dou->get_row('list', '*', "id = '$id'");
     if($list_info['status']!=4)
    {
        $dou->dou_msg('注意！只有支付失败的明细可以删除', 'list.php');
        exit;
    }

    if (isset($_POST['confirm'])) {


        $dou->create_admin_log("删除领工明细：" . json_encode($list_info));
        $dou->delete('list', "id = '$id'", 'list.php');
    } else {
        $_LANG['del_check'] = preg_replace('/d%/Ums', '该领工明细吗', $_LANG['del_check']);
        $dou->dou_msg($_LANG['del_check'], 'list.php', '', '30', "list.php?rec=del&id=$id");
    }
}


/**
 * +----------------------------------------------------------
 * 导出的会员数据
 * +----------------------------------------------------------
 * $checkbox 所选的会员条目
 * +----------------------------------------------------------
 */
function excel_pay_list($checkbox = '') {
    // 需要导出的字段
    $field = array('user_name', 'card_id', 'bankno', 'exNo', 'taxMoney', 'money', 'extaTaxMoney','mobile');

    // 导出的字段名称
    foreach ((array) $field as $value) {
        $excel_list['head'][] = $GLOBALS['_LANG']['user_' . $value];
    }
    $exNo='No'.date('YmdHis',time());
    // 导出列表

     $list = array();
     $list_card_arr=array();
    foreach($checkbox as $val)
    {
        $excel_item=array();
        $id=intval($val);
        if($id!=0)
        {
            $list_info =   $GLOBALS['dou']->get_row('list', '*', "id = '$id'");
            $user_info = $GLOBALS['dou']->get_row('admin', '*', "user_id = ".$list_info['user_id']);
            $excel_item['user_name']=$user_info['truename'];
            $excel_item['card_id']="\t".$user_info['card_id'];
            $excel_item['bankno']="\t".$user_info['bankno'].'';
            //发放周期 工资单id unique
            $excel_item['exNo']=$exNo.$id;
            $excel_item['taxMoney']=$list_info['pay_money'];//计税进行
            $excel_item['money']=$list_info['pay_money'];//实发金额
            $excel_item['extaTaxMoney']=0;//个税专项附加扣除
            $excel_item['mobile']="\t".$user_info['mobile'];//手机号
            array_push($list,$excel_item);
        }
    }

    $excel_list['list']= $list;
    return $excel_list;
}



/**
 * +----------------------------------------------------------
 * 导出个税报表
 * +----------------------------------------------------------
 * $checkbox 所选的会员条目
 * +----------------------------------------------------------
 */
function excel_tax_list($checkbox = '') {
    // 需要导出的字段
    $field = array('No','user_name', 'card_type', 'card_id', 'pro_name', 'totalMoney', 'taxRate', 'taxMoney','money');

    // 导出的字段名称
    foreach ((array) $field as $value) {
        $excel_list['head'][] =$GLOBALS['_LANG']['usertax_' . $value];
    }

    // 导出列表

    $list = array();
    $list_card_arr=array();
     foreach($checkbox as $key=>$val)
    {
        $excel_item=array();
        $id=intval($val);
        if($id!=0)
        {
            $list_info =   $GLOBALS['dou']->get_row('list', '*', "id = '$id'");
            $user_info = $GLOBALS['dou']->get_row('admin', '*', "user_id = ".$list_info['user_id']);
            $excel_item['No']=$key+1;
            $excel_item['order_id']=$id;
            $excel_item['user_name']=$user_info['truename'];
            $excel_item['card_type']='居民身份证';
            $excel_item['card_id']="\t".$user_info['card_id'].'';
            $excel_item['pro_name']='经营所得';
            $excel_item['bankno']=$list_info['bankno'];
            $excel_item['bankinfo']=$list_info['bankinfo'];
            $excel_item['bankcode']=$list_info['bankcode'];

            $moeny=$list_info['pay_money'];
            $totalMoney=round(floatval($list_info['pay_money'])/0.995,2);
            $taxMoney=round($totalMoney*0.005,2);


            $excel_item['totalMoney']=$totalMoney ;//应纳税额
            $excel_item['taxRate']='0.5%';
            $excel_item['taxMoney']=$taxMoney;//应纳税额
            $excel_item['money']=$moeny;//实收金额

            array_push($list,$excel_item);
        }

    }

    $excel_list['list']= $list;
    return $excel_list;
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