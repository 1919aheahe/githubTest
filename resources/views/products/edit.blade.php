@extends('layouts.app')
@section('title','edit page')

@section('content')
<div class="row">
    <!-- <メイン> -->
    <div class="col-10 col-md-6 offset-1 offset-md-3">
        <div class="card-body">
            <h1 class="mt4">編集</h1>
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif

            <form action="/products/update" method="POST">
               @csrf
               <div class="form-group">
                    <input type="hidden" name="id" value="{{old('id',
                    $product->id)}}" placeholder="商品名">
                </div>
               <div class="form-group">
                    <label for="product_name">商品名：</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" value="{{old('product_name',
                    $product->product_name)}}" placeholder="商品名">
                </div>
                @error('product_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div>
                    <label for="company_id">メーカー</label>
                    <select name="company_id" class="form-control" id="company_id" value="{{old('company_id',
                    $product->company_id)}}">
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
                    <input type="text" name="price" class="form-control" id="price" value="{{old('price',
                    $product->price)}}" placeholder="価格">
                </div>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="input-alpha-numeric" maxlength="10">
                    <label for="stock">在庫数：</label>
                    <input type="number" name="stock" class="form-control" id="stock" value="{{old('stock',
                    $product->stock)}}" placeholder="在庫数">
                </div>
                @error('stock')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="text-center mt-3">
                    <label for="exampleFormControlTextarea1">コメント</label>
                    <textarea class="form-control" name="comment" class="form-control" id="comment" value="{{old('comment',
                    $product->comment)}}"></textarea>
                </div>
                
                <div>
                    <input type="file" name="img_path" accept="image/png,image/jpeg,image/gif" class="form-control-file" />
                </div>

                <div class="text-center mt-3">
                    <input class="btn btn-primary" type="submit" value="送信する">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input class="btn btn-primary" type="button" onclick="history.back()" value="戻る">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection