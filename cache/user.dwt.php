<?php /* Smarty version 2.6.26, created on 2019-12-25 14:17:51
         compiled from user.dwt */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
" />
<meta name="generator" content="DouPHP v1.3" />
<title><?php echo $this->_tpl_vars['page_title']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['site']['root_url']; ?>
favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="http://58.banyar.cn/theme/default/style.css" rel="stylesheet" type="text/css" />
<link href="http://58.banyar.cn/theme/default/user.css" rel="stylesheet" type="text/css" />
<script>var root_url = "<?php echo $this->_tpl_vars['site']['root_url']; ?>
";</script> 
<script type="text/javascript" src="http://58.banyar.cn/theme/default/images/jquery.min.js"></script>
<script type="text/javascript" src="http://58.banyar.cn/theme/default/images/global.js"></script>
<script type="text/javascript" src="http://58.banyar.cn/theme/default/images/user.js"></script>
<script src="http://58.banyar.cn/theme/default/images/laydate/laydate.js"></script>

</head>
<body>
<div id="wrapper"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <div class="wrap mb">
  <div id="user"> 
   <?php if ($this->_tpl_vars['rec'] == 'login' || $this->_tpl_vars['rec'] == 'register' || $this->_tpl_vars['rec'] == 'password_reset'): ?>
   <div class="passport"> 
    <?php if ($this->_tpl_vars['rec'] == 'register'): ?>
    <div class="register">
     <h3><?php echo $this->_tpl_vars['lang']['user_register']; ?>
<em><?php echo $this->_tpl_vars['lang']['user_register_cue_0']; ?>
<?php echo $this->_tpl_vars['site']['site_name']; ?>
<?php echo $this->_tpl_vars['lang']['user_register_cue_1']; ?>
 <a href="<?php echo $this->_tpl_vars['url']['login']; ?>
"><?php echo $this->_tpl_vars['lang']['user_register_login']; ?>
</a></em></h3>
     <form id="register" action="<?php echo $this->_tpl_vars['url']['register_post']; ?>
" method="post" enctype="multipart/form-data">
      <div class="tableDiv">
       <dl>
        <dt>用户名<i>*</i>（字母开头，由字母数字下划线组成，长度4~20）</dt>
        <dd>
         <input name="user_name" type="text" class="textInput" value="<?php echo $this->_tpl_vars['post']['user_name']; ?>
" size="36" />
         <p id="user_name" class="cue"></p></dd>
       </dl>

       <dl>
       <dt>身份证号<i>*</i></dt>
       <dd>
        <input name="card_id" type="text" class="textInput" value="<?php echo $this->_tpl_vars['post']['card_id']; ?>
" size="36" />
        <p id="card_id" class="cue"></p></dd>
      </dl>
      <dl>
          <dt>身份证正面</dt>
          <dd>
           <div class="inputFile">
            <p id="card_idShow" class="imgShow" style="width: 108px;">
            </p>
            <input type="file" name="card_idShow" id="card_idClick" style="display: none" />
            <input type="hidden" name="card_idCheck" id="card_idValue" value="" />
            <input type="button" value="上传身份证正面照片" class="imgBtncard" />
           </div>
           <p id="card_idCheck" class="cue"></p>
          </dd>
         </dl>
       <dl>
       <dl>
         <dt>身份证反面</dt>
         <dd>
          <div class="inputFile">
           <p id="card_idbackShow" class="imgShow" style="width: 108px;">
           </p>
           <input type="file" name="card_idbackShow" id="card_idbackClick" style="display: none" />
           <input type="hidden" name="card_idbackCheck" id="card_idbackValue" value="" />
           <input type="button" value="上传身份证反面照片" class="imgBtncardback" />
          </div>
          <p id="card_idbackCheck" class="cue"></p>
         </dd>
        </dl>
      <dl>
         <dt>手机号<i>*</i></dt>
         <dd>
          <input name="mobile" id="mobile" type="text" class="textInput" value="<?php echo $this->_tpl_vars['post']['mobile']; ?>
" size="36" />
          <a href="javascript:;" class ="sendcodetext btn" style="width:100px;" onclick="douSendSms('/user.php?rec=sendcode',$('#mobile').val())">发送验证码</a>
          <p id="mobile" class="cue"></p></dd>
        </dl>
        <dt>验证码<i>*</i></dt>
           <dd>
            <input name="vcode" type="text" class="textInput" value="" size="36" />
            <input name="vcode_return" id="vcode_return" type="hidden" class="textInput" value="" size="4" />
            <p id="vcode" class="cue"></p></dd>
          </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_password']; ?>
<i>*</i></dt>
        <dd>
         <input name="password" type="password" class="textInput" size="36" />
         <p id="password" class="cue"></p></dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_password_confirm']; ?>
