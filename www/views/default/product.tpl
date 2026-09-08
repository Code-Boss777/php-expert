{* Страница товара *}

<h3>{{$rsProduct['name']}}</h3>

<img width="575" src="/images/products/{{$rsProduct['image']}}" alt="{{$rsProduct['name']}}">

<p><strong>Стоимость:</strong> {{$rsProduct['price']}} руб.</p>

{* === КНОПКИ КОРЗИНЫ === *}

{{if !$itemInCart}}
    <a id="addCart_{{$rsProduct['id']}}" href="#" class="btn btn-primary" onclick="addToCart({{$rsProduct['id']}}); return false;">Добавить в корзину</a>
{{/if}}

{{if $itemInCart}}
    <a id="removeCart_{{$rsProduct['id']}}" href="#" class="btn btn-danger" onclick="removeFromCart({{$rsProduct['id']}}); return false;">Удалить из корзины</a>
{{/if}}

<p><strong>Описание:</strong><br />{{$rsProduct['description']}}</p>

<a href="javascript:history.back();">Назад к списку товаров</a>