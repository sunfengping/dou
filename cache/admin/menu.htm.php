<?php /* Smarty version 2.6.26, created on 2019-12-19 10:38:53
         compiled from menu.htm */ ?>
<?php if ($this->_tpl_vars['user']['type'] == 3): ?>
<style>
 <?php echo '
     .slidemenu{display: none}
     .product1{display: block}
 '; ?>

</style>
<?php endif; ?>
<div id="menu">
 <ul class="top">
  <?php echo $this->_tpl_vars['lang']['menu_home']; ?>

 </ul>
 <!--
 <ul>
  <li<?php if ($this->_tpl_vars['cur'] == 'system'): ?> class="cur"<?php endif; ?>><a href="system.php"><i class="system"></i><em><?php echo $this->_tpl_vars['lang']['system']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'nav'): ?> class="cur"<?php endif; ?>><a href="nav.php"><i class="nav"></i><em><?php echo $this->_tpl_vars['lang']['nav']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'show'): ?> class="cur"<?php endif; ?>><a href="show.php"><i class="show"></i><em><?php echo $this->_tpl_vars['lang']['show']; ?>
</em></a></li>
  <li<?php if ($this->_tpl_vars['cur'] == 'page'): ?> class="cur"<?php endif; ?>><a href="page.php"><i class="page"></i><em><?php echo $this->_tpl_vars['lang']['menu_page']; ?>
</em></a></li>
 </ul>
 -->

 <ul>
  <li class="<?php if ($this->_tpl_vars['cur'] == 'product_category'): ?>cur<?php endif; ?> slidemenu"><a href="product_category.php"><i class="productCat"></i><em>任务分类</em></a></li>
  <li class=" <?php if ($this->_tpl_vars['cur'] == 'product1'): ?>cur product1 <?php endif; ?> slidemenu" ><a href="product.php?type=1"><i class="product"></i><em>商户端任务</em></a></li>
  <li style="display: none"  class=" <?php if ($this->_tpl_vars['cur'] == 'product0'): ?>cur<?php endif; ?> slidemenu"><a href="product.php?type=0" ><i class="product"></i><em>分包任务</em></a></li>
  <li class=" <?php if ($this->_tpl_vars['cur'] == 'list'): ?>cur<?php endif; ?> slidemenu" ><a href="list.php"><i class="list"></i><em>工人领工明细</em></a></li>
 </ul>
 <ul style="display: block">
  <li class="<?php if ($this->_tpl_vars['cur'] == 'article_category'): ?>cur<?php endif; ?> slidemenu"><a href="article_category.php"><i class="articleCat"></i><em>文章分类</em></a></li>
  <li class="<?php if ($this->_tpl_vars['cur'] == 'article'): ?>cur<?php endif; ?> slidemenu"><a href="article.php"><i class="article"></i><em>文章列表</em></a></li>

 </ul>

 <ul class="bot">
  <li class="<?php if ($this->_tpl_vars['cur'] == 'backup'): ?>cur<?php endif; ?> slidemenu"><a href="backup.php"><i class="backup"></i><em><?php echo $this->_tpl_vars['lang']['backup']; ?>
</em></a></li>

  <li class="<?php if ($this->_tpl_vars['cur'] == 'manager'): ?>cur<?php endif; ?> slidemenu"><a href="manager.php"><i class="manager"></i><em><?php echo $this->_tpl_vars['lang']['manager']; ?>
</em></a></li>
  <li class="<?php if ($this->_tpl_vars['cur'] == 'manager_log'): ?>cur<?php endif; ?> slidemenu"><a href="manager.php?rec=manager_log"><i class="managerLog"></i><em><?php echo $this->_tpl_vars['lang']['manager_log']; ?>
</em></a></li>
 </ul>
</div>