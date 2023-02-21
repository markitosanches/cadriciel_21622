@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <div class="display-5 mt-2">
                    {{ config('app.name')}}
                </div>
                <p>
                    <a href="{{route('blog.index')}}">Cliquer ici pour visiter les articles</a> 
                </p>
            </div>
        </div>
    </div>
@endsection