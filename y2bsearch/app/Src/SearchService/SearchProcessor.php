<?php

namespace App\Src\SearchService;

use App\Src\AbstractBaseClass;

class SearchProcessor extends AbstractBaseClass
{

    public function generateSearchQuery($search_keywords)
    {
        $params = [
            'index' => 'videos_en',
            'type' => 'videosSubtitles',
            'body' => [
                'query' => [
                    'terms' => ['subtitles' => explode(' ', $search_keywords)],
                ],
                'highlight' => [
                    'pre_tags' => ['<b>'],
                    'post_tags' => ['</b>'],
                    'fields' => [
                        "subtitles" => [
                            "fragment_size" => 30,
                            "number_of_fragments" => 3,
                        ],
                    ],
                ],
            ],
        ];

        return $params;
    }
}
