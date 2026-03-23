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

    public static function enqueue_editor_scripts(): void
    {
        $script = <<<'JS'
(function() {
    function waitForElementor(callback) {
        if (typeof elementor !== 'undefined' && elementor.channels && elementor.channels.editor) {
            callback();
        } else {
            setTimeout(function() { waitForElementor(callback); }, 50);
        }
    }

    function cleanWidgetDynamicData(widgetModel) {
        if (!widgetModel || widgetModel.get('widgetType') !== 'yt_pricing_card') return;

        var settings = widgetModel.get('settings');
        if (!settings) return;

        var features = settings.get('features_list');
        if (!features || !features.length) return;

        features.each(function(item) {
            var dynamic = item.get('__dynamic__');
            if (dynamic && typeof dynamic === 'object' && dynamic.feature_text !== undefined) {
                delete dynamic.feature_text;

                if (Object.keys(dynamic).length === 0) {
                    item.unset('__dynamic__');
                } else {
                    item.set('__dynamic__', dynamic, {silent: true});
                }

                item.trigger('change');
            }
        });
    }

    waitForElementor(function() {
        elementor.channels.editor.on('panel:open:widget', function(panel) {
            if (panel && panel.model) {
                cleanWidgetDynamicData(panel.model);
            }
        });
    });
})();
JS;

        wp_add_inline_script('elementor-editor', $script, 'after');
    }
}
