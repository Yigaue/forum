<?php
namespace App ;

trait RecordsActivity
{

    protected static function bootRecordsActivity()
    {
       if (auth()->guest()) return;
       foreach(static::getActivitiesToRecord() as $event){
           static::$event(function ($model) use ($event){
            $model->recordActivity($event);
           });
       }
    

    static::deleting (function ($model) {
        $model->activity()->delete();
    });
}
    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }
    protected function recordActivity($event)
    {
        // Activity::create([
        //     'user_id' =>auth()->id(),
        //     'type'=> $event.'_' . strtolower(new \ReflectionClass($this))->getShortName(),
        //     'subject_id' => $this->id,
        //     'subject_type' => get_class($this)
        // ]); //alternative code just below
        $this->activity()->create([
            'user_id' =>auth()->id(),
            'type'=>$this->getActivityType($event)
        ]);
    }
    public function activity()
    {
        return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityType($event)

        {
            $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
        }

}
