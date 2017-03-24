<?php

namespace Tests\SubtitleAnalyzer;


use App\Src\SubtitleAnalyzer\SubtitleAnalyzer;

class SubtitleAnalyzerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider ProvideSubtitles
     *
     * @param $searchTerm
     * @param $expected
     * @param $subtitles
     */
    public function shouldReturnAnalyzedAndProcessed($searchTerm, $expected, $subtitles)
    {
        $subtitleAnalyzer = new SubtitleAnalyzer();
        $result = $subtitleAnalyzer->analyzeAndProcess($subtitles, $searchTerm);
        static::assertEquals($expected, $result['hits']['hits']);
    }

    public function ProvideSubtitles()
    {
        return [
            [
                'searchKeyword' => 'better way to end',
                'expected' => [
                    0 => [
                        "_index" => "videos_en",
                        "_type" => "videosSubtitles",
                        "_id" => "n4bucphC9r4",
                        "_score" => 1.756412,
                        "_source" => [
                            "start" => 2,
                            "sentence" => ",align:start position:19%\npasta<c.colorCCCCCC><00:00:02.879><c> hot</c><00:00:03.330><c>dog</c><00:00:03.720><c> what</c><00:00:03.840><c> better</c><00:00:04.140><c> way</c><00:00:04.290><c> to</c><00:00:04.350><c> end</c></c>",
                            "subtitles" => [],
                            "image_default" => "https://i.ytimg.com/vi/n4bucphC9r4/default.jpg",
                            "image_medium" => "https://i.ytimg.com/vi/n4bucphC9r4/mqdefault.jpg",
                            "_subtitles" => [
                                "sentence" => [
                                    0 => "align:start position:19%\n<c.colorE5E5E5>hear<00:00:00.240><c> me</c><00:00:00.390><c> out</c><00:00:00.930><c> we've</c><00:00:01.140><c> had</c><00:00:01.319><c> steak</c><00:00:02.129><c> we've</c><00:00:02.250><c> had</c></c>",
                                    1 => ",align:start position:19%\npasta<c.colorCCCCCC><00:00:02.879><c> hot</c><00:00:03.330><c>dog</c><00:00:03.720><c> what</c><00:00:03.840><c> better</c><00:00:04.140><c> way</c><00:00:04.290><c> to</c><00:00:04.350><c> end</c></c>",
                                ],
                                "start" => [
                                    0 => "00:00:00.000",
                                    1 => "00:00:02.370",
                                    2 => "00:00:04.500",
                                ],
                                "end" => [],
                            ],
                            "video_hash_id" => "n4bucphC9r4",
                            "language" => "en",
                            "tags" => null,
                            "video_url" => "https://www.youtube.com/watch?v=n4bucphC9r4&t=2",
                            "@timestamp" => "2017-01-21T09:06:12.516Z",
                            "video_title" => "$27 Cake Vs. $1,120 Cake",
                            "@version" => "1",
                            "id" => 24,
                            "image_high" => "https://i.ytimg.com/vi/n4bucphC9r4/hqdefault.jpg",
                            "views" => null,
                            "video_id" => 68,
                            "upload_date" => null,
                        ],
                        'highlight' => ['subtitles' => ["   do nowthat <b>Donald</b> Trump is"]],
                    ],
                    1 => [
                        "_index" => "videos_en",
                        "_type" => "videosSubtitles",
                        "_id" => "n4bucphC9r4",
                        "_score" => 1.756412,
                        "_source" => [
                            "start" => 4,
                            "sentence" => "almost a better way to end",
                            "subtitles" => [],
                            "image_default" => "https://i.ytimg.com/vi/n4bucphC9r4/default.jpg",
                            "image_medium" => "https://i.ytimg.com/vi/n4bucphC9r4/mqdefault.jpg",
                            "_subtitles" => [
                                "sentence" => [
                                    0 => "bluh bluh bluh",
                                    1 => "almost a better way to ",
                                    2 => "almost a better way to end",
                                ],
                                "start" => [
                                    0 => "00:00:00.000",
                                    1 => "00:00:02.370",
                                    2 => "00:00:04.500",
                                ],
                                "end" => [],
                            ],
                            "video_hash_id" => "n4bucphC9r4",
                            "language" => "en",
                            "tags" => null,
                            "video_url" => "https://www.youtube.com/watch?v=n4bucphC9r4&t=4",
                            "@timestamp" => "2017-01-21T09:06:12.516Z",
                            "video_title" => "$27 Cake Vs. $1,120 Cake",
                            "@version" => "1",
                            "id" => 24,
                            "image_high" => "https://i.ytimg.com/vi/n4bucphC9r4/hqdefault.jpg",
                            "views" => null,
                            "video_id" => 68,
                            "upload_date" => null,
                        ],
                        'highlight' => ['subtitles' => ["   do nowthat <b>Donald</b> Trump is"]],
                    ],
                ],
                'subtitles' => [
                    'hits' => [
                        'hits' => [
                            0 => [
                                "_index" => "videos_en",
                                "_type" => "videosSubtitles",
                                "_id" => "n4bucphC9r4",
                                "_score" => 1.756412,
                                "_source" => [
                                    "subtitles" => [],
                                    "image_default" => "https://i.ytimg.com/vi/n4bucphC9r4/default.jpg",
                                    "image_medium" => "https://i.ytimg.com/vi/n4bucphC9r4/mqdefault.jpg",
                                    "_subtitles" => [
                                        "sentence" => [
                                            0 => "align:start position:19%\n<c.colorE5E5E5>hear<00:00:00.240><c> me</c><00:00:00.390><c> out</c><00:00:00.930><c> we've</c><00:00:01.140><c> had</c><00:00:01.319><c> steak</c><00:00:02.129><c> we've</c><00:00:02.250><c> had</c></c>",
                                            1 => ",align:start position:19%\npasta<c.colorCCCCCC><00:00:02.879><c> hot</c><00:00:03.330><c>dog</c><00:00:03.720><c> what</c><00:00:03.840><c> better</c><00:00:04.140><c> way</c><00:00:04.290><c> to</c><00:00:04.350><c> end</c></c>",
                                        ],
                                        "start" => [
                                            0 => "00:00:00.000",
                                            1 => "00:00:02.370",
                                            2 => "00:00:04.500",
                                        ],
                                        "end" => [],
                                    ],
                                    "video_hash_id" => "n4bucphC9r4",
                                    "language" => "en",
                                    "tags" => null,
                                    "video_url" => "https://www.youtube.com/watch?v=n4bucphC9r4",
                                    "@timestamp" => "2017-01-21T09:06:12.516Z",
                                    "video_title" => "$27 Cake Vs. $1,120 Cake",
                                    "@version" => "1",
                                    "id" => 24,
                                    "image_high" => "https://i.ytimg.com/vi/n4bucphC9r4/hqdefault.jpg",
                                    "views" => null,
                                    "video_id" => 68,
                                    "upload_date" => null,
                                ],
                                'highlight' => ['subtitles' => ["00:00:45.149 --> 00:00:49.770 align:start position:19% do<00:00:45.300><c> now</c><00:00:45.510><c>that</c><00:00:45.660><c> <b>Donald</b></c><00:00:46.079><c> Trump</c><00:00:46.140><c> is</c>"]],
                            ],
                            1 => [
                                "_index" => "videos_en",
                                "_type" => "videosSubtitles",
                                "_id" => "n4bucphC9r4",
                                "_score" => 1.756412,
                                "_source" => [
                                    "subtitles" => [],
                                    "image_default" => "https://i.ytimg.com/vi/n4bucphC9r4/default.jpg",
                                    "image_medium" => "https://i.ytimg.com/vi/n4bucphC9r4/mqdefault.jpg",
                                    "_subtitles" => [
                                        "sentence" => [
                                            0 => "bluh bluh bluh",
                                            1 => "almost a better way to ",
                                            2 => "almost a better way to end",
                                        ],
                                        "start" => [
                                            0 => "00:00:00.000",
                                            1 => "00:00:02.370",
                                            2 => "00:00:04.500",
                                        ],
                                        "end" => [],
                                    ],
                                    "video_hash_id" => "n4bucphC9r4",
                                    "language" => "en",
                                    "tags" => null,
                                    "video_url" => "https://www.youtube.com/watch?v=n4bucphC9r4",
                                    "@timestamp" => "2017-01-21T09:06:12.516Z",
                                    "video_title" => "$27 Cake Vs. $1,120 Cake",
                                    "@version" => "1",
                                    "id" => 24,
                                    "image_high" => "https://i.ytimg.com/vi/n4bucphC9r4/hqdefault.jpg",
                                    "views" => null,
                                    "video_id" => 68,
                                    "upload_date" => null,
                                ],
                                'highlight' => ['subtitles' => ["00:00:45.149 --> 00:00:49.770 align:start position:19% do<00:00:45.300><c> now</c><00:00:45.510><c>that</c><00:00:45.660><c> <b>Donald</b></c><00:00:46.079><c> Trump</c><00:00:46.140><c> is</c>"]],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
