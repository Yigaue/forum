@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header">
        <h1>
            {{$profileUser->name}}
            <small>Since {{$profileUser->created_at->diffForHumans()}}</small>
        </h1>

    </div>
    @foreach ($threads as $thread)
    <div class="card">
            <div class="card-header">
                <div class="level">
                    <span class="flex">
                    <a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a>
                 posted: {{$thread->title}}
                </span>
                <span>{{$thread->created_at->diffForHumans()}}</span>
                </div>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                
                <article>
                 <div class="card-body">{{$thread->body}}</div>
                </article>
                    
                   
            </div>
        </div>
    @endforeach
   {{ $threads->links()}}
</div>
@endsection
