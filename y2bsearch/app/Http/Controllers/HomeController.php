<?php

namespace App\Http\Controllers;

use App\Src\EsService\EsService;
use App\Src\SearchService\SearchProcessor;
use App\Src\SubtitleAnalyzer\SubtitleAnalyzer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function show(Request $request)
    {
        
    }
}
