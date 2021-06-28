<?php /* Smarty version 2.6.26, created on 2019-12-19 16:45:55
         compiled from list.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>工人领工明细</title>
<meta name="Copyright" content="Douco Design." />
<link href="templates/public.css" rel="stylesheet" type="text/css">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "javascript.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src="images/jquery.form.min.js"></script>
<script type="text/javascript" src="images/jquery.autotextarea.js"></script>
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
    <?php if ($this->_tpl_vars['rec'] == 'default'): ?>
    <h3><a href="list.php?rec=add" class="actionBtn add" style="display:none"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
    <?php if ($this->_tpl_vars['ppid'] > 0): ?>
    <div class="formBasic">
     <dl>
      <dt>总金额：<?php echo $this->_tpl_vars['total_amount']; ?>
元</dt>
      <dd>

      </dd>
     </dl>
    </div>
    <?php endif; ?>
     <div class="filter">

    <form action="list.php" method="post">

     <input name="ppid" type="text" class="inpMain" value="<?php echo $this->_tpl_vars['ppid']; ?>
" placeholder="总包任务id" size="20" />
     <input name="pid" type="text" class="inpMain" value="<?php echo $this->_tpl_vars['pid']; ?>
" placeholder="任务id" size="20" style="display: none" />
     <input name="uname" type="text" class="inpMain" value="<?php echo $this->_tpl_vars['uname']; ?>
" placeholder="用户名" size="20" />
     <input name="truename" type="text" class="inpMain" value="<?php echo $this->_tpl_vars['truename']; ?>
" placeholder="真实姓名" size="20" />
     <input name="card_id" type="text" class="inpMain" value="<?php echo $this->_tpl_vars['card_id']; ?>
" placeholder="身份证" size="40" />
     <input name="enterprise_name" type="text" placeholder="企业名称" class="inpMain" value="<?php echo $this->_tpl_vars['enterprise_name']; ?>
" size="20" />


     <select name="status">

      <?php if ($this->_tpl_vars['status'] == -1): ?>
      <option value="-1"  selected="selected">任务状态</option>
      <?php else: ?>
      <option value="-1">任务状态</option>
      <?php endif; ?>


      <?php if ($this->_tpl_vars['status'] == 0): ?>
      <option value="0" selected="selected">进行中</option>
      <?php else: ?>
      <option value="0" >进行中</option>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['status'] == 1): ?>
      <option value="1" selected="selected">未支付</option>
      <?php else: ?>
      <option value="1" >未支付</option>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['status'] == 2): ?>
      <option value="2" selected="selected">已支付</option>
      <?php else: ?>
      <option value="2" >已支付</option>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['status'] == 3): ?>
      <option value="3" selected="selected">付款中</option>
      <?php else: ?>
      <option value="3" >付款中</option>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['status'] == 4): ?>
      <option value="4" selected="selected">支付失败</option>
      <?php else: ?>
      <option value="4" >支付失败</option>
      <?php endif; ?>
     </select>

      <input name="submit" class="btnGray" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_filter']; ?>
" />
    </form>

    </div>

    <div id="list"<?php if ($this->_tpl_vars['sort']['handle']): ?> class="homeSortLeft"<?php endif; ?>>
    <form name="action" method="post" action="list.php?rec=action">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
        <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
        <th width="40" align="center"><?php echo $this->_tpl_vars['lang']['record_id']; ?>
</th>
        <th width="100" align="left">任务id</th>
        <th width="100" align="left">任务名称</th>
        <th width="100" align="left">商户名称</th>
        <th width="80" align="center">用户名称</th>
        <th width="80" align="center">真实姓名</th>
        <th width="80" align="center">身份证</th>
       <th width="80" align="center">任务价格</th>
       <th width="80" align="center">领任务时间</th>
       <th width="80" align="center">状态</th>
       <th width="80" align="center">完成时间</th>
       <th width="80" align="center">支付时间</th>

        <th width="80" align="center"><?php echo $this->_tpl_vars['lang']['handler']; ?>
</th>
      </tr>
      <?php $_from = $this->_tpl_vars['lists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <tr>
        <td align="center"><input type="checkbox" name="checkbox[]" value="<?php echo $this->_tpl_vars['list']['id']; ?>
" /></td>
        <td align="center"><?php echo $this->_tpl_vars['list']['id']; ?>
</td>
        <td><a href="/admin/product.php?id=<?php echo $this->_tpl_vars['list']['pid']; ?>
"><?php echo $this->_tpl_vars['list']['pid']; ?>
</a></td>
        <td><?php echo $this->_tpl_vars['list']['pname']; ?>
</td>
       <td align="center"><?php echo $this->_tpl_vars['list']['pcompany_name']; ?>
</td>
        <td align="center"><?php echo $this->_tpl_vars['list']['username']; ?>
</td>

        <td align="center"><?php echo $this->_tpl_vars['list']['truename']; ?>
</td>
        <td align="center"><?php echo $this->_tpl_vars['list']['card_id']; ?>
</td>
       <td align="center"><?php echo $this->_tpl_vars['list']['pay_money']; ?>
</td>
       <td align="center"><?php echo $this->_tpl_vars['list']['add_time']; ?>
</td>
       <td align="center"><?php if ($this->_tpl_vars['list']['status'] == 0): ?> 进行中<?php endif; ?><?php if ($this->_tpl_vars['list']['status'] == 1): ?> 未支付<?php endif; ?><?php if ($this->_tpl_vars['list']['status'] == 2): ?> 已支付<?php endif; ?><?php if ($this->_tpl_vars['list']['status'] == 3): ?> 付款中<?php endif; ?><?php if ($this->_tpl_vars['list']['status'] == 4): ?> 付款失败----<?php echo $this->_tpl_vars['list']['pay_msg']; ?>
<?php endif; ?></td>
       <td align="center"><?php echo $this->_tpl_vars['list']['finish_time']; ?>
</td>
       <td align="center"><?php echo $this->_tpl_vars['list']['pay_time']; ?>
</td>
        <td align="center">
         <?php if ($this->_tpl_vars['sort']['handle']): ?>
         <a href="list.php?rec=sort&act=set&id=<?php echo $this->_tpl_vars['list']['id']; ?>
"><?php echo $this->_tpl_vars['lang']['sort_btn']; ?>
</a>
         <?php else: ?>

         <?php if ($this->_tpl_vars['list']['status'] == 1): ?> <?php endif; ?>
         <?php if ($this->_tpl_vars['list']['status'] == 4): ?>
         <a href="list.php?rec=del&id=<?php echo $this->_tpl_vars['list']['id']; ?>
">删除</a>
         <?php endif; ?>
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
      <?php echo $this->_tpl_vars['lang']['category_move']; ?>

      <option value="export">导出打款报表</option>
      <option value="export2">导出个税报表</option>
      <option value="export3">发送线上支付报表</option>
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
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pager.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'add' || $this->_tpl_vars['rec'] == 'edit'): ?>
    <h3><a href="<?php echo $this->_tpl_vars['action_link']['href']; ?>
" class="actionBtn"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a>添加领工明细</h3>

    <form action="list.php?rec=<?php echo $this->_tpl_vars['form_action']; ?>
" method="post" enctype="multipart/form-data">
     <div class="formBasic">
      <dl>
       <dt>任务id</dt>
       <dd>
        <input type="text" name="pid" value="<?php echo $this->_tpl_vars['list']['pid']; ?>
" size="80" class="inpMain" />
       </dd>
      </dl>
      <dl>
       <dt>用户手机号</dt>
       <dd>
        <input type="text" name="mobile" value="<?php echo $this->_tpl_vars['list']['mobile']; ?>
" size="80" class="inpMain" />
       </dd>
      </dl>
      <dl>
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['list']['id']; ?>
">
       <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
      </dl>
     </div>
    </form>
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
</em><?php if (! $this->_tpl_vars['mask']['confirm']): ?><form action="list.php?rec=thumb" method="post"><input name="confirm" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['product_thumb_start']; ?>
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