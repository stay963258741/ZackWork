@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{  Auth::user()->name .'  '.('您已登入，請點選新增') }}</div>
                </div>

                <div class="text-center">
                    <a class="btn btn-primary" type="button" style="margin-top: 2vh;width:10vw;"
                       href="{{ route('addresses.create') }}">新增</a>
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>

        </div>

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">編號</th>
                <th scope="col">HOSTNAME</th>
                <th scope="col">創建時間</th>
                <th scope="col">更新時間</th>
                <th scope="col">刪除</th>
            </tr>
            </thead>

            <tbody>
            @foreach($addresses as $address)
                <tr>
                    <th scope="row">{{ $address->id }}</th>
                    <th>{{ $address->hostname }}</th>
                    <th>{{ $address->created_at }}</th>
                    <th>{{ $address->updated_at }}</th>
                    <th>
                        <form method="POST" action="/address/{{ $address->id }}">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-dark" type="submit" value="刪除">
                        </form>
                    </th>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection



