<?php

namespace App;

use App\Filters\ThreadFilters;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;
    protected $guarded = [];
    protected $with = ['creator','channel'];
    protected $appends = ['isSubscribedTo'];
    protected static function boot ()
    {
        parent::boot();

        // static::addGlobalScope('replyCount', function ($builder){
        //     $builder->withCount('replies');
        // }); ///////// this was removed because we added a replies_count to the thread table
        static::deleting(function($thread){
            $thread ->replies->each->delete();
            /*
                this ^^|^^ is know as higher order messaging,
                an alternative to the code below
            */

            // $thread->replies()->each(function ($reply) {
            //    $reply ->delete();
            // });
        });
        }
// This static class just below was moved into the RecordActivity trait file as boot...
    //    static::created(function ($thread){
    //     $thread -> recordActivity('created');
    //    });

    /*
    The two methods below where moved into RecordActivity trait
    */
    // protected function recordActivity($event)
    // {
    //     Activity::create([
    //         'user_id' => auth()->id(),
    //         'type' => getActivityType($event),
    //         'subject_id' => $this->id,
    //         'subject_type' => get_class($this)
    //     ]);
    // }
    // protected function getActivityType($event)
    // {
    //     return $event . '_'. strtolower((new \ReflectionClass($this))->getShortName());
    //

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
    return $this->hasMany('App\Reply');

/* we could also write the class like this: Reply::class without the quotation and root folder(APP).
     Laravel automatically takes the model name(Thread) or parent table to create the foreign key(thread_id).
    if this is the not the case the foreign key key should be specify e.g ('App\Reply', 'custom_id')
        The foreign key basically is the key that links the two table.
    */
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);


   //prepare notifications for all subcribers
   $this->subscriptions
   ->filter(function ($sub) use ($reply){
       return $sub->user_id != $reply->user_id;

   })
    ->each->notify($reply); // higher order collections method the alternative default long form is just below

    // ->each(function ($sub) use ($reply){
    //     $sub->notify ($reply);
    // });


    ////////  OR //////

    //   $sub->user->notify(new ThreadWasUpdated($this, $reply));

    // }); /// this was tranfer to ThreadSubcription, notifiy method. So we could chain
    ///////// that relationship immediately above

               return $reply;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
            return $this;
    }

    public function unsubscribe($userId = null)
    {
        return $this->subscriptions()
        ->where('user_id', $userId ? : auth()->id())
        ->delete();
    }

    public function subscriptions()
    {
       return $this->hasMany(ThreadSubscription::class);

    }

    public function getIssubscribedToAttribute()
    {
        return $this->subscriptions()
        ->where('user_id', auth()->id())
        ->exists();
    }
}
