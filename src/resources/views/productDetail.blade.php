@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/productDetail.css') }}">
@endsection
@section('content')
<div class="container">
    {{-- パンくずリスト --}}
    <div class="breadcrumb">
        <a href="/products" class="breadcrumb__link">商品一覧</a>
        <span class="breadcrumb__separator">></span>
        <span class="breadcrumb__current">商品詳細</span>
    </div>
    {{ $product->season }}
    {{-- 商品詳細表示 --}}
    <form action="{{ route('product.update', ['productId' => $product->id]) }}" class="container__form" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
        <div class="detail-form__group">
            <div class="detail-form__group__left">
                {{-- 商品画像 --}}
                <div>
                    <img id="preview" src="{{ asset('storage/' . $product->image) }}" alt="プレビュー画像" style="max-width: 300px; {{ $product->image ? '' : 'display: none;' }}">
                </div>
                <input type="file" name="product-img" class="detail-form__image" id="product-img" placeholder="商品画像" accept="image/*">
                <input type="hidden" name="existing-img" value="{{ $product->image }}">
            </div>
            <div class="detail-form__group__right">
                {{-- 商品名 --}}
                <div class="form__group">
                    <label for="" class="item__name">
                        商品名 <span class="item__name--required">必須</span>
                    </label>
                    <input type="text" class="item__text-input" id="product-name" name="product-name" placeholder="商品名" value="{{ $product->name }}">
                </div>
                {{-- 値段 --}}
                <div class="form__group">
                    <label for="" class="item__name">
                        値段 <span class="item__name--required">必須</span>
                    </label>
                    <input type="text" class="item__text-input" id="product-price" name="product-price" placeholder="値段" value="{{ $product->price }}">
                </div>
                {{-- 季節 --}}
                <div class="form__group">
                    <label for="product-season" class="form__item--name">
                        季節 <span class="form__item--required">必須</span>
                    </label>
                    <div class="form__checkbox">
                        <div class="form__checkbox-item">
                            <input type="checkbox" class="form__checkbox-input" id="season-spring" name="product-season[]" value="1" 
                                {{ (is_array(old('product-season')) ? in_array('1', old('product-season')) : in_array('1', $seasons)) ? 'checked' : '' }}>
                            <label for="season-spring" class="form__checkbox-label">春</label>
                        </div>
                        <div class="form__checkbox-item">
                            <div class="form__checkbox-item">
                            <input type="checkbox" class="form__checkbox-input" id="season-spring" name="product-season[]" value="2" 
                                {{ (is_array(old('product-season')) ? in_array('2', old('product-season')) : in_array('2', $seasons)) ? 'checked' : '' }}>
                            <label for="season-summer" class="form__checkbox-label">夏</label>
                        </div>
                        <div class="form__checkbox-item">
                            <input type="checkbox" class="form__checkbox-input" id="season-spring" name="product-season[]" value="3" 
                                {{ (is_array(old('product-season')) ? in_array('3', old('product-season')) : in_array('3', $seasons)) ? 'checked' : '' }}>
                            <label for="season-autumn" class="form__checkbox-label">秋</label>
                        </div>
                        <div class="form__checkbox-item">
                            <input type="checkbox" class="form__checkbox-input" id="season-spring" name="product-season[]" value="4" 
                                {{ (is_array(old('product-season')) ? in_array('4', old('product-season')) : in_array('4', $seasons)) ? 'checked' : '' }}>
                            <label for="season-winter" class="form__checkbox-label">冬</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- 商品説明 --}}
        <div class="form__group">
            <label for="product-desc" class="item__name">
                商品説明 <span class="item__name--required">必須</span>
            </label>
            <textarea name="product-desc" id="product-desc" cols="30" rows="10" class="item__text-input">{{ is_array(old('product-desc')) ? old('product-desc') : $product->description }}</textarea>
        </div>
        <div>
            <button type="button" onclick="location.href='{{ url('/products') }}'">戻る</button>
            <button type="submit" class="">変更</button>
        </div>
    </form>
    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection

@section('js')
<script src="{{ asset('js/productPreview.js') }}"></script>
@endsection