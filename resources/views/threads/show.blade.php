@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
            <a href="#">{{$thread->creator->name}}</a>
               posted: {{$thread->title}}
            </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                     
                        <article>
                        <div body>{{$thread->body}}</div>
                        </article>
                        
                       
                </div>
            </div>
        </div>
    </div>
    <br/>

    <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                @include('threads.replies')
                @endforeach
            </div>
        </div>
           
        @if(auth()->check())
        <div class="row justify-content-center">
                <div class="col-md-8">
                <form method="post" action="{{$thread->path().'/replies'}}"> 
                    {{csrf_field()}}
                    <div class="form-group">
                    <textarea name="body" id ="body" class="form-control" placeholder="join the discussion" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">leave comment</button>
                   </form>
                
                </div>
               
            </div>
            @else
        <p class="text-center">Please <a href="{{ route('login') }}">Sign in</a> to participate in the discussion</p>  
            @endif
</div>
@endsection
