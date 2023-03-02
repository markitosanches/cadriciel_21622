@extends('layouts.app')
@section('title', 'Create')
@section('content')
<div class="container">
    <h1> Blog</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td>{{$blog->title}}</td>
                <td>@isset($blog->blogHasUser)
                        {{$blog->blogHasUser->name}}
                    @endisset
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $blogs }}
</div>
@endsection