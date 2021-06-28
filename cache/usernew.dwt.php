<?php /* Smarty version 2.6.26, created on 2019-12-23 10:46:34
         compiled from usernew.dwt */ ?>
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

<link href="http://58.banyar.cn/theme/default/iview.css" rel="stylesheet" type="text/css" />
 <link href="http://58.banyar.cn/theme/default/appad0311e4491215359b7fc592dcfefe37.css" rel="stylesheet" type="text/css" />

<script>var root_url = "<?php echo $this->_tpl_vars['site']['root_url']; ?>
";</script> 
<script type="text/javascript" src="http://58.banyar.cn/theme/default/images/jquery.min.js"></script>
<script type="text/javascript" src="http://58.banyar.cn/theme/default/images/global.js"></script>
<script type="text/javascript" src="http://58.banyar.cn/theme/default/images/user.js"></script>
<script src="http://58.banyar.cn/theme/default/images/laydate/laydate.js"></script>
    <?php if ($this->_tpl_vars['rec'] == 'login'): ?>
<link href="http://58.banyar.cn/theme/default/loginstyle.css" rel="stylesheet" type="text/css">

    <?php endif; ?>


</head>
<body>
 <?php if ($this->_tpl_vars['rec'] == 'login'): ?>
 <div class="dl-bg">
 		<div class="dl-bg-con">
 			<div class="dl-con">
 				<div class="dl-con-top">
 					<div class="dl-logo"><img src="http://58.banyar.cn/theme/default/images/logo.jpg"></div>
 					<div class="dl-con-title">共包极丁任务企业系统</div>
 					<div class="dl-con-ftitle">搭建企业外包业务和职业承揽者更合规便捷的桥梁</div>
 				</div>
 				 <form  action="/usernew.php?rec=login_post" method="post">
 			  <div class="dl-con-btm">
 					<div class="dl-con-input">
 						<input type="text" name="user_name"  placeholder="输入您的账号">
 					</div>
 					<div class="dl-con-input">
 						<input  type="password" name="password" placeholder="输入您的密码">
 					</div>
 					<div class="dl-con-btn"><input  type="submit" name="submit" value="登录"></div>
                   			  </div>
 			     <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
                <input type="hidden" name="return_url" value="<?php echo $this->_tpl_vars['return_url']; ?>
" />
 			  </form>
 			</div>
 		</div>
 	</div>
 	<div class="dl-footer">Copyight@ 2020  共包极丁  版权所有</div>




 <?php endif; ?>
<?php if ($this->_tpl_vars['rec'] == 'showxlsform'): ?>
                   <div data-v-3e39c47e="" class="main">
                            <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
                              <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
                                <h1 data-v-3c3fa26a="">
                                  <span data-v-3c3fa26a="" class="actived">上传分发明细表格</span></h1>
                                <div data-v-3c3fa26a="" class="right-box">
                                                                   </div>
                              </div>

                               <iframe src='https://view.officeapps.live.com/op/view.aspx?src=http://58.banyar.cn/<?php echo $this->_tpl_vars['file']; ?>
' width='1500px' height='1000px' frameborder='1' >
                               </iframe>

                            </div>
                          </div>
          <?php endif; ?>


<div id="wrapper">  <div class="wrap mb">
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
   <div id="app">
   <div data-v-09660f48="" class="task-center-box">
    <div data-v-1bc31c24="" data-v-3e39c47e="" class="header-bg">
               <header data-v-1bc31c24="" class="header">
                   <div data-v-1bc31c24="" class="logo"></div>
                   <div data-v-1bc31c24="" class="menu">
                       <ul data-v-1bc31c24="">

                        <?php if ($this->_tpl_vars['rec'] == 'taskcenter'): ?>
                           <li data-v-1bc31c24="" class="selected" class="">
                               <a data-v-1bc31c24="" href="/usernew.php?rec=taskcenter">任务大厅</a>
                           </li>
                           <li data-v-1bc31c24="" >
                           <a data-v-1bc31c24="" href="/usernew.php?rec=list">我的</a>
                           </li>
                        <?php else: ?>
                           <li data-v-1bc31c24="" class="">
                              <a data-v-1bc31c24="" href="/usernew.php?rec=taskcenter">任务大厅</a>
                          </li>
                          <li data-v-1bc31c24="" class="selected">
                          <a data-v-1bc31c24="" href="/usernew.php?rec=list">我的</a>
                          </li>
                          <?php endif; ?>
                       </ul>
                   </div>
                   <div data-v-1bc31c24="" class="login">
                       <div data-v-1bc31c24="" class="drop-down company ivu-dropdown">
                           <div class="ivu-dropdown-rel">
                           <a data-v-1bc31c24="" class="top">
                           <?php echo $this->_tpl_vars['global_user']['user_name']; ?>

                                                     </a>
                           </div>
                           <div class="ivu-select-dropdown child" style="display: none;">
                               <ul data-v-1bc31c24="" class="ivu-dropdown-menu drop-down-menu">
                                   <li data-v-1bc31c24="" class="drop-down-item ivu-dropdown-item"><a style="color:#999" href="/usernew.php?rec=password">修改密码</a></li>
                                   <li data-v-1bc31c24="" class="drop-down-item ivu-dropdown-item"><a style="color:#999" href="/usernew.php?rec=logout">退出</a></li>
                               </ul>
                           </div>
                       </div>
                   </div><!----></header>
           </div>

<div data-v-3e39c47e="" class="layout-body">
  <div data-v-3e39c47e="" class="container">
   <?php if ($this->_tpl_vars['rec'] != 'password' && $this->_tpl_vars['rec'] != 'taskcenter' && $this->_tpl_vars['rec'] != 'taskcenterinfo'): ?>
     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/user_treenew.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <?php endif; ?>


  <?php if ($this->_tpl_vars['rec'] == 'list'): ?>
   <div data-v-3e39c47e="" class="main">
      <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
         <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
             <h1 data-v-3c3fa26a="">
               <span data-v-3c3fa26a="" class="actived">发布的任务</span>
             </h1>
             <div data-v-3c3fa26a="" class="right-box">
                <?php if ($this->_tpl_vars['createpro'] == 1): ?>
                 <button data-v-966930ee="" data-v-3c3fa26a="" type="button" class="publish-btn u-btn u-btn-red toaddlist">发布任务</button>
                 <?php endif; ?>

                                    <a  href="/images/明细模板.xls" download="明细模板.xls">
                   <button data-v-966930ee="" data-v-3c3fa26a="" type="button"
                                            class="u-btn u-btn-red reset-btn upload-btn mr10"
                                            style="background-color: rgb(224, 224, 224); color: black; width: 1.5rem; border: 1px solid rgb(224, 224, 224);">
                                        下载明细模板
                                    </button>
                  </a>

              </div>
          </div>
          <div data-v-67c9ef8f="" data-v-966930ee="" class="my-task-publish-list-box">
             <form data-v-67c9ef8f="" autocomplete="off" class="u-form ivu-form ivu-form-label-right" method="get" action="/usernew.php" target="_self" >
                  <div data-v-67c9ef8f="" class="ivu-row">
                          <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-8">
                              <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                  <div class="ivu-form-item-content">
                                      <div data-v-67c9ef8f="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                          <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                          <input  type="text" placeholder="任务编号" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" class="ivu-input ivu-input-large">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-8">
                              <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                  <div class="ivu-form-item-content">
                                      <div data-v-67c9ef8f=""
                                           class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                          <!----> <!----> <i
                                              class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                          <input   type="text" name="name" placeholder="任务标题" value="<?php echo $this->_tpl_vars['name']; ?>
" class="ivu-input ivu-input-large"> <!---->
                                      </div> <!----></div>
                              </div>
                          </div>
                          <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-8">
                              <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                  <div class="ivu-form-item-content">
                                      <div data-v-67c9ef8f="" class="ivu-select ivu-select-single ivu-select-large">
                                          <div tabindex="0" class="">
                                               <select  class="ivu-select-selection" name="status" style="witdh:100%">
                                                <option value="">全部</option>
                                                <option value="0">进行中</option>
                                                <option value=1"">已完成</option>
                                              </select>

                                          </div>

                                      </div>
                                    </div>
                              </div>
                          </div>
                  </div>

                              <div data-v-67c9ef8f="" class="ivu-row">
                                  <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-10">
                                      <div data-v-67c9ef8f="" class="ivu-form-item">
                                          <label class="ivu-form-item-label" style="width: 70px;">发布时间</label>
                                          <div class="ivu-form-item-content" style="margin-left: 70px;">
                                              <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                                  <div class="ivu-date-picker-rel">
                                                      <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                                             <input name="add_time1" id="time" value="<?php echo $this->_tpl_vars['add_time1']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"  class="ivu-input ivu-input-large">
                                                           - <input name="add_time2"  id="time1" value="<?php echo $this->_tpl_vars['add_time2']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"   class="ivu-input ivu-input-large">
                                                      </div>
                                                  </div>
                                             </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-10">
                                      <div data-v-67c9ef8f="" class="ivu-form-item">
                                            <label class="ivu-form-item-label" style="width: 70px;">截止时间</label>
                                            <div class="ivu-form-item-content" style="margin-left: 70px;">
                                                <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                                   <div class="ivu-date-picker-rel">
                                                       <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                                            <input type="text" name="end_time1" value="<?php echo $this->_tpl_vars['end_time1']; ?>
" id="time2" placeholder="选择任务截止时间"  style="width:46%" class="ivu-input ivu-input-large">
                                                           -<input type="text" name="end_time2" value="<?php echo $this->_tpl_vars['end_time2']; ?>
" id="time3" placeholder="选择任务截止时间"  style="width:46%" class="ivu-input ivu-input-large">
                                                       </div>
                                                  </div>

                                                </div>
                                            </div>
                                      </div>
                                  </div>
                                  <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-4">
                                  <input type="hidden" name="rec"  value="list" />
                                      <button data-v-67c9ef8f="" type="submit" class="u-btn u-btn-red search-btn"></button>
                                  </div>
                              </div>
                          </form>



                          <div data-v-67c9ef8f="" class="u-table ivu-table-wrapper">
                              <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe"><!---->
                                  <div class="ivu-table-header">
                                      <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                                          <colgroup>
                                              <col width="50">
                                              <col width="98">
                                              <col width="130">
                                              <col width="100">
                                              <col width="40">
                                              <col width="40">
                                              <col width="90">
                                              <col width="90">
                                              <col width="70">
                                              <col width="260"> <!----></colgroup>
                                          <thead>
                                          <tr>
                                              <th class="ivu-table-column-center">
                                                  <div class="ivu-table-cell"><span class="">序号</span>
                                                  </div>
                                              </th>
                                              <th class="">
                                                  <div class="ivu-table-cell"><span class="">任务编码</span>
                                                  </div>
                                              </th>
                                              <th class="ivu-table-column-center">
                                                  <div class="ivu-table-cell"><span class="">任务标题</span>
                                                  </div>
                                              </th>
                                              <th class="ivu-table-column-center">
                                                  <div class="ivu-table-cell"><span class="">需求单价</span>
                                                  </div>
                                              </th>
                                              <th class="ivu-table-column-center">
                                                  <div class="ivu-table-cell"><span class="">计算单位</span>
                                                  </div>
                                              </th>
                                              <th class="ivu-table-column-center">
                                                  <div class="ivu-table-cell"><span class="">需求人数</span>
                                                  </div>
                                              </th>
                                              <th class="">
                                                  <div class="ivu-table-cell"><span class="">截止时间</span>
                                                  </div>
                                              </th>
                                              <th class="">
                                                  <div class="ivu-table-cell"><span class="">发布时间</span>
                                                  </div>
                                              </th>
                                              <th class="ivu-table-column-center">
                                                  <div class="ivu-table-cell"><span class="">任务状态</span>
                                                  </div>
                                              </th>
                                              <th class="ivu-table-column-center">
                                                  <div class="ivu-table-cell"><span class="">操作</span>
                                                  </div>
                                              </th>
                                            </tr>
                                          </thead>
                                      </table>
                                  </div>
                                  <div class="ivu-table-body">
                                      <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                                          <colgroup>
                                              <col width="50">
                                              <col width="98">
                                              <col width="130">
                                              <col width="100">
                                              <col width="40">
                                              <col width="40">
                                              <col width="90">
                                              <col width="90">
                                              <col width="70">
                                              <col width="260">
                                          </colgroup>
                                          <tbody class="ivu-table-tbody">
                                          <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['order']):
?>
                                          <tr class="ivu-table-row">
                                              <td class="ivu-table-column-center">
                                                  <div class="ivu-table-cell">
                                                    <span><?php echo $this->_tpl_vars['key']+1; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="">
                                                  <div class="ivu-table-cell ivu-table-cell-ellipsis">
                                                    <span>T00000<?php echo $this->_tpl_vars['order']['id']; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="ivu-table-column-center">
                                                  <div class="ivu-table-cell">
                                                    <span><?php echo $this->_tpl_vars['order']['name']; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="ivu-table-column-center">
                                                  <div class="ivu-table-cell">
                                                    <span><?php echo $this->_tpl_vars['order']['price_str']; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="ivu-table-column-center">
                                                  <div class="ivu-table-cell">
                                                    <span><?php echo $this->_tpl_vars['order']['jisuandw']; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="ivu-table-column-center">
                                                  <div class="ivu-table-cell">
                                                    <span><?php echo $this->_tpl_vars['order']['max']; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="">
                                                  <div class="ivu-table-cell">
                                                    <span><?php echo $this->_tpl_vars['order']['end_time']; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="">
                                                  <div class="ivu-table-cell">
                                                    <span><?php echo $this->_tpl_vars['order']['add_time']; ?>
</span>
                                                  </div>
                                              </td>
                                              <td class="ivu-table-column-center">
                                                  <div class="ivu-table-cell">
                                                    <span>
                                                    <?php echo $this->_tpl_vars['order']['status_format']; ?>

                                                    </span>
                                                  </div>
                                              </td>
                                              <td class="ivu-table-column-center">
                                                  <div class="ivu-table-cell">
                                                      <div class="tr-div">
                                                        <span class="td-span"><a href="/usernew.php?rec=listinfo&id=<?php echo $this->_tpl_vars['order']['id']; ?>
"   style="color:#515a6e;">任务详情</a></span>
                                                        <span class="td-span" style="display: none;">编辑</span>
                                                        <span  class="td-span"><a href="/usernew.php?rec=myorder&ppid=T00000<?php echo $this->_tpl_vars['order']['id']; ?>
"   style="color:#515a6e;">订单明细</a></span>
                                                        <span class="td-span" style="display: none;">撤销任务</span>
                                                        <?php if ($this->_tpl_vars['order']['upload_status'] == 0): ?>
                                                            <span  class="td-span"><a href="/usernew.php?rec=uploadlist&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
"   style="color:#515a6e;">上传分发表格</a></span>
                                                       <br/>
                                                       <span  class="td-span" style="margin-left:0"><a style="color:#f87726;">上传</a></span> >
                                                       <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">审核</a></span> >
                                                       <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">确认</a></span> >
                                                       <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">打款</a></span> >
                                                       <span  class="td-span"><a style="color:#515a6e;">完成</a></span>

                                                        <?php endif; ?>
                                                        <?php if ($this->_tpl_vars['order']['upload_status'] == 1): ?>
                                                            <span  class="td-span"><a  href="/usernew.php?rec=showxlsform&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
