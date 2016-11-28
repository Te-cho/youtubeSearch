<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Elasticsearch\ClientBuilder;

class CrawlerController extends AnotherClass
{
	
	function __construct(argument)
	{
		# code...
	}

	public function StoreUrl($url){
		//Store that URL in our DB
	}
}