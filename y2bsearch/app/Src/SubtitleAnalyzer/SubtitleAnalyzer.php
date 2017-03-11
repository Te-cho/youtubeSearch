<?php

namespace App\Src\SubtitleAnalyzer;


use App\Src\Util\Sanitizer\Sanitizer;

class SubtitleAnalyzer
{
    /**
     * @param array $videos
     * @param $searchTerm
     *
     * @return array
     */
    public function getTiming(array $videos, $searchTerm)
    {
        $terms = explode(' ', $searchTerm);
        $termsCount = count($terms);
        foreach ($videos as $videoKey => $value) {
            $index = 0;
            $subtitles = $value['_source']['_subtitles'];
            foreach ($subtitles['sentence'] as $key => $subtitle) {
                $matchedTerms = 0;
                foreach ($terms as $term) {
                    if (str_contains($subtitle, $term)) {
                        $matchedTerms++;
                    } else {
                        break;
                    }
                }
                if ($matchedTerms === $termsCount) {
                    $index = $key;
                    break;
                }
            }
            $start = strtotime($subtitles['start'][$index]) - strtotime('TODAY');
//            $end = strtotime($subtitles['end'][$index]) - strtotime('TODAY');
            $sentence = $subtitles['sentence'][$index];
            if($start === 0){
                unset($videos[$videoKey]);
                continue;
            }
            $videos[$videoKey]['_source']['start'] = $start;
            $videos[$videoKey]['_source']['sentence'] = $sentence;
            $videos[$videoKey]['_source']['video_url'] = $videos[$videoKey]['_source']['video_url'] . '&t=' . $start;
        }

        return $videos;
    }

    public function analyzeAndProcess($response, $searchKeywords)
    {
        $responseProcessed = $response['hits']['hits'];
        $responseProcessed = $this->getTiming($responseProcessed, $searchKeywords);
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
            $highlight = $video['highlight']['subtitles'][0];
            $highlight = $sanitizer->cleanFromXMLTags($highlight);
            $videos[$index]['highlight']['subtitles'][0] = $highlight;
        }

        return $videos;
    }
}
