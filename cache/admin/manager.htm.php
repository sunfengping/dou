<?php /* Smarty version 2.6.26, created on 2020-04-23 21:04:43
         compiled from manager.htm */ ?>
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
   <div id="manager" class="mainBox" style="<?php echo $this->_tpl_vars['workspace']['height']; ?>
">
    <h3><?php if ($this->_tpl_vars['rec'] != 'manager_log'): ?>
     <a href="<?php echo $this->_tpl_vars['action_link']['href']; ?>
" class="actionBtn"  style="margin-left: 5px;"><?php echo $this->_tpl_vars['action_link']['text']; ?>
</a>&nbsp;&nbsp;&nbsp;&nbsp;
     <?php if ($this->_tpl_vars['type'] == 2): ?>
     <a href="manager.php?rec=uploadworker" class="actionBtn" style="margin-left: 5px;">批量添加工人</a>&nbsp;&nbsp;&nbsp;&nbsp;
     <?php endif; ?>
       <?php if ($this->_tpl_vars['rec'] == 'default'): ?>

     <a href="manager.php?rec=add&type=3" class="actionBtn" style="margin-left: 5px;">添加落地团队</a>&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="manager.php?rec=add&type=1" class="actionBtn" style="margin-left: 5px;">添加商户</a>&nbsp;&nbsp;&nbsp;&nbsp;
       <a href="manager.php?rec=add&type=2" class="actionBtn"  style="margin-left: 5px;">添加工人</a>
       <?php endif; ?>
     <?php endif; ?><?php echo $this->_tpl_vars['ur_here']; ?>
</h3>
    <?php if ($this->_tpl_vars['rec'] == 'default'): ?>
    <form action="manager.php" method="post">
     <select name="type">
      <option value=""  >全部</option>
      <?php if ($this->_tpl_vars['type'] == 0): ?>
      <option value="0" selected="selected">网站管理员</option>
      <?php else: ?>
      <option value="0">网站管理员</option>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <option value="3" selected="selected">落地团队</option>
      <?php else: ?>
      <option value="3">落地团队</option>
      <?php endif; ?>

       <?php if ($this->_tpl_vars['type'] == 1): ?>
      <option value="1" selected="selected">商户端用户</option>
      <?php else: ?>
      <option value="1">商户端用户</option>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 2): ?>
      <option value="2" selected="selected">工人用户</option>
      <?php else: ?>
      <option value="2">工人用户</option>
      <?php endif; ?>
      </select>
     <select name="status">
      <option value=""  >全部</option>
      <?php if ($this->_tpl_vars['status'] == 0): ?>
      <option value="0" selected="selected">待审核</option>
      <?php else: ?>
      <option value="0">待审核</option>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['status'] == 1): ?>
      <option value="1" selected="selected">审核通过</option>
      <?php else: ?>
      <option value="1">审核通过</option>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['status'] == 2): ?>
      <option value="2" selected="selected">审核失败</option>
      <?php else: ?>
      <option value="2">审核失败</option>
      <?php endif; ?>
     </select>
     <input name="user_name" type="text" placeholder="用户名" class="inpMain" value="<?php echo $this->_tpl_vars['user_name']; ?>
" size="20" />
     <input name="truename" type="text" placeholder="真实姓名" class="inpMain" value="<?php echo $this->_tpl_vars['truename']; ?>
" size="20" />
     <input name="mobile" type="text" placeholder="手机号" class="inpMain" value="<?php echo $this->_tpl_vars['mobile']; ?>
"  />
     <select name="stage">
      <option value=""  >所处状态</option>
      <?php if ($this->_tpl_vars['stage'] == 1): ?>
      <option value="1" selected="selected">未实名认证</option>
      <?php else: ?>
      <option value="1">未实名认证</option>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['stage'] == 2): ?>
      <option value="2" selected="selected">已认证未签约</option>
      <?php else: ?>
      <option value="2">已认证未签约</option>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['stage'] == 3): ?>
      <option value="3" selected="selected">已签约</option>
      <?php else: ?>
      <option value="3">已签约</option>
      <?php endif; ?>
     </select>
      <input name="submit" class="btnGray" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_filter']; ?>