"  style="color:#515a6e;" target="_blank">查看表格</a></span>
                                                            <br/>
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">上传</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#f87726;">审核</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">确认</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">打款</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">完成</a></span>
                                                        <?php endif; ?>
                                                        <?php if ($this->_tpl_vars['order']['upload_status'] == 2): ?>
                                                            <span  class="td-span"><a href="javascript:if(confirm('确认打款？')) location.href='/usernew.php?rec=paylist&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
'" style="color:green;">确认打款</a></span>
                                                            <br/>
                                                            <span  class="td-span"><a href="/usernew.php?rec=uploadyspdf&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
"   style="color:#515a6e;">上传验收扫描件</a></span>
                                                             <?php if ($this->_tpl_vars['order']['file5'] != ''): ?>
                                                             <span  class="td-span"><a  href="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
"   style="color:#515a6e;">下载验收扫描件</a></span>
                                                            <?php endif; ?>
                                                            <span  class="td-span"><a  href="/usernew.php?rec=showxlsform&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
" style="color:#515a6e;" target="_blank">查看表格</a></span>
                                                            <br/>
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">上传</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">审核</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#f87726;">确认</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">打款</a></span> >
                                                            <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">完成</a></span>

                                                        <?php endif; ?>

                                                        <?php if ($this->_tpl_vars['order']['upload_status'] == 3): ?>
                                                            <span  class="td-span"><a  href="/usernew.php?rec=showxlsform&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
" style="color:#515a6e;" target="_blank">查看表格</a></span>

                                                           <span  class="td-span"><a href="/usernew.php?rec=uploadyspdf&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
"   style="color:#515a6e;">上传验收扫描件</a></span>
                                                            <?php if ($this->_tpl_vars['order']['file5'] != ''): ?>
                                                            <span  class="td-span"><a  href="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
"   style="color:#515a6e;">下载验收扫描件</a></span>
                                                           <?php endif; ?>

                                                            <br/>
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">上传</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">审核</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">确认</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#f87726;">打款</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">完成</a></span>
                                                        <?php endif; ?>

                                                         <?php if ($this->_tpl_vars['order']['upload_status'] == 4): ?>
                                                            <span  class="td-span"><a  href="/usernew.php?rec=showxlsform&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
" style="color:#515a6e;" target="_blank">查看表格</a></span>
                                                            <?php if ($this->_tpl_vars['order']['file5'] == ''): ?>
                                                            <span  class="td-span"><a href="/usernew.php?rec=uploadyspdf&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
"   style="color:#515a6e;">上传验收扫描件</a></span>
                                                             <?php else: ?>
                                                             <span  class="td-span"><a  href="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
"   style="color:#515a6e;">下载验收扫描件</a></span>
                                                            <?php endif; ?>

                                                            <br/>
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">上传</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">审核</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">确认</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#515a6e;">打款</a></span> >
                                                           <span  class="td-span" style="margin-left:0"><a style="color:#f87726;">完成</a></span>
                                                        <?php endif; ?>

                                                        <?php if ($this->_tpl_vars['order']['upload_status'] == -1): ?>
                                                            <span  class="td-span"><a  href="/usernew.php?rec=showxlsform&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
" style="color:#515a6e;" target="_blank">查看表格</a></span><br/>
                                                            <span  class="td-span"><a href="/usernew.php?rec=uploadlist&ppid=<?php echo $this->_tpl_vars['order']['id']; ?>
"   style="color:#515a6e;">重新上传</a></span>
                                                        <br/>
                                                        <span  class="td-span"><a style="color:#f00;">审核失败：<?php echo $this->_tpl_vars['order']['upload_fail_reason']; ?>
</a></span>
                                                        <?php endif; ?>













                                                      </div>
                                                  </div>
                                              </td>
                                          </tr>
                                           <?php endforeach; endif; unset($_from); ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>

                        </div>
                        <div data-v-67c9ef8f="" class="page-box">
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        </div>
                      </div>
                  </div>
              </div>
  <?php endif; ?>


  <?php if ($this->_tpl_vars['rec'] == 'listdownload'): ?>
     <div data-v-3e39c47e="" class="main">
        <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
           <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
               <h1 data-v-3c3fa26a="">
                 <span data-v-3c3fa26a="" class="actived">发布的任务</span>
               </h1>
               <div data-v-3c3fa26a="" class="right-box">
                  <?php if ($this->_tpl_vars['createpro'] == 1): ?>
                   <button data-v-966930ee="" data-v-3c3fa26a="" type="button" class="publish-btn u-btn u-btn-red toaddlist">发布任务</button>
                   <?php endif; ?>

                                        <a  href="/images/明细模板.xls" download="明细模板.xls">
                     <button data-v-966930ee="" data-v-3c3fa26a="" type="button"
                                              class="u-btn u-btn-red reset-btn upload-btn mr10"
                                              style="background-color: rgb(224, 224, 224); color: black; width: 1.5rem; border: 1px solid rgb(224, 224, 224);">
                                          下载明细模板
                                      </button>
                    </a>

                </div>
            </div>
            <div data-v-67c9ef8f="" data-v-966930ee="" class="my-task-publish-list-box">
               <form data-v-67c9ef8f="" autocomplete="off" class="u-form ivu-form ivu-form-label-right" method="get" action="/usernew.php" target="_self" >
                    <div data-v-67c9ef8f="" class="ivu-row">
                            <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-8">
                                <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                    <div class="ivu-form-item-content">
                                        <div data-v-67c9ef8f="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                            <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                            <input  type="text" placeholder="任务编号" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" class="ivu-input ivu-input-large">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-8">
                                <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                    <div class="ivu-form-item-content">
                                        <div data-v-67c9ef8f=""
                                             class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                            <!----> <!----> <i
                                                class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                            <input   type="text" name="name" placeholder="任务标题" value="<?php echo $this->_tpl_vars['name']; ?>
" class="ivu-input ivu-input-large"> <!---->
                                        </div> <!----></div>
                                </div>
                            </div>
                            <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-8">
                                <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                    <div class="ivu-form-item-content">
                                        <div data-v-67c9ef8f="" class="ivu-select ivu-select-single ivu-select-large">
                                            <div tabindex="0" class="">
                                                 <select  class="ivu-select-selection" name="status" style="witdh:100%">
                                                  <option value="">全部</option>
                                                  <option value="0">进行中</option>
                                                  <option value=1"">已完成</option>
                                                </select>

                                            </div>

                                        </div>
                                      </div>
                                </div>
                            </div>
                    </div>

                                <div data-v-67c9ef8f="" class="ivu-row">
                                    <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-10">
                                        <div data-v-67c9ef8f="" class="ivu-form-item">
                                            <label class="ivu-form-item-label" style="width: 70px;">发布时间</label>
                                            <div class="ivu-form-item-content" style="margin-left: 70px;">
                                                <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                                    <div class="ivu-date-picker-rel">
                                                        <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                                               <input name="add_time1" id="time" value="<?php echo $this->_tpl_vars['add_time1']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"  class="ivu-input ivu-input-large">
                                                             - <input name="add_time2"  id="time1" value="<?php echo $this->_tpl_vars['add_time2']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"   class="ivu-input ivu-input-large">
                                                        </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-10">
                                        <div data-v-67c9ef8f="" class="ivu-form-item">
                                              <label class="ivu-form-item-label" style="width: 70px;">截止时间</label>
                                              <div class="ivu-form-item-content" style="margin-left: 70px;">
                                                  <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                                     <div class="ivu-date-picker-rel">
                                                         <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                                              <input type="text" name="end_time1" value="<?php echo $this->_tpl_vars['end_time1']; ?>
" id="time2" placeholder="选择任务截止时间"  style="width:46%" class="ivu-input ivu-input-large">
                                                             -<input type="text" name="end_time2" value="<?php echo $this->_tpl_vars['end_time2']; ?>
" id="time3" placeholder="选择任务截止时间"  style="width:46%" class="ivu-input ivu-input-large">
                                                         </div>
                                                    </div>

                                                  </div>
                                              </div>
                                        </div>
                                    </div>
                                    <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-4">
                                    <input type="hidden" name="rec"  value="listdownload" />
                                        <button data-v-67c9ef8f="" type="submit" class="u-btn u-btn-red search-btn"></button>
                                    </div>
                                </div>
                            </form>



                            <div data-v-67c9ef8f="" class="u-table ivu-table-wrapper">
                                <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe"><!---->
                                    <div class="ivu-table-header">
                                        <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                                            <colgroup>
                                                <col width="50">
                                                <col width="98">
                                                <col width="130">
                                                <col width="100">
                                                <col width="40">
                                                <col width="40">
                                                <col width="90">
                                                <col width="90">
                                                <col width="70">
                                                <col width="260"> <!----></colgroup>
                                            <thead>
                                            <tr>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">序号</span>
                                                    </div>
                                                </th>
                                                <th class="">
                                                    <div class="ivu-table-cell"><span class="">任务编码</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">任务标题</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">需求单价</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">计算单位</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">需求人数</span>
                                                    </div>
                                                </th>
                                                <th class="">
                                                    <div class="ivu-table-cell"><span class="">截止时间</span>
                                                    </div>
                                                </th>
                                                <th class="">
                                                    <div class="ivu-table-cell"><span class="">发布时间</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">任务状态</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">操作</span>
                                                    </div>
                                                </th>
                                              </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="ivu-table-body">
                                        <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                                            <colgroup>
                                                <col width="50">
                                                <col width="98">
                                                <col width="130">
                                                <col width="100">
                                                <col width="40">
                                                <col width="40">
                                                <col width="90">
                                                <col width="90">
                                                <col width="70">
                                                <col width="260">
                                            </colgroup>
                                            <tbody class="ivu-table-tbody">
                                            <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['order']):
?>
                                            <tr class="ivu-table-row">
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['key']+1; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="ivu-table-cell ivu-table-cell-ellipsis">
                                                      <span>T00000<?php echo $this->_tpl_vars['order']['id']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['name']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['price_str']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['jisuandw']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['max']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['end_time']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['add_time']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span>
                                                      <?php echo $this->_tpl_vars['order']['status_format']; ?>

                                                      </span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                        <div class="tr-div">
                                                          <?php if ($this->_tpl_vars['order']['file1'] != ''): ?>
                                                          <span  class="td-span" ><a  href="../../<?php echo $this->_tpl_vars['order']['file1']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file1']; ?>
">下载增值税专用发票 </a></span> |
                                                          <?php endif; ?>
                                                          <?php if ($this->_tpl_vars['order']['file2'] != ''): ?>
                                                           <span  class="td-span" ><a href="../../<?php echo $this->_tpl_vars['order']['file2']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file2']; ?>
">下载完税 </a></span> |
                                                          <?php endif; ?>
                                                          <?php if ($this->_tpl_vars['order']['file3'] != ''): ?>
                                                           <span  class="td-span" ><a href="../../<?php echo $this->_tpl_vars['order']['file3']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file3']; ?>
">下载个人增值发票</a></span> |
                                                          <?php endif; ?>
                                                           <?php if ($this->_tpl_vars['order']['file4'] != ''): ?>
                                                           <span  class="td-span" ><a href="../../<?php echo $this->_tpl_vars['order']['file4']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file4']; ?>
">下载电子回单</a></span> |
                                                          <?php endif; ?>
                                                           <?php if ($this->_tpl_vars['order']['file5'] != ''): ?>
                                                             <span  class="td-span" ><a href="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
" download="../../<?php echo $this->_tpl_vars['order']['file5']; ?>
">下载验收扫描件</a></span> |
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                             <?php endforeach; endif; unset($_from); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                          </div>
                          <div data-v-67c9ef8f="" class="page-box">
                              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                          </div>
                        </div>
                    </div>
                </div>
    <?php endif; ?>


   <?php if ($this->_tpl_vars['rec'] == 'myamount'): ?>
     <div data-v-3e39c47e="" class="main">
        <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
           <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
               <h1 data-v-3c3fa26a="">
                 <span data-v-3c3fa26a="" class="actived">我的钱包</span>
               </h1>
               <div data-v-3c3fa26a="" class="right-box">
                 <button data-v-966930ee="" data-v-3c3fa26a="" type="button" class="publish-btn u-btn u-btn-red toaddlist">余额：<?php echo $this->_tpl_vars['amount']; ?>
元</button>




                </div>
            </div>
            <div data-v-67c9ef8f="" data-v-966930ee="" class="my-task-publish-list-box">
               <form data-v-67c9ef8f="" autocomplete="off" class="u-form ivu-form ivu-form-label-right" method="get" action="/usernew.php" target="_self" >


                                <div data-v-67c9ef8f="" class="ivu-row">
                                    <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-10">
                                        <div data-v-67c9ef8f="" class="ivu-form-item">
                                            <label class="ivu-form-item-label" style="width: 70px;">时间</label>
                                            <div class="ivu-form-item-content" style="margin-left: 70px;">
                                                <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                                    <div class="ivu-date-picker-rel">
                                                        <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                                               <input name="add_time1" id="time" value="<?php echo $this->_tpl_vars['add_time1']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"  class="ivu-input ivu-input-large">
                                                             - <input name="add_time2"  id="time1" value="<?php echo $this->_tpl_vars['add_time2']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"   class="ivu-input ivu-input-large">
                                                        </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-4">
                                    <input type="hidden" name="rec"  value="list" />
                                        <button data-v-67c9ef8f="" type="submit" class="u-btn u-btn-red search-btn"></button>
                                    </div>
                                </div>
                            </form>



                            <div data-v-67c9ef8f="" class="u-table ivu-table-wrapper">
                                <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe"><!---->
                                    <div class="ivu-table-header">
                                        <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                                            <colgroup>
                                                <col width="187">
                                                <col width="235">
                                                <col width="267">
                                                <col width="237">
                                                <col width="177"><!----></colgroup>
                                            <thead>
                                            <tr>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">序号</span>
                                                    </div>
                                                </th>
                                                <th class="">
                                                    <div class="ivu-table-cell"><span class="">金额</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">描述</span>
                                                    </div>
                                                </th>
                                                <th class="ivu-table-column-center">
                                                    <div class="ivu-table-cell"><span class="">时间</span>
                                                    </div>
                                                </th>


                                              </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="ivu-table-body">
                                        <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                                            <colgroup>
                                                <col width="187">
                                                <col width="235">
                                                <col width="267">
                                                <col width="237">
                                                <col width="177">

                                            </colgroup>
                                            <tbody class="ivu-table-tbody">
                                            <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['order']):
?>
                                            <tr class="ivu-table-row">
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['key']+1; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell ivu-table-cell-ellipsis">
                                                      <span><?php echo $this->_tpl_vars['order']['amount']; ?>
元</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['desc']; ?>
</span>
                                                    </div>
                                                </td>
                                                <td class="ivu-table-column-center">
                                                    <div class="ivu-table-cell">
                                                      <span><?php echo $this->_tpl_vars['order']['add_time']; ?>
</span>
                                                    </div>
                                                </td>


                                            </tr>
                                             <?php endforeach; endif; unset($_from); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                          </div>
                          <div data-v-67c9ef8f="" class="page-box">
                              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                          </div>
                        </div>
                    </div>
                </div>
    <?php endif; ?>

<?php if ($this->_tpl_vars['rec'] == 'password'): ?>


