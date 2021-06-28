<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="treeBox">
 <h3>{$lang.about_tree}</h3>
 <ul data-v-67c9ef8f="" class="ivu-page">
  <li{if $top_cur} class="cur"{/if}><a href="{$top.url}">{$top.page_name}</a></li>
  <!-- {foreach from=$page_list item=list} -->
  <li{if $list.cur} class="cur"{/if}><a href="{$list.url}">{$list.page_name}</a></li>
  <!-- {if $list.child} -->
  <ul>
   <!-- {foreach from=$list.child item=child} -->
   <li{if $child.cur} class="cur"{/if}>-<a href="{$child.url}">{$child.page_name}</a></li>
   <!-- {/foreach} -->
  </ul>
  <!-- {/if} -->
  <!--{/foreach}-->
 </ul>
</div>

{*<div data-v-67c9ef8f="" class="page-box">
                              <ul data-v-67c9ef8f="" class="ivu-page"><span class="ivu-page-total">共 3 条</span>
                                  <li title="上一页" class="ivu-page-prev ivu-page-disabled"><a><i
                                          class="ivu-icon ivu-icon-ios-arrow-back"></i></a></li>
                                  <li title="1" class="ivu-page-item ivu-page-item-active"><a>1</a></li>
                                  <li title="下一页" class="ivu-page-next ivu-page-disabled"><a><i
                                          class="ivu-icon ivu-icon-ios-arrow-forward"></i></a></li>
                              </ul>
                          </div>*}