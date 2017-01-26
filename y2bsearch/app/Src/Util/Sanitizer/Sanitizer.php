<?php

namespace App\Src\Util\Sanitizer;


class Sanitizer
{
    /**
     * Will clean the highlights from the webVtt aditional tags and styles
     * @example "00:00:45.149 --> 00:00:49.770 align:start position:19% do<00:00:45.300><c> now</c><00:00:45.510><c>
     *     that</c><00:00:45.660><c> <b>Donald</b></c><00:00:46.079><c> Trump</c><00:00:46.140><c> is</c>";
     *
     * @param $sentence
     *
     * @return string
     */
    public function cleanFromXMLTags($sentence)
    {
        $time = '/[0-9]*:[0-9]*:[0-9]*.[0-9]* --> [0-9]*:[0-9]*:[0-9]*.[0-9]*/';
        $tags = '/<[^>]*>/';
        $values = '/[a-z]+:[a-z|0-9|%]+/';
        $res = preg_replace($tags, '', $sentence);
        $res = preg_replace($time, '', $res);
        $res = preg_replace($values, '', $res);

        return $res;
    }
}
