<?php

namespace App\Filters;

use Illuminate\Http\Request;
use array_intersect;

abstract class Filters
{
    protected $builder, $request;
    protected $filters = [];
   

     
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
   
    // we appy our filter to the builder
    public function apply($builder)
    {
        $this->builder = $builder;
       
        foreach ($this->getFilters() as $filter=>$value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        

        return $this->builder;
    }

   
    public function getFilters()
    {
        return $this->request->only($this->filters);
        // the 'only' method works fine and return an empty against the 'intersect' method which returns does not exist
        // we do  dd($this->getFilters()); just after  $this->builder = $builder in the 'apply' method to check.
    }
}
