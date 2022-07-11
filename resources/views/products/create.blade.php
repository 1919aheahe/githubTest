@extends('layouts.app')
@section('title','create page')

@section('content')
<div class="row">
    <!-- <メイン> -->
    <div class="col-10 col-md-6 offset-1 offset-md-3">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <div>
                    <label for="product_name">商品名：</label>
                    <input type="text" name="product_name" placeholder="商品名">
                </div>
                @error('product_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div>
                    <label for="company_id">メーカー:</label>
                    <select name="company_id" value="メーカー" required>
                        <option value="" selected="selected">選択してくだい</option>
                        <option value="1">1.田中株式会社</option>
                        <option value="2">2.鈴木産業</option>
                        <option value="3">3.佐藤合同会社</option>
                        <option value="4">4.高橋農場</option>
                    </select>
                </div>
                @error('company_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="input-alpha-numeric" maxlength="10">
                    <label for="price">価格：</label>
                    <input type="text" name="price" placeholder="価格">
                </div>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="input-alpha-numeric" maxlength="10">
                    <label for="stock">在庫数：</label>
                    <input type="number" name="stock" pattern="^[0-9a-zA-Z]+$" placeholder="在庫数">
                </div>
                @error('stock')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="exampleFormControlTextarea1">コメント</label>
                <textarea class="imeauto input-block-level" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                
                <input type="file" name="img_path" accept="image/png,image/jpeg,image/gif" class="form-control-file" />

                <div class="text-center mt-3">
                    <input class="btn btn-primary" type="submit" value="登録">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn btn-primary" type="button" onclick="history.back()" value="戻る">
                </div>
        </form>
    </div>
</div>
@endsection