" />
    </form>

    <form name="action" method="post" action="manager.php?rec=action">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic" style="margin-top: 10px;">
     <tr>
      <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
      <th width="30" align="center"><?php echo $this->_tpl_vars['lang']['record_id']; ?>
</th>
      <th align="left"><?php echo $this->_tpl_vars['lang']['manager_username']; ?>
</th>
       <th align="center">钱包</th>
       <th align="center">类型</th>
      <th align="center">身份证</th>
      <th align="center">手机号</th>
      <th align="center">真实姓名</th>
      <th align="center"><?php echo $this->_tpl_vars['lang']['manager_add_time']; ?>
</th>
      <th align="center"><?php echo $this->_tpl_vars['lang']['manager_last_login']; ?>
</th>
      <th align="center">状态</th>
      <th align="center">所处阶段</th>
      <th align="center"><?php echo $this->_tpl_vars['lang']['handler']; ?>
</th>
     </tr>
     <?php $_from = $this->_tpl_vars['manager_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['manager_list']):
?>
     <tr>
      <td align="center"><input type="checkbox" name="checkbox[]" value="<?php echo $this->_tpl_vars['manager_list']['user_id']; ?>
" /></td>
      <td align="center"><?php echo $this->_tpl_vars['manager_list']['user_id']; ?>
</td>
      <td><?php echo $this->_tpl_vars['manager_list']['user_name']; ?>
</td>
      <td><?php echo $this->_tpl_vars['manager_list']['amount']; ?>
</td>
       <td align="center"><?php if ($this->_tpl_vars['manager_list']['type'] == 0): ?>后台管理员<?php endif; ?><?php if ($this->_tpl_vars['manager_list']['type'] == 3): ?>落地团队<?php endif; ?><?php if ($this->_tpl_vars['manager_list']['type'] == 1): ?>商户端用户<?php endif; ?><?php if ($this->_tpl_vars['manager_list']['type'] == 2): ?>工人用户<?php endif; ?></td>
      <td align="center"><?php echo $this->_tpl_vars['manager_list']['card_id']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['manager_list']['mobile']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['manager_list']['truename']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['manager_list']['add_time']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['manager_list']['last_login']; ?>
</td>
      <td align="center">
       <?php if ($this->_tpl_vars['manager_list']['status'] == 0): ?>待审核<?php endif; ?>
       <?php if ($this->_tpl_vars['manager_list']['status'] == 1): ?>审核通过<?php endif; ?>
       <?php if ($this->_tpl_vars['manager_list']['status'] == 2): ?>审核失败<?php endif; ?></td>
      <td align="center"><?php echo $this->_tpl_vars['manager_list']['stage']; ?>
</td>
      <td align="center"><a href="manager.php?rec=edit&id=<?php echo $this->_tpl_vars['manager_list']['user_id']; ?>
"><?php echo $this->_tpl_vars['lang']['edit']; ?>
</a> | <a href="manager.php?rec=del&id=<?php echo $this->_tpl_vars['manager_list']['user_id']; ?>
"><?php echo $this->_tpl_vars['lang']['del']; ?>
</a></td>
     </tr>
     <?php endforeach; endif; unset($_from); ?>
    </table>
     <div class="action">
      <select name="action" onchange="douAction()">
       <option value="0"><?php echo $this->_tpl_vars['lang']['select']; ?>
</option>
       <option value="del_all"><?php echo $this->_tpl_vars['lang']['del']; ?>
</option>
       </select>
      <input name="submit" class="btn" type="submit" value="<?php echo $this->_tpl_vars['lang']['btn_execute']; ?>
" />
     </div>
    </form>
    <div class="clear"></div>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pager.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'add'): ?>

    <form action="manager.php?rec=insert" method="post">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="100" align="right">用户名</td>
       <td>
        <input type="text" name="user_name" size="40" class="inpMain" />
       </td>
      </tr>
      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
       <td width="100" align="right" >商户简称</td>
       <td>
        <input type="text" name="jc" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">商户简称</td>
       <td>
        <input type="text" name="jc" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 2 || $this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
       <td width="100" align="right"><?php echo $this->_tpl_vars['lang']['manager_email']; ?>
