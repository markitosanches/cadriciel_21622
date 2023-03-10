@extends('layouts.app')
@section('title', 'User List')
@section('content')
<div class="container">
    <h1> User list</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>@forelse($user->userHasBlogs as $blog)
                    <p>{{ $blog->title}}</p>
                    @empty
                    <p>no article</p>
                    @endforelse
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users }}
</div>
@endsection