<div class="password-operate-box">
  <div class="main">
           <div data-v-c2754978="" class="page-title-box">
                <p data-v-c2754978="">
                    修改密码
                    <span data-v-c2754978=""></span>
                </p>
          </div>
           <div class="password-operate-body"><!---->
               <form  class="password-form ivu-form ivu-form-label-top" action="/usernew.php?rec=password_post" method="post">
                   <div class="required-input ivu-form-item ivu-form-item-required">
                        <label class="ivu-form-item-label">旧密码</label>
                        <div class="ivu-form-item-content">
                           <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                <input name="old_password"  type="password" placeholder="请输入旧密码" class="ivu-input ivu-input-large">
                           </div>
                        </div>
                   </div>
                   <div class="required-input ivu-form-item ivu-form-item-required">
                        <label class="ivu-form-item-label">新密码</label>
                        <div class="ivu-form-item-content">
                           <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                <input name="password" type="password" placeholder="请输入新密码" class="ivu-input ivu-input-large">
                           </div>
                        </div>
                   </div>
                   <div class="required-input ivu-form-item ivu-form-item-required">
                         <label class="ivu-form-item-label">确认密码</label>
                         <div class="ivu-form-item-content">
                           <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                <input name="password_confirm"  type="password" placeholder="请确认密码" class="ivu-input ivu-input-large">
                           </div>
                         </div>
                   </div>
                   <div class="operate-pwd-btn-box ivu-form-item"><!---->
                       <div class="ivu-form-item-content">
                             <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
                           <button type="submit"  class="operate-pwd-btn u-btn u-btn-red ivu-btn ivu-btn-default ivu-btn-large">
                            <span>确定</span>
                           </button>
                       </div>
                   </div>
               </form>
           </div>
    </div>
</div>

 <?php endif; ?>



 <?php if ($this->_tpl_vars['rec'] == 'setinfo'): ?>


  <div data-v-3e39c47e="" class="main">
    <div data-v-3e39c47e="" class="my-users-list-box">
      <div data-v-3c3fa26a="" class="tab-title-box">
        <h1 data-v-3c3fa26a="">
          <span data-v-3c3fa26a="" class="actived">用户管理</span></h1>
        <div data-v-3c3fa26a="" class="right-box" style="display: none;"></div>
      </div>
      <div class="my-users-list-main">

        <div class="u-table ivu-table-wrapper">
          <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe">
            <!---->
            <div class="ivu-table-header">
              <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                <colgroup>
                  <col width="70">
                    <col width="103">
                      <col width="119">
                        <col width="119">
                          <col width="119">
                            <col width="119">
                              <col width="119">
                                <col width="200">
                                  <!----></colgroup>
                <thead>
                  <tr>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">序号</span>
                        <!---->
                        <!----></div>
                    </th>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">创建时间</span>
                        <!---->
                        <!----></div>
                    </th>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">登录帐号</span>
                        <!---->
                        <!----></div>
                    </th>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">用户名称</span>
                        <!---->
                        <!----></div>
                    </th>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">用户编号</span>
                        <!---->
                        <!----></div>
                    </th>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">角色</span>
                        <!---->
                        <!----></div>
                    </th>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">状态</span>
                        <!---->
                        <!----></div>
                    </th>
                    <th class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span class="">操作</span>
                        <!---->
                        <!----></div>
                    </th>
                    <!----></tr>
                </thead>
              </table>
            </div>
            <div class="ivu-table-body">
              <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                <colgroup>
                  <col width="70">
                    <col width="103">
                      <col width="119">
                        <col width="119">
                          <col width="119">
                            <col width="119">
                              <col width="119">
                                <col width="200"></colgroup>
                <tbody class="ivu-table-tbody">
                  <tr class="ivu-table-row">
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <span>1</span>
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!----></div>
                    </td>
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <!---->
                        <!---->
                        <!---->
                        <span><?php echo $this->_tpl_vars['user_info']['add_time']; ?>
</span>
                        <!---->
                        <!----></div>
                    </td>
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <!---->
                        <!---->
                        <!---->
                        <span><?php echo $this->_tpl_vars['user_info']['user_name']; ?>
</span>
                        <!---->
                        <!----></div>
                    </td>
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <!---->
                        <!---->
                        <!---->
                        <span><?php echo $this->_tpl_vars['enterprise_info']['enterprise_name']; ?>
</span>
                        <!---->
                        <!----></div>
                    </td>
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <!---->
                        <!---->
                        <!---->
                        <span><?php echo $this->_tpl_vars['user_info']['user_id']; ?>
</span>
                        <!---->
                        <!----></div>
                    </td>
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <!---->
                        <!---->
                        <!---->
                        <span>商户</span>
                        <!---->
                        <!----></div>
                    </td>
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <span>启用</span></div>
                    </td>
                    <td class="ivu-table-column-center">
                      <div class="ivu-table-cell">
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <!---->
                        <div class="tr-div">
                          <span class="td-span editcominfo">编辑</span>
                          <span class="td-span showcominfo">详情</span>
                                                    <span class="td-span"><a href="/usernew.php?rec=password" style="color:#000">修改密码</a></span></div>
                      </div>
                    </td>
                  </tr>
                  <!----></tbody>
              </table>
            </div>

            <!----></div>
          <!---->
         </div>
      </div>

      <div data-v-79861fda="" class="modal-box showcominfo_content" style="display: none;">
        <div data-v-79861fda="" class="modal-mask"></div>
        <div data-v-79861fda="" class="modal-container">
          <div data-v-79861fda="" class="modal-content" style="width: 600px;">
            <div data-v-79861fda="" class="modal-header">
              <b data-v-79861fda="">帐号详情</b>
              <span data-v-79861fda="" class="close_showcominfo_content">关闭</span></div>
            <div data-v-79861fda="" class="modal-body">
              <div data-v-79861fda="" class="basis-info">
                <form autocomplete="off" class="u-form ivu-form ivu-form-label-right" data-v-79861fda="">
                  <div class="ivu-row">
                    <div class="ivu-col ivu-col-span-12">
                      <div class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">用户编号:</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div class="input-box"><?php echo $this->_tpl_vars['user_info']['user_id']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div class="ivu-col ivu-col-span-12">
                      <div class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">登录帐号:</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div class="input-box"><?php echo $this->_tpl_vars['user_info']['user_name']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div class="ivu-row">
                    <div class="ivu-col ivu-col-span-12">
                      <div class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">用户名称:</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div class="input-box"><?php echo $this->_tpl_vars['enterprise_info']['enterprise_name']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div class="ivu-col ivu-col-span-12">
                      <div class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">角色:</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div class="input-box">商户</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div class="ivu-row">
                    <div class="ivu-col ivu-col-span-12">
                      <div class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">状态:</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div class="input-box">启用</div>
                          <!----></div>
                      </div>
                    </div>
                    <div class="ivu-col ivu-col-span-12">
                      <div class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">创建时间:</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div class="input-box"><?php echo $this->_tpl_vars['user_info']['add_time']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div data-v-79861fda="" class="modal-footer"></div>
          </div>
        </div>
      </div>

      <div data-v-79861fda="" class="modal-box editcominfo_content" style="display: none;">
        <div data-v-79861fda="" class="modal-mask"></div>
        <div data-v-79861fda="" class="modal-container">
          <div data-v-79861fda="" class="modal-content" style="width: 600px;">
            <div data-v-79861fda="" class="modal-header">
              <b data-v-79861fda="">编辑帐号</b>
              <span data-v-79861fda="" class="close_editcominfo_content">关闭</span></div>
            <div data-v-79861fda="" class="modal-body">
              <form   class="u-form ivu-form ivu-form-label-right"  action="/usernew.php?rec=setinfo_post" method="post">
                <div class="ivu-row">
                  <div class="u-form-col ivu-col ivu-col-span-22">
                    <div class="ivu-form-item ivu-form-item-required">
                      <label class="ivu-form-item-label" style="width: 120px;">登录帐号：</label>
                      <div class="ivu-form-item-content" style="margin-left: 120px;">
                        <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                          <!---->
                          <!---->
                          <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                          <input  type="text" value="<?php echo $this->_tpl_vars['user_info']['user_name']; ?>
" name="setuser_name" placeholder="请输入登录帐号" class="ivu-input ivu-input-large">
                          <!----></div>
                        <!----></div>
                    </div>
                  </div>
                </div>
                <div class="ivu-row">
                  <div class="u-form-col ivu-col ivu-col-span-22">
                    <div class="ivu-form-item ivu-form-item-required">
                      <label class="ivu-form-item-label" style="width: 120px;">用户名称：</label>
                      <div class="ivu-form-item-content" style="margin-left: 120px;">
                        <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                          <!---->
                          <!---->
                          <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                          <input  type="text" value="<?php echo $this->_tpl_vars['enterprise_info']['enterprise_name']; ?>
