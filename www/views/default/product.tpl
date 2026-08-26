{* Страница товара *}

<h3>{{$rsProduct['name']}}</h3>

<img width="575" src="/images/products/{{$rsProduct['image']}}" alt="{{$rsProduct['name']}}">

<p><strong>Стоимость:</strong> {{$rsProduct['price']}} руб.</p>

<a href="#" class="btn btn-success">Добавить в корзину</a>

<p><strong>Описание:</strong><br />{{$rsProduct['description']}}</p>

<a href="javascript:history.back();">Назад к списку товаров</a>