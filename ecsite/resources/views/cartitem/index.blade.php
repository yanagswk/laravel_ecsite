@extends('layouts.app')

@section('content')
    @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ session('flash_message') }}
            </div>
    @endif

    @error('quantity')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @foreach ($cartitems as $cartitem)
                        <div class="card-header">                   <!-- itemsプロパティにアクセスして名前を取り出す -->
                            <a href="/item/{{ $cartitem->item_id }}">{{ $cartitem->items->name }}</a>
                        </div>
                        <div class="card-body">
                            <div>
                                {{-- itemsプロパティにアクセスして値段を取り出す --}}
                                {{ $cartitem->items->amount }}円
                            </div>
                            <div class="form-inline">
                                <!-- 数量を更新するフォームに変更 -->
                                <form method="POST" action="/cartitem/{{ $cartitem->id }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="text" class="form-control" name="quantity" value="{{ $cartitem->quantity }}">
                                    個
                                    <button type="submit" class="btn btn-primary">更新</button>
                                </form>
                                <!-- 削除フォームを追加 -->
                                <form method="POST" action="/cartitem/{{ $cartitem->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-primary ml-1">カートから削除する</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        小計
                    </div>
                    <div class="card-body">
                        <div>
                            {{ $subtotal }}円
                        </div>
                        <div>
                            <a class="btn btn-primary" href="/buy" role="button">
                                レジに進む
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
