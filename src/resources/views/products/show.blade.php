@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<h2>商品詳細画面</h2>
<div>
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:300px;">
    <h3>{{ $product->name }}</h3>
    <p>価格: ¥{{ number_format($product->price) }}</p>
    <p>{{ $product->description }}</p>
</div>
@endsection