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
                @foreach ($activities as $date => $activity)
                @foreach($activity as $record)
            <h3 class="card-header">{{$date}}</h3>
                @include("profiles.activities.{$record->type}", ['activity' =>$record])
                <br/>
                @endforeach
                <br/>
                @endforeach
               {{-- {{ $threads->links()}} --}}
            </div>
    </div>
</div>


@endsection
