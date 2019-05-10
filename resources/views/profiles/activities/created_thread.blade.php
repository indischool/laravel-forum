@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }}님이 새 글타래
        <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>을(를) 작성하였습니다.
    @endslot

    @slot('body')
        <div class="body">{{ $activity->subject->body }}</div>
    @endslot
@endcomponent
