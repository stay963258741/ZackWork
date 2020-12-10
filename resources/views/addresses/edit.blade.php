@extends('layouts.layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">

            <form method="POST" action="{{ route('addresses.update',[$address->id]) }}">
                @csrf
                @method('PUT')

                <label class="label" for="id">編號</label>
                <div class="control">
                    <input class="input" type="text" name="id" id="id" value="{{ $address->id }}">
                </div>

                <div class="field">
                    <label class="label" for="hostname">網址</label>

                    <div class="control">
                        <textarea class="textarea" name="hostname" id="hostname">{{ $address->hostname }}</textarea>
                    </div>
                </div>

                <div class="field is-group">
                    <div class="control">
                        <button class="button is-link" type="submit">送出</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
