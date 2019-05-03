<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;

class KeyHelper
{
    /**
     * @param  $content
     * @return array
     */
    public static function getTags(string $content)
    {
        preg_match_all('/(^|\s)(#[a-z|\p{Han}]+\b)/ui', $content, $tags);

        return $tags[2];
    }

    /**
     * @return array
     */
    public static function getExampleKey()
    {
        $content = Collection::make([
            'Let us choose for ourselves our path in life, and let us try to strew that path with flowers. - Emilie du Chatelet',
            'If you know you are on the right track, if you have this inner knowledge, then nobody can turn you off... no matter what they say. - Barbara McClintock',
            'Don\'t let anyone rob you of your imagination, your creativity, or your curiosity. - Mae Jemison',
            'I hadn\'t been aware that there were doors closed to me until I started knocking on them. - Gertrude B. Elion',
            'Life need not be easy, provided only that it is not empty. - Lise Meitner',
        ])->random();

        $key = [
            'title' => 'My Favorite Quote',
            'content' => Crypt::encrypt($content),
            'tags' => '#inspire',
            'link' => 'https://www.google.com.tw/search?q='.substr(strrchr($content, '- '), 1),
            'password' => false,
        ];

        return $key;
    }
}
