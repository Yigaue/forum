<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public function favorited()
    {
        return $this->morphTo();
    }

}
