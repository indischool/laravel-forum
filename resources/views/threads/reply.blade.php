<reply :attributes="{{ $reply }}" inline-template v-cloak>
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
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-sm btn-primary" @click="update">저장</button>
                <button class="btn btn-sm btn-link" @click="editing = false">취소</button>
            </div>
            <div v-else v-text="body"></div>
        </div>

        @can('update', $reply)
        <div class="card-footer level">
            <button class="btn btn-secondary btn-sm mr-1" @click="editing = true">수정</button>
            <form method="POST" action="/replies/{{ $reply->id }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm">삭제</button>
            </form>
        </div>
        @endcan
    </div>
</reply>
