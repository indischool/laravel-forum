@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="level align-items-baseline">
                    <h1 class="mr-2">{{ $profileUser->name }}</h1>
                </div>

                @forelse($activities as $date => $activity)
                    <h3>{{ $date }}</h3>
                    @foreach($activity as $record)
                        @if(view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                @empty
                    <p>아직 활동기록이 없습니다.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