"  name="setenterprise_name" placeholder="请再次输入用户名称" class="ivu-input ivu-input-large ">
                          <!----></div>
                        <!----></div>
                    </div>
                  </div>
                </div>
                <div class="ivu-row">
                  <div class="u-form-col ivu-col ivu-col-span-22">
                    <div class="ivu-form-item ivu-form-item-required">
                      <label class="ivu-form-item-label" style="width: 120px;">角色：</label>
                      <div class="ivu-form-item-content" style="margin-left: 120px;">
                        <div class="ivu-select ivu-select-single ivu-select-large">
                          <div tabindex="0" class="ivu-select-selection">
                            <input type="hidden" value="">
                            <div>
                              <span class="ivu-select-placeholder">商户</span>
                              <!---->
                              <!---->

                            </div>

                          </div>

                        </div>
                        <!----></div>
                    </div>
                  </div>
                </div>
                <div class="ivu-row" style="display:none">
                  <div class="u-form-col ivu-col ivu-col-span-22">
                    <div class="ivu-form-item">
                      <label class="ivu-form-item-label" style="width: 120px;">状态：</label>
                      <div class="ivu-form-item-content" style="margin-left: 120px;">
                        <div name="ivuRadioGroup_1568683725698_3" class="ivu-radio-group ivu-radio-group-large ivu-radio-large">
                          <label class="ivu-radio-wrapper ivu-radio-group-item ivu-radio-wrapper-checked ivu-radio-large">
                            <span class="ivu-radio ivu-radio-checked">
                              <span class="ivu-radio-inner"></span>
                              <input type="radio" class="ivu-radio-input" name="ivuRadioGroup_1568683725698_3"></span>启用</label>
                          <label class="ivu-radio-wrapper ivu-radio-group-item ivu-radio-large">
                            <span class="ivu-radio">
                              <span class="ivu-radio-inner"></span>
                              <input type="radio" class="ivu-radio-input" name="ivuRadioGroup_1568683725698_3"></span>禁用</label>
                        </div>
                        <!----></div>
                    </div>
                  </div>
                </div>
                <div class="ivu-row">
                  <div class="u-form-col ivu-col ivu-col-span-22">
                    <div class="ivu-form-item">
                      <!---->
                      <div class="ivu-form-item-content" style="margin-left: 120px;">
                        <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
                        <button type="submit" class="u-btn u-btn-red reset-btn">保存</button>
                        <button type="button" class="u-btn reset-btn close_editcominfo_content">取消</button>
                        <!----></div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div data-v-79861fda="" class="modal-footer"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>

  <?php endif; ?>


 <?php if ($this->_tpl_vars['rec'] == 'addlist'): ?>
 <div data-v-3e39c47e="" class="main">
   <div data-v-6212b111="" data-v-3e39c47e="" class="task-publish-info-box">
     <div data-v-c2754978="" data-v-6212b111="" class="page-title-box">
       <p data-v-c2754978="">发布任务
         <span data-v-c2754978=""></span></p>
     </div>
     <div data-v-6212b111="" class="task-publish-body">
       <form  action="/usernew.php?rec=addlist_post" method="post"  enctype="multipart/form-data" class="task-publish-form u-form ivu-form ivu-form-label-right">
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-24">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">任务标题</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                   <!---->
                   <!---->
                   <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                   <input  name="name" type="text" placeholder="请输入任务标题" class="ivu-input ivu-input-large">
                   <!----></div>
                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-24">
             <div data-v-6212b111="" class="required-before ivu-form-item">
               <label class="ivu-form-item-label" style="width: 120px;">任务分类</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-row">
                     <select id="category1"  class="ivu-input ivu-input-large" style="width:40%; float:left">
                      <?php $_from = $this->_tpl_vars['category_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['cate']):
?>
                      <option value="<?php echo $this->_tpl_vars['cate']['cat_id']; ?>
"><?php echo $this->_tpl_vars['cate']['cat_name']; ?>
</option>
                      <?php endforeach; endif; unset($_from); ?>
                    </select>

                     <select name="cat_name"  class="ivu-input ivu-input-large" id="category2" style="display:none;width:40%; float:left">

                    </select>

                 </div>
                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="required-before ivu-form-item">
               <label class="ivu-form-item-label" style="width: 120px;">单价类型</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" name="ivuRadioGroup_1567672524607_0" class="ivu-radio-group ivu-radio-group-large ivu-radio-large">
                   <label data-v-6212b111="" class="ivu-radio-wrapper ivu-radio-group-item ivu-radio-wrapper-checked ivu-radio-large">
                     <span class="ivu-radio ivu-radio-checked">
                        <input type="radio"  value="0" class="change_price_type" name="price_type"></span>固定额</label>
                   <label data-v-6212b111="" class="ivu-radio-wrapper ivu-radio-group-item ivu-radio-large">
                     <span class="ivu-radio">
                        <input type="radio" value="1" class="change_price_type"  name="price_type"></span>范围</label>
                 </div>
                 <!----></div>
             </div>
           </div>
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="required-before ivu-form-item">
               <label class="ivu-form-item-label" style="width: 120px;">需求单价</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-row">
                   <div data-v-6212b111="" class="ivu-col ivu-col-span-11">
                     <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
                       <!---->
                       <div class="ivu-form-item-content" style="margin-left: 120px;">
                         <div data-v-6212b111="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                           <!---->
                           <!---->
                           <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                           <input  name="price" type="text" placeholder="请输入需求单价" maxlength="8" class="ivu-input ivu-input-large">
                           <!----></div>
                         <!----></div>
                     </div>
                   </div>
                   <div data-v-6212b111="" class="ivu-col ivu-col-span-2 price_to_span" style="text-align: center; display: none;">-</div>
                   <div data-v-6212b111="" class="ivu-col ivu-col-span-11 price_to_span" style="display: none;">
                     <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
                       <!---->
                       <div class="ivu-form-item-content" style="margin-left: 120px;">
                         <div data-v-6212b111="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                           <!---->
                           <!---->
                           <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                           <input name="price_to" type="text" placeholder="请输入需求单价" maxlength="8" class="ivu-input ivu-input-large">
                           <!----></div>
                         <!----></div>
                     </div>
                   </div>
                 </div>
                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">计算单位</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-select ivu-select-single ivu-select-large">
                   <div tabindex="0" class="ivu-select-selection">
                     <input type="hidden" value="">
                      <input name="jisuandw" type="text" placeholder="请输入计算单位" maxlength="8" class="ivu-input ivu-input-large">
                   </div>

                 </div>
                 <!----></div>
             </div>

           </div>

         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">需要人数</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                   <!---->
                   <!---->
                   <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                   <input  name="max" type="text" placeholder="请输入需要人数" maxlength="10" class="ivu-input ivu-input-large">
                   <!----></div>
                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-24">
             <div data-v-6212b111="" class="required-before ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">需求地点</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-row">
                   <div data-v-6212b111="" class="inline-col-first ivu-col ivu-col-span-8">
                <input  name="city" type="text" placeholder="请输入城市"  class="ivu-input ivu-input-large">
                   </div>

                    </div>

                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">报名截止时间</label>
                <div class="ivu-form-item-content" style="margin-left: 120px;">

                     <div class="ivu-date-picker-rel">
                         <!---->
                         <i class="ivu-icon ivu-icon-ios-calendar-outline ivu-input-icon ivu-input-icon-normal"></i>
                         <!---->
                         <input  name="stop_time"  id="time"  type="text" placeholder="选择报名截止时间" class="ivu-input ivu-input-large">
                         <!----></div>


                   <!----></div>
             </div>
           </div>
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">任务开始时间</label>
                <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-6212b111="" class="editable ivu-date-picker" style="width: 100%;">
                                  <div class="ivu-date-picker-rel">
                                      <!---->
                                      <i class="ivu-icon ivu-icon-ios-calendar-outline ivu-input-icon ivu-input-icon-normal"></i>
                                      <!---->
                                      <input  name="start_time"  id="time1"  type="text" placeholder="选择任务开始时间" class="ivu-input ivu-input-large">
                                      <!----></div>
                                  </div>

                                <!----></div>
           </div>
         </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">任务截止时间</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="editable ivu-date-picker" style="width: 100%;">
                   <div class="ivu-date-picker-rel">
                       <!---->
                       <i class="ivu-icon ivu-icon-ios-calendar-outline ivu-input-icon ivu-input-icon-normal"></i>
                       <!---->
                       <input  name="end_time"  id="time2"  type="text" placeholder="选择任务截止时间" class="ivu-input ivu-input-large">
                       <!----></div>
                   </div>

                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-12">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">发票类型</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-select ivu-select-single ivu-select-large">
                   <div tabindex="0" class="ivu-select-selection">
                     <input  name="tax_type"    type="text" placeholder="发票类型"  class="ivu-input ivu-input-large">
                   </div>

                 </div>
                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-24">
             <div data-v-6212b111="" class="ivu-form-item ivu-form-item-required">
               <label class="ivu-form-item-label" style="width: 120px;">描述</label>
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                 <div data-v-6212b111="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                   <textarea wrap="soft"  name="content" placeholder="描述" rows="2" class="ivu-input" style="height: 119px; min-height: 119px; max-height: 224px; overflow-y: hidden;"></textarea>
                 </div>
                 <!----></div>
             </div>
           </div>
         </div>
         <div data-v-6212b111="" class="ivu-row">
           <div data-v-6212b111="" class="ivu-col ivu-col-span-24">
             <div data-v-6212b111="" class="confirm-btn ivu-form-item">
               <!---->
               <div class="ivu-form-item-content" style="margin-left: 120px;">
                <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />

                 <?php if ($this->_tpl_vars['createpro'] == 1): ?>
                  <button data-v-6212b111="" type="submit" class="check-btn u-btn u-btn-red ivu-btn ivu-btn-button ivu-btn-large">
                                    <!---->
                                    <!---->
                                    <span>发布</span></button>
                 <?php endif; ?>


                 <!----></div>
             </div>
           </div>
         </div>
       </form>
     </div>
   </div>
 </div>
  <?php endif; ?>



  <?php if ($this->_tpl_vars['rec'] == 'myorder'): ?>
    <div data-v-3e39c47e="" class="main">
       <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
          <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
              <h1 data-v-3c3fa26a="">
                <span data-v-3c3fa26a="" class="actived">发布的订单</span>
              </h1>
           </div>
           <div data-v-67c9ef8f="" data-v-966930ee="" class="my-orders-publish-list-box">
              <form   class="u-form ivu-form ivu-form-label-right" method="get" action="/usernew.php" target="_self" >
                   <div data-v-67c9ef8f="" class="ivu-row">
                           <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-5">
                               <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                   <div class="ivu-form-item-content">
                                       <div data-v-67c9ef8f="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                           <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                           <input  type="text" placeholder="任务编号" name="ppid" value="<?php echo $this->_tpl_vars['ppid']; ?>
" class="ivu-input ivu-input-large">
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-5">
                              <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                  <div class="ivu-form-item-content">
                                      <div data-v-67c9ef8f="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                          <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                          <input  type="text" placeholder="订单编号" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" class="ivu-input ivu-input-large">
                                      </div>
                                  </div>
                              </div>
                          </div>
                           <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-5">
                               <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                   <div class="ivu-form-item-content">
                                       <div data-v-67c9ef8f=""
                                            class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                           <!----> <!----> <i
                                               class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                           <input   type="text" name="p_name" placeholder="任务标题" value="<?php echo $this->_tpl_vars['p_name']; ?>
" class="ivu-input ivu-input-large"> <!---->
                                       </div> <!----></div>
                               </div>
                           </div>
                           <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-4">
                              <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                  <div class="ivu-form-item-content">
                                      <div data-v-67c9ef8f=""
                                           class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                          <!----> <!----> <i
                                              class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                          <input   type="text" name="truename" placeholder="报名方" value="<?php echo $this->_tpl_vars['truename']; ?>
" class="ivu-input ivu-input-large"> <!---->
                                      </div> <!----></div>
                              </div>
                          </div>
                           <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-4">
                               <div data-v-67c9ef8f="" class="ivu-form-item"><!---->
                                   <div class="ivu-form-item-content">
                                       <div data-v-67c9ef8f="" class="ivu-select ivu-select-single ivu-select-large">
                                           <div tabindex="0" class="">
                                                <select  class="ivu-select-selection" name="status" style="witdh:100%">
                                                 <option  value="">订单状态<?php echo $this->_tpl_vars['status']; ?>
</option>
                                                 <?php if ($this->_tpl_vars['status'] == '0'): ?>
                                                 <option value="0" selected>已领取</option>
                                                 <?php else: ?>
                                                 <option value="0">已领取</option>
                                                 <?php endif; ?>

                                                 <?php if ($this->_tpl_vars['status'] == '1'): ?>
                                                  <option value="1" selected>已完成</option>
                                                  <?php else: ?>
                                                  <option value="1">已完成</option>
                                                  <?php endif; ?>

                                                  <?php if ($this->_tpl_vars['status'] == '2'): ?>
                                                    <option value="2" selected>已付款</option>
                                                     <?php else: ?>
                                                    <option value="2">已付款</option>
                                                    <?php endif; ?>


                                               </select>

                                           </div>

                                       </div>
                                     </div>
                               </div>
                           </div>
                   </div>

                               <div data-v-67c9ef8f="" class="ivu-row">
                                   <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-10">
                                       <div data-v-67c9ef8f="" class="ivu-form-item">
                                           <label class="ivu-form-item-label" style="width: 70px;">报名时间</label>
                                           <div class="ivu-form-item-content" style="margin-left: 70px;">
                                               <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                                   <div class="ivu-date-picker-rel">
                                                       <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                                              <input name="add_time1" id="time" value="<?php echo $this->_tpl_vars['add_time1']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"  class="ivu-input ivu-input-large">
                                                            - <input name="add_time2"  id="time1" value="<?php echo $this->_tpl_vars['add_time2']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"   class="ivu-input ivu-input-large">
                                                       </div>
                                                   </div>
                                              </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-10">
                                       <div data-v-67c9ef8f="" class="ivu-form-item">
                                             <label class="ivu-form-item-label" style="width: 70px;">创建时间</label>
                                             <div class="ivu-form-item-content" style="margin-left: 70px;">
                                                 <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                                    <div class="ivu-date-picker-rel">
                                                        <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                                             <input type="text" name="end_time1" value="<?php echo $this->_tpl_vars['end_time1']; ?>
" id="time2" placeholder="选择任务截止时间"  style="width:46%" class="ivu-input ivu-input-large">
                                                            -<input type="text" name="end_time2" value="<?php echo $this->_tpl_vars['end_time2']; ?>
" id="time3" placeholder="选择任务截止时间"  style="width:46%" class="ivu-input ivu-input-large">
                                                        </div>
                                                   </div>

                                                 </div>
                                             </div>
                                       </div>
                                   </div>
                                   <div data-v-67c9ef8f="" class="u-form-col ivu-col ivu-col-span-4">
                                   <input type="hidden" name="rec"  value="myorder" />
                                       <button data-v-67c9ef8f="" type="submit" class="u-btn u-btn-red search-btn"></button>
                                   </div>
                               </div>
                           </form>

<div class="u-table ivu-table-wrapper">
  <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe">
    <!---->
    <div class="ivu-table-header">
      <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
        <colgroup>
          <col width="50">
            <col width="75">
              <col width="100">
                <col width="93">
                  <col width="100">
                    <col width="100">
                      <col width="70">
                        <col width="75">
                          <col width="80">
                            <col width="80">
                              <col width="70">
                                <col width="75">
                                  <!----></colgroup>
        <thead>
          <tr>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">序号</span>
                <!---->
                <!----></div>
            </th>
            <th class="">
              <div class="ivu-table-cell">
                <span class="">订单时间</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">订单编号</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">任务编号</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">任务标题</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">需求单价</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">报名方</span>
                <!---->
                <!----></div>
            </th>
            <th class="">
              <div class="ivu-table-cell">
                <span class="">报名时间</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">需求地点</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">任务分类</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">订单状态</span>
                <!---->
                <!----></div>
            </th>
            <th class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span class="">操作</span>
                <!---->
                <!----></div>
            </th>
            <!----></tr>
        </thead>
      </table>
    </div>
    <div class="ivu-table-body">
       <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
        <colgroup>
          <col width="50">
            <col width="75">
              <col width="100">
                <col width="93">
                  <col width="100">
                    <col width="100">
                      <col width="70">
                        <col width="75">
                          <col width="80">
                            <col width="80">
                              <col width="70">
                                <col width="75"></colgroup>
        <tbody class="ivu-table-tbody">

        <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['order']):
?>
          <tr class="ivu-table-row">
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <span><?php echo $this->_tpl_vars['key']+1; ?>
</span>
                <!---->
                <!---->
                <!---->
                <!---->
                <!----></div>
            </td>
            <td class="">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span><?php echo $this->_tpl_vars['order']['add_time']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span>T00000<?php echo $this->_tpl_vars['order']['ppid']; ?>
_<?php echo $this->_tpl_vars['order']['id']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span>T00000<?php echo $this->_tpl_vars['order']['ppid']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span><?php echo $this->_tpl_vars['order']['p_name']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span><?php echo $this->_tpl_vars['order']['p_price']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span><?php echo $this->_tpl_vars['order']['truename']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span><?php echo $this->_tpl_vars['order']['add_time']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <!---->
                <!---->
                <div class="tr-div"><?php echo $this->_tpl_vars['order']['p_city']; ?>
</div></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span><?php echo $this->_tpl_vars['order']['p_catname']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <span><?php echo $this->_tpl_vars['order']['status']; ?>
</span>
                <!---->
                <!----></div>
            </td>
            <td class="ivu-table-column-center">
              <div class="ivu-table-cell">
                <!---->
                <!---->
                <!---->
                <!---->
                <!---->
                <div class="tr-div">
                  <span class="td-span"><a href="/usernew.php?rec=myorderinfo&id=<?php echo $this->_tpl_vars['order']['id']; ?>
" style="color:#515a6e;">详情</a></span>
                  <span class="td-span" style="display: none;">验收</span></div>
              </div>
            </td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
          <!----></tbody>
      </table>

    </div>

   </div>
  <!---->
 </div>



                         <div data-v-67c9ef8f="" class="page-box">
                             <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                         </div>
                       </div>
                   </div>
               </div>
   <?php endif; ?>




     <?php if ($this->_tpl_vars['rec'] == 'transaction'): ?>

        <div data-v-3e39c47e="" class="main">
          <div data-v-3e39c47e="" class="my-transactions-list-box">
            <div data-v-3c3fa26a="" class="tab-title-box">
              <h1 data-v-3c3fa26a="">
                <span data-v-3c3fa26a="" class="actived">我的交易</span></h1>
              <div data-v-3c3fa26a="" class="right-box" style="display: none;"></div>
            </div>
            <div class="my-transactions-list-main">
              <form  class="u-form ivu-form ivu-form-label-right"  method="get" action="/usernew.php" target="_self">
                <div class="ivu-row">
                  <div class="u-form-col ivu-col ivu-col-span-6">
                    <div class="ivu-form-item">
                      <!---->
                      <div class="ivu-form-item-content">
                        <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                          <!---->
                          <!---->
                          <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                          <input   type="text" placeholder="任务编号" name="ppid" value="<?php echo $this->_tpl_vars['ppid']; ?>
" class="ivu-input ivu-input-large">
                          <!----></div>
                        <!----></div>
                    </div>
                  </div>
                  <div class="u-form-col ivu-col ivu-col-span-6">
                    <div class="ivu-form-item">
                      <!---->
                      <div class="ivu-form-item-content">
                        <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                          <!---->
                          <!---->
                          <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                          <input   type="text" placeholder="订单编码"  name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" class="ivu-input ivu-input-large">
                          <!----></div>
                        <!----></div>
                    </div>
                  </div>
                  <div class="u-form-col ivu-col ivu-col-span-6">
                    <div class="ivu-form-item">
                      <!---->
                      <div class="ivu-form-item-content">
                          <div class="ivu-select ivu-select-single ivu-select-large">
                            <select  class="ivu-select-selection" name="status" style="witdh:100%">
                            <option  value="">收支类型 </option>
                            <?php if ($this->_tpl_vars['status'] == '0'): ?>
                            <option value="0" selected>已接单</option>
                            <?php else: ?>
                            <option value="0">已接单</option>
                            <?php endif; ?>

                            <?php if ($this->_tpl_vars['status'] == '1'): ?>
                            <option value="1" selected>待验收</option>
                            <?php else: ?>
                            <option value="1">待验收</option>
                            <?php endif; ?>

                            <?php if ($this->_tpl_vars['status'] == '2'): ?>
                            <option value="2" selected>验收通过</option>
                            <?php else: ?>
                            <option value="2">验收通过</option>
                            <?php endif; ?>


                        </select>
                        </div>
                        <!----></div>
                    </div>
                  </div>
                </div>

                <div class="ivu-row">
                  <div class="u-form-col ivu-col ivu-col-span-6">
                  <div class="ivu-select ivu-select-single ivu-select-large">
                     <select  class="ivu-select-selection" name="pay_status" style="witdh:100%">
                        <option  value="">支付状态 </option>
                        <?php if ($this->_tpl_vars['pay_status'] == '0'): ?>
                        <option value="0" selected>未支付</option>
                        <?php else: ?>
                        <option value="0">未支付</option>
                        <?php endif; ?>

                        <?php if ($this->_tpl_vars['pay_status'] == '1'): ?>
                        <option value="1" selected>已支付</option>
                        <?php else: ?>
                        <option value="1">已支付</option>
                        <?php endif; ?>

                    </select>
                   </div>
                  </div>
                  <div class="u-form-col ivu-col ivu-col-span-10">
                    <div class="ivu-form-item">
                     <label class="ivu-form-item-label" style="width: 70px;">报名时间</label>
                         <div class="ivu-form-item-content" style="margin-left: 70px;">
                             <div data-v-67c9ef8f="" class="editable ivu-date-picker" style="width: 100%;">
                                 <div class="ivu-date-picker-rel">
                                     <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                                         <input name="add_time1" id="time" value="<?php echo $this->_tpl_vars['add_time1']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"  class="ivu-input ivu-input-large">
                                         - <input name="add_time2"  id="time1" value="<?php echo $this->_tpl_vars['add_time2']; ?>
