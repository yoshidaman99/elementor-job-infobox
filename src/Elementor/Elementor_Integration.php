<?php

namespace Yosh_Tools\Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Integration
{
    public function register_widgets($widgets_manager): void
    {
        require_once YT_DIR . 'src/Elementor/Widgets/Pricing_Card_Widget.php';

        $widgets_manager->register(new Widgets\Pricing_Card_Widget());
    }

    public static function register_styles(): void
    {
        wp_register_style(
            'yt-pricing-card',
            YT_URL . 'assets/css/pricing-card.css',
            [],
            YT_VERSION
        );
    }

    public static function register_scripts(): void
    {
        wp_register_script(
            'yt-pricing-card',
            YT_URL . 'assets/js/pricing-card.js',
            ['elementor-frontend'],
            YT_VERSION,
            true
        );
    }
}
