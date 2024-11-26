<?php
class Event_Manager {
    public static function register_post_type() {
        register_post_type('event', [
            'labels' => [
                'name' => __('Eventos'),
                'singular_name' => __('Evento'),
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'rewrite' => ['slug' => 'eventos'],
        ]);
    }

    public static function init() {
        add_action('init', [__CLASS__, 'register_post_type']);
    }
}
Event_Manager::init();
