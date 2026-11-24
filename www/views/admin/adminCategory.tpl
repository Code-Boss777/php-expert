<h2>Категории</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Родительская категория</th>
        <th>Действие</th>
    </tr>
    {foreach $rsCategories as $item}
    <tr>
        <td>{$item['id']}</td>
        <td>
            <input type="text" id="catName_{$item['id']}" value="{$item['name']}" />
        </td>
        <td>
            <select id="catParent_{$item['id']}">
                <option value="0">Главная категория</option>
                {foreach $rsCategories as $parent}
                    {if $parent['id'] != $item['id']} {* Чтобы категория не могла быть родителем сама себе *}
                        <option value="{$parent['id']}" {if $parent['id'] == $item['parent_id']}selected{/if}>
                            {$parent['name']}
                        </option>
                    {/if}
                {/foreach}
            </select>
        </td>
        <td>
            <input type="button" value="Сохранить" onclick="updateCategory({$item['id']});" />
        </td>
    </tr>
    {/foreach}
</table>