<?php

namespace App\Src\SearchService;

use App\Src\AbstractBaseClass;

class SearchProcessor extends AbstractBaseClass
{

    public function generateSearchQuery($searchKeywords)
    {
        $params = [
            'index' => 'videos_en',
            'type' => 'videosSubtitles',
            'body' => [
                'size' => 9,
                'query' => [
                    'query_string' => [
                        'default_field' => "subtitles",
                        'query' => ""
                    ],
                ],
                'highlight' => [
                    'pre_tags' => ['<b>'],
                    'post_tags' => ['</b>'],
                    'fields' => [
                        "subtitles" => [
                            "fragment_size" => 300,
                            "number_of_fragments" => 3,
                        ],
                    ],
                ],
            ],
        ];
        $searchKeywords = '*'.str_replace(' ',' AND ', $searchKeywords);
        $searchKeywords .='*';
        $params['body']['query']['query_string']['query']=$searchKeywords;

        return $params;
    }
}
