@extends('layout.main')

@section('title', 'Welcome')

@section('content')
<div class="welcome-page">
    <p>🤩 Nice to see you, dear <span>{{ Auth::user()->name }}</span>! 👋</p>
</div>
@endsection
