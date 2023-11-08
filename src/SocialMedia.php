<?php

namespace FunctionalityPlugin;

use Illuminate\Support\Collection;

class SocialMedia
{
    private Collection $channels;

    public function __construct()
    {
        $this->channels = collect([
            'facebook' => [
                'label' => __('Facebook', 'functionality-plugin'),
                'icon' => 'facebook'
            ],
            'instagram' => [
                'label' => __('Instagram', 'functionality-plugin'),
                'icon' => 'instagram'
            ],
            'linkedin' => [
                'label' => __('LinkedIn', 'functionality-plugin'),
                'icon' => 'linkedin'
            ],
            'x' => [
                'label' => __('X', 'functionality-plugin'),
                'icon' => 'x-twitter'
            ],
            'youtube' => [
                'label' => __('YouTube', 'functionality-plugin'),
                'icon' => 'youtube'
            ],
            'vimeo' => [
                'label' => __('Vimeo', 'functionality-plugin'),
                'icon' => 'vimeo'
            ],
            'tiktok' => [
                'label' => __('TikTok', 'functionality-plugin'),
                'icon' => 'tiktok'
            ],
            'pinterest' => [
                'label' => __('Pinterest', 'functionality-plugin'),
                'icon' => 'pinterest'
            ],
            'tripadvisor' => [
                'label' => __('Tripadvisor', 'functionality-plugin'),
                'icon' => 'tripadvisor'
            ],
        ]);
    }

    public function allChannels() : Collection
    {
        return $this->channels->map(function ($channel, $key) {
            $channel['link'] = get_field('social_media_' . $key, 'option');
            return $channel;
        });
    }
    
    public function channels() : Collection
    {
        return $this->allChannels()
            ->filter(function ($channel) {
                return $channel['link'];
            });
    }
}
