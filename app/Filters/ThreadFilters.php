<?php
namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular', 'unanswered'];
   /**
    * filter a query by a given username.
    *
    * @param string $username
    * @return mixed

   */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
    protected function popular ()
    {
        $this->builder->getQuery()->oders= [];
        return $this->builder->orderBy('replies_count', 'desc');
    }
    protected function unanswered()
    {
        return $this->builder->where('replies_count', 0);

    }
}
