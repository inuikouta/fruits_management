@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/productDetail.css') }}">
@endsection
@section('content')
<div class="container">
    {{-- パンくずリスト --}}
    <div class="container__breadcrumb">
        <a href="/products" class="container__breadcrumb-link">商品一覧</a>
        <span class="container__breadcrumb-separator">></span>
        <span class="container__breadcrumb-current">商品詳細</span>
    </div>
    {{ $product->season }}
    {{-- 商品詳細表示 --}}
    <form action="{{ route('product.update', ['productId' => $product->id]) }}" class="form__update" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
        <div class="form__group">
            <div class="form__field-left">
                {{-- 商品画像 --}}
                <img id="preview" class="form__preview-img" src="{{ asset('storage/' . $product->image) }}" alt="プレビュー画像" style="{{ $product->image ? '' : 'display: none;' }}">
                <input type="file" name="product-img" class="from__input-img" id="product-img" placeholder="商品画像" accept="image/*">
                <input type="hidden" name="existing-img" value="{{ $product->image }}">
                <p class="form__error">
                    {{ $errors->first('product-img') }}
                </p>
            </div>
            <div class="form__field-right">
                {{-- 商品名 --}}
                <div class="form__item">
                    <label for="product-name" class="form__label">
                        商品名
                    </label>
                    <input type="text" class="form__input-text" id="product-name" name="product-name" placeholder="商品名" value="{{ $product->name }}">
                    <p class="form__error">
                        {{ $errors->first('product-name') }}
                    </p>
                </div>
                {{-- 値段 --}}
                <div class="form__item">
                    <label for="product-price" class="form__label">
                        値段
                    </label>
                    <input type="text" class="form__input-text" id="product-price" name="product-price" placeholder="値段" value="{{ $product->price }}">
                    <p class="form__error">
                        {{ $errors->first('product-price') }}
                    </p>
                </div>
                {{-- 季節 --}}
                <div class="form__item">
                    <label for="product-season" class="form__label">
                        季節
                    </label>
                    <div class="checkbox">
                        <div class="checkbox__item">
                            <input type="checkbox" class="checkbox__input" id="season-spring" name="product-season[]" value="1" 
                                {{ (is_array(old('product-season')) ? in_array('1', old('product-season')) : in_array('1', $seasons)) ? 'checked' : '' }}>
                            <label for="season-spring" class="checkbox__label">春</label>
                        </div>
                        <div class="checkbox__item">
                            <input type="checkbox" class="checkbox__input" id="season-spring" name="product-season[]" value="2" 
                                {{ (is_array(old('product-season')) ? in_array('2', old('product-season')) : in_array('2', $seasons)) ? 'checked' : '' }}>
                            <label for="season-summer" class="checkbox__label">夏</label>
                        </div>
                        <div class="checkbox__item">
                            <input type="checkbox" class="checkbox__input" id="season-spring" name="product-season[]" value="3" 
                                {{ (is_array(old('product-season')) ? in_array('3', old('product-season')) : in_array('3', $seasons)) ? 'checked' : '' }}>
                            <label for="season-autumn" class="checkbox__label">秋</label>
                        </div>
                        <div class="checkbox__item">
                            <input type="checkbox" class="checkbox__input" id="season-spring" name="product-season[]" value="4" 
                                {{ (is_array(old('product-season')) ? in_array('4', old('product-season')) : in_array('4', $seasons)) ? 'checked' : '' }}>
                            <label for="season-winter" class="checkbox__label">冬</label>
                        </div>
                    </div>
                    <p class="form__error">
                        {{ $errors->first('product-season') }}
                    </p>
                </div>
            </div>
        </div>
        {{-- 商品説明 --}}
        <div class="form__field">
            <label for="product-desc" class="form__label">
                商品説明
            </label>
            <textarea name="product-desc" id="product-desc" cols="30" rows="10" class="form__textarea">{{ is_array(old('product-desc')) ? old('product-desc') : $product->description }}</textarea>
            <p class="form__error">
                {{ $errors->first('product-desc') }}
            </p>
        </div>
        {{-- 戻ると変更ボタン --}}
        <div class="form__button">
            <button type="button" class="form__button--back" onclick="location.href='{{ url('/products') }}'">戻る</button>
            <button type="submit" class="form__button--save">変更</button>
        </div>
    </form>
    <form action="{{ route('product.destroy', ['productId' => $product->id]) }}" method="post" class="form__delete">
        @csrf
        @method('DELETE')
        <button type="submit" class="form__button--delete">
            <img src="{{ asset('icons/trash-icon.svg') }}" alt="削除ボタン" style="width: 24px; height: 24px;">
        </button>
    </form>
</div>
@endsection

@section('js')
<script src="{{ asset('js/productPreview.js') }}"></script>
@endsection