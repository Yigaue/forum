@component('profiles.activities.activity')
        @slot('heading')
<a href="{{$activity->subject->favorited->path()}}">
        {{$profileUser->name}} favorited a reply
        {{-- <a href = "{{$activity->subject->thread->path()}}">{{$activity->subject->thread->title}}</a> --}}
        </a>
        @endslot

        @slot('body')
    {{$activity->subject->favorited->body}}
    @endslot
    @endcomponent
