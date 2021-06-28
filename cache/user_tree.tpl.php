<?php /* Smarty version 2.6.26, created on 2019-12-25 14:17:55
         compiled from inc/user_tree.tpl */ ?>
<div class="userTree">
 <h3><?php echo $this->_tpl_vars['lang']['user']; ?>
</h3>
 <ul>
      <li<?php if ($this->_tpl_vars['rec'] == 'password'): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['url']['password']; ?>
"><?php echo $this->_tpl_vars['lang']['user_password_edit']; ?>
</a></li>
  <li<?php if ($this->_tpl_vars['rec'] == 'list' && $this->_tpl_vars['cur_filter'] == '0'): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['url']['list']; ?>
">所有任务</a></li>
  <li<?php if ($this->_tpl_vars['rec'] == 'list' && $this->_tpl_vars['cur_filter'] == '1'): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['url']['list']; ?>
&pay_status=0" style="font-size: 12px; padding-left: 50px;">待支付</a></li>
  <li<?php if ($this->_tpl_vars['rec'] == 'list' && $this->_tpl_vars['cur_filter'] == '2'): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['url']['list']; ?>
&pay_status=1&status=0"  style="font-size: 12px;padding-left: 50px;">进行中</a></li>
  <li<?php if ($this->_tpl_vars['rec'] == 'list' && $this->_tpl_vars['cur_filter'] == '3'): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['url']['list']; ?>
&status=1"  style="font-size: 12px;padding-left: 50px;"">已完成</a></li>
  <li<?php if ($this->_tpl_vars['rec'] == 'money'): ?> class="cur"<?php endif; ?>><a href="/user.php?rec=money">资金管理</a></li>
  <?php if ($this->_tpl_vars['open']['order']): ?>
  <li<?php if ($this->_tpl_vars['rec'] == 'order_list' || $this->_tpl_vars['rec'] == 'order'): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['url']['order_list']; ?>
"><?php echo $this->_tpl_vars['lang']['order_my']; ?>
</a></li>
  <?php endif; ?>
		<?php $_from = $this->_tpl_vars['link_user_center']['user_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tree']):
?>
  <li><a href="<?php echo $this->_tpl_vars['tree']['url']; ?>
"><?php echo $this->_tpl_vars['tree']['name']; ?>
</a></li>
		<?php endforeach; endif; unset($_from); ?>
		<?php if ($this->_tpl_vars['if_connect_plugin']): ?>
  <li<?php if ($this->_tpl_vars['rec'] == 'sns'): ?> class="cur"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['url']['sns']; ?>
"><?php echo $this->_tpl_vars['lang']['user_sns']; ?>
</a></li>
  <?php endif; ?>
  <li><a href="<?php echo $this->_tpl_vars['url']['logout']; ?>
"><?php echo $this->_tpl_vars['lang']['user_logout']; ?>
</a></li>
 </ul>
</div>