<?php

namespace App\Src\SubtitleAnalyzer;


class SubtitleAnalyzer
{
    /**
     * @param array $videos
     * @param string $searchTerm
     *
     * @return array
     */
    public function getTiming(array $videos, string $searchTerm)
    {
        $terms = explode(' ', $searchTerm);
        $termsCount = count($terms);
        foreach ($videos as $videoKey => $value) {
            $index = 0;
            $subtitles = $value['_source']['_subtitles'];
            foreach ($subtitles['sentence'] as $key => $subtitle) {
                $matchedTerms = 0;
                foreach ($terms as $term){
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
            $videos[$videoKey]['_source']['start'] = $start;
            $videos[$videoKey]['_source']['sentence'] = $sentence;
            $videos[$videoKey]['_source']['video_url'] = $videos[$videoKey]['_source']['video_url'] . '&t=' . $start;
        }

        return $videos;
    }
}
