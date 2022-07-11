@extends('layouts.app')
@section('title', 'TOP page')

@section('content')
<div class="container">
    <div class="row">
        <!-- <メイン> -->
        <div class="col-10 col-md-8 offset-1 offset-md-2">
        <!-- 検索フォーム -->
        <h5 class="card-title">検索フォーム</h5>
        <div id="custom-search-input">
            <div class="input-group col-md-12">
                <form action="{{ route('products.index') }}" method="GET">
                    {{ csrf_field() }}
                    <input type="text" class="form-control input-lg" placeholder="検索フォーム" name="keyword" value="{{ $keyword }}">
                    <select class="form-control input-lg" name="company_id" value="{{ $keyword }}" >
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-success">
                </form>
            </div>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>在庫数</th>
                    <th>メーカー名</th>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id}}</td>
                        <td>
                            @if(empty($product->img_path))
                            画像なし
                            @else
                                <img src="{{ asset('storage/images/' . $product->img_path) }}" width="100" height="100"/>
                            @endif
                        </td>
                        <td>{{ $product->product_name }}</td></a>
                        <td>{{ $product->price}}</td>
                        <td>{{ $product->stock}}</td>
                        <td>{{ $product->company_id}}</td>
                
                        <td>
                            <a href="{{ url('products/'.$product->id)}}" class="btn btn-success">詳細</a>
                            @auth
                            <form action="/products/delete/{{$product->id}}" method="POST">
                            {{ csrf_field() }}
                                <input type="submit" value="削除" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">
                            </form>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
</div>
@endsection