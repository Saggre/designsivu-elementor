<?php

namespace DesignsivuElementor;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin
{

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('foundation', plugins_url('/widgets/assets/js/foundation.min.js', __FILE__), '', '1.0.0', true);
        wp_enqueue_script('lottie', plugins_url('/widgets/assets/js/lottie.min.js', __FILE__), ['jquery'], '5.4.3', false);
        wp_enqueue_script('tilt', plugins_url('/widgets/assets/js/tilt.min.js', __FILE__), ['jquery'], '1.2.1', false);
        wp_enqueue_script('anime', plugins_url('/widgets/assets/js/anime.min.js', __FILE__), ['jquery'], '3.0.1', false);
        wp_enqueue_script('dse-app', plugins_url('/widgets/assets/js/app.min.js', __FILE__), ['jquery', 'lottie', 'anime', 'tilt'], '1.0.0', false);
    }

    /**
     *  enqueue styles
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('foundation', plugins_url('/widgets/assets/css/foundation.min.css', __FILE__));
        wp_enqueue_style('dse-app', plugins_url('/widgets/assets/css/app.min.css', __FILE__));
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files()
    {
        require_once(__DIR__ . '/widgets/lottie.php');
        require_once(__DIR__ . '/widgets/tilt.php');
        require_once(__DIR__ . '/widgets/scrolldown.php');
        require_once(__DIR__ . '/widgets/blob.php');
        require_once(__DIR__ . '/widgets/sideways.php');
        require_once(__DIR__ . '/widgets/striketrough.php');
        require_once(__DIR__ . '/widgets/quote.php');
        require_once(__DIR__ . '/widgets/employeeGallery.php');

    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets()
    {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();

        $striketrough = new Widgets\Striketrough();

        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Lottie());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Tilt());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Scrolldown());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Blob());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Sideways());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type($striketrough);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Quote());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\EmployeeGallery());
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct()
    {

        // Register widget scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'enqueue_scripts']);

        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_styles']);

        // Register widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);

        add_action('elementor/element/parse_css', function ($post_css, $element) {
        }, 10, 2);

    }
}

// Instantiate Plugin Class
Plugin::instance();