<i>*</i></dt>
        <dd>
         <input name="password_confirm" type="password" class="textInput" size="36" />
         <p id="password_confirm" class="cue"></p></dd>
       </dl>
       <dl>
        <dt>&nbsp;</dt>
        <dd>
         <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />

         <input type="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['user_register_btn']; ?>
" onclick="$('#reigister').submit();" />
        </dd>
       </dl>
      </div>
     </form>
    </div>
    <?php endif; ?> 
    <?php if ($this->_tpl_vars['rec'] == 'login'): ?>
    <div class="login">
     <h3><?php echo $this->_tpl_vars['lang']['user_login']; ?>
<em><?php echo $this->_tpl_vars['lang']['user_login_cue']; ?>
</em></h3>
     <form action="<?php echo $this->_tpl_vars['url']['login_post']; ?>
" method="post">
      <div class="tableDiv">
       <dl>
        <input type="text" name="user_name" class="textInput" />
       </dl>
       <dl>
        <input type="password" name="password" class="textInput" />
       </dl>
       <dl>
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
         <input type="hidden" name="return_url" value="<?php echo $this->_tpl_vars['return_url']; ?>
" />
        <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['user_login_btn']; ?>
" />
       </dl>
       <dl>
               </dl>
       <dl>
        <a href="<?php echo $this->_tpl_vars['url']['register']; ?>
" class="btnRegister"><?php echo $this->_tpl_vars['lang']['user_register']; ?>
</a>
       </dl>
      </div>
    <div class="snsIcon">
        <?php $_from = $this->_tpl_vars['connect_plugin_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plugin']):
?>
        <a href="<?php echo $this->_tpl_vars['plugin']['url']; ?>
" title="<?php echo $this->_tpl_vars['plugin']['name']; ?>
" style="background: #19B4EA url(<?php echo $this->_tpl_vars['plugin']['icon']; ?>
) no-repeat 50% 50%;"></a>
        <?php endforeach; endif; unset($_from); ?>
      </div>
     </form>
    </div>
    <?php endif; ?> 
    <?php if ($this->_tpl_vars['rec'] == 'password_reset'): ?>
    <div class="login">
     <?php if ($this->_tpl_vars['action'] == 'default'): ?>
     <h3><?php echo $this->_tpl_vars['lang']['user_password_reset']; ?>
<em><?php echo $this->_tpl_vars['lang']['user_password_reset_cue']; ?>
</em></h3>
     <form action="<?php echo $this->_tpl_vars['url']['password_reset_post']; ?>
" method="post">
      <div class="tableDiv">
       <dl>
        <input type="text" name="email" class="textInput" />
       </dl>
       <?php if ($this->_tpl_vars['site']['captcha']): ?>
       <dl>
        <input name="captcha" type="text" class="textArea captcha" size="10">
        <img id="vcode" class="pointer" src="<?php echo $this->_tpl_vars['site']['root_url']; ?>
captcha.php" alt="<?php echo $this->_tpl_vars['lang']['captcha']; ?>
" border="1" onClick="refreshimage()" title="<?php echo $this->_tpl_vars['lang']['captcha_refresh']; ?>
">
       </dl>
       <?php endif; ?> 
       <dl>
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
        <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['user_password_reset_btn']; ?>
" />
       </dl>
      </div>
     </form>
     <?php elseif ($this->_tpl_vars['action'] == 'reset'): ?>
     <h3><?php echo $this->_tpl_vars['lang']['user_password_reset_password']; ?>
</h3>
     <form action="<?php echo $this->_tpl_vars['url']['password_reset_post']; ?>
" method="post">
      <div class="tableDiv">
       <dl>
        <?php echo $this->_tpl_vars['lang']['user_password']; ?>
<input type="password" name="password" class="textInput" />
       </dl>
       <dl>
        <?php echo $this->_tpl_vars['lang']['user_password_confirm']; ?>
<input type="password" name="password_confirm" class="textInput" />
       </dl>
       <dl>
        <input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
" />
        <input type="hidden" name="code" value="<?php echo $this->_tpl_vars['code']; ?>
" />
        <input type="hidden" name="action" value="reset" />
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
        <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
       </dl>
      </div>
     </form>
     <?php endif; ?>
    </div>
    <?php endif; ?>
				<?php if ($this->_tpl_vars['rec'] == 'sns_link'): ?>
				<div class="snsLink">
					<div class="head"><?php echo $this->_tpl_vars['lang']['user_sns']; ?>
</div>
					<div class="img"><img src="<?php echo $this->_tpl_vars['sns']['avatar']; ?>
" /></div>
					<div><?php echo $this->_tpl_vars['sns']['nickname']; ?>
</div>
					<div class="action">
						<a href="<?php echo $this->_tpl_vars['url_register']; ?>
" class="btn"><?php echo $this->_tpl_vars['lang']['user_sns_new_account']; ?>
</a>
						<a href="<?php echo $this->_tpl_vars['url_login']; ?>
