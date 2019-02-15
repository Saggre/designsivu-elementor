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
class Blob extends Widget_Base
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
        return 'blob';
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
        return __('DS Anime Blob', 'designsivu-elementor');
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

        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'style_color_tab',
            [
                'label' => __('Color', 'plugin-name'),
            ]
        );

        $this->add_control(
            'color_start',
            [
                'label' => __('Foreground Color Start', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff0000',
            ]
        );

        $this->add_control(
            'color_end',
            [
                'label' => __('Foreground Color End', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e8aa30',
            ]
        );

        $this->add_control(
            'color_opacity',
            [
                'label' => __('Opacity', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_image_tab',
            [
                'label' => __('Image', 'plugin-name'),
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => __('Choose Image', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'blob_style',
            [
                'label' => __('Blob Style', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '0',
                'options' => [
                    '0' => __('1', 'plugin-domain'),
                    '1' => __('2', 'plugin-domain'),
                    '2' => __('3', 'plugin-domain'),
                    '3' => __('4', 'plugin-domain'),
                    '4' => __('5', 'plugin-domain'),
                    '5' => __('6', 'plugin-domain'),
                    '6' => __('7', 'plugin-domain'),
                ],
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

        $paths = [
            [
                "M 189,80.37 C 232.6,46.67 352.5,67.06 350.9,124.1 349.5,173.4 311.7,168 312.4,248.1 312.9,301.1 382.5,319.2 368.5,379.1 349.4,460.6 137.7,467.5 117.6,386.3 98.68,309.7 171.5,292.2 183.6,240.1 195.7,188.2 123.8,130.7 189,80.37 Z",
                "M 189,80.37 C 243,66.12 307.3,87.28 350.9,124.1 389.3,156.6 417,211.2 418.1,263.4 419.1,305.7 401.8,355.6 368.5,379.1 298.8,428 179.2,446.4 117.6,386.3 65.4,335.3 78.55,230.3 105.5,160.5 119.7,123.6 152.6,89.85 189,80.37 Z"
            ],
            [
                "M 418.1,159.8 C 460.9,222.9 497,321.5 452.4,383.4 417.2,432.4 371.2,405.6 271.3,420.3 137.2,440 90.45,500.6 42.16,442.8 -9.572,381 86.33,289.1 117.7,215.5 144.3,153.4 145.7,54.21 212.7,36.25 290.3,15.36 373.9,94.6 418.1,159.8 Z",
                "M 378.1,121.2 C 408.4,150 417.2,197.9 411,245.8 404.8,293.7 383.5,341.7 353.4,370.7 303.2,419.1 198.7,427.7 144.5,383.8 86.18,336.5 67.13,221.3 111.9,161 138.6,125 188.9,99.62 240.7,90.92 292.4,82.24 345.6,90.32 378.1,121.2 Z"
            ],
            [
                "M 193.7,217.3 C 236.4,228.3 279.7,242.7 320.9,231.8 362.6,220.9 446.8,197.1 457.6,241.5 469.3,289.8 378.7,308.3 330.2,319.2 278.5,330.8 222.3,319.2 172.1,302.2 125.2,286.4 33.08,273.2 45.14,225.2 57.22,177.1 145.7,204.8 193.7,217.3 Z",
                "M 184,127.4 C 235.4,92.39 319.7,79.27 359.9,132.2 383.2,163 357.1,216.6 355.8,258.8 354.8,291.2 371.3,332.9 352.9,356 306.1,414.4 205.1,419.3 153.7,367.2 123.8,336.8 128.6,272.1 136.1,225.2 142.1,187.8 157,145.7 184,127.4 Z"
            ],
            [
                "M 402.7,215.5 C 433.9,280.4 488.1,367.2 447.7,426.8 410.1,482.2 316.7,460.2 249.7,460.6 182.8,461.1 88.08,485.5 51.26,429.5 10.29,367.3 73.19,279.4 106.9,213 141.8,144 176.6,33.65 253.9,33.7 332.2,33.75 368.8,144.9 402.7,215.5 Z",
                "M 440.9,118.5 C 486.5,189.8 499,297.9 458.3,371.8 422.2,437.2 335.8,475.1 261.5,477.3 181.4,479.6 83.9,445.4 43.22,376.1 -0.2483,302.1 13.51,189.9 61.98,119.1 104.5,56.88 190.6,20.5 265.7,22.71 332.2,24.67 405,62.28 440.9,118.5 Z"
            ],
            [
                "M 368.1,46.42 C 461,96.69 473.7,266.2 422.3,358.4 379.1,436 259.6,484.8 175,457.5 107.5,435.7 12.65,329.8 60.93,277.7 95.18,240.8 154,379.3 194.2,348.9 250.7,306 116,204.1 148.4,140.9 184.8,70.02 298,8.455 368.1,46.42 Z",
                "M 451.5,185.8 C 441.5,266.2 339.6,305 272.3,350.2 207.7,393.6 226.7,444.7 182.6,447.9 132.8,451.4 83.97,399.9 66.37,353.1 34.6,268.4 41.16,141.8 112,85.44 186.1,26.33 313.8,54.1 396,101.4 425.2,118.2 455.6,152.4 451.5,185.8 Z"
            ],
            [
                "M 274.4,32.13 C 328.5,36.28 249,139.7 287.7,192.8 326.3,245.9 483.3,248.4 459,295 434.9,341.2 341.4,267.6 298,297.5 247.4,332.3 296,461.4 233.9,467.8 177.2,473.8 214.2,326.3 176,268.3 137.8,210.5 24.39,242.4 39.89,189.3 54.21,140.1 142,158.9 184.6,129.2 221.1,103.9 229.3,28.68 274.4,32.13 Z",
                "M 279.8,41.26 C 332.2,40.04 397.1,40.63 432.5,79.42 470.9,121.7 455.7,191.8 458.3,249 460.6,300.4 481.9,363.6 448.9,403.1 402.7,458.2 311.1,450.1 239.3,453.9 183.9,456.9 113.3,471.5 74.23,432.1 18.97,376.3 29.82,251.5 45.32,198.4 59.64,149.2 95.01,111.8 134.9,84.73 176.6,56.36 229.4,42.43 279.8,41.26 Z"
            ],
            [
                "M 280.1,34.42 C 465.8,29.89 514.6,354 417.3,392.3 318.9,423.2 332.3,114.7 233.3,143.6 134,172.6 294.3,390.5 212,453.2 174.8,481.6 106.3,459.6 74.54,425.3 21.22,367.7 30.13,244.7 45.63,191.6 59.95,142.4 95.32,105 135.2,77.89 176.9,49.52 229.9,29.96 280.1,34.42 Z",
                "M 251.1,32.08 C 320.8,39.34 403.4,70.51 435.8,132.7 476.2,210.5 460.8,325.2 406.4,394 360.4,452.2 271,467.5 196.8,469.3 144.1,470.5 65.63,471.7 45.51,423 17.77,355.8 140.2,302.9 148.3,230.6 154.4,177.4 80.17,122.4 106.2,75.55 130.7,31.47 200.9,26.86 251.1,32.08 Z"
            ]
        ];

        $settings = $this->get_settings_for_display();
        $uid = 'blob_' . uniqid();

        $morph_path_style = $settings['blob_style'];
        $morph_paths = $paths[0];

        switch ($morph_path_style) {
            case "0":
                $morph_paths = $paths[0];
                break;
            case "1":
                $morph_paths = $paths[1];
                break;
            case "2":
                $morph_paths = $paths[2];
                break;
            case "3":
                $morph_paths = $paths[3];
                break;
            case "4":
                $morph_paths = $paths[4];
                break;
            case "5":
                $morph_paths = $paths[5];
                break;
            case "6":
                $morph_paths = $paths[6];
                break;
            default:
                $morph_paths = $paths[0];
                break;
        }

        ?>
        <div class="blob-container"
             morphed-path="<?php echo($morph_paths[0]); ?>"
             unmorphed-path="<?php echo($morph_paths[1]); ?>"
             style="text-align: <?php echo $settings['text_align'] ?>;">
            <div class="blob-wrapper">
                <div class="item item--style-1">
                    <svg class="item__svg" width="500px" height="500px" viewBox="0 0 500 500" aria-hidden="true">
                        <defs>
                            <linearGradient id="<?php echo($uid . '_gradient'); ?>" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%"
                                      style="stop-color:<?php echo($settings['color_start']); ?>;stop-opacity:1"/>
                                <stop offset="100%"
                                      style="stop-color:<?php echo($settings['color_end']); ?>;stop-opacity:1"/>
                            </linearGradient>
                        </defs>
                        <clipPath id="<?php echo($uid . '_clip'); ?>">
                            <path class="item__clippath"
                                  d="<?php echo($morph_paths[1]); ?>"/>
                        </clipPath>
                        <?php if ($settings['background_image']) { ?>
                            <g clip-path="url(#<?php echo($uid . '_clip'); ?>)">
                                <image class="item__img"
                                       xlink:href="<?php echo($settings['background_image']['url']); ?>"
                                       x="0" y="0"/>
                            </g>
                        <?php } ?>
                        <?php $color_opacity = intval($settings['color_opacity']['size']) / 100.0; ?>
                        <g style="opacity:<?php echo($color_opacity); ?>;"
                           clip-path="url(#<?php echo($uid . '_clip'); ?>)">
                            <rect x="0" y="0" width="500" height="500" fill="url(#<?php echo($uid . '_gradient'); ?>)"/>
                        </g>
                    </svg>
                    <div class="item__meta">
                        <h2 class="item__title">Codium fasciculatus</h2>
                        <h3 class="item__subtitle">Exoplanet Gliese 180 b</h3>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
