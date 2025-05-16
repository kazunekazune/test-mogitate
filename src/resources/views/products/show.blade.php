@extends('layouts.app')

@section('title', '商品詳細・編集')

@section('head')
<style>
    .edit-container {
        position: relative;
        background: #f7f7f7;
        padding: 32px;
        border-radius: 12px;
        max-width: 900px;
        margin: 48px auto 0 auto;
    }

    .edit-main {
        display: flex;
        gap: 40px;
        align-items: flex-start;
        justify-content: center;
        margin-top: 0;
    }

    .edit-left {
        width: 320px;
        flex-shrink: 0;
    }

    .edit-right {
        flex: 1;
    }

    .form-group {
        margin-bottom: 24px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        font-size: 1em;
        background: #fafafa;
        margin-bottom: 4px;
    }

    input[type="file"] {
        margin-bottom: 8px;
    }

    .checkbox-group label {
        margin-right: 18px;
        font-weight: normal;
    }

    .error-message {
        color: #e53935;
        font-size: 0.95em;
        margin-bottom: 4px;
    }

    .button-group {
        display: flex;
        gap: 16px;
        justify-content: center;
        margin-top: 24px;
    }

    .btn {
        padding: 10px 32px;
        border: none;
        border-radius: 8px;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        transition: background 0.2s;
    }

    .btn-cancel {
        background: #eee;
        color: #333;
    }

    .btn-submit {
        background: #f7b500;
        color: #fff;
    }

    .btn-submit:hover {
        background: #e6a800;
    }

    .trash-btn {
        background: none;
        border: none;
        cursor: pointer;
        position: absolute;
        right: 32px;
        bottom: 32px;
        padding: 0;
    }

    .trash-btn img {
        width: 40px;
        height: 40px;
        transition: filter 0.2s;
    }

    .trash-btn:hover img {
        filter: brightness(0.8);
    }

    .center-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        margin-top: 32px;
    }

    .form-group,
    .description-group {
        width: 600px;
        background: none;
        border: none;
        border-radius: 0;
        padding: 0;
    }

    .description-group textarea {
        width: 600px;
        min-height: 180px;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 1em;
        background: #fafafa;
        resize: vertical;
    }
</style>
@endsection

@section('content')
<div class="edit-container">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="edit-main">
            <div class="edit-left">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%; border-radius:8px; margin-bottom:16px;">
                <input type="file" name="image">
                @if ($errors->has('image'))
                <div class="error-message">{{ $errors->first('image') }}</div>
                @endif
            </div>
            <div class="edit-right">
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name', $product->name) }}">
                    @if ($errors->has('name'))
                    <div class="error-message">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>値段</label>
                    <input type="number" name="price" placeholder="値段を入力" value="{{ old('price', $product->price) }}">
                    @if ($errors->has('price'))
                    <div class="error-message">{{ $errors->first('price') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label>季節</label>
                    <div class="checkbox-group">
                        @php
                        $selectedSeasons = old('season', explode(',', $product->season));
                        @endphp
                        @foreach(['春', '夏', '秋', '冬'] as $season)
                        <label>
                            <input type="checkbox" name="season[]" value="{{ $season }}"
                                {{ in_array($season, $selectedSeasons) ? 'checked' : '' }}>
                            {{ $season }}
                        </label>
                        @endforeach
                    </div>
                    @if ($errors->has('season'))
                    <div class="error-message">{{ $errors->first('season') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="center-area">
            <div class="form-group description-group">
                <label>商品説明</label>
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @if ($errors->has('description'))
                <div class="error-message">{{ $errors->first('description') }}</div>
                @endif
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-cancel" onclick="window.location='{{ route('products.index') }}'">戻る</button>
                <button type="submit" class="btn btn-submit">変更を保存</button>
            </div>
        </div>
    </form>
    <form action="{{ route('products.delete', $product->id) }}" method="POST" class="trash-btn">
        @csrf
        <button type="submit" style="background:none; border:none; padding:0;">
            <img src="{{ asset('images/trash-icon.png') }}" alt="削除">
        </button>
    </form>
</div>
@endsection