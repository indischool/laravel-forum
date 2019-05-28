<div id="reply-{{ $reply->id }}" class="card mb-3">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner->name) }}">
                    {{ $reply->owner->name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </h5>

            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    @csrf

                    <button type="submit" class="btn btn-outline-primary"
                        {{ $reply->isFavorited() ? 'disabled' : ''}}>좋아요
                        {{ $reply->favorites_count }}개</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>

    @can('update', $reply)
    <div class="card-footer">
        <form method="POST" action="/replies/{{ $reply->id }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-xs">삭제</button>
        </form>
    </div>
    @endcan
</div>
