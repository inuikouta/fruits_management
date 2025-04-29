@extends('layouts.app')
<style>
    .filter-tag {
        display: flex;
        align-items: center;
        width: 140px;
        border: 1px solid #caaf00;
        border-radius: 20px;
        padding: 8px 10px;
        font-size: 14px;
    }

    .close-btn {
        background: none;
        border: none;
        border: 1px solid #caaf00;
        border-radius: 50%;
        margin-left: 10px;
        color: #caaf00;
        font-size: 16px;
        cursor: pointer;
    }

    .close-btn:hover {
        color: red;
    }
</style>
@section('css')
<link rel="stylesheet" href="{{ asset('css/productList.css') }}">
@endsection

@section('content')
<div class="top">
    <div class="top__left">
        <p class="top__heading">商品一覧</p>
    </div>
    <div class="top__right">
        <a href="/products/register" class="top__add-btn">+ 商品を追加</a>
    </div>
</div>
<div class="section">
    <div class="section__left">
        <form action="/products/search" method="get">
            @csrf
            <input type="text" name="word" placeholder="商品名で検索" class="section__search-text">
            <button class="section__search-btn">検索</button>
            <p class="section__subheading">価格順で表示</p>
            <select name="price_sort" id="" class="section__select">
                <option value="">価格で並び替え</option>
                <option value="desc">高い順に表示</option>
                <option value="asc">低い順に表示</option>
            </select>
        </form>

        @isset($price_sort)
            <form method="get" action="/products" class="filter-tag">
                {{ $price_sort }}
                <button class="close-btn">×</button>
            </form>
        @endisset

    </div>

    <div class="section__right product-list__sort">
        @foreach($products as $product)
        <a href="{{ route('product.show', ['productId' => $product->id])}}" class="product__item">
            <img src="{{ asset( 'storage/' . $product->image ) }}" alt="商品画像" class="product__image">
            <div class="product__info">
                <p class="product__name">{{ $product->name }}</p>
                <p class="product__price">{{ $product->price }}$</p>
            </div>
        </a>
        @endforeach
    </div>
</div>

<div>
    {{ $products->links() }}
</div>
@endsection