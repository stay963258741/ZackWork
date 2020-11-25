@extends('layouts.layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <h1>新增網址</h1>

            <form method="POST" action="/address">
                @csrf

                <div class="field">
                    <label class="label" for="hostname"></label>

                    <div class="control">
                        <input class="input" type="text" name="hostname" id="hostname">
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">新增</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