" class="btnGray"><?php echo $this->_tpl_vars['lang']['user_sns_old_account']; ?>
</a>
					</div>
				</div>
				<?php endif; ?>
   </div>
   <?php else: ?>
   <div class="userLeft"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/user_tree.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
   <div class="userIn">
    <div class="main"> 
     <?php if ($this->_tpl_vars['rec'] == 'default'): ?>
     <div class="startPage">
      <div class="basicInfo">
       <div class="basic">
        <h2><?php echo $this->_tpl_vars['global_user']['user_name']; ?>
</h2>
        <p><?php echo $this->_tpl_vars['welcome']; ?>
</p>
        <a class="link" href="<?php echo $this->_tpl_vars['url']['edit']; ?>
"><?php echo $this->_tpl_vars['lang']['user_modify_edit']; ?>
 &gt;</a>
        <img class="avatar" src="<?php echo $this->_tpl_vars['user_info']['avatar']; ?>
" width="120" height="120" alt="<?php echo $this->_tpl_vars['user']['user_name']; ?>
">
       </div>
       <ul class="info">
        <li><?php echo $this->_tpl_vars['lang']['user_email']; ?>
：<b><?php echo $this->_tpl_vars['user_info']['email']; ?>
</b></li>
        <li><?php echo $this->_tpl_vars['lang']['user_telphone']; ?>
：<b><?php echo $this->_tpl_vars['user_info']['telphone']; ?>
</b></li>
        <li><?php echo $this->_tpl_vars['lang']['user_sn']; ?>
：<b><?php echo $this->_tpl_vars['user_info']['user_sn']; ?>
</b></li>
        <li><?php echo $this->_tpl_vars['lang']['user_last_login']; ?>
：<b><?php echo $this->_tpl_vars['user_info']['last_login']; ?>
</b></li>
        <li><?php echo $this->_tpl_vars['lang']['user_last_ip']; ?>
：<b><?php echo $this->_tpl_vars['user_info']['last_ip']; ?>
</b></li>
        <li><?php echo $this->_tpl_vars['lang']['user_login_count']; ?>
：<b><?php echo $this->_tpl_vars['user_info']['login_count']; ?>
</b></li>
       </ul>
      </div>
     </div>
     <?php endif; ?> 
     <?php if ($this->_tpl_vars['rec'] == 'edit'): ?>
     <h3><?php echo $this->_tpl_vars['lang']['user_edit']; ?>
</h3>
     <form id="userEdit" action="<?php echo $this->_tpl_vars['url']['edit_post']; ?>
" method="post" enctype="multipart/form-data">
      <div class="tableDiv">
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_contact']; ?>
<i>*</i></td>
        <dd><input name="contact" type="text" class="textInput" value="<?php echo $this->_tpl_vars['user_info']['contact']; ?>
" size="55" />
         <p id="contact" class="cue"></p></dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_telphone']; ?>
<i>*</i></dt>
        <dd><input name="telphone" type="text" class="textInput" value="<?php echo $this->_tpl_vars['user_info']['telphone']; ?>
" size="55" />
         <p id="telphone" class="cue"></p></dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_address']; ?>
</dt>
        <dd><input name="address" type="text" class="textInput" value="<?php echo $this->_tpl_vars['user_info']['address']; ?>
" size="80" />
         <p id="address" class="cue"></p></dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_postcode']; ?>
</dt>
        <dd><input name="postcode" type="text" class="textInput" value="<?php echo $this->_tpl_vars['user_info']['postcode']; ?>
" size="55" />
         <p id="postcode" class="cue"></p></dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_sex']; ?>
</dt>
        <dd><label for="sex_1">
          <input type="radio" name="sex" id="sex_1" value="1"<?php if ($this->_tpl_vars['user_info']['sex'] == '1'): ?> checked="true"<?php endif; ?>>
          <?php echo $this->_tpl_vars['lang']['user_man']; ?>
</label>
         <label for="sex_0">
          <input type="radio" name="sex" id="sex_0" value="0"<?php if ($this->_tpl_vars['user_info']['sex'] == '0'): ?> checked="true"<?php endif; ?>>
          <?php echo $this->_tpl_vars['lang']['user_woman']; ?>
</label>
         <?php echo $this->_tpl_vars['wrong']['sex']; ?>
</dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_avatar']; ?>
</dt>
        <dd>
         <div class="inputFile">
          <p id="avatarShow" class="imgShow">
           <?php if ($this->_tpl_vars['user_info']['avatar']): ?>
           <img src="<?php echo $this->_tpl_vars['user_info']['avatar']; ?>
" />
           <?php endif; ?>
          </p>
          <input type="file" name="avatar" id="avatarClick" style="display: none" />
          <input type="hidden" name="avatarCheck" id="avatarValue" value="<?php echo $this->_tpl_vars['user_info']['avatar']; ?>
