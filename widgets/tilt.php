<?php

namespace DesignsivuElementor\Widgets;

use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Image;

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
class Tilt extends Widget_Image
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
        return 'tilt';
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
        return __('DS Tilt Image', 'designsivu-elementor');
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
        $uid = 'tilt_' . uniqid();
        $settings = $this->get_settings_for_display();
        if (empty($settings['image']['url'])) {
            return;
        }
        $has_caption = $this->has_caption($settings);
        //$this->add_render_attribute( 'wrapper', 'class', 'elementor-image' );
        $this->add_render_attribute(
            'wrapper',
            [
                'id' => $uid,
                'class' => ['elementor-image', 'tilt-image'],
                'style' => 'display: inline-block;'
            ]
        );

        if (!empty($settings['shape'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-image-shape-' . $settings['shape']);
        }
        $link = $this->get_link_url($settings);
        if ($link) {
            $this->add_render_attribute('link', [
                'href' => $link['url'],
                'data-elementor-open-lightbox' => $settings['open_lightbox'],
            ]);
            if (Plugin::$instance->editor->is_edit_mode()) {
                $this->add_render_attribute('link', [
                    'class' => 'elementor-clickable',
                ]);
            }
            if (!empty($link['is_external'])) {
                $this->add_render_attribute('link', 'target', '_blank');
            }
            if (!empty($link['nofollow'])) {
                $this->add_render_attribute('link', 'rel', 'nofollow');
            }
        } ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php if ($has_caption) : ?>
            <figure class="wp-caption">
                <?php endif; ?>
                <?php if ($link) : ?>
                <a <?php echo $this->get_render_attribute_string('link'); ?>>
                    <?php endif; ?>
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings); ?>
                    <?php if ($link) : ?>
                </a>
            <?php endif; ?>
                <?php if ($has_caption) : ?>
                    <figcaption
                            class="widget-image-caption wp-caption-text"><?php echo $this->get_caption($settings); ?></figcaption>
                <?php endif; ?>
                <?php if ($has_caption) : ?>
            </figure>
        <?php endif; ?>
        </div>
        <script>
            jQuery('#<?php echo($uid); ?>').tilt({
                maxTilt: 12,
                speed: 100
            })
        </script>
        <?php
    }

    /**
     * Check if the current widget has caption
     *
     * @access private
     * @since 2.3.0
     *
     * @param array $settings
     *
     * @return boolean
     */
    private function has_caption($settings)
    {
        return (!empty($settings['caption_source']) && 'none' !== $settings['caption_source']);
    }

    /**
     * Get the caption for current widget.
     *
     * @access private
     * @since 2.3.0
     *
     * @param $settings
     *
     * @return string
     */
    private function get_caption($settings)
    {
        $caption = '';
        if (!empty($settings['caption_source'])) {
            switch ($settings['caption_source']) {
                case 'attachment':
                    $caption = wp_get_attachment_caption($settings['image']['id']);
                    break;
                case 'custom':
                    $caption = !empty($settings['caption']) ? $settings['caption'] : '';
            }
        }

        return $caption;
    }

    /**
     * Render image widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template()
    {

    }

    /**
     * Retrieve image widget link URL.
     *
     * @since 1.0.0
     * @access private
     *
     * @param array $settings
     *
     * @return array|string|false An array/string containing the link URL, or false if no link.
     */
    private function get_link_url($settings)
    {
        if ('none' === $settings['link_to']) {
            return false;
        }
        if ('custom' === $settings['link_to']) {
            if (empty($settings['link']['url'])) {
                return false;
            }

            return $settings['link'];
        }

        return [
            'url' => $settings['image']['url'],
        ];
    }
}
