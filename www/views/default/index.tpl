<div id="centerColumn">
    
    {foreach from=$rsProducts item=item}
        <div style="float: left; padding: 0px 30px 40px 0px; width: 150px; text-align: center;">
            <a href="/product/{$item['id']}/">
                <img src="/images/products/{$item['image']}" width="100" alt="{$item['name']}" />
            </a>
            <br />
            <a href="/product/{$item['id']}/">{$item['name']}</a>
            <br />
            <span style="color: #e44b4b; font-weight: bold;">{$item['price']} руб.</span>
        </div>
    {/foreach}
    
</div>