</td>
       <td>
        <input type="text" name="email" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right"><?php echo $this->_tpl_vars['lang']['manager_email']; ?>
</td>
       <td>
        <input type="text" name="email" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 2 || $this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
       <td width="100" align="right">钱包余额</td>
       <td>
        <input type="text" name="amount" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">钱包余额</td>
       <td>
        <input type="text" name="amount" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>


      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr  style="display: none">
       <td width="100" align="right">身份证</td>
       <td>
        <input type="text" name="card_id" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">身份证</td>
       <td>
        <input type="text" name="card_id" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr   style="display: none">
       <td width="100" align="right">真实姓名</td>
       <td>
        <input type="text" name="truename" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">真实姓名</td>
       <td>
        <input type="text" name="truename" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>



      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr  style="display: none">
       <td width="100" align="right">手机号</td>
       <td>
        <input type="text" name="mobile" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">手机号</td>
       <td>
        <input type="text" name="mobile" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>


      <tr>
       <td width="100" align="right">类型</td>
       <td>
        <select name="type"  class="inpMain">
         <?php if ($this->_tpl_vars['type'] == 0): ?>
         <option value="0" selected >网站管理员</option>
         <?php else: ?>
         <option value="0"  >网站管理员</option>
         <?php endif; ?>

         <?php if ($this->_tpl_vars['type'] == 3): ?>
         <option value="3" selected >落地团队</option>
         <?php else: ?>
         <option value="3"  >落地团队</option>
         <?php endif; ?>

         <?php if ($this->_tpl_vars['type'] == 1): ?>
         <option value="1" selected >商户端用户</option>
         <?php else: ?>
         <option value="1"  >商户端用户</option>
         <?php endif; ?>

         <?php if ($this->_tpl_vars['type'] == 2): ?>
         <option value="2"  selected>工人用户</option>
         <?php else: ?>
         <option value="2" >工人用户</option>
         <?php endif; ?>

        </select>
       </td>
      </tr>
      <tr>
       <td width="100" align="right">状态</td>
       <td>
        <select name="status"  class="inpMain">
         <option value="0"  >待审核</option>
         <option value="1"  >审核通过</option>
         <option value="2"  >审核失败</option>
        </select>
       </td>
      </tr>




      <?php if ($this->_tpl_vars['type'] == 2 || $this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
       <td width="100" align="right">是否可以自主创建任务</td>
       <td>
        <select name="createpro"  class="inpMain">
         <option value="0"  >不允许</option>
         <option value="1"  >允许</option>
        </select>
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">是否可以自主创建任务</td>
       <td>
        <select name="createpro"  class="inpMain">
         <option value="0"  >不允许</option>
         <option value="1"  >允许</option>
        </select>
       </td>
      </tr>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr  style="display: none">
       <td width="100" align="right">签约公司</td>
       <td>
        <select name="company"  class="inpMain">
         <?php $_from = $this->_tpl_vars['company_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cam']):
?>
         <option value="<?php echo $this->_tpl_vars['cam']['company']; ?>
"  ><?php echo $this->_tpl_vars['cam']['company']; ?>
</option>
         <?php endforeach; endif; unset($_from); ?>
        </select>
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">签约公司</td>
       <td>
        <select name="company"  class="inpMain">
         <?php $_from = $this->_tpl_vars['company_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cam']):
?>
         <option value="<?php echo $this->_tpl_vars['cam']['company']; ?>
"  ><?php echo $this->_tpl_vars['cam']['company']; ?>
</option>
         <?php endforeach; endif; unset($_from); ?>
        </select>
       </td>
      </tr>
      <?php endif; ?>


      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['manager_password']; ?>
</td>
       <td>
        <input type="password" name="password" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['manager_password_confirm']; ?>
