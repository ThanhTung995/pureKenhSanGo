<?php
/*
 * Plugin Name: Pure KenhSanGo
 * Plugin URI: http://thietkeweb.vietmoz.com/
 * Author: Vietmoz
 * Author URI: http://thietkeweb.vietmoz.com/vietmoz
 * Description: Plugin Pure KenhSanGo custom for kenhsango.com
 * Version: 1.0.13
 * Text Domain: pure
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class KenhSanGo{
    private static $instance;

    public static function getInstance(){
        if (!isset(self::$instance) && !(self::$instance instanceof KenhSanGo)) {
            self::$instance = new KenhSanGo();
            self::$instance->setup();
            self::$instance->service();
            self::$instance->EnqueueScript();
            self::$instance->Update();
        }

        return self::$instance;
    }

    public function setup(){
        if (!defined('DIR')) {
            define('DIR', plugin_dir_path(__FILE__));
        }

        if (!defined('URL')) {
            define('URL', plugin_dir_url(__FILE__));
        }
    }

    public function Update(){
        include_once DIR . 'includes/update.php';
        define( 'WP_GITHUB_FORCE_UPDATE', true );
        if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
            $config = array(
                'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
                'proper_folder_name' => 'pureKenhSanGo', // this is the name of the folder your plugin lives in
                'api_url' => 'https://api.github.com/repos/ThanhTung995/pureKenhSanGo', // the GitHub API url of your GitHub repo
                'raw_url' => 'https://raw.github.com/ThanhTung995/pureKenhSanGo/master', // the GitHub raw url of your GitHub repo
                'github_url' => 'https://github.com/ThanhTung995/pureKenhSanGo', // the GitHub url of your GitHub repo
                'zip_url' => 'https://github.com/ThanhTung995/pureKenhSanGo/archive/master.zip', // the zip url of the GitHub repo
                'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
                'requires' => '1.0', // which version of WordPress does your plugin require?
                'tested' => '1.0', // which version of WordPress is your plugin tested up to?
                'readme' => 'README.md', // which file to use as the readme for the version number
                'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
            );
            new WP_GitHub_Updater($config);
        }
    }

    public function EnqueueScript(){
        /**
         * Never worry about cache again!
         */
        function pure_load_scripts($hook) {

            // create my own version codes
            $pure_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'assets/js/js.js' ));
            $pure_css_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'assets/css/css.css' ));

            //
            wp_enqueue_script( 'pure_js', plugins_url( 'assets/js/js.js', __FILE__ ), array(), $pure_js_ver );
            wp_register_style( 'pure_css',    plugins_url( 'assets/css/css.css',    __FILE__ ), false,   $pure_css_ver );
            wp_enqueue_style ( 'pure_css' );

        }
        add_action('wp_enqueue_scripts', 'pure_load_scripts',100);
    }


    public function service(){
        include_once DIR . "includes/woocommerce/custom-tab.php";
        include_once DIR . "includes/woocommerce/button.php";
    }

}

function getKenhSanGo(){
    return KenhSanGo::getInstance();
}

getKenhSanGo();









