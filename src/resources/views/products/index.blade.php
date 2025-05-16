@extends('layouts.app')

@section('title', '商品一覧')

@section('head')
<style>
    .main-layout {
        padding: 0 32px;
        display: flex;
        align-items: flex-start;
        gap: 40px;
        margin-top: 32px;
        background-color: #f8f8f8
    }

    .sidebar {
        width: 260px;
        flex-shrink: 0;
    }

    .sidebar h2 {
        margin-top: 0;
        margin-bottom: 32px;
        font-size: 1.4em;
        font-weight: bold;
    }

    .search-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 32px;
    }

    .search-input {
        border-radius: 20px;
        border: 1px solid #ccc;
        padding: 10px 16px;
        outline: none;
        font-size: 1em;
        color: #888;
        background: #fafafa;
    }

    .search-btn {
        background: #f7b500;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 0;
        font-weight: bold;
        font-size: 1em;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
    }

    .search-btn:hover {
        background: #e6a800;
    }

    .label-sort {
        margin-top: 24px;
        margin-bottom: 8px;
        font-size: 1em;
        color: #333;
        font-weight: bold;
    }

    .select-wrapper {
        position: relative;
        width: 100%;
        height: 44px;
    }

    .sort-select {
        width: 100%;
        height: 44px;
        line-height: 44px;
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 0px 36px 0px 16px;
        font-size: 1em;
        background: #fafafa;
        color: #888;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        outline: none;
        box-sizing: border-box;
        margin-bottom: 24px;
        cursor: pointer;
        height: 44px;
        line-height: 44px;
    }

    .select-wrapper::after {
        content: "";
        position: absolute;
        top: 50%;
        right: 18px;
        width: 0;
        height: 0;
        pointer-events: none;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 7px solid #bbb;
        transform: translateY(-50%);
        z-index: 2;
    }

    .product-area {
        flex: 1;
        min-width: 0;
    }

    .product-area-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .product-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 16px 8px 16px;
    }

    .product-name {
        font-size: 1.1em;
        font-weight: normal;
        margin: 0;
    }

    .product-price {
        font-weight: bold;
        color: #333;
        margin: 0;
    }

    .add-btn {
        background: #f7b500;
        color: #fff;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        transition: background 0.2s;
    }

    .add-btn:hover {
        background: #e6a800;
    }

    .product-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
    }

    .product-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 0 0 16px 0;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .product-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
        margin-bottom: 12px;
    }

    .product-name {
        font-size: 1.1em;
        margin: 0 16px 8px 16px;
    }

    .product-price {
        font-weight: bold;
        color: #333;
        margin: 0 16px 8px 16px;
    }

    .pagination-nav {
        display: flex;
        justify-content: center;
        margin-top: 24px;
    }

    .pagination-list {
        display: flex;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination-item {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pagination-item a,
    .pagination-item span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #fff;
        color: #f7b500;
        font-weight: bold;
        font-size: 1.1em;
        text-decoration: none;
        border: 1px solid #f7b500;
        transition: background 0.2s, color 0.2s;
    }

    .pagination-item.active span {
        background: #f7b500;
        color: #fff;
        border: 1px solid #f7b500;
    }

    .pagination-item.disabled span {
        color: #ccc;
        border: 1px solid #eee;
        background: #fafafa;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
<div class="main-layout">
    <aside class="sidebar">
        <h2>商品一覧</h2>
        <form method="GET" action="{{ route('products.index') }}" class="search-form">
            <input type="text" name="keyword" class="search-input" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit" class="search-btn">検索</button>
        </form>
        <div class="label-sort">価格順で表示</div>
        <form method="GET" action="{{ route('products.index') }}" class="sort-form">
            <div class="select-wrapper">
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="">価格で並べ替え</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                </select>
            </div>
        </form>
    </aside>
    <section class="product-area">
        <div class="product-area-header">
            <div></div>
            <a href="{{ route('products.register') }}" class="add-btn">＋商品を追加</a>
        </div>
        <div class="product-list">
            @foreach ($products as $product)
            <a href="{{ route('products.show', $product) }}" class="product-card-link" style="text-decoration:none; color:inherit;">
                <div class="product-card">
                    <img class="product-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-info-row">
                        <span class="product-name">{{ $product->name }}</span>
                        <span class="product-price">¥{{ number_format($product->price) }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div>
            {{ $products->links('vendor.pagination.custom') }}
        </div>
    </section>
</div>
@endsection