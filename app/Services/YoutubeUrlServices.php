<?php
namespace App\Services;

use App\Models\Post;

class YoutubeUrlServices
{
    //hepers functions
    public function getDomainName(Post $post)
    {
        // Parse the URL
        $parsed_url = parse_url($post->url);

        // Extract the domain name
        $domain = $parsed_url['host'];

        return $domain;
    }

    public static function isShortsUrl($url)
    {
        return strpos($url, 'shorts/') !== true;
    }

    public function convertShortsToEmbed($shortsUrl)
    {
        $pattern = '/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/';

        $replacement = 'youtube.com/embed/$1';

        return preg_replace($pattern, $replacement, $shortsUrl);
    }

    //check shorts and embed video
    public function urlSet($posts)
    {
        if ($this->getDomainName($posts) == Post::YOUTUBE && $this->isShortsUrl($posts)) {

            $posts->url = $this->convertShortsToEmbed($posts->url);

        }

        if ($this->getDomainName($posts) == Post::YOUTUBE && !$this->isShortsUrl($posts)) {

            $posts->url = $this->convertShortsToEmbed($posts->url);

        }
    }

}
