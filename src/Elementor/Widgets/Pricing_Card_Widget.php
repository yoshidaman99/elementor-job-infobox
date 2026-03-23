<?php

namespace Yosh_Tools\Elementor\Widgets;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

class Pricing_Card_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'yt_pricing_card';
    }

    public function get_title()
    {
        return __('Pricing Card', 'yosh-tools');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
    }

    public function get_categories()
    {
        return ['yosh-tools'];
    }

    public function get_keywords()
    {
        return ['pricing', 'price', 'card', 'plan', 'toggle', 'hourly', 'monthly', 'yosh', 'tools'];
    }

    public function get_style_depends()
    {
        return ['yt-pricing-card'];
    }

    public function get_script_depends()
    {
        return ['yt-pricing-card'];
    }

    protected function register_controls()
    {
        $this->register_card_info_controls();
        $this->register_pricing_controls();
        $this->register_features_controls();
        $this->register_card_style_controls();
        $this->register_title_style_controls();
        $this->register_description_style_controls();
        $this->register_toggle_style_controls();
        $this->register_price_style_controls();
        $this->register_features_style_controls();
    }

    private function register_card_info_controls(): void
    {
        $this->start_controls_section(
            'card_info_section',
            [
                'label' => __('Card Info', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'card_title',
            [
                'label' => __('Title', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Medical Records Assistant', 'yosh-tools'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'card_description',
            [
                'label' => __('Description', 'yosh-tools'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('HIPAA-compliant management of patient records and documentation.', 'yosh-tools'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'toggle_label_hourly',
            [
                'label' => __('Toggle Label (Hourly)', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Hourly Rate', 'yosh-tools'),
            ]
        );

        $this->add_control(
            'toggle_label_monthly',
            [
                'label' => __('Toggle Label (Monthly)', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Monthly Rate', 'yosh-tools'),
            ]
        );

        $this->add_control(
            'default_toggle_state',
            [
                'label' => __('Default Toggle State', 'yosh-tools'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Hourly', 'yosh-tools'),
                'label_off' => __('Monthly', 'yosh-tools'),
                'return_value' => 'hourly',
                'default' => 'hourly',
            ]
        );

        $this->end_controls_section();
    }

    private function register_pricing_controls(): void
    {
        $this->start_controls_section(
            'pricing_section',
            [
                'label' => __('Pricing', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs('pricing_tabs');

        $this->start_controls_tab(
            'hourly_tab',
            ['label' => __('Hourly', 'yosh-tools')]
        );

        $this->add_control(
            'hourly_currency',
            [
                'label' => __('Currency Symbol', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => '$',
            ]
        );

        $this->add_control(
            'hourly_price',
            [
                'label' => __('Price', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => '10',
            ]
        );

        $this->add_control(
            'hourly_suffix',
            [
                'label' => __('Suffix', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => '/hour',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'monthly_tab',
            ['label' => __('Monthly', 'yosh-tools')]
        );

        $this->add_control(
            'monthly_currency',
            [
                'label' => __('Currency Symbol', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => '$',
            ]
        );

        $this->add_control(
            'monthly_min_price',
            [
                'label' => __('Min Price', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => '1,500',
            ]
        );

        $this->add_control(
            'monthly_max_price',
            [
                'label' => __('Max Price', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => '2,700',
            ]
        );

        $this->add_control(
            'monthly_separator',
            [
                'label' => __('Range Separator', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => ' - ',
            ]
        );

        $this->add_control(
            'monthly_suffix',
            [
                'label' => __('Suffix', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => '/month',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    private function register_features_controls(): void
    {
        $this->start_controls_section(
            'features_section',
            [
                'label' => __('Features', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'feature_text',
            [
                'label' => __('Feature Text', 'yosh-tools'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Feature here', 'yosh-tools'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'label' => __('Features', 'yosh-tools'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['feature_text' => __('160 hours per seat', 'yosh-tools')],
                    ['feature_text' => __('Dedicated success manager', 'yosh-tools')],
                    ['feature_text' => __('24/7 global coverage', 'yosh-tools')],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        $this->end_controls_section();
    }

    private function register_card_style_controls(): void
    {
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => __('Card', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_background_color',
            [
                'label' => __('Background Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .yt-pricing-card',
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => __('Border Radius', 'yosh-tools'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => '12',
                    'right' => '12',
                    'bottom' => '12',
                    'left' => '12',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .yt-pricing-card',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => __('Padding', 'yosh-tools'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '28',
                    'right' => '28',
                    'bottom' => '28',
                    'left' => '28',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'card_hover_transition',
            [
                'label' => __('Hover Transition (s)', 'yosh-tools'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'default' => ['size' => '0.3', 'unit' => 's'],
                'range' => ['s' => ['min' => 0, 'max' => 2, 'step' => 0.1]],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card' => 'transition: transform {{SIZE}}{{UNIT}} ease, box-shadow {{SIZE}}{{UNIT}} ease, border-color {{SIZE}}{{UNIT}} ease, border-width {{SIZE}}{{UNIT}} ease, border-radius {{SIZE}}{{UNIT}} ease',
                ],
            ]
        );

        $this->add_control(
            'card_hover_transform',
            [
                'label' => __('Hover Transform Y', 'yosh-tools'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => '-4', 'unit' => 'px'],
                'range' => ['px' => ['min' => -20, 'max' => 0, 'step' => 1]],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card:hover' => 'transform: translateY({{SIZE}}{{UNIT}})',
                ],
            ]
        );

        $this->add_control(
            'card_hover_box_shadow',
            [
                'label' => __('Hover Box Shadow', 'yosh-tools'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'yosh-tools'),
                'label_off' => __('No', 'yosh-tools'),
                'default' => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card:hover' => 'box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1)',
                ],
            ]
        );

        $this->add_control(
            'card_hover_border_heading',
            [
                'label' => __('Hover Border', 'yosh-tools'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_hover_border_color',
            [
                'label' => __('Hover Border Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'card_hover_border_width',
            [
                'label' => __('Hover Border Width', 'yosh-tools'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => '2',
                    'right' => '2',
                    'bottom' => '2',
                    'left' => '2',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'card_hover_border_radius',
            [
                'label' => __('Hover Border Radius', 'yosh-tools'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => '16',
                    'right' => '16',
                    'bottom' => '16',
                    'left' => '16',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-card:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_title_style_controls(): void
    {
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __('Title', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .yt-pricing-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1a1a2e',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_text_align',
            [
                'label' => __('Alignment', 'yosh-tools'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => __('Left', 'yosh-tools'), 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => __('Center', 'yosh-tools'), 'icon' => 'eicon-text-align-center'],
                    'right' => ['title' => __('Right', 'yosh-tools'), 'icon' => 'eicon-text-align-right'],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-title' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_bottom_spacing',
            [
                'label' => __('Bottom Spacing', 'yosh-tools'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => '4'],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_description_style_controls(): void
    {
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => __('Description', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .yt-pricing-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_bottom_spacing',
            [
                'label' => __('Bottom Spacing', 'yosh-tools'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => '0'],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_toggle_style_controls(): void
    {
        $this->start_controls_section(
            'toggle_style_section',
            [
                'label' => __('Toggle', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_active_color',
            [
                'label' => __('Active Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-toggle-input:checked + .yt-pricing-toggle-track' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'toggle_inactive_color',
            [
                'label' => __('Inactive Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-toggle-track' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'toggle_label_typography',
                'selector' => '{{WRAPPER}} .yt-pricing-toggle-label',
            ]
        );

        $this->add_control(
            'toggle_label_color',
            [
                'label' => __('Label Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-toggle-label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_price_style_controls(): void
    {
        $this->start_controls_section(
            'price_style_section',
            [
                'label' => __('Price', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .yt-price-amount',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('Price Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#dc2626',
                'selectors' => [
                    '{{WRAPPER}} .yt-price-display' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'suffix_color',
            [
                'label' => __('Suffix Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .yt-price-suffix, {{WRAPPER}} .yt-price-separator' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'price_alignment',
            [
                'label' => __('Price Alignment', 'yosh-tools'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => __('Left', 'yosh-tools'), 'icon' => 'eicon-text-align-left'],
                    'center' => ['title' => __('Center', 'yosh-tools'), 'icon' => 'eicon-text-align-center'],
                    'right' => ['title' => __('Right', 'yosh-tools'), 'icon' => 'eicon-text-align-right'],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .yt-price-display' => 'place-self: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_bottom_spacing',
            [
                'label' => __('Bottom Spacing', 'yosh-tools'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => '20'],
                'selectors' => [
                    '{{WRAPPER}} .yt-pricing-price-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function register_features_style_controls(): void
    {
        $this->start_controls_section(
            'features_style_section',
            [
                'label' => __('Features', 'yosh-tools'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'checkmark_color',
            [
                'label' => __('Checkmark Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .yt-feature-check' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_typography',
                'selector' => '{{WRAPPER}} .yt-feature-text',
            ]
        );

        $this->add_control(
            'feature_text_color',
            [
                'label' => __('Text Color', 'yosh-tools'),
                'type' => Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .yt-feature-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_item_spacing',
            [
                'label' => __('Item Spacing', 'yosh-tools'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => '6'],
                'selectors' => [
                    '{{WRAPPER}} .yt-feature-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $is_hourly = $settings['default_toggle_state'] === 'hourly';
        $toggle_id = 'yt-toggle-' . $this->get_id();
        $features = $settings['features_list'];

        echo '<div class="yt-pricing-card" data-default-toggle="' . esc_attr($is_hourly ? 'hourly' : 'monthly') . '">';

        if (!empty($settings['card_title'])) {
            echo '<h3 class="yt-pricing-title">' . esc_html($settings['card_title']) . '</h3>';
        }

        if (!empty($settings['card_description'])) {
            echo '<p class="yt-pricing-description">' . esc_html($settings['card_description']) . '</p>';
        }

        $hourly_label = esc_attr($settings['toggle_label_hourly']);
        $monthly_label = esc_attr($settings['toggle_label_monthly']);
        $visible_label = $is_hourly ? $hourly_label : $monthly_label;

        echo '<div class="yt-pricing-toggle-row">';
        echo '<span class="yt-pricing-toggle-label" data-hourly-label="' . $hourly_label . '" data-monthly-label="' . $monthly_label . '">' . esc_html($visible_label) . '</span>';
        echo '<input type="checkbox" id="' . esc_attr($toggle_id) . '" class="yt-pricing-toggle-input"' . checked($is_hourly, true, false) . '>';
        echo '<label for="' . esc_attr($toggle_id) . '" class="yt-pricing-toggle-track">';
        echo '<span class="yt-pricing-toggle-thumb"></span>';
        echo '</label>';
        echo '</div>';

        echo '<div class="yt-pricing-price-wrap">';

        $hourly_display = $is_hourly ? 'flex' : 'none';
        $monthly_display = $is_hourly ? 'none' : 'flex';

        echo '<div class="yt-price-display yt-price-hourly" style="display:' . $hourly_display . '">';
        echo '<span class="yt-price-currency">' . esc_html($settings['hourly_currency']) . '</span>';
        echo '<span class="yt-price-amount">' . esc_html($settings['hourly_price']) . '</span>';
        echo '<span class="yt-price-suffix">' . esc_html($settings['hourly_suffix']) . '</span>';
        echo '</div>';

        echo '<div class="yt-price-display yt-price-monthly" style="display:' . $monthly_display . '">';
        echo '<span class="yt-price-currency">' . esc_html($settings['monthly_currency']) . '</span>';
        echo '<span class="yt-price-amount">' . esc_html($settings['monthly_min_price']) . '</span>';
        echo '<span class="yt-price-separator">' . esc_html($settings['monthly_separator']) . '</span>';
        echo '<span class="yt-price-currency">' . esc_html($settings['monthly_currency']) . '</span>';
        echo '<span class="yt-price-amount">' . esc_html($settings['monthly_max_price']) . '</span>';
        echo '<span class="yt-price-suffix">' . esc_html($settings['monthly_suffix']) . '</span>';
        echo '</div>';

        echo '</div>';

        if (!empty($features)) {
            echo '<ul class="yt-features-list">';
            foreach ($features as $feature) {
                if (empty($feature['feature_text'])) {
                    continue;
                }
                echo '<li class="yt-feature-item">';
                echo '<span class="yt-feature-check">&#10003;</span>';
                echo '<span class="yt-feature-text">' . esc_html($feature['feature_text']) . '</span>';
                echo '</li>';
            }
            echo '</ul>';
        }

        echo '</div>';
    }

    protected function render_plain_content()
    {
        $this->render();
    }

    protected function content_template()
    {
        ?>
        <#
        var isHourly = settings.default_toggle_state === 'hourly';
        var toggleId = 'yt-toggle-{{{ elementorModel.get( "id" ) }}}';
        var hourlyLabel = settings.toggle_label_hourly;
        var monthlyLabel = settings.toggle_label_monthly;
        var visibleLabel = isHourly ? hourlyLabel : monthlyLabel;

        var hourlyDisplay = isHourly ? 'flex' : 'none';
        var monthlyDisplay = isHourly ? 'none' : 'flex';
        #>
        <div class="yt-pricing-card" data-default-toggle="{{ isHourly ? 'hourly' : 'monthly' }}">

            <# if (settings.card_title) { #>
                <h3 class="yt-pricing-title">{{{ settings.card_title }}}</h3>
            <# } #>

            <# if (settings.card_description) { #>
                <p class="yt-pricing-description">{{{ settings.card_description }}}</p>
            <# } #>

            <div class="yt-pricing-toggle-row">
                <span class="yt-pricing-toggle-label" data-hourly-label="{{ hourlyLabel }}" data-monthly-label="{{ monthlyLabel }}">{{{ visibleLabel }}}</span>
                <input type="checkbox" id="{{ toggleId }}" class="yt-pricing-toggle-input" {{{ isHourly ? 'checked' : '' }}}>
                <label for="{{ toggleId }}" class="yt-pricing-toggle-track">
                    <span class="yt-pricing-toggle-thumb"></span>
                </label>
            </div>

            <div class="yt-pricing-price-wrap">
                <div class="yt-price-display yt-price-hourly" style="display:{{ hourlyDisplay }}">
                    <span class="yt-price-currency">{{{ settings.hourly_currency }}}</span>
                    <span class="yt-price-amount">{{{ settings.hourly_price }}}</span>
                    <span class="yt-price-suffix">{{{ settings.hourly_suffix }}}</span>
                </div>
                <div class="yt-price-display yt-price-monthly" style="display:{{ monthlyDisplay }}">
                    <span class="yt-price-currency">{{{ settings.monthly_currency }}}</span>
                    <span class="yt-price-amount">{{{ settings.monthly_min_price }}}</span>
                    <span class="yt-price-separator">{{{ settings.monthly_separator }}}</span>
                    <span class="yt-price-currency">{{{ settings.monthly_currency }}}</span>
                    <span class="yt-price-amount">{{{ settings.monthly_max_price }}}</span>
                    <span class="yt-price-suffix">{{{ settings.monthly_suffix }}}</span>
                </div>
            </div>

            <# var features = settings.features_list; #>
            <# if (features && features.length) { #>
                <ul class="yt-features-list">
                    <# _.each(features, function(feature) { #>
                        <# if (feature.feature_text) { #>
                            <li class="yt-feature-item">
                                <span class="yt-feature-check">&#10003;</span>
                                <span class="yt-feature-text">{{{ feature.feature_text }}}</span>
                            </li>
                        <# } #>
                    <# }); #>
                </ul>
            <# } #>

        </div>
        <?php
    }
}
