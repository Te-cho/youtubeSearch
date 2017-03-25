<?php

namespace App\Src\SubtitleAnalyzer;


use App\Src\Util\Sanitizer\Sanitizer;

class SubtitleAnalyzer
{
    public function analyzeAndProcess($response)
    {
        $responseProcessed = $response['hits']['hits'];
//        $responseProcessed = $this->getTiming($responseProcessed);
        $responseProcessed = $this->cleanHighlights($responseProcessed);
        $response['hits']['hits'] = $responseProcessed;

        return $response;
    }

    /**
     * Will clean all the highlights from the webVtt aditional tags and styles
     *
     * @param $videos
     *
     * @return mixed
     */
    private function cleanHighlights($videos)
    {
        $sanitizer = new Sanitizer();
        foreach ($videos as $index => $video) {
            $highlight = $video['inner_hits']['subtitles']['hits']['hits'][0]['highlight']['subtitles.sentence'];
            $highlight = $sanitizer->cleanFromXMLTags($highlight);
            $videos[$index]['inner_hits']['subtitles']['hits']['hits'][0]['highlight']['subtitles.sentence'] =
                $highlight;
        }

        return $videos;
    }

    //to make main page search tophits, like the normal search result
    public function makeSearchResult($response)
    {
        foreach ($response['hits']['hits'] as $key => $video) {
            $innerHits = [
                "subtitles" => [
                    "hits" => [
                        "total" => 1,
                        "max_score" => 12.094503,
                        "hits" => [
                            0 => [
                                "_nested" => [],
                                "_score" => 12.094503,
                                "_source" => [
                                    "sentence" => $video['_source']['subtitles'][0]['sentence'],
                                    "start" => $video['_source']['subtitles'][0]['start'],
                                    "index" => 0,
                                    "end" => $video['_source']['subtitles'][0]['end'],
                                ],
                                "highlight" => [
                                    "subtitles.sentence" => [
                                        $video['_source']['subtitles'][0]['sentence'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ];
            $response['hits']['hits'][$key]['inner_hits'] = $innerHits;
        }

        return $response;
    }
}
