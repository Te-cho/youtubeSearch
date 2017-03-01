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
        $search_keywords = strtolower($request->get('search', 'was'));
        $searchProcessor = new SearchProcessor();
        $client = EsService::generateESConnection();
        $params = $searchProcessor->generateTopSearchQuery();
        $response = $client->search($params);
        $subtitlesService = new SubtitleAnalyzer();
        $response = $subtitlesService->analyzeAndProcess($response, $search_keywords);
        $data['videos'] = $response['hits']['hits'];
        $data['mainPage'] = true;

        return view('main-page', $data);

    }
}
