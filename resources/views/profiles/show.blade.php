@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
            <div class="card-header">
                    <h1>
                        {{$profileUser->name}}
                        <small> {{$profileUser->created_at->diffForHumans()}}</small>
                    </h1>

                </div>
                @forelse ($activities as $date => $activity)
                @foreach($activity as $record)
                @if(view()->exists("profiles.activities.{$record->type}"))
                 <h3 class="card-header">{{$date}}</h3>
                @include("profiles.activities.{$record->type}", ['activity' =>$record])
               @endif
                <br/>
                @endforeach

                <br/>
                 @empty
                <p>There is no activity for this user yet</p>
                @endforelse
               {{-- {{ $threads->links()}} --}}
            </div>
    </div>
</div>


@endsection
