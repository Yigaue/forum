<div class="card">
                  
        <div class="card-header">

         <div class="level">  
             <h5  class="flex">     
             <a href="/profiles/{{$reply->owner->name}}">{{$reply->owner->name}}</a> said
            {{$reply->created_at->diffForHumans()}}
             </h5>
         <div>
               
         <form method="post" action="/replies/{{$reply->id}}/favorites">
            {{ csrf_field()}}
             <button type="submit" class="btn btn-default" {{$reply->isFavorited()? 'disabled': ''}}>
             {{$reply->favorites_count}} {{str_plural('Favorite', $reply->favorites_count)}}
            </button>
         </form>
        </div>
         </div>
        </div>
            <div class="card-body">
                <div class="body">{{$reply->body}}</div>
            </div>
        </div>
        <br/>
 