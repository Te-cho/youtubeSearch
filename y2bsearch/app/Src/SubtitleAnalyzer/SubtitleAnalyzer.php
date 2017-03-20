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
}
