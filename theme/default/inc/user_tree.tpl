<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="userTree">
 <h3>{$lang.user}</h3>
 <ul>
  {*<li{if $rec eq 'default'} class="cur"{/if}><a href="{$url.user}">{$lang.user_main}</a></li>*}
  {*<li{if $rec eq 'edit'} class="cur"{/if}><a href="{$url.edit}">{$lang.user_edit}</a></li>*}
  <li{if $rec eq 'password'} class="cur"{/if}><a href="{$url.password}">{$lang.user_password_edit}</a></li>
  <li{if $rec eq 'list'  and $cur_filter eq '0'} class="cur"{/if}><a href="{$url.list}">所有任务</a></li>
  <li{if $rec eq 'list' and $cur_filter eq '1'} class="cur"{/if}><a href="{$url.list}&pay_status=0" style="font-size: 12px; padding-left: 50px;">待支付</a></li>
  <li{if $rec eq 'list' and $cur_filter eq '2'} class="cur"{/if}><a href="{$url.list}&pay_status=1&status=0"  style="font-size: 12px;padding-left: 50px;">进行中</a></li>
  <li{if $rec eq 'list' and $cur_filter eq '3'} class="cur"{/if}><a href="{$url.list}&status=1"  style="font-size: 12px;padding-left: 50px;"">已完成</a></li>
  <li{if $rec eq 'money'} class="cur"{/if}><a href="/user.php?rec=money">资金管理</a></li>
  <!-- {if $open.order} -->
  <li{if $rec eq 'order_list' || $rec eq 'order'} class="cur"{/if}><a href="{$url.order_list}">{$lang.order_my}</a></li>
  <!-- {/if} -->
		<!-- {foreach from=$link_user_center.user_tree item=tree} -->
  <li><a href="{$tree.url}">{$tree.name}</a></li>
		<!--{/foreach}-->
		<!-- {if $if_connect_plugin} -->
  <li{if $rec eq 'sns'} class="cur"{/if}><a href="{$url.sns}">{$lang.user_sns}</a></li>
  <!-- {/if} -->
  <li><a href="{$url.logout}">{$lang.user_logout}</a></li>
 </ul>
</div>