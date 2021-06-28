<?php /* Smarty version 2.6.26, created on 2019-12-25 14:17:51
         compiled from inc/header.tpl */ ?>
<div id="top">
 <div class="wrap">
  <ul class="topNav">
                                                           <?php if ($this->_tpl_vars['open']['user']): ?> 
   <?php if ($this->_tpl_vars['global_user']): ?>
   <li class="spacer"></li>
   <li><a href="<?php echo $this->_tpl_vars['url']['user']; ?>
"><?php echo $this->_tpl_vars['global_user']['user_name']; ?>
，<?php echo $this->_tpl_vars['lang']['user_welcom_top']; ?>
</a></li>
   <li class="spacer"></li>
   <li><a href="<?php echo $this->_tpl_vars['url']['logout']; ?>
"><?php echo $this->_tpl_vars['lang']['user_logout']; ?>
</a></li>
   <?php else: ?>
   <li class="spacer"></li>
   <li><a href="<?php echo $this->_tpl_vars['url']['login']; ?>
"><?php echo $this->_tpl_vars['lang']['user_login_nav']; ?>
</a></li>
   <li class="spacer"></li>
   <li><a href="<?php echo $this->_tpl_vars['url']['register']; ?>
"><?php echo $this->_tpl_vars['lang']['user_register_nav']; ?>
</a></li>
   <?php endif; ?> 
   <?php endif; ?>
  </ul>
                             </div>
</div>
                                                                                                                  