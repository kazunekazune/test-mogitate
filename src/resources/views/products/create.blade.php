@extends('layouts.app')

@section('title', '商品登録')

@section('head')
<style>
    .form-container {
        max-width: 480px;
        margin: 40px auto;
        background: #f7f7f7;
        padding: 32px 40px;
        border-radius: 12px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    label {
        font-weight: bold;
        margin-bottom: 6px;
        display: block;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 1em;
        background: #fafafa;
        margin-bottom: 4px;
    }

    input[type="file"] {
        margin-bottom: 8px;
    }

    input[type="checkbox"] {
        margin-right: 6px;
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
        margin-top: 32px;
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

    .required-label {
        background: #e53935;
        color: #fff;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.9em;
        font-weight: bold;
        margin-left: 4px;
        display: inline-block;
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>商品名 <span class="required-label">必須</span></label>
            <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}">
            @if ($errors->has('name'))
            <div class="error-message">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>値段 <span class="required-label">必須</span></label>
            <input type="number" name="price" placeholder="値段を入力" value="{{ old('price') }}">
            @if ($errors->has('price'))
            <div class="error-message">{{ $errors->first('price') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>商品画像 <span class="required-label">必須</span></label>
            <input type="file" name="image">
            @if ($errors->has('image'))
            <div class="error-message">{{ $errors->first('image') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label>季節 <span class="required-label">複数選択可</span></label>
            <div class="checkbox-group">
                @php
                $selectedSeasons = old('season', []);
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

        <div class="form-group">
            <label>商品説明 <span style="color:#e53935;">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
            <div class="error-message">{{ $errors->first('description') }}</div>
            @endif
        </div>

        <div class="button-group">
            <button type="button" class="btn btn-cancel" onclick="window.location='{{ route('products.index') }}'">戻る</button>
            <button type="submit" class="btn btn-submit">登録</button>
        </div>
    </form>
    @endsection