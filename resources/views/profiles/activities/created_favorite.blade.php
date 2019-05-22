@component('profiles.activities.activity')
@slot('heading')
<a href="{{ $activity->subject->favorited->path() }}">{{ $profileUser->name }}님이 댓글을 좋아했습니다.</a>
@endslot

@slot('body')
<div class="body">{{ $activity->subject->favorited->body }}</div>
@endslot
@endcomponent
