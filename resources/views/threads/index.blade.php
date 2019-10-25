@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                        @foreach($threads as $thread)
                        <article>
                     <h1>
                        <a href="{{$thread->path()}}">
                         {{$thread->title}}
                        </a>
                     </h1>
                        <div body>{{$thread->body}}</div>
                        </article>
                        <hr>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
