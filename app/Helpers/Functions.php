<?php

use Illuminate\Support\Str;

if (!function_exists('truncate')) {
    function truncate($data, $limit = 150)
    {
        return Str::limit($data, $limit, '...');
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format = 'jS M, Y')
    {
        return date($format, strtotime($date));
    }
}

if (!function_exists('breadCrumbTitle')) {
    function breadCrumbTitle($title)
    {
        $temp = ucwords(str_replace('-', ' ', $title));

        return $temp;
    }
}

if (!function_exists('removeStyleTags')) {
    function removeStyleTags($html = "")
    {

        $html = preg_replace('/<style\\b[^>]*>(.*?)<\\/style>/s', "", $html);
        return strip_tags($html);
        // $doc = new DOMDocument();
        // libxml_use_internal_errors(true);
        // $doc->loadHTML($html);
        // $doc->encoding = 'UTF-8';
        // $path = new DOMXPath($doc);
        // $nodes = $path->query("//*[@style]");
        // foreach ($nodes as $node) {
        //     $node->removeAttribute('style');
        // }
        // $html_new = $doc->saveHTML();
        // return $html_new;
    }
}

function getYoutubeEmbedUrl($url)
{
    if (!isset($youtube_id)) {
        return;
    }
    $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
    return 'https://www.youtube.com/embed/' . $youtube_id;
}