" type="text" placeholder="选择任务发布时间" style="width:46%"   class="ivu-input ivu-input-large">
                                     </div>
                                 </div>
                             </div>
                         </div>
                    </div>
                  </div>
                  <div class="u-form-col ivu-col ivu-col-span-8">
                   <input type="hidden" name="rec"  value="transaction" />
                    <button  type="submit" class="u-btn u-btn-red search-btn"></button>
                  </div>
                </div>
              </form>
              <div class="u-table ivu-table-wrapper">
                <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe">
                  <!---->
                  <div class="ivu-table-header">
                    <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                      <colgroup>
                        <col width="50">
                          <col width="100">
                            <col width="100">
                              <col width="70">
                                <col width="100">
                                  <col width="70">
                                    <col width="75">
                                      <col width="151">
                                        <col width="152">
                                          <col width="100">
                                            <!----></colgroup>
                      <thead>
                        <tr>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">序号</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">订单编号</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">交易流水号</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">收支类型</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">应付金额</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">支付状态</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="">
                            <div class="ivu-table-cell">
                              <span class="">支付时间</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">需求方</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">服务方</span>
                              <!---->
                              <!----></div>
                          </th>
                          <th class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span class="">操作</span>
                              <!---->
                              <!----></div>
                          </th>
                          <!----></tr>
                      </thead>
                    </table>
                  </div>
                  <div class="ivu-table-body">
                    <table cellspacing="0" cellpadding="0" border="0" style="width: 969px;">
                      <colgroup>
                        <col width="50">
                          <col width="100">
                            <col width="100">
                              <col width="70">
                                <col width="100">
                                  <col width="70">
                                    <col width="75">
                                      <col width="151">
                                        <col width="152">
                                          <col width="100"></colgroup>
                      <tbody class="ivu-table-tbody">
                       <?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['order']):
?>
                        <tr class="ivu-table-row">
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <span><?php echo $this->_tpl_vars['key']+1; ?>
</span>
                              <!---->
                              <!---->
                              <!---->
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span>T00000<?php echo $this->_tpl_vars['order']['ppid']; ?>
_<?php echo $this->_tpl_vars['order']['id']; ?>
</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span><?php echo $this->_tpl_vars['order']['extra']; ?>
</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span>支出</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span><?php echo $this->_tpl_vars['order']['pay_money']; ?>
</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span><?php echo $this->_tpl_vars['order']['pay_status']; ?>
</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span><?php echo $this->_tpl_vars['order']['pay_time']; ?>
</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span><?php echo $this->_tpl_vars['order']['request_name']; ?>
</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <span><?php echo $this->_tpl_vars['order']['service_name']; ?>
</span>
                              <!---->
                              <!----></div>
                          </td>
                          <td class="ivu-table-column-center">
                            <div class="ivu-table-cell">
                              <!---->
                              <!---->
                              <!---->
                              <!---->
                              <!---->
                              <div class="tr-div">
                                <span class="td-span">费用计算详情</span></div>
                            </div>
                          </td>
                        </tr>
                         <?php endforeach; endif; unset($_from); ?>
                         </tbody>
                    </table>
                  </div>

                  <!---->
                  <!---->
                  <!---->
                  <!----></div>
                <!---->
               </div>
              <div class="page-box">
                 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              </div>
            </div>
            <!----></div>
        </div>
 <?php endif; ?>




   <?php if ($this->_tpl_vars['rec'] == 'companyinfo'): ?>

   <div data-v-3e39c47e="" class="main">
     <div data-v-6dd27a7c="" data-v-3e39c47e="" class="company-info-box">
       <div data-v-3c3fa26a="" data-v-6dd27a7c="" class="tab-title-box">
         <h1 data-v-3c3fa26a="">
           <span data-v-3c3fa26a="" class="actived">公司信息</span></h1>
         <div data-v-3c3fa26a="" class="right-box" style="display: none;"></div>
       </div>
       <div data-v-6dd27a7c="" class="company-info-body">
         <div data-v-6dd27a7c="" class="basis-info">
           <h4 data-v-6dd27a7c=""><?php echo $this->_tpl_vars['enterprise_info']['enterprise_name']; ?>
</h4>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">登录帐号:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['global_user']['user_name']; ?>
</span></p>
           <p data-v-6dd27a7c="" style="display:none">
             <span data-v-6dd27a7c="" class="label">用户ID:</span>
             <span data-v-6dd27a7c="" class="text">U002827</span></p>
         </div>
         <div data-v-6dd27a7c="" class="basis-info">
           <h4 data-v-6dd27a7c="">企业信息</h4>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">企业名称:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['enterprise_name']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">用户类型:</span>
             <span data-v-6dd27a7c="" class="text">商户</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">统一社会信用代码:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['credit_code']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">营业执照有效期:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['term_validity']; ?>
</span>
           </p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">企业办公地:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['enterprise_addr']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">行业类型:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['industry_type']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">经营范围:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['scope_business']; ?>
</span>
           </p>
         </div>
         <div data-v-6dd27a7c="" class="basis-info">
           <h4 data-v-6dd27a7c="">法定代表人信息</h4>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">法定代表人:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['legal_person']; ?>
    </span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">证件类型:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['card_type']; ?>
</span>
           </p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">证件号码:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['card_no']; ?>
</span>
           </p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">证件有效期:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['card_time']; ?>
</span></p>
         </div>
         <div data-v-6dd27a7c="" class="basis-info">
           <h4 data-v-6dd27a7c="">企业联系人信息</h4>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">联系人姓名:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['contacts_name']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">联系人邮箱:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['contacts_email']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">联系方式:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['contacts_tel']; ?>
</span></p>
         </div>
         <div data-v-6dd27a7c="" class="basis-info">
           <h4 data-v-6dd27a7c="">对公账户信息</h4>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">开户银行:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['open_bank']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">开户城市:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['open_bank_city']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">支行名称:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['branch_bank']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">开户公司名称:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['enterprise_name']; ?>
</span></p>
           <p data-v-6dd27a7c="">
             <span data-v-6dd27a7c="" class="label">银行帐号:</span>
             <span data-v-6dd27a7c="" class="text"><?php echo $this->_tpl_vars['enterprise_info']['bank_no']; ?>
