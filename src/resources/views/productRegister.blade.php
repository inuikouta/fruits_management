@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/productRegister.css') }}">
@endsection

@section('content')

<div class="container">
    <h1 class="container__title">商品登録</h1>
    <form action="{{ route('product.register') }}" class="container__form" method="post" enctype="multipart/form-data">
        @csrf
        {{-- 商品名 --}}
        <div class="form__field">
            <label for="product-name" class="form__label">
                商品名 <span class="form__label--required">必須</span>
            </label>
            <input type="text" class="form__input-text" id="product-name" name="product-name" placeholder="商品名" value="{{ old('product-name') }}">
            <p class="form__error">
                {{ $errors->first('product-name') }}
            </p>
        </div>
        {{-- 値段 --}}
        <div class="form__field">
            <label for="product-price" class="form__label">
                値段 <span class="form__label--required">必須</span>
            </label>
            <input type="text" class="form__input-text" id="product-price" name="product-price" placeholder="値段" value="{{ old('product-price') }}">
            <p class="form__error">
                {{ $errors->first('product-price') }}
            </p>
        </div>
        {{-- 商品画像 --}}
        <div class="form__field">
            <label for="product-img" class="form__label">
                商品画像 <span class="form__label--required">必須</span>
            </label>
            <img id="preview" class="form__img-preview" alt="プレビュー画像" style="max-width: 50%; display: none;">
            <input type="file" class="form__input-img" id="product-img" name="product-img" placeholder="商品画像" accept="image/*" value="{{ old('product-img') }}">
            <p class="form__error">
                {{ $errors->first('product-img') }}
            </p>
        </div>
        {{-- 季節 --}}
        <div class="form__field">
            <label for="product-season" class="form__label">
                季節 <span class="form__label--required">必須</span><span class="form__label--multi-select">複数選択可</span>
            </label>
            <div class="checkbox">
                <div class="checkbox__item">
                    <input type="checkbox" class="checkbox__input" id="season-spring" name="product-season[]" value="1" 
                        {{ is_array(old('product-season')) && in_array('spring', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-spring" class="checkbox__label">春</label>
                </div>
                <div class="checkbox__item">
                    <input type="checkbox" class="checkbox__input" id="season-summer" name="product-season[]" value="2" 
                        {{ is_array(old('product-season')) && in_array('summer', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-summer" class="checkbox__label">夏</label>
                </div>
                <div class="checkbox__item">
                    <input type="checkbox" class="checkbox__input" id="season-autumn" name="product-season[]" value="3" 
                        {{ is_array(old('product-season')) && in_array('autumn', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-autumn" class="checkbox__label">秋</label>
                </div>
                <div class="checkbox__item">
                    <input type="checkbox" class="checkbox__input" id="season-winter" name="product-season[]" value="4" 
                        {{ is_array(old('product-season')) && in_array('winter', old('product-season')) ? 'checked' : '' }}>
                    <label for="season-winter" class="checkbox__label">冬</label>
                </div>
            </div>
            <p class="form__error">
                {{ $errors->first('product-season') }}
            </p>
        </div>
        {{-- 商品説明 --}}
        <div class="form__field">
            <label for="product-desc" class="form__label">
                商品説明 <span class="form__label--required">必須</span>
            </label>
            <textarea name="product-desc" class="form__textarea" id="product-desc" placeholder="商品の説明を入力" cols="30" rows="10" class="form__input">{{ old('product-desc') }}</textarea>
            <p class="form__error">
                {{ $errors->first('product-desc') }}
            </p>
        </div>
        {{-- ボタン --}}
        <div class="form__button">
            <button type="button" class="form__button--back" onclick="location.href='{{ url('/products') }}'">戻る</button>
            <button type="submit" class="form__button--save">登録</button>
        </div>
    </form>
</div>

@endsection

@section('js')
<script src="{{ asset('js/productPreview.js') }}"></script>
@endsection
