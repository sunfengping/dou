<?php /* Smarty version 2.6.26, created on 2019-12-19 10:38:53
         compiled from header.htm */ ?>
<div id="dcHead">
 <div id="head">
  <div class="logo"><a href="index.php" title="任务管理系统">任务管理系统</a></div>
  <div class="box">
   <ul class="siteName">
    <?php echo $this->_tpl_vars['site']['site_name']; ?>

   </ul>
   <ul class="nav">
  
    <li><a href="../index.php" target="_blank"><?php echo $this->_tpl_vars['lang']['top_go_site']; ?>
</a></li>
    <li><a href="index.php?rec=clear_cache"><?php echo $this->_tpl_vars['lang']['clear_cache']; ?>
</a></li>
    <li class="dropMenu"><a href="JavaScript:void(0);" class="parent"><?php echo $this->_tpl_vars['lang']['top_welcome']; ?>
<?php echo $this->_tpl_vars['user']['user_name']; ?>
</a>
     <div class="menu"> <a href="manager.php?rec=edit&id=<?php echo $this->_tpl_vars['user']['user_id']; ?>
"><?php echo $this->_tpl_vars['lang']['top_manager_edit']; ?>
</a> <a href="cloud.php?rec=account"><?php echo $this->_tpl_vars['lang']['cloud_account']; ?>
</a> </div>
    </li>
    <li><a href="login.php?rec=logout"><?php echo $this->_tpl_vars['lang']['top_logout']; ?>
</a></li>
   </ul>
  </div>
 </div>
</div>
<!-- dcHead 结束 -->