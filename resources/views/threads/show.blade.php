@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{$thread->replies_count}}" inline-template>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="level">
                        <span class="flex">
                        <a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a>
                        posted: {{$thread->title}}
                        </span>
                        @can('update',$thread)
                    <form action="{{$thread->path()}}" method="POST">
                        {{csrf_field() }}
                        {{method_field('DELETE')}}
                        <button class="btn btn-link">Delete Thread</button>
                        </form>
                        @endcan
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
            <br/>
        {{-- <replies-component :data="{{$thread->replies}}" removed when implementing pagination--}}
            <replies-component @added ="repliesCount++" @removed="repliesCount--"></replies-component>

                {{-- @foreach($replies as $reply)
                @include('threads.reply')
                @endforeach
                {{$replies->links()}} --}}

               {{-- @if(auth()->check())

                <form method="post" action="{{$thread->path().'/replies'}}">
                {{csrf_field()}}
                <div class="form-group">
                <textarea name="body" id ="body" class="form-control" placeholder="join the discussion" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">leave comment</button>
                </form>


             @else
                 <p class="text-center">Please <a href="{{ route('login') }}">Sign in</a> to participate in the discussion</p>
             @endif --}}
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p>
                        This thread was published {{$thread->created_at->diffForHumans()}} by
                    <a href="/profiles/{{$thread->creator->name}}">{{$thread->creator->name}}</a>, and currently
                    has <span

                    v-text="repliesCount"></span> {{str_plural('comment', $thread->replies_count)}}.
                    </p>
                    <p>
                    <subscribe-button :active="{{json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                     </p>
                </div>
            </div>
        </div>


    </div>
</div>
</thread-view>

@endsection
