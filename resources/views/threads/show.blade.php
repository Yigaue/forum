@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    
                <a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a>
                     posted: {{$thread->title}}
                  
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
            <br/>
  
                @foreach($replies as $reply)
                @include('threads.reply')
                @endforeach
                {{$replies->links()}}
           
               @if(auth()->check())
      
                <form method="post" action="{{$thread->path().'/replies'}}"> 
                {{csrf_field()}}
                <div class="form-group">
                <textarea name="body" id ="body" class="form-control" placeholder="join the discussion" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-default">leave comment</button>
                </form>
                
            
             @else
                 <p class="text-center">Please <a href="{{ route('login') }}">Sign in</a> to participate in the discussion</p>  
             @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p>
                        This thread was published {{$thread->created_at->diffForHumans()}} by
                    <a href="#">{{$thread->creator->name}}</a>, and currently
                    has {{$thread->replies_count}} {{str_plural('comment', $thread->replies_count)}}.
                    </p>   
                </div>
            </div>
        </div>
        
 
    </div>
</div>
@endsection
