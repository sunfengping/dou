<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<ul class="userTree">
 <li><a href="{$url.user}">{$lang.user_main}</a></li>
 <li><a href="{$url.edit}">{$lang.user_edit}</a></li>
 <li><a href="{$url.password}">{$lang.user_password_edit}</a></li>
 <!-- {if $open.order} -->
 <li><a href="{$url.order_list}">{$lang.order_my}</a></li>
 <!-- {/if} -->
	<!-- {foreach from=$link_user_center.user_tree item=tree} -->
	<li><a href="{$tree.url}">{$tree.name}</a></li>
	<!--{/foreach}-->
	<!-- {if $if_connect_plugin} -->
	<li><a href="{$url.sns}">{$lang.user_sns}</a></li>
	<!-- {/if} -->
 <li><a href="{$url.logout}">{$lang.user_logout}</a></li>
</ul>