</span></p>
         </div>
         <div data-v-6dd27a7c="" class="basis-info" style="display:none">
           <h4 data-v-6dd27a7c="">主签约信息</h4>
           <form data-v-828611b8="" data-v-6dd27a7c="" autocomplete="off" class="u-form ivu-form ivu-form-label-right">
             <div data-v-828611b8="" class="ivu-row">
               <div data-v-828611b8="" class="ivu-col ivu-col-span-12">
                 <div data-v-828611b8="" class="ivu-form-item">
                   <label class="ivu-form-item-label" style="width: 150px;">费用模式</label>
                   <div class="ivu-form-item-content" style="margin-left: 150px;">
                     <div data-v-828611b8="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                       <!---->
                       <!---->
                       <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                       <input autocomplete="off" spellcheck="false" type="text" placeholder="请选择费用模式" readonly="readonly" class="ivu-input ivu-input-large">
                       <!----></div>
                     <!----></div>
                 </div>
               </div>
             </div>
             <div data-v-828611b8="" class="ivu-row">
               <div data-v-828611b8="" class="ivu-col ivu-col-span-12">
                 <div data-v-828611b8="" class="ivu-form-item">
                   <label class="ivu-form-item-label" style="width: 150px;">签约期限</label>
                   <div class="ivu-form-item-content" style="margin-left: 150px;">
                     <div data-v-828611b8="" class="editable ivu-date-picker" style="width: 100%;">
                       <div class="ivu-date-picker-rel">
                         <div class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type ivu-date-picker-editor">
                           <!---->
                           <i class="ivu-icon ivu-icon-ios-calendar-outline ivu-input-icon ivu-input-icon-normal"></i>
                           <!---->
                           <input autocomplete="off" spellcheck="false" type="text" placeholder="签约期限" readonly="readonly" class="ivu-input ivu-input-large">
                           <!----></div>
                       </div>
                       <div class="ivu-select-dropdown" style="display: none;">
                         <div>
                           <div class="ivu-picker-panel-body-wrapper" steps="">
                             <!---->
                             <div class="ivu-picker-panel-body">
                               <div class="ivu-date-picker-header">
                                 <span class="ivu-picker-panel-icon-btn ivu-date-picker-prev-btn ivu-date-picker-prev-btn-arrow-double">
                                   <i class="ivu-icon ivu-icon-ios-arrow-back"></i>
                                 </span>
                                 <span class="ivu-picker-panel-icon-btn ivu-date-picker-prev-btn ivu-date-picker-prev-btn-arrow">
                                   <i class="ivu-icon ivu-icon-ios-arrow-back"></i>
                                 </span>
                                 <span>
                                   <span class="ivu-date-picker-header-label">2020年</span>
                                   <span class="ivu-date-picker-header-label">4月</span></span>
                                 <span class="ivu-picker-panel-icon-btn ivu-date-picker-next-btn ivu-date-picker-next-btn-arrow-double">
                                   <i class="ivu-icon ivu-icon-ios-arrow-forward"></i>
                                 </span>
                                 <span class="ivu-picker-panel-icon-btn ivu-date-picker-next-btn ivu-date-picker-next-btn-arrow">
                                   <i class="ivu-icon ivu-icon-ios-arrow-forward"></i>
                                 </span>
                               </div>
                               <div class="ivu-picker-panel-content">
                                 <div class="ivu-date-picker-cells">
                                   <div class="ivu-date-picker-cells-header">
                                     <span>日</span>
                                     <span>一</span>
                                     <span>二</span>
                                     <span>三</span>
                                     <span>四</span>
                                     <span>五</span>
                                     <span>六</span></div>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-prev-month">
                                     <em>29</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-prev-month">
                                     <em>30</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-prev-month">
                                     <em>31</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>1</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>2</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>3</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>4</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>5</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>6</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>7</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>8</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>9</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>10</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>11</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>12</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>13</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>14</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>15</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>16</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>17</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>18</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>19</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>20</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>21</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>22</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>23</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>24</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>25</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>26</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>27</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>28</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-selected ivu-date-picker-cells-focused">
                                     <em>29</em></span>
                                   <span class="ivu-date-picker-cells-cell">
                                     <em>30</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>1</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>2</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>3</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>4</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>5</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>6</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>7</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>8</em></span>
                                   <span class="ivu-date-picker-cells-cell ivu-date-picker-cells-cell-next-month">
                                     <em>9</em></span>
                                 </div>
                               </div>
                               <div class="ivu-picker-panel-content" style="display: none;">
                                 <!----></div>
                               <!----></div>
                           </div>
                         </div>
                       </div>
                     </div>
                     <!----></div>
                 </div>
               </div>
               <div data-v-828611b8="" class="ivu-col ivu-col-span-12">
                 <div data-v-828611b8="" class="ivu-form-item">
                   <label class="ivu-form-item-label" style="width: 150px;">是否自动延期</label>
                   <div class="ivu-form-item-content" style="margin-left: 150px;">
                     <label data-v-828611b8="" class="ivu-checkbox-wrapper ivu-checkbox-large" onclick="return false;">
                       <span class="ivu-checkbox">
                         <span class="ivu-checkbox-inner"></span>
                         <input type="checkbox" class="ivu-checkbox-input"></span>
                       <!----></label>
                     <!----></div>
                 </div>
               </div>
             </div>
             <div data-v-828611b8="" class="ivu-row">
               <div data-v-828611b8="" class="ivu-col ivu-col-span-12">
                 <div data-v-828611b8="" class="ivu-form-item">
                   <label class="ivu-form-item-label" style="width: 150px;">是否分摊服务费用</label>
                   <div class="ivu-form-item-content" style="margin-left: 150px;">
                     <label data-v-828611b8="" class="ivu-checkbox-wrapper ivu-checkbox-large" onclick="return false;">
                       <span class="ivu-checkbox">
                         <span class="ivu-checkbox-inner"></span>
                         <input type="checkbox" class="ivu-checkbox-input"></span>
                       <!----></label>
                     <!----></div>
                 </div>
               </div>
             </div>
             <div data-v-828611b8="" class="ivu-row">
               <div data-v-828611b8="" class="ivu-col ivu-col-span-36">
                 <div data-v-828611b8="" class="ivu-form-item">
                   <label class="ivu-form-item-label" style="width: 150px;">服务费率 企业</label>
                   <div class="ivu-form-item-content" style="margin-left: 150px;">
                     <div data-v-828611b8="" class="u-table ivu-table-wrapper">
                       <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe">
                         <!---->
                         <div class="ivu-table-header">
                           <table cellspacing="0" cellpadding="0" border="0" style="width: 809px;">
                             <colgroup>
                               <col width="20">
                                 <col width="302">
                                   <col width="243">
                                     <col width="243">
                                       <!----></colgroup>
                             <thead>
                               <tr>
                                 <th class="ivu-table-column-center">
                                   <div class="ivu-table-cell">
                                     <span class="">#</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">最小金额</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">最大金额</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">比率%</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <!----></tr>
                             </thead>
                           </table>
                         </div>
                         <div class="ivu-table-body">
                           <table cellspacing="0" cellpadding="0" border="0" style="width: 809px;">
                             <colgroup>
                               <col width="20">
                                 <col width="302">
                                   <col width="243">
                                     <col width="243"></colgroup>
                             <tbody class="ivu-table-tbody">
                               <tr class="ivu-table-row">
                                 <td class="ivu-table-column-center">
                                   <div class="ivu-table-cell">
                                     <span>1</span>
                                     <!---->
                                     <!---->
                                     <!---->
                                     <!---->
                                     <!----></div>
                                 </td>
                                 <td class="">
                                   <div class="ivu-table-cell">
                                     <!---->
                                     <!---->
                                     <!---->
                                     <span>0</span>
                                     <!---->
                                     <!----></div>
                                 </td>
                                 <td class="">
                                   <div class="ivu-table-cell">
                                     <!---->
                                     <!---->
                                     <!---->
                                     <span>-1</span>
                                     <!---->
                                     <!----></div>
                                 </td>
                                 <td class="">
                                   <div class="ivu-table-cell">
                                     <!---->
                                     <!---->
                                     <!---->
                                     <span>8.03</span>
                                     <!---->
                                     <!----></div>
                                 </td>
                               </tr>
                               <!----></tbody>
                           </table>
                         </div>
                         <div class="ivu-table-tip" style="display: none;">
                           <table cellspacing="0" cellpadding="0" border="0">
                             <tbody>
                               <tr>
                                 <td style="width: 809px;">
                                   <span>暂无筛选结果</span></td>
                               </tr>
                             </tbody>
                           </table>
                         </div>
                         <!---->
                         <!---->
                         <!---->
                         <!----></div>
                       <!---->
                       <object tabindex="-1" type="text/html" data="about:blank" style="display: block; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; border: none; padding: 0px; margin: 0px; opacity: 0; z-index: -1000; pointer-events: none;"></object>
                     </div>
                     <!----></div>
                 </div>
               </div>
             </div>
             <div data-v-828611b8="" class="ivu-row" style="display: none;">
               <div data-v-828611b8="" class="ivu-col ivu-col-span-36">
                 <div data-v-828611b8="" class="ivu-form-item">
                   <label class="ivu-form-item-label" style="width: 150px;">服务费率 个人</label>
                   <div class="ivu-form-item-content" style="margin-left: 150px;">
                     <div data-v-828611b8="" class="u-table ivu-table-wrapper">
                       <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe">
                         <!---->
                         <div class="ivu-table-header">
                           <table cellspacing="0" cellpadding="0" border="0" style="width: 201px;">
                             <colgroup>
                               <col width="20">
                                 <col width="100">
                                   <col width="40">
                                     <col width="40">
                                       <!----></colgroup>
                             <thead>
                               <tr>
                                 <th class="ivu-table-column-center">
                                   <div class="ivu-table-cell">
                                     <span class="">#</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">最小金额</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">最大金额</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">比率%</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <!----></tr>
                             </thead>
                           </table>
                         </div>
                         <div class="ivu-table-body" style="display: none;">
                           <table cellspacing="0" cellpadding="0" border="0" style="width: 201px;">
                             <colgroup>
                               <col width="20">
                                 <col width="100">
                                   <col width="40">
                                     <col width="40"></colgroup>
                             <tbody class="ivu-table-tbody"></tbody>
                           </table>
                         </div>
                         <div class="ivu-table-tip">
                           <table cellspacing="0" cellpadding="0" border="0">
                             <tbody>
                               <tr>
                                 <td style="width: 0px;">
                                   <span>暂无数据</span></td>
                               </tr>
                             </tbody>
                           </table>
                         </div>
                         <!---->
                         <!---->
                         <!---->
                         <!----></div>
                       <!---->
                       <object tabindex="-1" type="text/html" data="about:blank" style="display: block; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; border: none; padding: 0px; margin: 0px; opacity: 0; z-index: -1000; pointer-events: none;"></object>
                     </div>
                     <!----></div>
                 </div>
               </div>
             </div>
             <div data-v-828611b8="" class="ivu-row">
               <div data-v-828611b8="" class="ivu-col ivu-col-span-36">
                 <div data-v-828611b8="" class="ivu-form-item">
                   <label class="ivu-form-item-label" style="width: 150px;">个人经营税率</label>
                   <div class="ivu-form-item-content" style="margin-left: 150px;">
                     <div data-v-828611b8="" class="u-table ivu-table-wrapper">
                       <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe">
                         <!---->
                         <div class="ivu-table-header">
                           <table cellspacing="0" cellpadding="0" border="0" style="width: 809px;">
                             <colgroup>
                               <col width="20">
                                 <col width="302">
                                   <col width="243">
                                     <col width="243">
                                       <!----></colgroup>
                             <thead>
                               <tr>
                                 <th class="ivu-table-column-center">
                                   <div class="ivu-table-cell">
                                     <span class="">#</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">最小金额</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">最大金额</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <th class="">
                                   <div class="ivu-table-cell">
                                     <span class="">比率%</span>
                                     <!---->
                                     <!----></div>
                                 </th>
                                 <!----></tr>
                             </thead>
                           </table>
                         </div>
                         <div class="ivu-table-body">
                           <table cellspacing="0" cellpadding="0" border="0" style="width: 809px;">
                             <colgroup>
                               <col width="20">
                                 <col width="302">
                                   <col width="243">
                                     <col width="243"></colgroup>
                             <tbody class="ivu-table-tbody">
                               <tr class="ivu-table-row">
                                 <td class="ivu-table-column-center">
                                   <div class="ivu-table-cell">
                                     <span>1</span>
                                     <!---->
                                     <!---->
                                     <!---->
                                     <!---->
                                     <!----></div>
                                 </td>
                                 <td class="">
                                   <div class="ivu-table-cell">
                                     <!---->
                                     <!---->
                                     <!---->
                                     <span>0</span>
                                     <!---->
                                     <!----></div>
                                 </td>
                                 <td class="">
                                   <div class="ivu-table-cell">
                                     <!---->
                                     <!---->
                                     <!---->
                                     <span>-1</span>
                                     <!---->
                                     <!----></div>
                                 </td>
                                 <td class="">
                                   <div class="ivu-table-cell">
                                     <!---->
                                     <!---->
                                     <!---->
                                     <span>0.5</span>
                                     <!---->
                                     <!----></div>
                                 </td>
                               </tr>
                               <!----></tbody>
                           </table>
                         </div>
                         <div class="ivu-table-tip" style="display: none;">
                           <table cellspacing="0" cellpadding="0" border="0">
                             <tbody>
                               <tr>
                                 <td style="width: 809px;">
                                   <span>暂无筛选结果</span></td>
                               </tr>
                             </tbody>
                           </table>
                         </div>
                         <!---->
                         <!---->
                         <!---->
                         <!----></div>
                       <!---->
                       <object tabindex="-1" type="text/html" data="about:blank" style="display: block; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; border: none; padding: 0px; margin: 0px; opacity: 0; z-index: -1000; pointer-events: none;"></object>
                     </div>
                     <!----></div>
                 </div>
               </div>
             </div>
           </form>
         </div>
         <div data-v-6dd27a7c="" class="basis-info" style="display:none">
           <h4 data-v-6dd27a7c="">签约列表
             <div data-v-6dd27a7c="" class="u-table ivu-table-wrapper">
               <div class="ivu-table ivu-table-large ivu-table-border ivu-table-stripe">
                 <!---->
                 <div class="ivu-table-header">
                   <table cellspacing="0" cellpadding="0" border="0" style="width: 959px;">
                     <colgroup>
                       <col width="20">
                         <col width="259">
                           <col width="199">
                             <col width="200">
                               <col width="200">
                                 <col width="80">
                                   <!----></colgroup>
                     <thead>
                       <tr>
                         <th class="ivu-table-column-center">
                           <div class="ivu-table-cell">
                             <span class="">#</span>
                             <!---->
                             <!----></div>
                         </th>
                         <th class="">
                           <div class="ivu-table-cell">
                             <span class="">企业</span>
                             <!---->
                             <!----></div>
                         </th>
                         <th class="">
                           <div class="ivu-table-cell">
                             <span class="">服务公司</span>
                             <!---->
                             <!----></div>
                         </th>
                         <th class="">
                           <div class="ivu-table-cell">
                             <span class="">费用模式</span>
                             <!---->
                             <!----></div>
                         </th>
                         <th class="">
                           <div class="ivu-table-cell">
                             <span class="">签约期限</span>
                             <!---->
                             <!----></div>
                         </th>
                         <th class="">
                           <div class="ivu-table-cell">
                             <span class="">操作</span>
                             <!---->
                             <!----></div>
                         </th>
                         <!----></tr>
                     </thead>
                   </table>
                 </div>
                 <div class="ivu-table-body">
                   <table cellspacing="0" cellpadding="0" border="0" style="width: 959px;">
                     <colgroup>
                       <col width="20">
                         <col width="259">
                           <col width="199">
                             <col width="200">
                               <col width="200">
                                 <col width="80"></colgroup>
                     <tbody class="ivu-table-tbody">
                       <tr class="ivu-table-row">
                         <td class="ivu-table-column-center">
                           <div class="ivu-table-cell">
                             <span>1</span>
                             <!---->
                             <!---->
                             <!---->
                             <!---->
                             <!----></div>
                         </td>
                         <td class="">
                           <div class="ivu-table-cell">
                             <!---->
                             <!---->
                             <!---->
                             <!---->
                             <!---->
                             <span>山东和信会计师事务所(特殊普通合伙)上海分所</span></div>
                         </td>
                         <td class="">
                           <div class="ivu-table-cell">
                             <!---->
                             <!---->
                             <!---->
                             <!---->
                             <!---->
                             <span>上海睿猫科技发展有限公司</span></div>
                         </td>
                         <td class="">
                           <div class="ivu-table-cell">
                             <!---->
                             <!---->
                             <!---->
                             <span>平台</span>
                             <!---->
                             <!----></div>
                         </td>
                         <td class="">
                           <div class="ivu-table-cell">
                             <!---->
                             <!---->
                             <!---->
                             <span>2020-04-29</span>
                             <!---->
                             <!----></div>
                         </td>
                         <td class="">
                           <div class="ivu-table-cell">
                             <!---->
                             <!---->
                             <!---->
                             <!---->
                             <!---->
                             <div class="tr-div">
                               <span class="td-span">查看</span></div>
                           </div>
                         </td>
                       </tr>
                       <!----></tbody>
                   </table>
                 </div>

                 <!---->
                 <!---->
                 <!---->
                 <!----></div>
               <!---->
              </div>
           </h4>
         </div>
         <!----></div>
     </div>
   </div>
   <?php endif; ?>



    <?php if ($this->_tpl_vars['rec'] == 'tasktool'): ?>
    <div data-v-3e39c47e="" class="main">
      <div data-v-3e39c47e="" class="my-todo-list-box">
        <div data-v-3c3fa26a="" class="tab-title-box">
          <h1 data-v-3c3fa26a="">
            <span data-v-3c3fa26a="" class="actived">待办事务</span></h1>
          <div data-v-3c3fa26a="" class="right-box" style="display: none;"></div>
        </div>
        <div class="my-todo-list-main">
          <div class="todo-list clearfix">
                                  <div class="item">
              <button type="button" class="u-btn-red ivu-btn ivu-btn-default ivu-btn-large">
                <!---->
                <!---->
                <span><a href="/usernew.php?rec=myorder&status=1" style="color:#fff">待验收订单</a></span></button>
              <span class="txt">当前有
                <em><?php echo $this->_tpl_vars['dys']; ?>
</em>个任务订单待验收</span></div>
                      </div>
        </div>
      </div>
    </div>
     <?php endif; ?>




       <?php if ($this->_tpl_vars['rec'] == 'listinfo'): ?>

       <div data-v-3e39c47e="" class="main">
         <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
           <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
             <h1 data-v-3c3fa26a="">
               <span data-v-3c3fa26a="" class="actived">发布的任务</span></h1>
             <div data-v-3c3fa26a="" class="right-box">
               <button data-v-966930ee="" data-v-3c3fa26a="" type="button" class="publish-btn u-btn u-btn-red">
               <a href="/usernew.php?rec=addlist" style="color:#fff">发布任务</a>
               </button>
                                               </div>
           </div>
           <div data-v-562f3806="" data-v-966930ee="" class="task-info-box">
             <h1 data-v-562f3806="">任务详情</h1>
             <div data-v-562f3806="" class="task-info-body">
               <div data-v-562f3806="" class="basis-info">
                 <h4 data-v-562f3806=""><?php echo $this->_tpl_vars['company']['name']; ?>
</h4>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">需求方:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['request_name']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">需求单价:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['price_str']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">计算单位:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['jisuandw']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">需求人数:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['max']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">任务分类:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['cat_name']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">需求地点:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['city']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">报名截止日期:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['stop_time']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">发布日期:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['add_time']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">任务开始时间:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['start_time']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">任务结束时间:</span>
                   <span data-v-562f3806="" class="text"><?php echo $this->_tpl_vars['company']['end_time']; ?>
</span></p>
                 <p data-v-562f3806="">
                   <span data-v-562f3806="" class="label">任务状态:</span>
                   <span data-v-562f3806="" class="text applying"><?php echo $this->_tpl_vars['company']['status_str']; ?>
</span></p>
                 <!----></div>
               <div data-v-562f3806="" class="task-des">
                 <div data-v-562f3806="" class="des-tab">
                   <ul data-v-562f3806="">
                     <li data-v-562f3806="" class="active">需求描述</li>
                     <li data-v-562f3806="" class="" style="display: none;">承接方( 0 )</li>
                     <li data-v-562f3806="" class="" style="display: none;">指派( 0 )</li></ul>
                 </div>
                 <div data-v-562f3806="" class="des-main">
                   <p data-v-562f3806=""><?php echo $this->_tpl_vars['company']['content']; ?>
</p></div>
                 <!---->
                 <!----></div>
               <!----></div>
           </div>
         </div>
       </div>

        <?php endif; ?>



        <?php if ($this->_tpl_vars['rec'] == 'myorderinfo'): ?>
        <div data-v-3e39c47e="" class="main">
          <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
            <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
              <h1 data-v-3c3fa26a="">
                <span data-v-3c3fa26a="" class="actived">发布的订单</span></h1>
              <div data-v-3c3fa26a="" class="right-box" style="display: none;">
                <button data-v-966930ee="" data-v-3c3fa26a="" type="button" class="publish-btn u-btn u-btn-red">发布任务</button>
                <div data-v-966930ee="" class="u-btn u-btn-red reset-btn upload-btn mr10 ivu-upload" data-v-3c3fa26a="">
                  <div class="ivu-upload ivu-upload-select">
                    <input type="file" class="ivu-upload-input">批量发布</div>
                  <ul class="ivu-upload-list"></ul>
                </div>
                <button data-v-966930ee="" data-v-3c3fa26a="" type="button" class="u-btn u-btn-red reset-btn upload-btn mr10" style="background-color: rgb(224, 224, 224); color: black; width: 1.5rem; border: 1px solid rgb(224, 224, 224);">下载批量发布模板</button></div>
            </div>
            <div data-v-72207a2c="" data-v-966930ee="" class="order-info-box">
              <h1 data-v-72207a2c="">订单详情</h1>
              <div data-v-72207a2c="" class="basis-info">
                <form data-v-72207a2c="" autocomplete="off" class="u-form ivu-form ivu-form-label-right">
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">订单编号</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box">T00000<?php echo $this->_tpl_vars['order']['ppid']; ?>
_<?php echo $this->_tpl_vars['order']['id']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">任务编号</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box">T00000<?php echo $this->_tpl_vars['order']['ppid']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">订单状态</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box status"><?php echo $this->_tpl_vars['product']['status_str']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">任务标题</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['product']['name']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">任务分类</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['product']['cat_name']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">单价类型</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['product']['price_type_str']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">需求单价(元)</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['product']['price_str']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">计算单位</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['product']['jisuandw']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">数量</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['product']['max']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">实付金额(元)</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['order']['pay_money']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">报名方</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['order']['truename']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">需求地点</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['product']['city']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">报名时间</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['order']['add_time']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <div data-v-72207a2c="" class="ivu-row">
                    <div data-v-72207a2c="" class="ivu-col ivu-col-span-12">
                      <div data-v-72207a2c="" class="ivu-form-item">
                        <label class="ivu-form-item-label" style="width: 120px;">订单完成时间</label>
                        <div class="ivu-form-item-content" style="margin-left: 120px;">
                          <div data-v-72207a2c="" class="input-box"><?php echo $this->_tpl_vars['order']['finish_time']; ?>