</td>
       <td>
        <input type="password" name="password_confirm" size="40" class="inpMain" />
       </td>
      </tr>
      <?php if ($this->_tpl_vars['type'] == 1): ?>

      <tr>
       <td width="100" align="right">签约类型</td>
       <td>

        <span id="span1">
          <ul id="content">

          </ul>
          <a class="actionBtn"  style="margin-left: 5px;">添加</a>
        </span>

        <span id="span2" style="display: none">

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

          <a class="actionBtn"  style="margin-left: 5px;">保存</a>
        </span>
       <input type="hidden" id="cat_ids" name="cat_ids" />

       </td>
      </tr>


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
          alert(\'请稍后再试\');
         }
        });
       }

       $("#span1 .actionBtn").click(function(){
        $(this).css("display","none");
        $("#span2").css("display","block");
       });

        $("#span2 .actionBtn").click(function(){
        $("#span2").css("display","none");
        $("#span1 .actionBtn").css("display","block");
        $("#cat_ids").val($("#cat_ids").val()+","+$(\'#category2\').val());
        $("#span1 #content").append("<li class=\'"+$(\'#category2\').val()+"\'>"+$("#category2").find("option:selected").text()+" <a class=\'delBtns\' data-value=\'"+$(\'#category2\').val()+"\' style=\'margin-left: 5px;\'>删除</a></li>");


        });



       $("#content").on("click",".delBtns",function(){
        var id = $(this).attr("data-value");
         $(this).parent().remove();
         var str_ids = $("#cat_ids").val()+",";
         re = new RegExp(","+id+",","g");
         var Newstr = str_ids.replace(re, ",");
         $("#cat_ids").val(Newstr);
        });







       '; ?>

      </script>




      <tr>
       <td width="100" align="right">企业名称</td>
       <td>
        <input type="text" name="enterprise_name"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">费率设置</td>
       <td>
        <input type="text" name="taxrat"  class="inpMain" />%
       </td>
      </tr>


      <tr>
       <td width="100" align="right">社会信用统一代码</td>
       <td>
        <input type="text" name="credit_code"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">营业执照有效期</td>
       <td>
        <input type="text" name="term_validity"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">企业办公地</td>
       <td>
        <input type="text" name="enterprise_addr"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">行业类型</td>
       <td>
        <input type="text" name="industry_type"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">经营范围</td>
       <td>
        <input type="text" name="scope_business"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">法人姓名</td>
       <td>
        <input type="text" name="legal_person"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">证件类型</td>
       <td>
        <input type="text" name="card_type"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">证件号</td>
       <td>
        <input type="text" name="card_no"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">有效期</td>
       <td>
        <input type="text" name="card_time"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">企业联系人姓名</td>
       <td>
        <input type="text" name="contacts_name"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">企业联系人邮箱</td>
       <td>
        <input type="text" name="contacts_email"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">联系方式</td>
       <td>
        <input type="text" name="contacts_tel"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">开户行</td>
       <td>
        <input type="text" name="open_bank"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">开户城市</td>
       <td>
        <input type="text" name="open_bank_city"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">支行名称</td>
       <td>
        <input type="text" name="branch_bank"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">开户公司名称</td>
       <td>
        <input type="text" name="open_company"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">银行账户</td>
       <td>
        <input type="text" name="bank_no"  class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>
      <tr>
       <td></td>
       <td>
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
        <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
       </td>
      </tr>
     </table>
    </form>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'edit'): ?>
    <form action="manager.php?rec=update" method="post">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <td width="100" align="right"><?php echo $this->_tpl_vars['lang']['manager_username']; ?>
</td>
       <td>
        <input type="text" name="user_name" value="<?php echo $this->_tpl_vars['manager_info']['user_name']; ?>
" size="40" class="inpMain" <?php if ($this->_tpl_vars['user']['action_list'] != 'ALL'): ?>readonly="true"<?php endif; ?>/>
       </td>
      </tr>


      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
        <td width="100" align="right">商户简称</td>
       <td>
        <input type="text" name="jc" value="<?php echo $this->_tpl_vars['manager_info']['jc']; ?>
" size="40" class="inpMain"  />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">商户简称</td>
       <td>
        <input type="text" name="jc" value="<?php echo $this->_tpl_vars['manager_info']['jc']; ?>
" size="40" class="inpMain"  />
       </td>
      </tr>
      <?php endif; ?>





      <?php if ($this->_tpl_vars['type'] == 2 || $this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
       <td width="100" align="right">钱包余额</td>
       <td>
        <input type="text" name="amount" size="40"   value="<?php echo $this->_tpl_vars['manager_info']['amount']; ?>
" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">钱包余额</td>
       <td>
        <input type="text" name="amount" size="40"   value="<?php echo $this->_tpl_vars['manager_info']['amount']; ?>
" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>


      <?php if ($this->_tpl_vars['type'] == 2 || $this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
        <td width="100" align="right"><?php echo $this->_tpl_vars['lang']['manager_email']; ?>
</td>
       <td>
        <input type="text" name="email" value="<?php echo $this->_tpl_vars['manager_info']['email']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right"><?php echo $this->_tpl_vars['lang']['manager_email']; ?>
</td>
       <td>
        <input type="text" name="email" value="<?php echo $this->_tpl_vars['manager_info']['email']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr   style="display: none">
       <td width="100" align="right">真实姓名</td>
       <td>
        <input type="text" name="truename" value="<?php echo $this->_tpl_vars['manager_info']['truename']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">真实姓名</td>
       <td>
        <input type="text" name="truename" value="<?php echo $this->_tpl_vars['manager_info']['truename']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>

      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr  style="display: none">
       <td width="100" align="right">身份证</td>
       <td>
        <input type="text" name="card_id" value="<?php echo $this->_tpl_vars['manager_info']['card_id']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">身份证</td>
       <td>
        <input type="text" name="card_id" value="<?php echo $this->_tpl_vars['manager_info']['card_id']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>

      <tr>
       <td width="100" align="right">身份证正面</td>
       <td>
        <img src="<?php echo $this->_tpl_vars['manager_info']['card_pics']; ?>
" width="300px" />
       </td>
      </tr>
      <tr>
       <td width="100" align="right">身份证反面</td>
       <td>
        <img src="<?php echo $this->_tpl_vars['manager_info']['card_pic_backs']; ?>
" width="300px" />
       </td>
      </tr>
      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr  style="display: none">
       <td width="100" align="right">手机号</td>
       <td>
        <input type="text" name="mobile" value="<?php echo $this->_tpl_vars['manager_info']['mobile']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">手机号</td>
       <td>
        <input type="text" name="mobile" value="<?php echo $this->_tpl_vars['manager_info']['mobile']; ?>
" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>

      <tr>
       <td width="100" align="right">类型</td>
       <td>
        <select name="type"  class="inpMain">
         <?php if ($this->_tpl_vars['manager_info']['type'] == 0): ?>
         <option value="0" selected="selected">网站管理员</option>
         <?php else: ?>
         <option value="0"  >网站管理员</option>
         <?php endif; ?>
         <?php if ($this->_tpl_vars['manager_info']['type'] == 3): ?>
         <option value="3" selected="selected">落地团队</option>
         <?php else: ?>
         <option value="3"  >落地团队</option>
         <?php endif; ?>
         <?php if ($this->_tpl_vars['manager_info']['type'] == 1): ?>
         <option value="1" selected="selected">商户端用户</option>
         <?php else: ?>
         <option value="1"  >商户端用户</option>
         <?php endif; ?>
         <?php if ($this->_tpl_vars['manager_info']['type'] == 2): ?>
         <option value="2" selected="selected">工人用户</option>
         <?php else: ?>
         <option value="2"  >工人用户</option>
         <?php endif; ?>
        </select>
       </td>
      <tr>
       <td width="100" align="right">状态</td>
       <td>
        <select name="status"  class="inpMain">

         <?php if ($this->_tpl_vars['manager_info']['status'] == 0): ?>
         <option value="0"  selected="selected">待审核</option>
         <?php else: ?>
         <option value="0"  >待审核</option>
         <?php endif; ?>


         <?php if ($this->_tpl_vars['manager_info']['status'] == 1): ?>
         <option value="1"   selected="selected">审核通过</option>
          <?php else: ?>
         <option value="1"  >审核通过</option>
         <?php endif; ?>

         <?php if ($this->_tpl_vars['manager_info']['status'] == 2): ?>
         <option value="2"   selected="selected">审核失败</option>
          <?php else: ?>
         <option value="2"  >审核失败</option>
         <?php endif; ?>


        </select>
       </td>
      </tr>

      <?php if ($this->_tpl_vars['type'] == 2): ?>
      <tr>
       <td width="100" align="right">所处阶段</td>
       <td>
        <?php echo $this->_tpl_vars['manager_info']['stage']; ?>

       </td>
      </tr>
      <?php endif; ?>


      <?php if ($this->_tpl_vars['type'] == 2 || $this->_tpl_vars['type'] == 3): ?>
      <tr style="display: none">
       <td width="100" align="right">是否允许自主创建任务</td>
       <td>
        <select name="createpro"  class="inpMain">

         <?php if ($this->_tpl_vars['manager_info']['createpro'] == 0): ?>
         <option value="0"  selected="selected">不允许</option>
         <?php else: ?>
         <option value="0"  >不允许</option>
         <?php endif; ?>


         <?php if ($this->_tpl_vars['manager_info']['createpro'] == 1): ?>
         <option value="1"   selected="selected">允许</option>
         <?php else: ?>
         <option value="1"  >允许</option>
         <?php endif; ?>

        </select>
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">是否允许自主创建任务</td>
       <td>
        <select name="createpro"  class="inpMain">

         <?php if ($this->_tpl_vars['manager_info']['createpro'] == 0): ?>
         <option value="0"  selected="selected">不允许</option>
         <?php else: ?>
         <option value="0"  >不允许</option>
         <?php endif; ?>


         <?php if ($this->_tpl_vars['manager_info']['createpro'] == 1): ?>
         <option value="1"   selected="selected">允许</option>
         <?php else: ?>
         <option value="1"  >允许</option>
         <?php endif; ?>

        </select>
       </td>
      </tr>
      <?php endif; ?>


      <?php if ($this->_tpl_vars['type'] == 3): ?>
      <tr  style="display: none">
       <td width="100" align="right">签约公司</td>
       <td>
        <select name="company" class="inpMain">
         <option value="" selected="selected">请选择公司主体</option>
         <?php $_from = $this->_tpl_vars['company_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cam']):
?>
         <?php if ($this->_tpl_vars['manager_info']['company'] == $this->_tpl_vars['cam']['company']): ?>
         <option value="<?php echo $this->_tpl_vars['cam']['company']; ?>
" selected="selected"><?php echo $this->_tpl_vars['cam']['company']; ?>
</option>
         <?php else: ?>
         <option value="<?php echo $this->_tpl_vars['cam']['company']; ?>
"  ><?php echo $this->_tpl_vars['cam']['company']; ?>
</option>
         <?php endif; ?>
         <?php endforeach; endif; unset($_from); ?>


        </select>
       </td>
      </tr>
      <?php else: ?>
      <tr>
       <td width="100" align="right">签约公司</td>
       <td>
        <select name="company" class="inpMain">
         <option value="" selected="selected">请选择公司主体</option>
         <?php $_from = $this->_tpl_vars['company_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cam']):
?>
         <?php if ($this->_tpl_vars['manager_info']['company'] == $this->_tpl_vars['cam']['company']): ?>
         <option value="<?php echo $this->_tpl_vars['cam']['company']; ?>
" selected="selected"><?php echo $this->_tpl_vars['cam']['company']; ?>
</option>
         <?php else: ?>
         <option value="<?php echo $this->_tpl_vars['cam']['company']; ?>
"  ><?php echo $this->_tpl_vars['cam']['company']; ?>
</option>
         <?php endif; ?>
         <?php endforeach; endif; unset($_from); ?>


        </select>
       </td>
      </tr>
      <?php endif; ?>


       <?php if ($this->_tpl_vars['if_check']): ?>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['manager_old_password']; ?>
</td>
       <td>
        <input type="password" name="old_password" size="40" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['manager_new_password']; ?>
</td>
       <td>
        <input type="password" name="password" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td align="right"><?php echo $this->_tpl_vars['lang']['manager_new_password_confirm']; ?>
</td>
       <td>
        <input type="password" name="password_confirm" size="40" class="inpMain" />
       </td>
      </tr>


      <?php if ($this->_tpl_vars['type'] == 1): ?>

      <tr>
      <tr>
       <td width="100" align="right">签约类型</td>
       <td>

        <span id="span1">
          <ul id="content">
            <?php $_from = $this->_tpl_vars['select_cat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['cate']):
?>
           <li class='<?php echo $this->_tpl_vars['cate']['id']; ?>
'> <?php echo $this->_tpl_vars['cate']['name']; ?>
<a class='delBtns' data-value='<?php echo $this->_tpl_vars['cate']['id']; ?>
' style='margin-left: 5px;'>删除</a></li>
           <?php endforeach; endif; unset($_from); ?>
          </ul>
          <a class="actionBtn"  style="margin-left: 5px;">添加</a>
        </span>

        <span id="span2" style="display: none">

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

          <a class="actionBtn"  style="margin-left: 5px;">保存</a>
        </span>
        <input type="hidden" id="cat_ids" name="cat_ids" value="<?php echo $this->_tpl_vars['manager_info']['cat_ids']; ?>
" />

       </td>
      </tr>


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
          alert(\'请稍后再试\');
         }
        });
       }

       $("#span1 .actionBtn").click(function(){
        $(this).css("display","none");
        $("#span2").css("display","block");
       });

       $("#span2 .actionBtn").click(function(){
        $("#span2").css("display","none");
        $("#span1 .actionBtn").css("display","block");
        $("#cat_ids").val($("#cat_ids").val()+","+$(\'#category2\').val());
        $("#span1 #content").append("<li class=\'"+$(\'#category2\').val()+"\'>"+$("#category2").find("option:selected").text()+" <a class=\'delBtns\' data-value=\'"+$(\'#category2\').val()+"\' style=\'margin-left: 5px;\'>删除</a></li>");


       });



       $("#content").on("click",".delBtns",function(){
        var id = $(this).attr("data-value");
        $(this).parent().remove();
        var str_ids = $("#cat_ids").val()+",";
        re = new RegExp(","+id+",","g");
        var Newstr = str_ids.replace(re, ",");
        $("#cat_ids").val(Newstr);
       });







       '; ?>

      </script>



      <tr>
       <td width="100" align="right">费率</td>
       <td>
        <input type="text" name="taxrat"  value="<?php echo $this->_tpl_vars['manager_info']['taxrat']; ?>
"  class="inpMain" />%
       </td>
      </tr>

      <tr>
       <td width="100" align="right">企业名称</td>
       <td>
        <input type="text" name="enterprise_name"  value="<?php echo $this->_tpl_vars['enterprise_info']['enterprise_name']; ?>
"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">社会信用统一代码</td>
       <td>
        <input type="text" name="credit_code" value="<?php echo $this->_tpl_vars['enterprise_info']['credit_code']; ?>
"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">营业执照有效期</td>
       <td>
        <input type="text" name="term_validity"  value="<?php echo $this->_tpl_vars['enterprise_info']['term_validity']; ?>
" class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">企业办公地</td>
       <td>
        <input type="text" name="enterprise_addr" value="<?php echo $this->_tpl_vars['enterprise_info']['enterprise_addr']; ?>
"   class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">行业类型</td>
       <td>
        <input type="text" name="industry_type"  value="<?php echo $this->_tpl_vars['enterprise_info']['industry_type']; ?>
" class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">经营范围</td>
       <td>
        <input type="text" name="scope_business"   value="<?php echo $this->_tpl_vars['enterprise_info']['scope_business']; ?>
"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">法人姓名</td>
       <td>
        <input type="text" name="legal_person"   value="<?php echo $this->_tpl_vars['enterprise_info']['legal_person']; ?>
" class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">证件类型</td>
       <td>
        <input type="text" name="card_type" value="<?php echo $this->_tpl_vars['enterprise_info']['card_type']; ?>
"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">证件号</td>
       <td>
        <input type="text" name="card_no" value="<?php echo $this->_tpl_vars['enterprise_info']['card_no']; ?>
"   class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">有效期</td>
       <td>
        <input type="text" name="card_time" value="<?php echo $this->_tpl_vars['enterprise_info']['card_time']; ?>
"   class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">企业联系人姓名</td>
       <td>
        <input type="text" name="contacts_name"  value="<?php echo $this->_tpl_vars['enterprise_info']['contacts_name']; ?>
" class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">企业联系人邮箱</td>
       <td>
        <input type="text" name="contacts_email" value="<?php echo $this->_tpl_vars['enterprise_info']['contacts_email']; ?>
"  class="inpMain" />
       </td>
      </tr>


      <tr>
       <td width="100" align="right">联系方式</td>
       <td>
        <input type="text" name="contacts_tel" value="<?php echo $this->_tpl_vars['enterprise_info']['contacts_tel']; ?>
"   class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">开户行</td>
       <td>
        <input type="text" name="open_bank"  value="<?php echo $this->_tpl_vars['enterprise_info']['open_bank']; ?>
"   class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">开户城市</td>
       <td>
        <input type="text" name="open_bank_city" value="<?php echo $this->_tpl_vars['enterprise_info']['open_bank_city']; ?>
"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">支行名称</td>
       <td>
        <input type="text" name="branch_bank" value="<?php echo $this->_tpl_vars['enterprise_info']['branch_bank']; ?>
"  class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">开户公司名称</td>
       <td>
        <input type="text" name="open_company"  value="<?php echo $this->_tpl_vars['enterprise_info']['open_company']; ?>
" class="inpMain" />
       </td>
      </tr>

      <tr>
       <td width="100" align="right">银行账户</td>
       <td>
        <input type="text" name="bank_no"   value="<?php echo $this->_tpl_vars['enterprise_info']['bank_no']; ?>
" class="inpMain" />
       </td>
      </tr>
      <?php endif; ?>


      <tr>
       <td></td>
       <td>
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['manager_info']['user_id']; ?>
" />
        <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
       </td>
      </tr>
     </table>
    </form>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'manager_log'): ?>
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
     <tr>
      <th width="30" align="center"><?php echo $this->_tpl_vars['lang']['record_id']; ?>
</th>
      <th width="150" align="left"><?php echo $this->_tpl_vars['lang']['manager_log_create_time']; ?>
</th>
      <th width="100" align="center"><?php echo $this->_tpl_vars['lang']['manager_log_user_name']; ?>
</th>
      <th align="left"><?php echo $this->_tpl_vars['lang']['manager_log_action']; ?>
</th>
      <th width="100" align="center"><?php echo $this->_tpl_vars['lang']['manager_log_ip']; ?>
</th>
     </tr>
     <?php $_from = $this->_tpl_vars['log_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['log_list']):
?>
     <tr>
      <td align="center"><?php echo $this->_tpl_vars['log_list']['id']; ?>
</td>
      <td><?php echo $this->_tpl_vars['log_list']['create_time']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['log_list']['user_name']; ?>
</td>
      <td align="left"><?php echo $this->_tpl_vars['log_list']['action']; ?>
</td>
      <td align="center"><?php echo $this->_tpl_vars['log_list']['ip']; ?>
</td>
     </tr>
     <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pager.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['rec'] == 'uploadworker'): ?>
    <h3>上传工人模板</h3>
    <form action="manager.php?rec=uploadworker_post"method="post" enctype="multipart/form-data">
     <div class="formBasic">
      <dl>
       <dt>上传文件</dt>
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
   </div>
 </div>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 </div>
</body>
</html>