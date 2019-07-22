@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="level">
                        <span class="flex">
                            작성자: <a href="{{ route('profile', $thread->creator->name) }}">{{ $thread->creator->name }}</a>,
                            {{ $thread->title }}
                        </span>

                                @can('update', $thread)
                                    <form action="{{ $thread->path() }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-link">스레드 삭제</button>

                                    </form>
                                @endcan
                            </div>

                        </div>

                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>

                    <replies :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>

                    {{--                @foreach($replies as $reply)--}}
                    {{--                    @include('threads.reply')--}}
                    {{--                @endforeach--}}

                    {{ $replies->links() }}

                    @auth
                        <form method="POST" action="{{ $thread->path() . '/replies' }}">
                            @csrf
                            <div class="form-group">
                    <textarea type="text" name="body" class="form-control" placeholder="Have something to say?"
                              rows="5"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    @endauth
                    @guest
                        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this
                            discussion.
                        </p>
                    @endguest
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            이 스레드는 {{ $thread->created_at->diffForHumans() }}에 작성되었고 현재
                            <span v-text="repliesCount"></span>
                            개의 댓글이 있습니다.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
