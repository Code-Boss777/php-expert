<div id="leftColumn>
<div id=leftMenu>
    <div class="menuCaption">Меню</div>
    {foreach from=$rsCategories item=item}
    <a href="#">{$item['name']}</a><br/>
    {if isset($item['children'])}
        {foreach from=$item['children'] item=itemChild}
            <span style="padding-left: 15px;">-- </span>
            <a href="#">{$itemChild['name']}</a><br/>
    {/foreach}
{/if}
{/foreach}
</div>
</div>
    <div id=centerColumn>
 