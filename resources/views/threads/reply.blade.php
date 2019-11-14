{{-- <reply-component :attributes= "{{$reply}}" inline-template v-cloak>
<div>
<div id = "reply-{{$reply->id}}" class="card">

        <div class="card-header">

         <div class="level">
             <h5  class="flex">
             <a href="/profiles/{{$reply->owner->name}}">{{$reply->owner->name}}</a> said
            {{$reply->created_at->diffForHumans()}}
             </h5>
             @if(Auth::check())
         <div>
         <favorite-component :reply="{{$reply}}"></favorite-component> --}}

         {{-- <form method="post" action="/replies/{{$reply->id}}/favorites">
            {{ csrf_field()}}
             <button type="submit" class="btn btn-default" {{$reply->isFavorited()? 'disabled': ''}}>
             {{$reply->favorites_count}} {{str_plural('Favorite', $reply->favorites_count)}}
            </button>
         </form> --}}
        {{-- </div>
        @endif
         </div>
        </div>
            <div class="card-body">
                <div v-if="editing">
                    <div class="form-group">
                    <textarea class="form-control" v-model = "body">{{$reply->body}}</textarea>
                    </div>
                    <button class="btn btn-sm btn-primary" @click="update">Update</button>
                     <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
                </div>
                <div v-else v-text="body">
                </div>

                </div>

            @can('update', $reply)
            <div class="card-footer level">
             <button class="btn btn-secondary btn-sm mr-3" @click="editing = true">Edit</button>
             <button class="btn btn-danger btn-sm mr-3" @click="destroy">Delete</button>

                {{-- <form method="POST" action="/replies/{{$reply->id}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger btn-sm">Delete</button></button>
                </form> --}}
            {{-- </div>
            @endcan
        </div>
        <br/>
        </div>
    </reply-component> --}}
