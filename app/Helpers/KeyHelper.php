<?php

namespace App\Helpers;

class KeyHelper
{
    /**
     * @param  $content
     * @return array
     */
    static function getTags(string $content)
    {
        preg_match_all('/(^|\s)(#[a-z|\p{Han}]+\b)/ui', $content, $tags);

        return $tags[2];
    }
}
