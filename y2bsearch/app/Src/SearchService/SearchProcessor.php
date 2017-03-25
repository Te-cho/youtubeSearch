<?php

namespace App\Src\SearchService;

use App\Src\AbstractBaseClass;

class SearchProcessor extends AbstractBaseClass
{

    public function generateTopSearchQuery()
    {
        $params = [
            'index' => 'videos_en',
            'type' => 'videosSubtitles',
            'body' => [
                'size' => 3,
                'query' => [
                    "exists" => ["field" => "created_at"],
                ],
                'sort' => [
                    'created_at' => ['order' => 'desc'],
                ],
            ],
        ];

        return $params;
    }

    public function generateSearchQuery($searchKeywords)
    {
        $searchKeywords = explode(' ', $searchKeywords);
        //Taking half the number of keywords as a must match criteria
        $minimumMatch = (int)ceil(count($searchKeywords) / 2);
        $nestedQuery = [
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
                            'minimum_should_match' => $minimumMatch,
                            'should' => [],
                            'boost' => 2,
                        ],
                    ],
                ],
            ],
        ];
        $titleQuery = [
            'minimum_should_match' => $minimumMatch,
            'boost' => 0.5,
            'should' => [],
        ];
        foreach ($searchKeywords as $keyword) {
            $nestedQuery['must']['nested']['query']['bool']['should'][] = [
                'term' => [
                    'subtitles.sentence' => $keyword,
                ],
            ];
            $titleQuery['should'][] = [
                'term' => [
                    'video_title' => $keyword,
                ],
            ];
        }
        $params = [
            'index' => 'videos_en',
            'type' => 'videosSubtitles',
            'body' => [
                'size' => 9,
                'query' => [
                    'bool' => [
                        'minimum_should_match' => 1, // either tilte or nested
                        'should' => [
                            ['bool' => $nestedQuery],
                            ['bool' => $titleQuery],
                        ],
                    ],
                ],
                'sort' => [
                    '_score' => ['order' => 'desc'],
                ],
            ],
        ];

        return $params;
    }
}
