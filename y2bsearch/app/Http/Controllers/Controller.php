<?php

namespace App\Http\Controllers;

use App\Src\EsService\EsService;
use App\Src\GA\GoogleAnalyticsService;
use App\Src\SearchService\SearchProcessor;
use App\Src\SubtitleAnalyzer\SubtitleAnalyzer;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
//        (new GoogleAnalyticsService)->printResultss();
        $search_keywords = strtolower($request->get('search', ''));
        if (empty($search_keywords)) {
            return $this->mainPage($search_keywords);
        } else {
            return $this->searchPage($search_keywords);
        }

    }

    public function mainPage($search_keywords)
    {
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

    public function searchPage($search_keywords)
    {
        $searchProcessor = new SearchProcessor();
        $client = EsService::generateESConnection();
        $params = $searchProcessor->generateSearchQuery($search_keywords);
        $response = $client->search($params);
        $subtitlesService = new SubtitleAnalyzer();
        $response = $subtitlesService->analyzeAndProcess($response, $search_keywords);
        $data['videos'] = $response['hits']['hits'];

        return view('search-page', $data);
    }
}
