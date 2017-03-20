<?php

namespace App\Src\SearchService;

use App\Src\AbstractBaseClass;

class SearchProcessor extends AbstractBaseClass
{

    public function generateTopSearchQuery()
    {
        $searchKeywords = "search";
        $params = [
            'index' => 'videos_en',
            'type' => 'videosSubtitles',
            'body' => [
                'size' => 3,
                'query' => [
                    'query_string' => [
                        'default_field' => "subtitles",
                        'query' => "",
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
        $searchKeywords = '*' . str_replace(' ', ' AND ', $searchKeywords);
        $searchKeywords .= '*';
        $params['body']['query']['query_string']['query'] = $searchKeywords;

        return $params;
    }

    public function generateSearchQuery($searchKeywords)
    {
        $params = [
            'index' => 'videos_en',
            'type' => 'videosSubtitles',
            'body' => [
                'size' => 9,
                'query' => [
                    'bool' => [
                        'must' => [
                            "nested" => [
                                'path' => "subtitles",
                                'inner_hits' => [
                                    'highlight' => [
                                        'pre_tags' => ['<b>'],
                                        'post_tags' => ['</b>'],
                                        "order" => "score",
                                        'fields' => [
                                            "subtitles.sentence" => [
                                                "fragment_size" => 300,
                                                "number_of_fragments" => 100,
                                            ],
                                        ],
                                    ],
                                ],
                                'query' => [
                                    'bool' => [
                                        'must' => [],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'sort' => [
                    '_score' => ['order' => 'desc'],
                ],
            ],
        ];
        $searchKeywords = explode(' ', $searchKeywords);
        foreach ($searchKeywords as $keyword) {
            $params['body']['query']['bool']['must']['nested']['query']['bool']['must'][] = [
                'term' => [
                    'subtitles.sentence' => $keyword,
                ],
            ];
        }

        return $params;
    }
}
