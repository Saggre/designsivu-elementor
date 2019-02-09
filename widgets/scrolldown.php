<?php

namespace DesignsivuElementor\Widgets;

use Elementor\Controls_Manager;
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
class Scrolldown extends Widget_Base
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
        return 'sidekick';
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
        return __('DS Sidekick', 'designsivu-elementor');
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
            'background_color',
            [
                'label' => __('Background Color', 'designsivu-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0)',
                'selectors' => [
                    '{{WRAPPER}} .designsivu-elementor-vertical-menu' => 'background: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3c3c3c',
                'selectors' => [
                    '{{WRAPPER}} .designsivu-elementor-vertical-menu-item' => 'color: {{VALUE}} !important'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Typography', 'plugin-domain'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .designsivu-elementor-vertical-menu',
            ]
        );

        $this->add_control(
            'element_spacing',
            [
                'label' => __('Spacing', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 10,
                'selectors' => [
                    '{{WRAPPER}} .designsivu-elementor-vertical-menu-spacing' => 'height: {{VALUE}}px'
                ],
            ]
        );

        $this->add_control(
            'position_horizontal',
            [
                'label' => __('Horizontal Alignment', 'plugin-domain'),
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

        $this->add_control(
            'position_vertical',
            [
                'label' => __('Vertical Alignment', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'plugin-domain'),
                        'icon' => 'fa fa-hand-o-up',
                    ],
                    'middle' => [
                        'title' => __('Middle', 'plugin-domain'),
                        'icon' => 'fa fa-hand-lizard-o',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'plugin-domain'),
                        'icon' => 'fa fa-hand-o-down',
                    ],
                ],
                'default' => 'middle',
                'toggle' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => __('Title', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('List Title', 'plugin-domain'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_link',
            [
                'label' => __('Link', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'plugin-domain'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'label' => __('Icon', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-angle-left',
            ]
        );

        $this->add_control(
            'sidekick_list',
            [
                'label' => __('Repeater List', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => __('Scroll Down', 'plugin-domain')
                    ]
                ],
                'title_field' => '{{{ list_title }}}'
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
        $position_class = 'designsivu-elementor-vertical-menu-middle-left';

        if ($settings['position_vertical'] && $settings['position_horizontal']) {
            if ($settings['position_horizontal'] === 'left') {
                // left
                switch ($settings['position_vertical']) {
                    case 'top':
                        $position_class = 'designsivu-elementor-vertical-menu-top-left';
                        break;
                    case 'middle':
                        $position_class = 'designsivu-elementor-vertical-menu-middle-left';
                        break;
                    case 'bottom':
                        $position_class = 'designsivu-elementor-vertical-menu-bottom-left';
                        break;
                }
            } else {
                // right
                switch ($settings['position_vertical']) {
                    case 'top':
                        $position_class = 'designsivu-elementor-vertical-menu-top-right';
                        break;
                    case 'middle':
                        $position_class = 'designsivu-elementor-vertical-menu-middle-right';
                        break;
                    case 'bottom':
                        $position_class = 'designsivu-elementor-vertical-menu-bottom-right';
                        break;
                }
            }
        }

        ?>
        <div class="designsivu-elementor-vertical-menu-container">
            <div class="designsivu-elementor-vertical-menu <?php echo $position_class ?>">
                <?php
                if ($settings['sidekick_list']) {
                    $index = 1;
                    foreach ($settings['sidekick_list'] as $item) {
                        $target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';
                        ?>
                        <a <?php echo($item['list_link']['url'] ? 'href="' . $item['list_link']['url'] . '"' : ''); ?>
                                class="designsivu-elementor-vertical-menu-item">
                            <?php echo $item['list_title'] ?>
                            <i class="<?php echo $item['list_icon'] ?>" aria-hidden="true"></i>
                        </a>
                        <?php if ($index !== count($settings['sidekick_list'])) { ?>
                            <div class="designsivu-elementor-vertical-menu-spacing">
                        <?php } ?>
                        </div>
                        <?php
                        $index++;
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }

}
