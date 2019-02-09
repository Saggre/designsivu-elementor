<?php

namespace DesignsivuElementor\Widgets;

use Elementor\Controls_Manager;
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
class Lottie extends Widget_Base
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
        return 'lottie';
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
        return __('DS Lottie Animation', 'designsivu-elementor');
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
        return 'fa fa-eye';
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
            'json',
            [
                'label' => __('Lottie JSON', 'designsivu-elementor'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'max_height',
            [
                'label' => __('Height', 'designsivu-elementor'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 999999,
                'step' => 1,
                'default' => 256,
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'designsivu-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => __('Alignment', 'designsivu-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'designsivu-elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'designsivu-elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'designsivu-elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
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
        $uid = 'lottie_' . uniqid();

        $max_height = $settings['max_height'];
        ?>
        <div style="text-align: <?php echo $settings['text_align'] ?>;">
            <div style="width: auto; height: <?php echo $max_height ?>px; display: inline-block;"
                 class="designsivu-elementor-item" id="<?php echo $uid ?>">
            </div>
        </div>

        <script>
            var animationData = <?php echo $settings['json']?>;
            lottie.loadAnimation({
                animationData: animationData,
                container: document.getElementById('<?php echo $uid ?>'),
                renderer: 'svg',
                loop: true,
                autoplay: true
            });
        </script>
        <?php
    }

}