" />
          <input type="button" value="<?php echo $this->_tpl_vars['lang']['user_avatar_upload']; ?>
" class="imgBtn" />
         </div>
         <p id="avatarCheck" class="cue"></p>
        </dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_nickname']; ?>
</dt>
        <dd><input name="nickname" type="text" class="textInput" value="<?php echo $this->_tpl_vars['user_info']['nickname']; ?>
" size="55" />
         <p id="nickname" class="cue"></p></dd>
       </dl>
       <?php if ($this->_tpl_vars['user_info']['defined']): ?>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_defined']; ?>
</dt>
        <dd><textarea name="defined" id="defined" cols="58" class="textAreaAuto" style="height:<?php echo $this->_tpl_vars['user_info']['defined_count']; ?>
0px"><?php echo $this->_tpl_vars['user_info']['defined']; ?>
</textarea>
        <script type="text/javascript" src="http://58.banyar.cn/theme/default/images/jquery.autotextarea.js"></script>
        <script type="text/javascript">
         <?php echo '
         $("#defined").autoTextarea({maxHeight:300});
         '; ?>

        </script></dd>
       </dl>
       <?php endif; ?>
       <dl>
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
        <input type="button" class="btn" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" onclick="douSubmit('userEdit')"/>
       </dl>
      </div>
     </form>
     <?php endif; ?> 
     <?php if ($this->_tpl_vars['rec'] == 'password'): ?>
     <h3><?php echo $this->_tpl_vars['lang']['user_password_edit']; ?>
</h3>
     <form action="<?php echo $this->_tpl_vars['url']['password_post']; ?>
" method="post">
      <div class="tableDiv">
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_old_password']; ?>
<i>*</i></dt>
        <dd><input name="old_password" type="password" class="textInput" size="40" /></dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_password']; ?>
<i>*</i></dt>
        <dd><input name="password" type="password" class="textInput" size="40" /></dd>
       </dl>
       <dl>
        <dt><?php echo $this->_tpl_vars['lang']['user_password_confirm']; ?>
<i>*</i></dt>
        <dd><input name="password_confirm" type="password" class="textInput" size="40" /></dd>
       </dl>
       <dl>
        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
        <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
       </dl>
      </div>
     </form>
     <?php endif; ?>
					<?php if ($this->_tpl_vars['rec'] == 'sns'): ?>
					<h3><?php echo $this->_tpl_vars['lang']['user_sns']; ?>
</h3>
					<div class="snsList">
						<?php $_from = $this->_tpl_vars['plugin_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plugin']):
?>
						<dl>
							<dt><i style="background: #19B4EA url(<?php echo $this->_tpl_vars['plugin']['icon']; ?>
) no-repeat 50% 50%;"></i><?php echo $this->_tpl_vars['plugin']['name']; ?>
 <?php if ($this->_tpl_vars['plugin']['linked']): ?><em><?php echo $this->_tpl_vars['lang']['user_sns_linked']; ?>
</em><?php endif; ?></dt>
							<dd>
								<?php if ($this->_tpl_vars['plugin']['linked']): ?>
								<a href="<?php echo $this->_tpl_vars['url']['sns']; ?>
&remove=<?php echo $this->_tpl_vars['plugin']['unique_id']; ?>
"><?php echo $this->_tpl_vars['lang']['user_sns_remove']; ?>
</a>
								<?php else: ?>
								<a href="<?php echo $this->_tpl_vars['url']['sns']; ?>
&link=<?php echo $this->_tpl_vars['plugin']['unique_id']; ?>
"><?php echo $this->_tpl_vars['lang']['user_sns_link']; ?>
</a>
								<?php endif; ?>
							</dd>
						</dl>
						<?php endforeach; endif; unset($_from); ?>
					</div>
					<?php endif; ?> 
     <?php if ($this->_tpl_vars['rec'] == 'order_list'): ?>
     <h3><?php echo $this->_tpl_vars['lang']['order_my']; ?>
</h3>
     <div class="orderList">
      <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
      <div class="item">
       <div class="status"><?php echo $this->_tpl_vars['order']['status_format']; ?>
</div>
       <table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail">
        <tr>
         <td class="info"><em><?php echo $this->_tpl_vars['order']['add_time']; ?>
</em><em><?php echo $this->_tpl_vars['order']['contact']; ?>
</em><em><?php echo $this->_tpl_vars['lang']['order_sn']; ?>
：<a href="<?php echo $this->_tpl_vars['url']['order']; ?>
&order_sn=<?php echo $this->_tpl_vars['order']['order_sn']; ?>
"><?php echo $this->_tpl_vars['order']['order_sn']; ?>
</a></em></td>
         <td class="amount"><?php echo $this->_tpl_vars['lang']['order_order_amount']; ?>
