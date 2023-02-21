@extends('layouts.app')
@section('title', 'Post')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-2">
                <div class="display-5 mt-2">
                    {{ config('app.name')}}
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="display-6 mt-2">
                    {{$blogPost->title}}
                </div>
                <p>
                {!! $blogPost->body !!}
                </p>
                <p>
                    <strong>Author : </strong> {{$blogPost->user_id}}
                </p>
                <a href="{{route('blog.index')}}" class="btn btn-sm btn-primary">Retourner</a>
            </div>
        </div>

    </div>
@endsection