@extends('layouts.app')
@section('title', 'Blog List')
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
                <div class="card">
                    <div class="card-header">
                        Blog List
                    </div>
                    <div class="card-body">
                        <ul>
                            @forelse($blogs as $blog)
                                <li><a href="{{ route('blog.show', $blog->id)}}">{{ $blog->title }}</a></li>
                            @empty
                                <li>Aucun article de blog disponible</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
