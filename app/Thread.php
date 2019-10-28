<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    protected static function boot ()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function ($builder){
            $builder->withCount('replies');
        });
    }

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
        $this->replies()->create($reply);
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}