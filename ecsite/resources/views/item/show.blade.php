@extends('layouts.app')

@section('content')
    @if (Session::has('flash_message'))
        <div class="alert alert-danger">
            {{ session('flash_message') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    {{-- 商品名､金額変更処理 --}}
                    <form action="{{ $item->id }}/update" method="post">
                        @csrf
                        <div class="card-header">
                            {{-- <a href="/item/{{ $item->id }}">{{ $item->name }}</a> --}}
                            <input type="text" name="item_name" value="{{ $item->name }}" style="width:100%;">
                        </div>
                        <div class="card-body">
                            {{-- <p>{{ $item->amount }}円</p> --}}
                            <p><input type="text" name="item_amount" value="{{ $item->amount }}">円</p>
                            {{-- <input type="button" value="更新" class="btn btn-primary"> --}}
                            <button>更新</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
