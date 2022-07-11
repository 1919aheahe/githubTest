@extends('layouts.app')
@section('title','detail page')

@section('content')
<div class="container">
    <div class="row">
        <!-- <メイン> -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <div class="card">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>商品画像</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー名</th>
                    </tr>
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if(empty($product->img_path))
                            画像なし
                            @else
                                <img src="{{ asset('storage/images/' . $product->img_path) }}" width="100" height="100"/>
                            @endif
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->company_id }}</td>
                        <td>{{ $product->comment }}</td>
                    </tr>
                </table>
                <div>
                    @auth
                    <a href="{{ url('products/edit/'.$product->id) }}" class="btn btn-primary">編集する</a>
                    @endauth
                    <input class="btn btn-primary" type="button" onclick="history.back()" value="戻る">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection