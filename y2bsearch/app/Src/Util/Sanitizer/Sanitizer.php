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
        $exceptionTags = '/(<b>)|(</b>)/';
        $open = ['tag' => '<b>', 'value' => 'boldOpen'];
        $close = ['tag' => '</b>', 'value' => 'boldClose'];
        $time = '/[0-9]*:[0-9]*:[0-9]*.[0-9]* --> [0-9]*:[0-9]*:[0-9]*.[0-9]*/';
        $tags = '/<[^>]*>/';
        $values = '/[a-z]+:[a-z|0-9|%]+/';
        $misc = '/(\r?\n)/';
        $res = $sentence;
        $res = str_replace($open['tag'], $open['value'], $res);
        $res = str_replace($close['tag'], $close['value'], $res);
        $res = preg_replace($tags, '', $res);
        $res = preg_replace($time, '', $res);
        $res = preg_replace($values, '', $res);
        $res = preg_replace($misc, '', $res);
        $res = str_replace($open['value'], $open['tag'], $res);
        $res = str_replace($close['value'], $close['tag'], $res);

        return $res;
    }
}
