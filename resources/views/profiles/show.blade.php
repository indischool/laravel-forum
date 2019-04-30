@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>{{ $profileUser->name }}</h1>
        <small>{{ $profileUser->created_at->diffForHumans() }}부터</small>
    </div>

    @foreach($threads as $thread)
    <div class="card mb-2">
        <div class="card-body">
            <article>
                <div class="level">
                    <h4 class="flex">
                        <a href="{{ $thread->path() }}">
                            {{ $thread->title }}
                        </a>
                    </h4>
                    <span>{{ $thread->created_at->diffForHumans() }}</span>
                </div>

                <div class="body">{{ $thread->body }}</div>
            </article>
        </div>
    </div>
    @endforeach

    {{ $threads->links() }}

</div>
@endsection