</div>
                          <!----></div>
                      </div>
                    </div>
                  </div>
                  <!---->
                  <!---->
                  <div data-v-72207a2c="">
                    <div data-v-72207a2c="" class="ivu-row">
                      <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                        <div data-v-72207a2c="" class="ivu-form-item">
                          <label class="ivu-form-item-label" style="width: 120px;">凭证</label>
                          <div class="ivu-form-item-content" style="margin-left: 120px;">
                            <!----></div>
                        </div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-row">
                      <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                        <div data-v-72207a2c="" class="ivu-form-item">
                          <label class="ivu-form-item-label" style="width: 120px;">完成情况</label>
                          <div class="ivu-form-item-content" style="margin-left: 120px;">
                            <div data-v-72207a2c="" class="input-box"></div>
                            <!----></div>
                        </div>
                      </div>
                    </div>
                    <div data-v-72207a2c="" class="ivu-row">
                      <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                        <div data-v-72207a2c="" class="ivu-form-item">
                          <label class="ivu-form-item-label" style="width: 120px;">扣款原因</label>
                          <div class="ivu-form-item-content" style="margin-left: 120px;">
                            <div data-v-72207a2c="" class="input-box"></div>
                            <!----></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!---->
                  <!---->
                  <!----></form>
              </div>
              <div data-v-79861fda="" data-v-72207a2c="" class="modal-box" style="display: none;">
                <div data-v-79861fda="" class="modal-mask"></div>
                <div data-v-79861fda="" class="modal-container">
                  <div data-v-79861fda="" class="modal-content" style="width: 600px;">
                    <div data-v-79861fda="" class="modal-header">
                      <b data-v-79861fda="">提交订单</b>
                      <span data-v-79861fda="">关闭</span></div>
                    <div data-v-79861fda="" class="modal-body">
                      <form data-v-72207a2c="" autocomplete="off" class="u-form ivu-form ivu-form-label-right" data-v-79861fda="">
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">需求单价</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="input-box">100.00 - 500.00</div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">计算单位</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="input-box">次</div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">数量</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                  <!---->
                                  <!---->
                                  <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                  <input autocomplete="off" spellcheck="false" type="text" placeholder="数量" class="ivu-input ivu-input-large">
                                  <!----></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">上传凭证</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="ivu-upload">
                                  <div class="ivu-upload ivu-upload-select">
                                    <input type="file" class="ivu-upload-input">浏览</div>
                                  <ul class="ivu-upload-list"></ul>
                                </div>
                                <div data-v-72207a2c=""></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">完成情况</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                  <!---->
                                  <!---->
                                  <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                  <input autocomplete="off" spellcheck="false" type="text" placeholder="完成情况" class="ivu-input ivu-input-large">
                                  <!----></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <!---->
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <button data-v-72207a2c="" type="button" class="check-btn u-btn u-btn-red">确认提交</button>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div data-v-79861fda="" class="modal-footer"></div>
                  </div>
                </div>
              </div>
              <div data-v-79861fda="" data-v-72207a2c="" class="modal-box" style="display: none;">
                <div data-v-79861fda="" class="modal-mask"></div>
                <div data-v-79861fda="" class="modal-container">
                  <div data-v-79861fda="" class="modal-content" style="width: 600px;">
                    <div data-v-79861fda="" class="modal-header">
                      <b data-v-79861fda="">放弃订单</b>
                      <span data-v-79861fda="">关闭</span></div>
                    <div data-v-79861fda="" class="modal-body">
                      <form data-v-72207a2c="" autocomplete="off" class="u-form ivu-form ivu-form-label-right" data-v-79861fda="">
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">放弃原因</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                  <!---->
                                  <!---->
                                  <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                  <input autocomplete="off" spellcheck="false" type="text" placeholder="请填写放弃原因..." class="ivu-input ivu-input-large">
                                  <!----></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <!---->
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <button data-v-72207a2c="" type="button" class="check-btn u-btn u-btn-red">确定</button>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div data-v-79861fda="" class="modal-footer"></div>
                  </div>
                </div>
              </div>
              <div data-v-79861fda="" data-v-72207a2c="" class="modal-box" style="display: none;">
                <div data-v-79861fda="" class="modal-mask"></div>
                <div data-v-79861fda="" class="modal-container">
                  <div data-v-79861fda="" class="modal-content" style="width: 600px;">
                    <div data-v-79861fda="" class="modal-header">
                      <b data-v-79861fda="">订单验收</b>
                      <span data-v-79861fda="">关闭</span></div>
                    <div data-v-79861fda="" class="modal-body">
                      <form data-v-72207a2c="" autocomplete="off" class="u-form ivu-form ivu-form-label-right" data-v-79861fda="">
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">需求单价</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="input-box">100.00 - 500.00</div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">计算单位</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="input-box">次</div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">数量</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="input-box">1</div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">凭证</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">完成情况</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="input-box"></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">应付金额</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                  <!---->
                                  <!---->
                                  <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                  <input autocomplete="off" spellcheck="false" type="text" placeholder="应付金额" class="ivu-input ivu-input-large">
                                  <!----></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">扣款原因</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                  <!---->
                                  <!---->
                                  <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                  <input autocomplete="off" spellcheck="false" type="text" placeholder="扣款原因" class="ivu-input ivu-input-large">
                                  <!----></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <!---->
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <button data-v-72207a2c="" type="button" class="check-btn u-btn u-btn-red">通过</button>
                                <!---->
                                <button data-v-72207a2c="" type="button" class="check-btn u-btn u-btn-black">不通过</button>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div data-v-79861fda="" class="modal-footer"></div>
                  </div>
                </div>
              </div>
              <div data-v-79861fda="" data-v-72207a2c="" class="modal-box" style="display: none;">
                <div data-v-79861fda="" class="modal-mask"></div>
                <div data-v-79861fda="" class="modal-container">
                  <div data-v-79861fda="" class="modal-content" style="width: 600px;">
                    <div data-v-79861fda="" class="modal-header">
                      <b data-v-79861fda="">不通过</b>
                      <span data-v-79861fda="">关闭</span></div>
                    <div data-v-79861fda="" class="modal-body">
                      <form data-v-72207a2c="" autocomplete="off" class="u-form ivu-form ivu-form-label-right" data-v-79861fda="">
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <label class="ivu-form-item-label" style="width: 120px;">不通过原因</label>
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <div data-v-72207a2c="" class="ivu-input-wrapper ivu-input-wrapper-large ivu-input-type">
                                  <!---->
                                  <!---->
                                  <i class="ivu-icon ivu-icon-ios-loading ivu-load-loop ivu-input-icon ivu-input-icon-validate"></i>
                                  <input autocomplete="off" spellcheck="false" type="text" placeholder="不通过原因" class="ivu-input ivu-input-large">
                                  <!----></div>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                        <div data-v-72207a2c="" class="ivu-row">
                          <div data-v-72207a2c="" class="ivu-col ivu-col-span-24">
                            <div data-v-72207a2c="" class="ivu-form-item">
                              <!---->
                              <div class="ivu-form-item-content" style="margin-left: 120px;">
                                <button data-v-72207a2c="" type="button" class="check-btn u-btn u-btn-red">确定</button>
                                <!----></div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div data-v-79861fda="" class="modal-footer"></div>
                  </div>
                </div>
              </div>
              <div data-v-79861fda="" data-v-72207a2c="" class="modal-box" style="display: none;">
                <div data-v-79861fda="" class="modal-mask"></div>
                <div data-v-79861fda="" class="modal-container">
                  <div data-v-79861fda="" class="modal-content" style="width: 600px;">
                    <div data-v-79861fda="" class="modal-header">
                      <b data-v-79861fda="">图片</b>
                      <span data-v-79861fda="">关闭</span></div>
                    <div data-v-79861fda="" class="modal-body">
                      <div data-v-72207a2c="" data-v-79861fda="" class="show-scale-img">
                        <img data-v-72207a2c="" data-v-79861fda="" src=""></div>
                    </div>
                    <div data-v-79861fda="" class="modal-footer"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>





         <?php if ($this->_tpl_vars['rec'] == 'uploadlist'): ?>
         <div data-v-3e39c47e="" class="main">
                  <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
                    <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
                      <h1 data-v-3c3fa26a="">
                        <span data-v-3c3fa26a="" class="actived">上传分发明细表格</span></h1>
                      <div data-v-3c3fa26a="" class="right-box">
                                               </div>
                    </div>




                <?php if ($this->_tpl_vars['product_info']['upload_status'] < 1): ?>
                     <form action="/usernew.php?rec=uploadlist_post" method="post" enctype="multipart/form-data">
                     <div class="formBasic">
                      <dl>
                        <dd>
                        <input type="file" name="image" class="inpFlie" />
                        <input name="submit" style="width: 1rem;  height: .32rem; line-height: .22rem; margin-right: .2rem;background-color: #ca2012;
                        border-color: #ca2012; color: #fff;    text-align: center;
                                                               padding: .06px .07rem;border:none"
                         class="btn" size="38"  type="submit" value="提交" />
                       </dd>
                      </dl>
                      <input type="hidden" name="ppid" value="<?php echo $this->_tpl_vars['ppid']; ?>
">

                      </div>
                    </form>

                <?php endif; ?>

                  </div>
                </div>
          <?php endif; ?>



           <?php if ($this->_tpl_vars['rec'] == 'uploadyspdf'): ?>
                   <div data-v-3e39c47e="" class="main">
                            <div data-v-966930ee="" data-v-3e39c47e="" class="my-content-box">
                              <div data-v-3c3fa26a="" data-v-966930ee="" class="tab-title-box">
                                <h1 data-v-3c3fa26a="">
                                  <span data-v-3c3fa26a="" class="actived">上传验收扫描件</span></h1>
                                <div data-v-3c3fa26a="" class="right-box">
                                                                   </div>
                              </div>




                          <?php if ($this->_tpl_vars['product_info']['file5'] == '' || $this->_tpl_vars['product_info']['upload_status'] == 2 || $this->_tpl_vars['product_info']['upload_status'] == 3): ?>
                               <form action="/usernew.php?rec=uploadyspdf_post" method="post" enctype="multipart/form-data">
                               <div class="formBasic">
                                <dl>
                                  <dd>
                                  <input type="file" name="image" class="inpFlie" />
                                  <input name="submit" style="width: 1rem;  height: .32rem; line-height: .22rem; margin-right: .2rem;background-color: #ca2012;
                                  border-color: #ca2012; color: #fff;    text-align: center;
                                                                         padding: .06px .07rem;border:none"
                                   class="btn" size="38"  type="submit" value="提交" />
                                 </dd>
                                </dl>
                                <input type="hidden" name="ppid" value="<?php echo $this->_tpl_vars['ppid']; ?>
">

                                </div>
                              </form>

                          <?php endif; ?>

                            </div>
                          </div>
                    <?php endif; ?>







  </div>
</div>


 <?php if ($this->_tpl_vars['rec'] == 'taskcenter'): ?>


<div data-v-09660f48="" class="search">
        <div data-v-09660f48="" class="search-box clearfix">
         <form  class="u-form ivu-form ivu-form-label-right taskcenteForm" method="get" action="/usernew.php" target="_self" >
            <div data-v-09660f48="" class="search-input">
                <input data-v-09660f48="" name="keyword" value="<?php echo $this->_tpl_vars['keyword']; ?>
" type="text" placeholder="请输入关键词"></div>
                <input data-v-09660f48="" name="price" id="taskcenter_price" value="<?php echo $this->_tpl_vars['price']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="status"   value="<?php echo $this->_tpl_vars['status']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="add_time" id="taskcenter_addtime"   value="<?php echo $this->_tpl_vars['add_time']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="end_time" id="taskcenter_endtime"   value="<?php echo $this->_tpl_vars['end_time']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="city" id="taskcenter_city"   value="<?php echo $this->_tpl_vars['city']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="cat_id" id="taskcenter_catid"   value="<?php echo $this->_tpl_vars['cat_id']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="cat_id2" id="taskcenter_catid2"   value="<?php echo $this->_tpl_vars['cat_id2']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="province" id="taskcenter_province"   value="<?php echo $this->_tpl_vars['province']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="order" id="taskcenter_order"   value="<?php echo $this->_tpl_vars['order']; ?>
" type="hidden" >
                <input data-v-09660f48="" name="order_value" id="taskcenter_order_value"   value="<?php echo $this->_tpl_vars['order_value']; ?>
" type="hidden" >
                 <input type="hidden" name="rec"  value="taskcenter" />
                          <div data-v-09660f48=""  class="search-button taskcenterSearch"> 搜索 </div></div>
         </form>
    </div>
    <div data-v-09660f48="" class="task-center-header">
        <div data-v-09660f48="" class="container">
            <div data-v-09660f48="" class="search-title">
                <div data-v-09660f48="" class="search-box clearfix">
                    <div data-v-09660f48="" class="search-item clearfix">
                        <div data-v-09660f48="" class="item-l">需求地点：</div>
                        <div data-v-09660f48="" class="item-r">
                            <?php if ($this->_tpl_vars['province'] == 'all' && $this->_tpl_vars['city'] == 'all'): ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon type-item item-actived province-city-all">
                                <span data-v-09660f48="">全部</span>
                                <!---->
                            </div>
                             <?php else: ?>
                             <div data-v-09660f48="" data-value="all" class="item-icon type-item  province-city-all">
                                 <span data-v-09660f48="">全部</span>
                                 <!---->
                             </div>
                              <?php endif; ?>

                            <div data-v-09660f48="" class="item-icon type-item province ">
                            <?php if ($this->_tpl_vars['province'] != '' && $this->_tpl_vars['province'] != 'all'): ?>
                            <span data-v-09660f48=""><?php echo $this->_tpl_vars['province']; ?>
</span>
                            <?php else: ?>
                             <span data-v-09660f48=""> 省市</span>
                            <?php endif; ?>

                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down"></i>
                            </div>
                            <div data-v-09660f48="" class="item-icon type-item  city">
                               <?php if ($this->_tpl_vars['city'] != '' && $this->_tpl_vars['city'] != 'all'): ?>
                                <span data-v-09660f48=""><?php echo $this->_tpl_vars['city']; ?>
