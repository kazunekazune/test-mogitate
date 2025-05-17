<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>商品名 <span class="required-label">必須</span></label>
        <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name', $product->name) }}">
        @if ($errors->has('name'))
        <div class="error-message">{{ $errors->first('name') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label>値段 <span class="required-label">必須</span></label>
        <input type="number" name="price" placeholder="値段を入力" value="{{ old('price', $product->price) }}">
        @if ($errors->has('price'))
        <div class="error-message">{{ $errors->first('price') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label>商品画像 <span class="required-label">必須</span></label>
        <div>
            <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" style="max-width:200px;">
        </div>
        <input type="file" name="image">
        @if ($errors->has('image'))
        <div class="error-message">{{ $errors->first('image') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label>季節 <span class="required-label">複数選択可</span></label>
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

    <div class="form-group">
        <label>商品説明 <span class="required-label">必須</span></label>
        <textarea name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
        @if ($errors->has('description'))
        <div class="error-message">{{ $errors->first('description') }}</div>
        @endif
    </div>

    <div class="button-group">
        <button type="button" class="btn btn-cancel" onclick="window.location='{{ route('products.index') }}'">戻る</button>
        <button type="submit" class="btn btn-submit">変更を保存</button>
    </div>
</form>

<!-- ゴミ箱ボタン -->
<form action="{{ route('products.destroy', $product->id) }}" method="POST" style="position: absolute; right: 40px; bottom: 40px;">
    @csrf
    @method('DELETE')
    <button type="submit" style="background: none; border: none; cursor: pointer;">
        <img src="/path/to/trash-icon.svg" alt="削除" width="32">
    </button>
</form>