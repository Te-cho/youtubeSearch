<?php

namespace App\Http\Controllers;

use App\Src\EsService\EsService;
use App\Src\SearchService\SearchProcessor;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function show(Request $request)
    {
        $search_keywords = $request->get('search', 'was');
        $searchProcessor = new SearchProcessor();
        $client = EsService::generateESConnection();

        $params = $searchProcessor->generateSearchQuery($search_keywords);
        $response = $client->search($params);
        $data['videos'] = $response['hits']['hits'];

        // dd($data['videos'][0]['highlight']['subtitles']);

        return view('welcome', $data);

    }
}
