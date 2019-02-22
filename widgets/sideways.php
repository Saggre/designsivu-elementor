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
class Sideways extends Widget_Base
{

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
        return 'sideways';
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
        return __('DS Sideways scrolling text', 'designsivu-elementor');
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
            'text',
            [
                'label' => __('Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'The quick brown fox',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3c3c3c',
                'selectors' => [
                    '{{WRAPPER}} .designsivu-elementor-sideways .designsivu-elementor-sideways-text' => 'color: {{VALUE}} !important'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Typography', 'plugin-domain'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .designsivu-elementor-sideways .designsivu-elementor-sideways-text',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => __('Speed', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => __('Scroll Direction', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'plugin-domain'),
                        'icon' => 'fa fa-hand-o-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'plugin-domain'),
                        'icon' => 'fa fa-hand-o-right',
                    ]
                ],
                'default' => 'left',
                'toggle' => true,
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
        <div class="designsivu-elementor-sideways" sideways-speed="<?php echo($settings['speed']['size']); ?>"
             scroll-direction="<?php echo($settings['direction']); ?>">
            <div class="designsivu-elementor-sideways-text">
                <?php
                for ($i = 0; $i < 10; $i++) {
                    echo($settings['text'] . '&nbsp;');
                }
                ?>
            </div>
        </div>
        <?php
    }

}