</span>
                                <?php else: ?>
                                 <span data-v-09660f48="">行政区</span>
                                <?php endif; ?>
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down"></i>
                            </div>
                        </div>
                    </div>
                    <ul data-v-09660f48="" class="sub-menu province_list" style="display: none;">
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">北京</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">天津</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">上海</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">重庆</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">河北</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">山西</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">内蒙古</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">辽宁</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">吉林</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">黑龙江</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">江苏</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">浙江</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">安徽</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">福建</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">江西</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">山东</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">河南</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">湖北</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">湖南</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">广东</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">广西</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">海南</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">四川</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">贵州</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">云南</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">西藏</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">陕西</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">甘肃</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">青海</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">宁夏</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">新疆</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">台湾</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">香港</span></li>
                        <li data-v-09660f48="" class="province-item">
                            <span data-v-09660f48="">澳门</span></li>
                    </ul>
                    <ul data-v-09660f48="" class="sub-menu city_list" style="display: none;"></ul>
                </div>
                <div data-v-09660f48="" class="search-box task-category-box clearfix">
                    <div data-v-09660f48="" class="search-item clearfix">
                        <div data-v-09660f48="" class="item-l">任务分类：</div>
                        <div data-v-09660f48="" class="item-r">


                             <?php if ($this->_tpl_vars['cat_id'] == 'all' && $this->_tpl_vars['cat_id2'] == 'all'): ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon type-item item-actived searchCat">全部</div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon type-item searchCat">全部</div>
                            <?php endif; ?>

                            <?php $_from = $this->_tpl_vars['cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>


                            <?php if ($this->_tpl_vars['cat_id'] == $this->_tpl_vars['cat']['cat_id']): ?>
                            <div data-v-09660f48="" data-value="<?php echo $this->_tpl_vars['cat']['cat_id']; ?>
" class="item-icon item-actived type-item searchCat">
                                <span data-v-09660f48=""><?php echo $this->_tpl_vars['cat']['cat_name']; ?>
</span>
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="<?php echo $this->_tpl_vars['cat']['cat_id']; ?>
" class="item-icon type-item searchCat">
                                <span data-v-09660f48=""><?php echo $this->_tpl_vars['cat']['cat_name']; ?>
</span>
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down"></i>
                            </div>
                            <?php endif; ?>


                            <?php endforeach; endif; unset($_from); ?>

                        </div>
                    </div>
                    <ul data-v-09660f48="" class="sub-menu cat2" style="display: none;"></ul>
                </div>
                <div data-v-09660f48="" class="search-box">
                    <div data-v-09660f48="" class="search-item clearfix">
                        <div data-v-09660f48="" class="item-l">需求单价：</div>
                        <div data-v-09660f48="" class="item-r">

                            <?php if ($this->_tpl_vars['price'] == 'all'): ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon item-actived searchPrice">全部
                                <i data-v-09660f48=""  class="ivu-icon ivu-icon-ios-arrow-down " style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon  searchPrice">全部
                                <i data-v-09660f48=""  class="ivu-icon ivu-icon-ios-arrow-down " style="display: none;"></i>
                            </div>
                            <?php endif; ?>

                             <?php if ($this->_tpl_vars['price'] == '0-5000'): ?>
                            <div data-v-09660f48="" data-value="0-5000" class="item-icon item-actived searchPrice">5K以下
                                <i data-v-09660f48=""  class="ivu-icon ivu-icon-ios-arrow-down " style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="0-5000" class="item-icon searchPrice">5K以下
                                <i data-v-09660f48=""  class="ivu-icon ivu-icon-ios-arrow-down " style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['price'] == '5000-10000'): ?>
                            <div data-v-09660f48="" data-value="5000-10000" class="item-icon item-actived searchPrice">5-10K
                                <i data-v-09660f48=""  class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="5000-10000" class="item-icon searchPrice">5-10K
                                <i data-v-09660f48=""  class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['price'] == '10000-30000'): ?>
                            <div data-v-09660f48=""  data-value="10000-30000" class="item-icon item-actived searchPrice">10-30K
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down " style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48=""  data-value="10000-30000" class="item-icon searchPrice">10-30K
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down " style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['price'] == '30000-0'): ?>
                            <div data-v-09660f48="" data-value="30000-0" class="item-icon item-actived searchPrice">30K以上
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down searchPrice" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="30000-0" class="item-icon searchPrice">30K以上
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down searchPrice" style="display: none;"></i>
                            </div>
                            <?php endif; ?>






                        </div>
                    </div>
                </div>
                <div data-v-09660f48="" class="search-box">
                    <div data-v-09660f48="" class="search-item clearfix">
                        <div data-v-09660f48="" class="item-l">发布时间：</div>
                        <div data-v-09660f48="" class="item-r">
                            <?php if ($this->_tpl_vars['add_time'] == 'all'): ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon item-actived searchAddtime">全部
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon  searchAddtime">全部
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['add_time'] == 'today'): ?>
                            <div data-v-09660f48="" data-value="today"  class="item-icon item-actived searchAddtime">今日
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="today"  class="item-icon searchAddtime">今日
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['add_time'] == 'three'): ?>
                            <div data-v-09660f48="" data-value="three" class="item-icon item-actived searchAddtime">最近三天
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="three" class="item-icon searchAddtime">最近三天
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['add_time'] == 'week'): ?>
                            <div data-v-09660f48="" data-value="week" class="item-icon  item-actived searchAddtime">最近一周
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="week" class="item-icon searchAddtime">最近一周
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['add_time'] == 'month'): ?>
                            <div data-v-09660f48="" data-value="month" class="item-icon  item-actived  searchAddtime">最近一个月
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="month" class="item-icon searchAddtime">最近一个月
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
                <div data-v-09660f48="" class="search-box">
                    <div data-v-09660f48="" class="search-item clearfix">
                        <div data-v-09660f48="" class="item-l">截止时间：</div>
                        <div data-v-09660f48="" class="item-r">


                            <?php if ($this->_tpl_vars['end_time'] == 'all'): ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon item-actived searchEndtime">全部
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="all" class="item-icon  searchEndtime">全部
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['end_time'] == 'today'): ?>
                            <div data-v-09660f48="" data-value="today" class="item-icon item-actived searchEndtime">今日
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="today" class="item-icon searchEndtime">今日
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['end_time'] == 'three'): ?>
                            <div data-v-09660f48="" data-value="three" class="item-icon item-actived searchEndtime">最近三天
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="three" class="item-icon searchEndtime">最近三天
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['end_time'] == 'week'): ?>
                            <div data-v-09660f48="" data-value="week" class="item-icon item-actived searchEndtime">最近一周
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="week" class="item-icon searchEndtime">最近一周
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>


                            <?php if ($this->_tpl_vars['end_time'] == 'month'): ?>
                            <div data-v-09660f48="" data-value="month" class="item-icon item-actived searchEndtime">最近一个月
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php else: ?>
                            <div data-v-09660f48="" data-value="month" class="item-icon searchEndtime">最近一个月
                                <i data-v-09660f48="" class="ivu-icon ivu-icon-ios-arrow-down" style="display: none;"></i>
                            </div>
                            <?php endif; ?>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul data-v-09660f48="" class="search-tab">

     <?php if ($this->_tpl_vars['status'] == '0'): ?>
        <li data-v-09660f48="" class="actived"><a href="/usernew.php?rec=taskcenter&status=0" style="color:#fff">报名中</a></li>
        <li data-v-09660f48="" class=""><a href="/usernew.php?rec=taskcenter&status=1"  style="color:#000">已完成</a></li>
 <?php else: ?>
  <li data-v-09660f48="" ><a href="/usernew.php?rec=taskcenter&status=0"  style="color:#000">报名中</a></li>
          <li data-v-09660f48="" class="actived"><a href="/usernew.php?rec=taskcenter&status=1"  style="color:#fff">已完成</a></li>
 <?php endif; ?>
 <?php if ($this->_tpl_vars['createpro'] == 1): ?>
 <li data-v-09660f48="" class="publish">

             <button data-v-09660f48="" class="u-btn u-btn-red publish-btn"><a href="/usernew.php?rec=addlist" style="color:#fff">发布任务</a></button></li>
 <?php endif; ?>


    </ul>
    <div data-v-09660f48="" class="container">
         <div data-v-09660f48="" class="filter-box">
            <ul data-v-09660f48="" class="clearfix orders">

              <?php if ($this->_tpl_vars['order'] == 'default'): ?>

                  <?php if ($this->_tpl_vars['order_value'] == 'asc'): ?>
                    <li data-v-09660f48="" data-value="default" class="item actived sort">默认</li>
                  <?php else: ?>
                    <li data-v-09660f48="" data-value="default" class="item actived  ">默认</li>
                  <?php endif; ?>

               <?php else: ?>
                <li data-v-09660f48="" data-value="default" class="item  sort">默认</li>
              <?php endif; ?>

              <?php if ($this->_tpl_vars['order'] == 'add_time'): ?>

                      <?php if ($this->_tpl_vars['order_value'] == 'asc'): ?>
                        <li data-v-09660f48="" data-value="add_time" class="item actived sort">发布时间</li>
                      <?php else: ?>
                        <li data-v-09660f48="" data-value="add_time" class="item actived ">发布时间</li>
                      <?php endif; ?>

              <?php else: ?>
                  <li data-v-09660f48="" data-value="add_time" class="item sort">发布时间</li>
              <?php endif; ?>

              <?php if ($this->_tpl_vars['order'] == 'end_time'): ?>

                    <?php if ($this->_tpl_vars['order_value'] == 'asc'): ?>
                        <li data-v-09660f48="" data-value="end_time" class="item actived sort">截止时间</li>
                    <?php else: ?>
                        <li data-v-09660f48="" data-value="end_time" class="item actived  ">截止时间</li>
                    <?php endif; ?>

              <?php else: ?>
                <li data-v-09660f48="" data-value="end_time" class="item sort">截止时间</li>
              <?php endif; ?>

              <?php if ($this->_tpl_vars['order'] == 'price'): ?>

                    <?php if ($this->_tpl_vars['order_value'] == 'asc'): ?>
                        <li data-v-09660f48=""  data-value="price" class="item  actived sort">需求单价</li>
                    <?php else: ?>
                        <li data-v-09660f48=""  data-value="price" class="item  actived ">需求单价</li>
                    <?php endif; ?>

              <?php else: ?>
                  <li data-v-09660f48=""  data-value="price" class="item sort">需求单价</li>
              <?php endif; ?>

              <li data-v-09660f48="" data-value="declear" class="clear">清空筛选条件</li></ul>




        </div>
        <div data-v-09660f48="" class="task-main">
            <ul data-v-09660f48="">
<?php $_from = $this->_tpl_vars['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
                 <?php if ($this->_tpl_vars['order']['status'] == 0): ?>
                <li data-v-09660f48="" class="clearfix taskcenteritem"  data-id="<?php echo $this->_tpl_vars['order']['id']; ?>
">
                    <div data-v-09660f48="" class="type">
                        <span data-v-09660f48=""><?php echo $this->_tpl_vars['order']['cat_name']; ?>
</span></div>
                    <div data-v-09660f48="" class="info">
                        <h4 data-v-09660f48=""><?php echo $this->_tpl_vars['order']['name']; ?>
</h4>
                        <p data-v-09660f48="">
                            <span data-v-09660f48="" class="price"><?php echo $this->_tpl_vars['order']['price_str']; ?>
元/单</span>
                            <span data-v-09660f48="">需求人数：<?php echo $this->_tpl_vars['order']['max']; ?>
人</span>
                            <span data-v-09660f48="">需求地点：<?php echo $this->_tpl_vars['order']['city']; ?>
</span>
                            <span data-v-09660f48="" class="task-time">截止日期: <?php echo $this->_tpl_vars['order']['end_time']; ?>
</span></p>
                    </div>
                    <div data-v-09660f48="" class="view">
                        <button data-v-09660f48="" type="button" class="u-btn u-btn-red detail">查看详情</button>
                        <span data-v-09660f48="" class="time">发布时间：<?php echo $this->_tpl_vars['order']['add_time']; ?>
</span></div>
                </li>

                <?php else: ?>




                <li data-v-09660f48="" class="clearfix complete taskcenteritem"  data-id="<?php echo $this->_tpl_vars['order']['id']; ?>
">
                  <div data-v-09660f48="" class="type">
                    <span data-v-09660f48=""><?php echo $this->_tpl_vars['order']['cat_name']; ?>
</span></div>
                  <div data-v-09660f48="" class="info">
                    <h4 data-v-09660f48=""><?php echo $this->_tpl_vars['order']['name']; ?>
</h4>
                    <p data-v-09660f48="">
                      <span data-v-09660f48="" class="price"><?php echo $this->_tpl_vars['order']['price_str']; ?>
元/次</span>
                      <span data-v-09660f48="">需求人数：<?php echo $this->_tpl_vars['order']['max']; ?>
人</span>
                      <span data-v-09660f48="">需求地点：<?php echo $this->_tpl_vars['order']['city']; ?>
</span>
                      <span data-v-09660f48="" class="task-time">截止日期: <?php echo $this->_tpl_vars['order']['end_time']; ?>
</span></p>
                  </div>
                  <div data-v-09660f48="" class="view">
                    <span data-v-09660f48="" class="duration">为期
                      <b data-v-09660f48=""><?php echo $this->_tpl_vars['order']['days']; ?>
</b>天</span>
                    <span data-v-09660f48="" class="time">发布时间：<?php echo $this->_tpl_vars['order']['add_time']; ?>
</span></div>
                </li>

                 <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
                
            </ul>
            <div data-v-09660f48="" class="page-box">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
        </div>
    </div>
   
<?php endif; ?>

</div>
</div>





<?php if ($this->_tpl_vars['rec'] == 'taskcenterinfo'): ?>
<div id="app">
<div data-v-cbe2d02c="" class="task-info-box">
<div data-v-cbe2d02c="" class="task-info-bg">
  <div data-v-cbe2d02c="" class="task-info">
    <div data-v-cbe2d02c="" class="task-info-left">
      <span data-v-cbe2d02c="" class="status"><?php echo $this->_tpl_vars['product']['status_str']; ?>
</span>
      <h4 data-v-cbe2d02c="" class="title"><?php echo $this->_tpl_vars['product']['name']; ?>
</h4>
      <p data-v-cbe2d02c="" class="info"><?php echo $this->_tpl_vars['product']['city']; ?>
　•　<?php echo $this->_tpl_vars['product']['max']; ?>
人　•　<?php echo $this->_tpl_vars['product']['end_time']; ?>
截止</p>
      <p data-v-cbe2d02c="" class="tags">
        <span data-v-cbe2d02c=""><?php echo $this->_tpl_vars['product']['cat_name']; ?>
</span>
      </p>
      <p data-v-cbe2d02c="" class="price">￥<?php echo $this->_tpl_vars['product']['price_str']; ?>
元/单</p></div>
  </div>
</div>
<div data-v-cbe2d02c="" class="container main clearfix">
  <div data-v-cbe2d02c="" class="task-info-body">
    <div data-v-cbe2d02c="" class="basis-info">
      <p data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="label">计算单位:</span>
        <span data-v-cbe2d02c="" class="text"><?php echo $this->_tpl_vars['product']['jisuandw']; ?>
</span></p>
      <p data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="label">需求人数:</span>
        <span data-v-cbe2d02c="" class="text"><?php echo $this->_tpl_vars['product']['max']; ?>
</span></p>
      <p data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="label">报名截止日期:</span>
        <span data-v-cbe2d02c="" class="text"><?php echo $this->_tpl_vars['product']['stop_time']; ?>
</span></p>
      <p data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="label">发布日期:</span>
        <span data-v-cbe2d02c="" class="text"><?php echo $this->_tpl_vars['product']['add_time']; ?>
</span></p>
      <p data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="label">任务开始时间:</span>
        <span data-v-cbe2d02c="" class="text"><?php echo $this->_tpl_vars['product']['start_time']; ?>
</span></p>
      <p data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="label">任务结束时间:</span>
        <span data-v-cbe2d02c="" class="text"><?php echo $this->_tpl_vars['product']['end_time']; ?>
</span></p>
      <p data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="label">任务状态:</span>
        <span data-v-cbe2d02c="" class="text"><?php echo $this->_tpl_vars['product']['status_str']; ?>
</span></p>
    </div>
    <div data-v-cbe2d02c="" class="task-des">
      <div data-v-cbe2d02c="" class="des-tab">
        <ul data-v-cbe2d02c="">
          <li data-v-cbe2d02c="" class="active">需求描述</li></ul>
      </div>
      <div data-v-cbe2d02c="" class="des-main">
        <p data-v-cbe2d02c=""><?php echo $this->_tpl_vars['product']['content']; ?>
</p></div>
    </div>
  </div>
  <div data-v-cbe2d02c="" class="task-info-company">
    <div data-v-cbe2d02c="" class="company-box">
      <div data-v-cbe2d02c="" class="company clearfix">
        <div data-v-cbe2d02c="" class="logo"></div>
        <div data-v-cbe2d02c="" class="text">
          <h5 data-v-cbe2d02c=""><?php echo $this->_tpl_vars['product']['request_name']; ?>
</h5></div>
      </div>
    </div>
    <ul data-v-cbe2d02c="" class="company-ul">
      <li data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="type">行业</span>通信/网络设备</li>
      <li data-v-cbe2d02c="">
        <span data-v-cbe2d02c="" class="type">性质</span>民营</li></ul>
  </div>
</div>
</div>
</div>
<?php endif; ?>



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