：<b><?php echo $this->_tpl_vars['order']['order_amount_format']; ?>
</b></td>
        </tr>
        <tr>
         <td class="list">
          <div class="listBox">
           <?php $_from = $this->_tpl_vars['order']['item_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
           <dl>
            <div class="img"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
" target="_blank"><img title="<?php echo $this->_tpl_vars['item']['name']; ?>
" src="<?php echo $this->_tpl_vars['item']['thumb']; ?>
" width="60" /></a></div>
            <dt><?php echo $this->_tpl_vars['item']['name']; ?>
</dt>
            <dd><?php echo $this->_tpl_vars['item']['price']; ?>
 x <?php echo $this->_tpl_vars['item']['item_number']; ?>
</dd>
           </dl>
           <?php endforeach; endif; unset($_from); ?>
          </div>
         </td>
         <td class="action btnAction">
          <a href="<?php echo $this->_tpl_vars['url']['order']; ?>
&order_sn=<?php echo $this->_tpl_vars['order']['order_sn']; ?>
"><?php echo $this->_tpl_vars['lang']['order_view']; ?>
</a>
          <?php if ($this->_tpl_vars['order']['status'] == '0'): ?>
										<?php if ($this->_tpl_vars['order']['cashier_url']): ?>
										<a href="<?php echo $this->_tpl_vars['order']['cashier_url']; ?>
" class="pay"><?php echo $this->_tpl_vars['lang']['order_payment_btn']; ?>
</a>
										<?php endif; ?>
          <a href="javascript:;" onclick="douConfirm('<?php echo $this->_tpl_vars['url']['order_cancel']; ?>
&order_sn=<?php echo $this->_tpl_vars['order']['order_sn']; ?>
', '<?php echo $this->_tpl_vars['lang']['order_cancel_confirm']; ?>
')"><?php echo $this->_tpl_vars['lang']['order_cancel']; ?>
</a>
          <?php endif; ?>
         </td>
        </tr>
       </table>
      </div>
      <?php endforeach; endif; unset($_from); ?>
     </div>
     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
     <?php endif; ?> 
     <?php if ($this->_tpl_vars['rec'] == 'order'): ?>
     <h3><?php echo $this->_tpl_vars['lang']['order_view']; ?>
</h3>
     <div class="order">
						<div class="head">
							<div class="title">
								<h2><?php echo $this->_tpl_vars['lang']['order_sn']; ?>
：<?php echo $this->_tpl_vars['order']['order_sn']; ?>
</h2>
								<div class="action btnAction">
									<?php if ($this->_tpl_vars['order']['status'] == '0'): ?>
									<?php if ($this->_tpl_vars['order']['cashier_url']): ?>
									<a href="<?php echo $this->_tpl_vars['order']['cashier_url']; ?>
" class="pay"><?php echo $this->_tpl_vars['lang']['order_payment_btn']; ?>
</a>
									<?php endif; ?>
									<a href="javascript:;" onclick="douConfirm('<?php echo $this->_tpl_vars['url']['order_cancel']; ?>
&order_sn=<?php echo $this->_tpl_vars['order']['order_sn']; ?>
', '<?php echo $this->_tpl_vars['lang']['order_cancel_confirm']; ?>
')"><?php echo $this->_tpl_vars['lang']['order_cancel']; ?>
</a>
									<?php endif; ?>
								</div>
							</div>
							<div class="subTitle">
								<span><?php echo $this->_tpl_vars['lang']['order_status']; ?>
：<?php echo $this->_tpl_vars['order']['status_format']; ?>
</span><span><?php echo $this->_tpl_vars['lang']['order_add_time']; ?>
：<?php echo $this->_tpl_vars['order']['add_time']; ?>
</span>
							</div>
						</div>
						<table class="itemList">
       <?php $_from = $this->_tpl_vars['order']['item_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
       <tr>
								<td width="60"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
" target="_blank"><img title="<?php echo $this->_tpl_vars['item']['name']; ?>
" src="<?php echo $this->_tpl_vars['item']['thumb']; ?>
" width="60" /></a></td>
        <td><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['name']; ?>
</a></td>
        <td align="center"><?php echo $this->_tpl_vars['item']['price']; ?>
 x <?php echo $this->_tpl_vars['item']['item_number']; ?>
</td>
       </tr>
       <?php endforeach; endif; unset($_from); ?>
      </table>
						<div class="info">
							<h2><?php echo $this->_tpl_vars['lang']['order_consignee']; ?>
</h2>
							<ul>
								<li><?php echo $this->_tpl_vars['lang']['order_contact']; ?>
：<?php echo $this->_tpl_vars['order']['contact']; ?>
</li>
								<li><?php echo $this->_tpl_vars['lang']['order_telphone']; ?>
：<?php echo $this->_tpl_vars['order']['telphone']; ?>
</li>
								<li><?php echo $this->_tpl_vars['lang']['order_postcode']; ?>
：<?php echo $this->_tpl_vars['order']['postcode']; ?>
</li>
								<li><?php echo $this->_tpl_vars['lang']['order_address']; ?>
：<?php echo $this->_tpl_vars['order']['address']; ?>
</li>
							</ul>
						</div>
						<?php if ($this->_tpl_vars['order']['pay_name']): ?>
						<div class="info">
							<h2><?php echo $this->_tpl_vars['lang']['order_payment']; ?>
</h2>
							<ul>
								<li><?php echo $this->_tpl_vars['order']['pay_name']; ?>
</li>
							</ul>
						</div>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['order']['shipping_id']): ?>
						<div class="info">
							<h2><?php echo $this->_tpl_vars['lang']['order_payment']; ?>
</h2>
							<ul>
								<li><?php echo $this->_tpl_vars['lang']['order_shipping']; ?>
：<?php echo $this->_tpl_vars['order']['shipping_name']; ?>
</li>
								<li><?php echo $this->_tpl_vars['lang']['order_tracking_no']; ?>
：<?php if ($this->_tpl_vars['order']['tracking_no']): ?><?php echo $this->_tpl_vars['order']['tracking_no']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['order_undelivered']; ?>
<?php endif; ?></li>
							</ul>
						</div>
						<?php endif; ?>
						<div class="totalAmount">
							<?php echo $this->_tpl_vars['lang']['order_item_amount']; ?>
：<b class="price"><?php echo $this->_tpl_vars['order']['item_amount_format']; ?>
</b><br />
							<?php if ($this->_tpl_vars['order']['shipping_id']): ?>
							<?php echo $this->_tpl_vars['lang']['order_shipping_fee']; ?>
：<b class="price"><?php echo $this->_tpl_vars['order']['shipping_fee_format']; ?>
</b><br />
							<?php endif; ?>
							<?php echo $this->_tpl_vars['lang']['order_order_amount']; ?>
：<b class="price"><?php echo $this->_tpl_vars['order']['order_amount_format']; ?>
</b>
						</div>
     </div>
     <?php endif; ?>

     <?php if ($this->_tpl_vars['rec'] == 'list'): ?>
          <h3>我的任务<span style="font-size:18px; color:#ff8103 ">&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $this->_tpl_vars['count']; ?>
)</span><span style="float:right;  font-size:15px; "><a href="/user.php?rec=addlist" target="_blank">添加任务</a></span></h3>
          <div class="orderList">
           <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
           <div class="item">
            <div class="status" >
            <?php if ($this->_tpl_vars['order']['pay_status'] == 0 && $this->_tpl_vars['order']['status'] == 0): ?> <span style="color:#ff8103">未支付</span><?php endif; ?>
            <?php if ($this->_tpl_vars['order']['pay_status'] == 1 && $this->_tpl_vars['order']['status'] == 0): ?> <span style="color:#00ec00">进行中</span><?php endif; ?>
             <?php if ($this->_tpl_vars['order']['status'] == 1): ?><span style="color:#0080ff"> 已完成</span><?php endif; ?>
            </div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail">
             <tr>
              <td class="info" style=" border-bottom: none;"><em><?php echo $this->_tpl_vars['order']['add_time']; ?>
