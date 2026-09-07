{* Страница товара *}

<h3>{{$rsProduct['name']}}</h3>

<img width="575" src="/images/products/{{$rsProduct['image']}}" alt="{{$rsProduct['name']}}">

<p><strong>Стоимость:</strong> {{$rsProduct['price']}} руб.</p>

{* КНОПКА ДОБАВЛЕНИЯ *}
{* КНОПКА ДОБАВЛЕНИЯ *}
{* КНОПКА ДОБАВЛЕНИЯ *}
<a id="addCart_{$rsProduct['id']}" href="#" class="btn btn-primary" onclick="addToCart({$rsProduct['id']}); return false;">Добавить в корзину</a>
{* КНОПКА УДАЛЕНИЯ (скрыта по умолчанию) *}
<a id="removeCart_{{ $rsProduct['id'] }}" href="#" class="btn btn-danger" style="display:none;" onclick="removeFromCart({{ $rsProduct['id'] }}); return false;">Удалить из корзины</a>
<p><strong>Описание:</strong><br />{{$rsProduct['description']}}</p>

<a href="javascript:history.back();">Назад к списку товаров</a>