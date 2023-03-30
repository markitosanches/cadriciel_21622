@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Chat</div>
        <div class="card-body">
            <chat-messages></chat-messages>
        </div>
        <div class="card-footer">
            <chat-form></chat-form>
        </div>
    </div>
</div>
@endsection
