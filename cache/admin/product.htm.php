<?php /* Smarty version 2.6.26, created on 2021-06-15 10:45:58
         compiled from product.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $this->_tpl_vars['lang']['home']; ?>
<?php if ($this->_tpl_vars['ur_here']): ?> - <?php echo $this->_tpl_vars['ur_here']; ?>
 <?php endif; ?></title>
<meta name="Copyright" content="Douco Design." />
<link href="templates/public.css" rel="stylesheet" type="text/css">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "javascript.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="images/jquery.form.min.js"></script>
<script type="text/javascript" src="images/jquery.autotextarea.js"></script>
    <script src="images/laydate/laydate.js"></script>
 <script type="text/javascript" src="images/user.js"></script>
   

</head>
<body>
<div id="dcWrap">
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <div id="dcLeft"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
 <div id="dcMain">
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "handle.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <div class="mainBox" style="<?php echo $this->_tpl_vars['workspace']['height']; ?>
">
    <?php if ($this->_tpl_vars['rec'] == 'showdicform'): ?>
    <h3><a href="/admin/product.php?rec=createpro&id=<?php echo $this->_tpl_vars['id']; ?>
" class="actionBtn add">?????????????????????</a>??????????????????????????????</h3>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
     <tr>
      <!--<th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>-->
      <th width="40" align="center">????????????</th>
      <th width="80" align="center">????????????</th>
      <th width="80" align="center">????????????</th>
      <th width="80" align="center">???????????????</th>
     </tr>
     <?php $_from = $this->_tpl_vars['product_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
     <tr>
      <!--<td align="center"><input type="checkbox" name="checkbox[]" value="" /></td>-->
      <td align="center"><?php echo $this->_tpl_vars['product']['cat_name']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['product']['price']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['product']['count']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['product']['mobile']; ?>
</td>

     </tr>
     <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'default'): ?>
    <h3>
        <?php if ($this->_tpl_vars['user']['type'] != 3): ?>
        <a href="<?php echo $this->_tpl_vars['action_link']['href']; ?>
" class="actionBtn add"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a>
        <?php endif; ?>
        <?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
    <div class="filter">
    <form action="product.php" method="post">
     <select name="cat_id">
      <option value="0"><?php echo $this->_tpl_vars['lang']['uncategorized']; ?>
</option>
      <?php $_from = $this->_tpl_vars['product_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cate']):
?>
      <?php if ($this->_tpl_vars['cate']['cat_id'] == $this->_tpl_vars['cat_id']): ?>
      <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['cate']['mark']; ?>
 <?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
      <?php else: ?>
      <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
"><?php echo $this->_tpl_vars['cate']['mark']; ?>
 <?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
     </select>


     <select name="type">
      <option value="">????????????</option>
      <?php if ($this->_tpl_vars['type'] == 0): ?>
      <option value="0" selected="selected">????????????</option>
      <?php else: ?>
      <option value="0" >????????????</option>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['type'] == 1): ?>
      <option value="1" selected="selected">???????????????</option>
      <?php else: ?>
      <option value="1" >???????????????</option>
      <?php endif; ?>
     </select>




        <select name="upload_status">
            <option value="">????????????</option>
            <?php if ($this->_tpl_vars['upload_status'] == 0): ?>
            <option value="0" selected="selected">???????????????</option>
            <?php else: ?>
            <option value="0" >???????????????</option>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['upload_status'] == 1): ?>
            <option value="1" selected="selected">?????????</option>
            <?php else: ?>
            <option value="1" >?????????</option>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['upload_status'] == 2): ?>
            <option value="2" selected="selected">????????????????????????</option>
            <?php else: ?>
            <option value="2" >????????????????????????</option>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['upload_status'] == 3): ?>
            <option value="3" selected="selected">???????????????</option>
            <?php else: ?>
            <option value="3" >???????????????</option>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['upload_status'] == -1): ?>
            <option value="-1" selected="selected">????????????</option>
            <?php else: ?>
            <option value="-1" >????????????</option>
            <?php endif; ?>

        </select>

        <input name="user_id" type="text" placeholder="??????id" class="inpMain" value="<?php echo $this->_tpl_vars['user_id']; ?>
" size="20" />
        <input name="enterprise_name" type="text" placeholder="????????????" class="inpMain" value="<?php echo $this->_tpl_vars['enterprise_name']; ?>
" size="20" />
     <?php if ($this->_tpl_vars['type'] == 0): ?>
     <input name="pid" type="text" placeholder="??????????????????id" class="inpMain" value="<?php echo $this->_tpl_vars['pid']; ?>
" size="20" />
     <?php endif; ?>

     <input name="keyword" type="text" class="inpMain" value="<?php echo $this->_tpl_vars['keyword']; ?>
" size="20" />
     <input name="submit" class="btnGray" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_filter']; ?>
" />
    </form>
    <span>
    <!--<a class="btnGray" href="product.php?rec=thumb">?????????????????????</a>-->
    <?php if ($this->_tpl_vars['sort']['handle']): ?>
    <?php echo $this->_tpl_vars['lang']['sort_close']; ?>

    <?php else: ?>
    <!--<a class="btnGray" href="product.php?rec=sort&act=handle">????????????????????????</a>-->
    <?php endif; ?>
    </span>
    </div>
    <?php if ($this->_tpl_vars['sort']['handle']): ?>
    <div class="homeSortRight">
     <ul class="homeSortBg">
      <?php echo $this->_tpl_vars['sort']['bg']; ?>

     </ul>
     <ul class="homeSortList">
      <?php $_from = $this->_tpl_vars['sort']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
      <li>
       <img src="<?php echo $this->_tpl_vars['product']['image']; ?>
" width="60" height="60">
       <a href="product.php?rec=sort&act=cancel&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" title="<?php echo $this->_tpl_vars['lang']['sort_cancel']; ?>
">X</a>
      </li>
      <?php endforeach; endif; unset($_from); ?>
     </ul>
    </div>
    <?php endif; ?>
    <div id="list"<?php if ($this->_tpl_vars['sort']['handle']): ?> class="homeSortLeft"<?php endif; ?>>
    <form name="action" method="post" action="product.php?rec=action">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
        <th width="30" align="center"><?php echo $this->_tpl_vars['lang']['record_id']; ?>
</th>
        <th width="30" align="center">????????????</th>
        <th width="90" align="left">????????????</th>
        <th width="70" align="center"><?php echo $this->_tpl_vars['lang']['product_category']; ?>
</th>
       <th width="70" align="center">????????????</th>
       <th width="70" align="center">????????????</th>
       <th width="70" align="center">????????????</th>
       <th width="70" align="center">??????</th>
       <th width="70" align="center"><?php echo $this->_tpl_vars['lang']['add_time']; ?>
</th>

          <?php if ($this->_tpl_vars['user']['type'] != 3): ?>
        <th width="80" align="center"><?php echo $this->_tpl_vars['lang']['handler']; ?>
</th>
        <th width="80" align="center">?????????????????????</th>
         <?php endif; ?>
        <th width="90" align="center">??????</th>
      </tr>
      <?php $_from = $this->_tpl_vars['product_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
      <tr>
        <td align="center"><input type="checkbox" name="checkbox[]" value="<?php echo $this->_tpl_vars['product']['id']; ?>
" /></td>
        <td align="center">
            <?php if ($this->_tpl_vars['product']['is_read'] == 1): ?>
            <div class="circle" style="float: left"></div>
            <?php endif; ?>
            <?php echo $this->_tpl_vars['product']['id']; ?>
</td>
           <td> id:<?php echo $this->_tpl_vars['product']['user_id']; ?>
<br/>???????????????<?php echo $this->_tpl_vars['product']['enterprise_name']; ?>
</td>
        <td><?php echo $this->_tpl_vars['product']['name']; ?>
</td>
        <td align="center"><?php if ($this->_tpl_vars['product']['cat_name']): ?><?php echo $this->_tpl_vars['product']['cat_name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['uncategorized']; ?>
<?php endif; ?></td>
       <td align="center"><?php echo $this->_tpl_vars['product']['price']; ?>
</td>
       <td align="center"><?php echo $this->_tpl_vars['product']['max']; ?>
</td>
       <td align="center"><?php if ($this->_tpl_vars['product']['pay_status'] == 0): ?> ?????????<?php endif; ?><?php if ($this->_tpl_vars['product']['pay_status'] == 1): ?> ?????????<?php endif; ?></td>
       <td align="center"><?php if ($this->_tpl_vars['product']['status'] == 0): ?> ?????????<?php endif; ?><?php if ($this->_tpl_vars['product']['status'] == 1): ?> ?????????<?php endif; ?></td>
       <td align="center"><?php echo $this->_tpl_vars['product']['add_time']; ?>
</td>
      <?php if ($this->_tpl_vars['user']['type'] != 3): ?>
      <td align="center">
           <?php if ($this->_tpl_vars['product']['upload_status'] == 1): ?>
           <a href="product.php?rec=showxlsdetails&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" id="showListDetails" data-value="<?php echo $this->_tpl_vars['product']['file_path']; ?>
">??????????????????</a> |
           <?php if ($this->_tpl_vars['product']['status'] == 0): ?>
                  <a href="product.php?rec=xlsreplace&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">??????????????????</a> |
                  <a href="product.php?rec=xlspass&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">????????????</a> |
                   <span id="xlsfail"><a>????????????</a> |
                    <span style="display: none;">
                        <textarea name="upload_fail_reason" id="upload_fail_reason" cols="30" class="textAreaAuto" style="height:50px"></textarea>
                        <input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['product']['id']; ?>
" />
                        <input  class="btn"  id="savexlsfail" value="??????" style="width:80px; text-align: center" />
                    </span>
                   </span>
          <?php endif; ?>

          <?php endif; ?>
          <?php if ($this->_tpl_vars['product']['upload_status'] == 2): ?>
           <a href="product.php?rec=showxlsdetails&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" id="showListDetails" data-value="<?php echo $this->_tpl_vars['product']['file_path']; ?>
">??????????????????</a> |
          <?php if ($this->_tpl_vars['product']['status'] == 0): ?>
          <a href="product.php?rec=showxlsdetails&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" id="showListDetails" data-value="<?php echo $this->_tpl_vars['product']['file_path']; ?>
">??????????????????</a> |
          <a>????????????????????????</a> |
          <a href="http://58.banyar.cn/admin/list.php?ppid=<?php echo $this->_tpl_vars['product']['id']; ?>
">?????????</a>
          <?php endif; ?>
          <?php endif; ?>

          <?php if ($this->_tpl_vars['product']['upload_status'] == 3): ?>
           <a href="product.php?rec=showxlsdetails&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" id="showListDetails" data-value="<?php echo $this->_tpl_vars['product']['file_path']; ?>
">??????????????????</a> |
          <?php if ($this->_tpl_vars['product']['status'] == 0): ?>
          <a>?????????</a> |

          <a href="http://58.banyar.cn/admin/list.php?ppid=<?php echo $this->_tpl_vars['product']['id']; ?>
">?????????</a>
          <?php endif; ?>
          <?php endif; ?>

          <?php if ($this->_tpl_vars['product']['upload_status'] == -1): ?>
           <a href="product.php?rec=showxlsdetails&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" id="showListDetails" data-value="<?php echo $this->_tpl_vars['product']['file_path']; ?>
">??????????????????</a> |
          <?php if ($this->_tpl_vars['product']['status'] == 0): ?>
          <a>????????????</a>|
          <br/>?????????<font style="color:#f00"><?php echo $this->_tpl_vars['product']['upload_fail_reason']; ?>
</font>

          <?php endif; ?>
          <?php endif; ?>
          <a   href="http://58.banyar.cn/admin/product.php?rec=uploadfile&type=5&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">????????????????????? </a> |
            |<a href="http://58.banyar.cn/admin/product.php?rec=uploadfile&type=4&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">??????????????????</a> |
          <?php if ($this->_tpl_vars['product']['file4'] != ''): ?>
           <a  href="../../<?php echo $this->_tpl_vars['product']['file4']; ?>
" download="../../<?php echo $this->_tpl_vars['product']['file4']; ?>
">?????????????????? </a> |
          <?php endif; ?>
          <?php if ($this->_tpl_vars['product']['file5'] != ''): ?>
          <a  href="../../<?php echo $this->_tpl_vars['product']['file5']; ?>
" download="../../<?php echo $this->_tpl_vars['product']['file5']; ?>
">????????????????????? </a> |
          <?php endif; ?>
      </td>
      <td align="center">
         <?php if ($this->_tpl_vars['type'] == 1): ?>
         <a href="product.php?rec=upload&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" style="display: none">????????????????????????????????????_?????????????????????</a> |
         <a href="product.php?rec=uploadnew&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">????????????????????????????????????_???</a> |
            <?php if ($this->_tpl_vars['product']['count'] == 0): ?>
                <a href="product.php?rec=addamount&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">??????????????????</a> |
            <?php else: ?>
                <a href="product.php?rec=addamount&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">??????????????????</a> |
            <?php endif; ?>
         <a href="product.php?rec=showdicform&id=<?php echo $this->_tpl_vars['product']['id']; ?>
" style="display: none">?????????????????????????????????</a> |
         <?php endif; ?>
         <?php if ($this->_tpl_vars['sort']['handle']): ?>
         <a href="product.php?rec=sort&act=set&id=<?php echo $this->_tpl_vars['product']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['sort_btn']; ?>
</a>
         <?php else: ?>
         <a href="product.php?rec=edit&id=<?php echo $this->_tpl_vars['product']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['edit']; ?>
</a> | <a href="product.php?rec=del&id=<?php echo $this->_tpl_vars['product']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['del']; ?>
</a>
         <?php endif; ?>
        </td>
      <?php endif; ?>
      <td align="center">

            <a   href="http://58.banyar.cn/admin/product.php?rec=uploadfile&type=1&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">??????????????????????????? </a> |
           <a   href="http://58.banyar.cn/admin/product.php?rec=uploadfile&type=2&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">????????????</a> |
           <a   href="http://58.banyar.cn/admin/product.php?rec=uploadfile&type=3&id=<?php echo $this->_tpl_vars['product']['id']; ?>
">????????????????????????</a> |

               <?php if ($this->_tpl_vars['product']['file1'] != ''): ?>
           <a   href="../../<?php echo $this->_tpl_vars['product']['file1']; ?>
" download="../../<?php echo $this->_tpl_vars['product']['file1']; ?>
">??????????????????????????? </a> |
               <?php endif; ?>
               <?php if ($this->_tpl_vars['product']['file2'] != ''): ?>
           <a   href="../../<?php echo $this->_tpl_vars['product']['file2']; ?>
" download="../../<?php echo $this->_tpl_vars['product']['file2']; ?>
">???????????? </a> |
               <?php endif; ?>
               <?php if ($this->_tpl_vars['product']['file3'] != ''): ?>
           <a  href="../../<?php echo $this->_tpl_vars['product']['file3']; ?>
" download="../../<?php echo $this->_tpl_vars['product']['file3']; ?>
">???????????????????????? </a> |
               <?php endif; ?>


      </td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
    </table>
    <div class="action">
     <select name="action" onchange="douAction()">
      <option value="0"><?php echo $this->_tpl_vars['lang']['select']; ?>
</option>
      <option value="del_all"><?php echo $this->_tpl_vars['lang']['del']; ?>
</option>
      <option value="category_move"><?php echo $this->_tpl_vars['lang']['category_move']; ?>
</option>
     </select>
     <select name="new_cat_id" style="display:none">
      <option value="0"><?php echo $this->_tpl_vars['lang']['uncategorized']; ?>
</option>
      <?php $_from = $this->_tpl_vars['product_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cate']):
?>
      <?php if ($this->_tpl_vars['cate']['cat_id'] == $this->_tpl_vars['cat_id']): ?>
      <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['cate']['mark']; ?>
 <?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
      <?php else: ?>
      <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
"><?php echo $this->_tpl_vars['cate']['mark']; ?>
 <?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
     </select>
     <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_execute']; ?>
" />
    </div>
    </form>
    </div>
    <div class="clear"></div>
     <script type="text/javascript">
         <?php echo '
         $("#xlsfail").on(\'click\',function(){
                $(this).children(\'span\').css(\'display\',\'block\');
         });
         $("#savexlsfail").on(\'click\',function(){
             var upload_fail_reason = $(this).parent().children(\'textarea\').val();
             var id = $(this).parent().children(\'input[name=id]\').val();
             if(upload_fail_reason=="")
             {
                 alert(\'?????????????????????\');
                 return;
             }
              $.ajax({
                 type: \'post\',
                 url:\'product.php?rec=xlsfail\',
                 data: {upload_fail_reason:upload_fail_reason,id:id},
                 dateType: \'json\',
                 success: function(response){
                     alert(\'????????????\');
                     document.location.reload();
                 },
                 error:function(){
                     alert(\'???????????????\');
                 }
             });
         });
         '; ?>

     </script>


    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pager.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php endif; ?>
  <?php if ($this->_tpl_vars['rec'] == 'upload'): ?>
  <h3>????????????????????????????????????</h3>
  <form action="product.php?rec=upload_post"method="post" enctype="multipart/form-data">
   <div class="formBasic">
    <dl>
     <dt>????????????</dt>
     <dd>
      <input type="file" name="image" size="38" class="inpFlie" />
      <?php if ($this->_tpl_vars['article']['image']): ?><a href="<?php echo $this->_tpl_vars['article']['image']; ?>
" target="_blank"><img src="images/icon_yes.png"></a><?php else: ?><img src="images/icon_no.png"><?php endif; ?>
     </dd>
    </dl>
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
    <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
   </div>
   </form>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['rec'] == 'uploadnew'): ?>
  <h3>????????????????????????????????????</h3>
  <form action="product.php?rec=uploadnew_post"method="post" enctype="multipart/form-data">
   <div class="formBasic">
    <dl>
     <dt>????????????</dt>
     <dd>
      <input type="file" name="image" size="38" class="inpFlie" />
      <?php if ($this->_tpl_vars['article']['image']): ?><a href="<?php echo $this->_tpl_vars['article']['image']; ?>
" target="_blank"><img src="images/icon_yes.png"></a><?php else: ?><img src="images/icon_no.png"><?php endif; ?>
     </dd>
    </dl>
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
    <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
   </div>
  </form>
  <?php endif; ?>


     <?php if ($this->_tpl_vars['rec'] == 'uploadfile'): ?>
     <h3>??????</h3>
     <form action="product.php?rec=uploadfile_post"method="post" enctype="multipart/form-data">
         <div class="formBasic">
             <dl>
                 <dt>????????????</dt>
                 <dd>
                     <input type="file" name="image" size="38" class="inpFlie" />
                     <?php if ($this->_tpl_vars['article']['image']): ?><a href="<?php echo $this->_tpl_vars['article']['image']; ?>
" target="_blank"><img src="images/icon_yes.png"></a><?php else: ?><img src="images/icon_no.png"><?php endif; ?>
                 </dd>
             </dl>
             <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
             <input type="hidden" name="type" value="<?php echo $this->_tpl_vars['type']; ?>
">
             <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
         </div>
     </form>
     <?php endif; ?>



     <?php if ($this->_tpl_vars['rec'] == 'addamount'): ?>
     <h3>?????????????????????????????????</h3>
     <form action="product.php?rec=addamount_post" method="post" enctype="multipart/form-data">
         <div class="formBasic">
             <dl>
                 <dt>????????????</dt>
                 <dd>
                     <?php if ($this->_tpl_vars['count'] == 0): ?>
                     <input type="text" name="amount" value="" size="80" class="inpMain"  />
                     <?php else: ?>
                     <input type="text" name="amount" value="<?php echo $this->_tpl_vars['rc_info']['amount']; ?>
" size="80" class="inpMain"  />
                     <?php endif; ?>
                 </dd>
             </dl>

             <dl>
             <dt>??????</dt>
             <dd>
                 <?php if ($this->_tpl_vars['count'] == 0): ?>
                 <textarea name="des" cols="115" rows="3" class="textArea" /></textarea>
                 <?php else: ?>
                 <textarea name="des" cols="115" rows="3" class="textArea" /><?php echo $this->_tpl_vars['rc_info']['des']; ?>
</textarea>
                 <?php endif; ?>

             </dd>
             </dl>
             <dl>
                 <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
                 <input type="hidden" name="pid" value="<?php echo $this->_tpl_vars['id']; ?>
">
                 <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
             </dl>
         </div>
     </form>
     <?php endif; ?>

     <?php if ($this->_tpl_vars['rec'] == 'xlsreplace'): ?>
     <h3>????????????????????????????????????</h3>
     <form action="product.php?rec=xlsreplace_post"method="post" enctype="multipart/form-data">
         <div class="formBasic">
             <dl>
                 <dt>????????????</dt>
                 <dd>
                     <input type="file" name="image" size="38" class="inpFlie" />
                     <?php if ($this->_tpl_vars['article']['image']): ?><a href="<?php echo $this->_tpl_vars['article']['image']; ?>
" target="_blank"><img src="images/icon_yes.png"></a><?php else: ?><img src="images/icon_no.png"><?php endif; ?>
                 </dd>
             </dl>
             <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
             <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
         </div>
     </form>
     <?php endif; ?>
     <?php if ($this->_tpl_vars['rec'] == 'showxlsdetails'): ?>
     <h3>??????xls??????</h3>
     <iframe src='https://view.officeapps.live.com/op/view.aspx?src=http://58.banyar.cn/<?php echo $this->_tpl_vars['file']; ?>
' width='1500px' height='800px' frameborder='1'>
     </iframe>

     <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'add' || $this->_tpl_vars['rec'] == 'edit'): ?>
    <h3><a href="<?php echo $this->_tpl_vars['action_link']['href']; ?>
" class="actionBtn"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
    <form action="product.php?rec=<?php echo $this->_tpl_vars['form_action']; ?>
" method="post" enctype="multipart/form-data">
     <div class="formBasic">
      <dl>
       <dt><?php echo $this->_tpl_vars['lang']['product_name']; ?>
</dt>
       <dd>
        <input type="text" name="name" value="<?php echo $this->_tpl_vars['product']['name']; ?>
" size="80" class="inpMain" />
       </dd>
      </dl>
      <dl >
       <dt><?php echo $this->_tpl_vars['lang']['product_category']; ?>
</dt>
          <dd>
              <select id="category1"    style="width:40%; float:left">
                  <?php $_from = $this->_tpl_vars['category_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['cate']):
?>
                  <?php echo $this->_tpl_vars['cate']['cat_id']; ?>

                  <?php if ($this->_tpl_vars['parent_cat_info']['parent_id'] == $this->_tpl_vars['cate']['cat_id']): ?>
                  <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
                  <?php else: ?>
                  <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
"><?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
                  <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?>
              </select>
              <?php if ($this->_tpl_vars['rec'] == 'add'): ?>
              <select name="cat_id"    id="category2" style="display:none;width:40%; float:left">
              </select>
              <?php endif; ?>

              <?php if ($this->_tpl_vars['rec'] == 'edit'): ?>
              <select name="cat_id"    id="category2" style="width:40%; float:left">

                  <?php $_from = $this->_tpl_vars['child_category_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['cate']):
?>
                  <?php echo $this->_tpl_vars['cate']['cat_id']; ?>

                  <?php if ($this->_tpl_vars['product']['cat_id'] == $this->_tpl_vars['cate']['cat_id']): ?>
                  <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
                  <?php else: ?>
                  <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
"><?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
                  <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?>

              </select>
              <?php endif; ?>


          </dd>
      </dl>

<div style="clear: both"></div>
         <dl>
             <dt>????????????</dt>
             <dd>
                 <select name="price_type" class="price_type">

                     <option value="" selected="selected">??????????????????</option>

                     <?php if ($this->_tpl_vars['product']['price_type'] == 0): ?>
                     <option value="0" selected="selected">?????????</option>
                     <?php else: ?>
                     <option value="0"  >?????????</option>
                     <?php endif; ?>

                     <?php if ($this->_tpl_vars['product']['price_type'] == 1): ?>
                     <option value="1" selected="selected">??????</option>
                     <?php else: ?>
                     <option value="1"  >??????</option>
                     <?php endif; ?>
                 </select>
             </dd>
         </dl>
         <dl>
             <dt>?????????id</dt>
             <dd style="float: left">
                 <input type="text" name="user_id" value="<?php echo $this->_tpl_vars['product']['user_id']; ?>
" size="40" class="inpMain" />
             </dd>
         </dl>
         <div style="clear: both"></div>
      <dl>
       <dt><?php echo $this->_tpl_vars['lang']['product_price']; ?>
</dt>
       <dd style="float: left">
        <input type="text" name="price" value="<?php if ($this->_tpl_vars['product']['price']): ?><?php echo $this->_tpl_vars['product']['price']; ?>
<?php else: ?>0<?php endif; ?>" size="40" class="inpMain" />
       </dd>
          <?php if ($this->_tpl_vars['product']['price_type'] == 1): ?>
          <dd class="price_to" style="float: left">
              - <input type="text" name="price_to" value="<?php if ($this->_tpl_vars['product']['price_to']): ?><?php echo $this->_tpl_vars['product']['price_to']; ?>
<?php else: ?>0<?php endif; ?>" size="40" class="inpMain" />
          </dd>
          <?php else: ?>
          <dd class="price_to" style="float: left;display: none">
              - <input type="text" name="price_to" value="<?php if ($this->_tpl_vars['product']['price_to']): ?><?php echo $this->_tpl_vars['product']['price_to']; ?>
<?php else: ?>0<?php endif; ?>" size="40" class="inpMain" />
          </dd>
          <?php endif; ?>

      </dl>

      <dl style="clear: both">
         <dt>????????????</dt>
         <dd>
             <input type="text" name="max" value="<?php if ($this->_tpl_vars['product']['max']): ?><?php echo $this->_tpl_vars['product']['max']; ?>
<?php else: ?>0<?php endif; ?>" size="40" class="inpMain" />
         </dd>
     </dl>
         <dl>
             <dt>????????????</dt>
             <dd>
                 <input type="text" name="jisuandw" value="<?php echo $this->_tpl_vars['product']['jisuandw']; ?>
" size="40" class="inpMain" />
             </dd>
         </dl>
         <dl>
             <dt>????????????</dt>
             <dd>
                 <input type="text" name="city" value="<?php echo $this->_tpl_vars['product']['city']; ?>
"   class="inpMain" />
             </dd>
         </dl>
         <dl>
             <dt>????????????</dt>
             <dd>
                 <input type="text" name="tax_type" value="<?php echo $this->_tpl_vars['product']['tax_type']; ?>
"   class="inpMain" />
             </dd>
         </dl>
      <dl style="display: none">
       <dt>?????????????????????(?????????,?????????????????????????????????????????????????????????)</dt>
       <dd>
        <input type="text" name="bind_mobile" value="<?php echo $this->_tpl_vars['product']['bind_mobile']; ?>
"  class="inpMain" />
       </dd>
      </dl>
      <dl>
       <dl style="display: none">
        <dt>????????????id</dt>
        <dd>
         <input type="text" name="pid" value="<?php echo $this->_tpl_vars['product']['pid']; ?>
"  class="inpMain" />
        </dd>
       </dl>


          <dl>
              <dt>????????????</dt>
              <dd>
                  <select name="company">
                      <option value="" selected="selected">?????????????????????</option>

                      <?php if ($this->_tpl_vars['product']['company'] == '????????????????????????????????????'): ?>
                      <option value="????????????????????????????????????" selected="selected">????????????????????????????????????</option>
                      <?php else: ?>
                      <option value="????????????????????????????????????"  >????????????????????????????????????</option>
                      <?php endif; ?>

                      <?php if ($this->_tpl_vars['product']['company'] == '??????????????????????????????????????????'): ?>
                      <option value="??????????????????????????????????????????" selected="selected">??????????????????????????????????????????</option>
                      <?php else: ?>
                      <option value="??????????????????????????????????????????"  >??????????????????????????????????????????</option>
                      <?php endif; ?>


                      <?php if ($this->_tpl_vars['product']['company'] == '?????????????????????????????????????????????'): ?>
                      <option value="?????????????????????????????????????????????" selected="selected">?????????????????????????????????????????????</option>
                      <?php else: ?>
                      <option value="?????????????????????????????????????????????"  >?????????????????????????????????????????????</option>
                      <?php endif; ?>


                  </select>
              </dd>
          </dl>

      <dl>
       <dt>????????????</dt>
       <dd>
        <select name="status">
           <?php if ($this->_tpl_vars['product']['status'] == 0): ?>
         <option value="0" selected="selected">?????????</option>
         <?php else: ?>
         <option value="0"  >?????????</option>
         <?php endif; ?>

         <?php if ($this->_tpl_vars['product']['status'] == 1): ?>
         <option value="1" selected="selected">?????????</option>
         <?php else: ?>
         <option value="1"  >?????????</option>
         <?php endif; ?>
         </select>
       </dd>
      </dl>
        <dl>
         <dt>????????????</dt>
         <dd>
          <select name="pay_status">
           <?php if ($this->_tpl_vars['product']['pay_status'] == 0): ?>
           <option value="0" selected="selected">?????????</option>
           <?php else: ?>
           <option value="0"  >?????????</option>
           <?php endif; ?>

           <?php if ($this->_tpl_vars['product']['pay_status'] == 1): ?>
           <option value="1" selected="selected">?????????</option>
           <?php else: ?>
           <option value="1"  >?????????</option>
           <?php endif; ?>
          </select>
         </dd>
        </dl>
      <dl style="display: none">
       <dt>????????????</dt>
       <dd>
           <!--
        <select name="type">
         <option value="0" selected="selected">????????????</option>
<option value="1"  >???????????????</option>
        </select>
           -->

           <select name="type">
               <option value="1" selected="selected">???????????????</option>
           </select>
       </dd>
      </dl>

        <dl>
         <dt>??????????????????</dt>
         <dd>
          <input name="start_time"  value="<?php echo $this->_tpl_vars['product']['start_time']; ?>
"   type="text" class="inpMain" id="time"  style="width:250px"  />
         </dd>
        </dl>
        <dl>
         <dt>??????????????????</dt>
         <dd>
          <input name="stop_time"  value="<?php echo $this->_tpl_vars['product']['stop_time']; ?>
"  type="text" class="inpMain"  id="time1" style="width:250px"   />
         </dd>
        </dl>
        <dl>
         <dt>??????????????????</dt>
         <dd>
          <input name="end_time"  value="<?php echo $this->_tpl_vars['product']['end_time']; ?>
" type="text" class="inpMain" id="time2" style="width:250px"   />
         </dd>
        </dl>
      <?php if ($this->_tpl_vars['product']['defined']): ?>
      <dl>
       <dt><?php echo $this->_tpl_vars['lang']['product_defined']; ?>
</dt>
       <dd>
        <textarea name="defined" id="defined" cols="50" class="textAreaAuto" style="height:<?php echo $this->_tpl_vars['product']['defined_count']; ?>
0px"><?php echo $this->_tpl_vars['product']['defined']; ?>
</textarea>
        <script type="text/javascript">
         <?php echo '
         $("#defined").autoTextarea({maxHeight:300});




         '; ?>

        </script>
        </dd>
      </dl>
      <?php endif; ?>
      <dl style="display: none">
       <dt><?php echo $this->_tpl_vars['lang']['product_content']; ?>
</dt>
       <dd>
        <!-- FileBox -->
        <div id="contentFile" class="fileBox">
         <ul class="fileBtn">
          <li class="btnFile" onclick="fileBox('content');"><?php echo $this->_tpl_vars['lang']['file_insert_image']; ?>
</li>
          <li class="fileStatus" style="display:none"><img src="images/loader.gif" alt="uploading"/></li>
         </ul>
        </div>
        <!-- /FileBox -->
        <!-- TinyMCE -->
        <script type="text/javascript" charset="utf-8" src="include/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="include/tinymce/init.js"></script>
        <textarea id="content" name="content" rows="20"><?php echo $this->_tpl_vars['product']['content']; ?>
</textarea>
        <!-- /TinyMCE -->
       </dd>
      </dl>
      <dl style="display:none">
       <dt><?php echo $this->_tpl_vars['lang']['thumb']; ?>
</dt>
       <dd>
        <input type="file" name="image" size="38" class="inpFlie" />
        <?php if ($this->_tpl_vars['product']['image']): ?><a href="<?php echo $this->_tpl_vars['product']['image']; ?>
" target="_blank"><img src="images/icon_yes.png"></a><?php else: ?><img src="images/icon_no.png"><?php endif; ?></dd>
      </dl>
      <dl style="display: none">
       <dt>??????</dt>
       <dd>
        <input type="text" name="keywords" value="<?php echo $this->_tpl_vars['product']['keywords']; ?>
" size="114" class="inpMain" />
       </dd>
      </dl>
        <dl style="display: none">>
         <dt>????????????</dt>
         <dd>
          <input type="text" name="zhouqi" value="<?php echo $this->_tpl_vars['product']['zhouqi']; ?>
" size="114" class="inpMain" />
         </dd>
        </dl>
        <dl>
        <dt>????????????</dt>
        <dd>
        <textarea name="content" cols="115" rows="3" class="textArea" /><?php echo $this->_tpl_vars['product']['content']; ?>
</textarea>
        </dd>
        </dl>
      <!--<dl>-->
       <?php echo $this->_tpl_vars['lang']['description']; ?>

       <!--<dd>-->
        <?php echo $this->_tpl_vars['product']['description']; ?>

       <!--</dd>-->
      <!--</dl>-->
      <dl>
       <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
       <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['product']['id']; ?>
">
       <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
      </dl>
     </div>
    </form>
     <script type="text/javascript">
         <?php echo '
         var select=document.getElementById("category1");
         select.onchange=function(){
             var cat_id =  $(this).val();
             $.ajax({
                 type: \'post\',
                 url:\'product.php?rec=getcatchildlist\',
                 data: {cat_id:cat_id},
                 dateType: \'json\',
                 success: function(response){

                     var obj3  = JSON.parse(response);

                     var html = \'\';

                     if(obj3)
                     {
                         $.each(obj3,function(i,n)
                         {
                             console.log(n);
                             html += \'<option value="\'+n.cat_id+\'">\'+n.cat_name+\'</option>\';
                         });
                         $(\'#category2\').html(html);
                         $(\'#category2\').css("display","block");
                     }

                 },
                 error:function(){
                     alert(\'???????????????\');
                 }
             });
         }




         '; ?>

     </script>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'thumb'): ?>
    <h3><a href="<?php echo $this->_tpl_vars['action_link']['href']; ?>
" class="actionBtn"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
    <script type="text/javascript">
    <?php echo '
     function mask(i) {
        document.getElementById(\'mask\').innerHTML += i;
        document.getElementById(\'mask\').scrollTop = 100000000;
     }
     function success() {
        var d=document.getElementById(\'success\');
        d.style.display="block";
     }
    '; ?>

    </script>
    <dl id="maskBox">
     <dt><em><?php echo $this->_tpl_vars['mask']['count']; ?>
</em><?php if (! $this->_tpl_vars['mask']['confirm']): ?><form action="product.php?rec=thumb" method="post"><input name="confirm" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['product_thumb_start']; ?>
" /></form><?php endif; ?></dt>
     <dd class="maskBg"><?php echo $this->_tpl_vars['mask']['bg']; ?>
<i id="success"><?php echo $this->_tpl_vars['lang']['product_thumb_succes']; ?>
</i></dd>
     <dd id="mask"></dd>
    </dl>
    <?php endif; ?>
   </div>
 </div>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 </div>
<?php if ($this->_tpl_vars['rec'] == 'default'): ?>
<script type="text/javascript">
<?php echo 'onload = function() {document.forms[\'action\'].reset();}'; ?>

</script>
<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "filebox.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['rec'] != 're_thumb'): ?>
</body>
</html>
<?php endif; ?>