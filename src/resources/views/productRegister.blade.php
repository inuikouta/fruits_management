@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/productRegister.css') }}">
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h1 class="container__title">商品登録</h1>
    <form action="{{ route('product.register') }}" class="container__form" method="post" enctype="multipart/form-data">
        @csrf
        {{-- 商品名 --}}
        <div class="form__group">
            <label for="product-name" class="form__item--name">
                商品名 <span class="form__item--required">必須</span>
            </label>
            <input type="text" class="form__text-input" id="product-name" name="product-name" placeholder="商品名" value="{{ old('product-name') }}">
        </div>
        {{-- 値段 --}}
        <div class="form__group">
            <label for="product-price" class="form__item--name">
                値段 <span class="form__item--required">必須</span>
            </label>
            <input type="text" class="form__text-input" id="product-price" name="product-price" placeholder="値段" value="{{ old('product-price') }}">
        </div>
        {{-- 商品画像 --}}
        <div class="form__group">
            <label for="product-img" class="form__item--name">
                商品画像 <span class="form__item--required">必須</span>
            </label>
            <input type="file" class="form__img-input" id="product-img" name="product-img" placeholder="商品画像" accept="image/*" value="{{ old('product-img') }}">
            <div>
                <img id="preview" src="" alt="プレビュー画像" style="max-width: 300px;">
            </div>
        </div>
        {{-- 季節 --}}
        <div class="form__group">
            <label for="product-season" class="form__item--name">
                季節 <span class="form__item--required">必須</span>
            </label>
            <div class="form__checkbox">
                <div class="form__checkbox-item">
                    <input type="checkbox" class="form__checkbox-input" id="season-spring" name="product-season[]" value="1" 
                        {{ is_array(old('product-season')) && in_array('spring', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-spring" class="form__checkbox-label">春</label>
                </div>
                <div class="form__checkbox-item">
                    <input type="checkbox" class="form__checkbox-input" id="season-summer" name="product-season[]" value="2" 
                        {{ is_array(old('product-season')) && in_array('summer', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-summer" class="form__checkbox-label">夏</label>
                </div>
                <div class="form__checkbox-item">
                    <input type="checkbox" class="form__checkbox-input" id="season-autumn" name="product-season[]" value="3" 
                        {{ is_array(old('product-season')) && in_array('autumn', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-autumn" class="form__checkbox-label">秋</label>
                </div>
                <div class="form__checkbox-item">
                    <input type="checkbox" class="form__checkbox-input" id="season-winter" name="product-season[]" value="4" 
                        {{ is_array(old('product-season')) && in_array('winter', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-winter" class="form__checkbox-label">冬</label>
                </div>
            </div>
        </div>
        {{-- 商品説明 --}}
        <div class="form__group">
            <label for="product-desc" class="form__item--name">
                商品説明 <span class="form__item--required">必須</span>
            </label>
            <textarea name="product-desc" id="product-desc" cols="30" rows="10" class="form__input">{{ old('product-desc') }}</textarea>
        </div>
        {{-- ボタン --}}
        <div>
            <button type="button" onclick="location.href='{{ url('/products') }}'">戻る</button>
            <button type="submit" class="">登録</button>
        </div>
    </form>
</div>

@endsection

@section('js')
<script src="{{ asset('js/productPreview.js') }}"></script>
@endsection