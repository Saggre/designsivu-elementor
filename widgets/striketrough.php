<?php

namespace DesignsivuElementor\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Striketrough extends Widget_Base
{

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        $this->add_wpml_support();
    }

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'striketrough';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('DS Striketrough', 'designsivu-elementor');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'fa fa-list-ul';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['general'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'designsivu-elementor'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'designsivu-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'The quick brown fox',
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __('Color', 'designsivu-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff0000',
                'selectors' => [
                    '{{WRAPPER}} .dse-striketrough-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .dse-striketrough:after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .dse-striketrough' => 'background-color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'designsivu-elementor'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .dse-striketrough-title',
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => __('Height', 'designsivu-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dse-striketrough-wrapper' => 'height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_control(
            'overextended-height',
            [
                'label' => __('Overextended Height', 'designsivu-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .dse-striketrough' => 'bottom: -{{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="dse-striketrough-title-wrapper">
            <div class="dse-striketrough-title">
                <?php echo($settings['title']); ?>
            </div>
        </div>
        <div class="dse-striketrough-wrapper">
            <div class="dse-striketrough"></div>
        </div>
        <?php
    }

    /**
     * Add WPML translation support
     *
     * @access public
     */
    public function add_wpml_support()
    {
        add_filter('wpml_elementor_widgets_to_translate', [$this, 'wpml_widgets_to_translate_filter']);
    }

    /**
     * Adds the current widget's fields to WPML translatable widgets
     *
     * @access public
     * @return array
     */
    public function wpml_widgets_to_translate_filter($widgets)
    {
        $widgets[$this->get_name()] = [
            'conditions' => ['widgetType' => $this->get_name()],
            'fields' => [
                [
                    'field' => 'title',
                    'type' => __('Text', 'designsivu-elementor'),
                    'editor_type' => 'LINE'
                ],
            ],
        ];

        return $widgets;
    }

}
