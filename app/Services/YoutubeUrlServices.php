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
        // Pattern for YouTube Shorts URLs
        $shortsPattern = '/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/';

        // Fixed base URL for YouTube embed
        $embedBaseUrl = 'https://www.youtube.com/embed/';

        // Check if the URL is a YouTube Shorts URL
        if (preg_match($shortsPattern, $shortsUrl, $matches)) {
            // Get the video ID (the part after '/shorts/')
            $videoId = $matches[1];

            // Return the full embed URL
            return $embedBaseUrl . $videoId;
        }

        // If the URL does not match the pattern, return it as is
        return $shortsUrl;
    }


    //check shorts and embed video set posts array url set 
    public function urlSet($post)
    {
        if ($post->video_type == Post::YOUTUBE_SHORT) {
            $post->url = $this->convertShortsToEmbed($post->url);
        }

        if ($post->video_type == Post::YOUTUBE_VIDEO) {
            $post->url = $post->url;
        }
    }
}