</em><em><?php echo $this->_tpl_vars['order']['contact']; ?>
</em><em>编号：<a href="<?php echo $this->_tpl_vars['url']['list_detail']; ?>
&id=<?php echo $this->_tpl_vars['order']['id']; ?>
"><?php echo $this->_tpl_vars['order']['id']; ?>
</a></em><em>项目名称：<?php echo $this->_tpl_vars['order']['name']; ?>
</em></td>
              <td class="amount" style=" border-bottom: none;">任务金额：<b><?php echo $this->_tpl_vars['order']['order_amount_format']; ?>
</b></td>
             </tr>
             <tr>
               <td class="info" style=" border-bottom: none;"><em>报名开始时间：<?php echo $this->_tpl_vars['order']['start_time']; ?>
</em></td>
               <td class="amount" style=" border-bottom: none;">报名截止时间：<?php echo $this->_tpl_vars['order']['stop_time']; ?>
</td>
              </tr>
             <tr>
               <td class="info" style=" border-bottom: none;"><em>绑定人：<?php echo $this->_tpl_vars['order']['bind_mobile']; ?>
</em></td>
               <td class="amount" style=" border-bottom: none;"><em>城市：<?php echo $this->_tpl_vars['order']['city']; ?>
</em></td>
              </tr>
              <tr>
              <td class="info" style=" border-bottom: none;"><em>结算周期：<?php echo $this->_tpl_vars['order']['zhouqi']; ?>
