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

    private $searchKeywords = "";

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $this->searchKeywords = $request->get('search', '');
//        (new GoogleAnalyticsService)->printResultss();
        $search_keywords = strtolower($this->searchKeywords);
        if (empty($search_keywords)) {
            return $this->mainPage();
        } else {
            return $this->searchPage($search_keywords);
        }

    }

    public function mainPage()
    {
        $searchProcessor = new SearchProcessor();
        $client = EsService::generateESConnection();
        $params = $searchProcessor->generateTopSearchQuery();
        $response = $client->search($params);
        $subtitlesService = new SubtitleAnalyzer();
        $response = $subtitlesService->makeSearchResult($response);
        $response = $subtitlesService->analyzeAndProcess($response);
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
        $response = $subtitlesService->analyzeAndProcess($response);
        $data['videos'] = $response['hits']['hits'];
        $data['searchKeywords'] = $this->searchKeywords;

        return view('search-page', $data);
    }
}
