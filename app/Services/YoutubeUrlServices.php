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
        $domain = $parsed_url['path'];
        
        return $domain;
    }

    public static function isShortsUrl($url)
    {
        return strpos($url, 'shorts/') !== true;
    }

    public function convertShortsToEmbed($shortsUrl)
    {
        // Pattern for YouTube Shorts URLs
        $shortsPattern = '/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/';
        // Replacement for YouTube Shorts embed URL
        $shortsReplacement = 'youtube.com/embed/$1';
        // Check if the URL is a YouTube Shorts URL
        if (preg_match($shortsPattern, $shortsUrl)) {
            return preg_replace($shortsPattern, $shortsReplacement, $shortsUrl);
        }
        // If the URL does not match any known pattern, return it as is
        return $shortsUrl;
    }

    //check shorts and embed video set posts array url set 
    public function urlSet($posts)
    {
        if ($this->getDomainName($posts) == Post::YOUTUBE_SORT_PATH && $this->isShortsUrl($posts->url)) {
            $posts->url = $this->convertShortsToEmbed($posts->url);
        }
        
        if ($this->getDomainName($posts) == Post::YOUTUBE && $this->isShortsUrl($posts->url)) {
            $posts->url = $posts->url;
        }
    }

}