</em></td>
              <td class="amount" style=" border-bottom: none;"><em>任务截止时间：<?php echo $this->_tpl_vars['order']['end_time']; ?>
</em></td>
             </tr>
             <tr>
              <td class="list">
               <div class="listBox">
                <?php $_from = $this->_tpl_vars['order']['item_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <dl>
                 <div class="img"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
" target="_blank"><img title="<?php echo $this->_tpl_vars['item']['name']; ?>
" src="<?php echo $this->_tpl_vars['item']['thumb']; ?>
" width="60" /></a></div>
                 <dt><?php echo $this->_tpl_vars['item']['name']; ?>
</dt>
                 <dd><?php echo $this->_tpl_vars['item']['price']; ?>
 x <?php echo $this->_tpl_vars['item']['item_number']; ?>
</dd>
                </dl>
                <?php endforeach; endif; unset($_from); ?>
               </div>
              </td>
              <td class="action btnAction">
               <a href="/user.php?rec=userlist&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
" target="_blank"  >领任务明细</a>
               <?php if ($this->_tpl_vars['order']['pay_status'] == 0 && $this->_tpl_vars['order']['status'] == 0): ?>
               <a href="javascript:;" onclick="douConfirm('<?php echo $this->_tpl_vars['url']['del_pro']; ?>
&id=<?php echo $this->_tpl_vars['order']['id']; ?>
', '确定删除吗？')">删除</a>
               <a href="javascript:;" onclick="douConfirm('<?php echo $this->_tpl_vars['url']['pay']; ?>
&id=<?php echo $this->_tpl_vars['order']['id']; ?>
', '确定付款吗？')">去支付</a>

               <?php endif; ?>
                             <?php if ($this->_tpl_vars['order']['status'] == '0'): ?>
     										<?php if ($this->_tpl_vars['order']['cashier_url']): ?>
     										<a href="<?php echo $this->_tpl_vars['order']['cashier_url']; ?>
" class="pay"><?php echo $this->_tpl_vars['lang']['order_payment_btn']; ?>
</a>
     										<?php endif; ?>
                              <?php endif; ?>
              </td>
             </tr>
            </table>

           </div>
           <?php endforeach; endif; unset($_from); ?>
          </div>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <?php endif; ?>



          <?php if ($this->_tpl_vars['rec'] == 'addlist'): ?>
               <h3>添加任务</h3>
               <form action="/user.php?rec=addlist_post" method="post"  enctype="multipart/form-data">
                <div class="tableDiv">
                 <dl>
                  <dt>项目名称<i>*</i></dt>
                  <dd><input name="name" type="text" class="textInput" style="width:250px" /></dd>
                 </dl>
                  <dl>
                   <dt>结算周期<i>*</i></dt>
                   <dd><input name="zhouqi" type="text" class="textInput" style="width:250px" /></dd>
                  </dl>

                 <dl>
                  <dt>标准结算价<i>*</i></dt>
                  <dd><input name="price" type="number" class="textInput"  style="width:250px" /></dd>
                 </dl>
                 <dl>
                  <dt>验收标准</dt>
                  <dd><textarea name="check_sta" class="textInput" style="height:50px; width:250px" ></textarea></dd>
                 </dl>
                 <dl>
                  <dt>描述</dt>
                  <dd><input name="keywords" type="text" class="textInput" style="width:250px"  /></dd>
                 </dl>

                    <dl>
                     <dt>城市</dt>
                     <dd><input name="city" type="text" class="textInput" style="width:250px"  /></dd>
                    </dl>
                    <dl>
                     <dt>需要人数</dt>
                     <dd><input name="max" type="number" class="textInput" style="width:250px"  /></dd>
                    </dl>

                     <dl>
                     <dt>绑定手机号<em>多个手机号，请用英文,隔开</em></dt>
                     <dd><textarea name="bind_mobile" class="textInput" style="height:50px; width:250px" ></textarea></dd>
                    </dl>
                     <dl>
                      <dt>报名开始时间</dt>
                      <dd>
                      <input name="start_time"   type="text" class="textInput time"  style="width:250px" id="time"  />
                      </dd>
                     </dl>
                     <dl>
                      <dt>报名截止时间</dt>
                      <dd>
                      <input name="stop_time"  type="text" class="textInput" id="time1" style="width:250px"   />
                      </dd>
                     </dl>
                     <dl>
                       <dt>任务结束时间</dt>
                       <dd>
                       <input name="end_time"  type="text" class="textInput" style="width:250px" id="time2"  />
                       </dd>
                      </dl>

                       <dl style="display:none">
                                <dt>上传商户总包任务发放表格</dt>
                                <dd>
                                 <div class="inputFile">
                                  <p id="dis_formShow" class="imgShow" style="width: 108px;">
                                  </p>
                                  <input type="file" name="dis_formShow" id="dis_formClick" style="display: none" />
                                  <input type="hidden" name="dis_formCheck" id="dis_formValue" value="" />
                                  <input type="button" value="上传商户总包任务发放表格" class="imgBtndisForm" />
                                 </div>
                                 <p id="dis_formCheck" class="cue"></p>
                                </dd>
                               </dl>
                             <dl>

                    <dl>
                  <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
                  <input type="submit" name="submit" class="btn" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
" />
                 </dl>
                </div>
               </form>

               <?php endif; ?>




               <?php if ($this->_tpl_vars['rec'] == 'userlist'): ?>
                         <h3>我的任务<span style="font-size:18px; color:#ff8103 ">&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $this->_tpl_vars['total']; ?>
)</span></h3>
                         <div class="orderList">
                          <?php $_from = $this->_tpl_vars['user_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
                          <div class="item">

                           <table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail">
                            <tr>
                             <td class="info" style=" border-bottom: none;"><em>编号：<a href="<?php echo $this->_tpl_vars['url']['list_detail']; ?>
&id=<?php echo $this->_tpl_vars['order']['id']; ?>
"><?php echo $this->_tpl_vars['order']['id']; ?>
</a></em><em>报名方：<?php echo $this->_tpl_vars['order']['truename']; ?>
</em></td>
                             <td class="amount" style=" border-bottom: none;">需求单价：<b><?php echo $this->_tpl_vars['order']['order_amount_format']; ?>
</b></td>
                            </tr>
                            <tr>
                              <td class="info" style=" border-bottom: none;"><em>报名时间：<?php echo $this->_tpl_vars['order']['add_time']; ?>
</em></td>
                              <td class="amount" style=" border-bottom: none;">状态：<?php echo $this->_tpl_vars['order']['status_format']; ?>
</td>
                             </tr>


                           </table>

                          </div>
                          <?php endforeach; endif; unset($_from); ?>
                         </div>
                         <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                         <?php endif; ?>






                <?php if ($this->_tpl_vars['rec'] == 'money'): ?>
                         <h3>资金管理<span style="font-size:18px; color:#ff8103 ">&nbsp;&nbsp;&nbsp;&nbsp;(已支出<?php echo $this->_tpl_vars['total']; ?>
元)</span></h3>
                         <div class="orderList">
                          <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
                          <div class="item">

                           <table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail">

                           <tr>
                            <td class="info" style=" border-bottom: none;">支付金额：<b style="font-size: 16px;"><?php echo $this->_tpl_vars['order']['order_amount_format']; ?>
</b></td>
                            <td class="amount" style=" border-bottom: none;"><em>支付时间：<?php echo $this->_tpl_vars['order']['pay_time']; ?>
</em></td>
                           </tr>

                            <tr>
                          <td class="info" style=" border-bottom: none;">任务名称：<a href="/user.php?rec=list&id=<?php echo $this->_tpl_vars['order']['id']; ?>
" target="_blank"><b><?php echo $this->_tpl_vars['order']['name']; ?>
</b></a> </td>
                          <td class="amount" style=" border-bottom: none;"><em>任务编号：<?php echo $this->_tpl_vars['order']['id']; ?>
</em></td>
                         </tr>


                            <tr>
                             <td class="list">
                              <div class="listBox">
                               <?php $_from = $this->_tpl_vars['order']['item_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                               <dl>
                                <div class="img"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
" target="_blank"><img title="<?php echo $this->_tpl_vars['item']['name']; ?>
" src="<?php echo $this->_tpl_vars['item']['thumb']; ?>
" width="60" /></a></div>
                                <dt><?php echo $this->_tpl_vars['item']['name']; ?>
</dt>
                                <dd><?php echo $this->_tpl_vars['item']['price']; ?>
 x <?php echo $this->_tpl_vars['item']['item_number']; ?>
</dd>
                               </dl>
                               <?php endforeach; endif; unset($_from); ?>
                              </div>
                             </td>
                             <td class="action btnAction">
                              <div class="status" >
                                <?php if ($this->_tpl_vars['order']['pay_status'] == 0 && $this->_tpl_vars['order']['status'] == 0): ?> <span style="color:#ff8103">未支付</span><?php endif; ?>
                                <?php if ($this->_tpl_vars['order']['pay_status'] == 1 && $this->_tpl_vars['order']['status'] == 0): ?> <span style="color:#00ec00">进行中</span><?php endif; ?>
                                 <?php if ($this->_tpl_vars['order']['status'] == 1): ?><span style="color:#0080ff"> 已完成</span><?php endif; ?>
                                </div>

                             </td>
                            </tr>
                           </table>

                          </div>
                          <?php endforeach; endif; unset($_from); ?>
                         </div>
                         <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                         <?php endif; ?>


    </div>
   </div>
   <!-- /userIn --> 
   <?php endif; ?> 
  </div>
 </div>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/online_service.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
</body>
</html>