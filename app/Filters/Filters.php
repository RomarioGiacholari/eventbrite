<?php

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters 
{

	protected $request;
	
	protected $builder;

	protected $filters = [];

    /**
     * Filters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
	{

		$this->request = $request;
	}

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
	{
		$this->builder = $builder;

		foreach($this->filters as $filter){

			if(method_exists($this, $filter) && $this->request->has($filter)){

			    $this->$filter($this->request->$filter);
			}
		}

		return $this->builder;
	}


}