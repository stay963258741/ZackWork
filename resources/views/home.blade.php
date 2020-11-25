@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{  Auth::user()->name .'  '.('您已登入，請點選新增') }}</div>
            </div>

            <a class="btn btn-primary"  type="button" style="margin-top: 2vh;width:10vw;"
               href="{{ route('addresses.create') }}">新增</a>


            <div class="card-body mt-3">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
