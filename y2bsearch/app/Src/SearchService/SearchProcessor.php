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
                'query' => [
                    'bool' => [
                        'must' => [],
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
        $searchKeywords = explode(' ', $searchKeywords);
        foreach ($searchKeywords as $searchKeyword) {
            $params['body']['query']['bool']['must'][] = [
                'term' => ['subtitles' => $searchKeyword],
            ];
        }

        return $params;
    }
}
