<?php

namespace DesignsivuElementor\Widgets;

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
class EmployeeGallery extends Widget_Base
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
        return 'employee_gallery';
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
        return __('DS Employee Image Gallery', 'designsivu-elementor');
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
        return 'fa fa-image';
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => __('Name', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'John Smith',
            ]
        );

        $repeater->add_control(
            'quote',
            [
                'label' => __('Quote', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Live, love, laugh',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Job Title', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'CEO',
            ]
        );

        $repeater->add_control(
            'phone',
            [
                'label' => __('Phone number', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'main_image',
            [
                'label' => __('Employee Image', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'hover_image',
            [
                'label' => __('Employee Hover Image', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'list',
            [
                'label' => __('Employees', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => 'Employee',
            ]
        );

        $this->end_controls_section();
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
     * Render image widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="dse-employees grid-x">
            <?php
            if ($settings['list']) {
                foreach ($settings['list'] as $item) {
                    ?>
                    <div class="dse-employee--cell cell medium-6 large-4">
                        <div class="dse-employee--container grid-x">
                            <div class="dse-employee--images cell">
                                <div class="dse-employee--image-container">
                                    <img class="dse-employee--main-image"
                                         src="<?php echo($item['main_image']['url']); ?>"/>
                                </div>
                                <div class="dse-employee--image-container">
                                    <img class="dse-employee--hover-image"
                                         src="<?php echo($item['hover_image']['url']); ?>"/>
                                </div>
                            </div>
                            <div class="dse-employee--info-container cell">
                                <div class="dse-employee--static-info">
                                    <h4 class="dse-employee--name"><?php echo($item['name']); ?></h4>
                                </div>
                                <div class="dse-employee--hover-wrapper">
                                    <div class="dse-employee--unhover-info">
                                        <div class="dse-employee--quote-wrapper">
                                            <h5 class="dse-employee--quote"><?php echo($item['title']); ?></h5>
                                        </div>
                                    </div>
                                    <div class="dse-employee--hover-info">
                                        <?php if (!empty($item['quote'])) { ?>
                                            <h6 class="dse-employee--title">“<?php echo($item['quote']); ?>“</h6>
                                            <hr class="dse-employee--hr"/>
                                        <?php } ?>
                                        <?php if (!empty($item['phone'])) { ?>
                                            <div class="dse-employee--phone"><?php echo($item['phone']); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="dse-employee--overlay"></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }

}
