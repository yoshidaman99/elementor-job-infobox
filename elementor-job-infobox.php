<?php
/**
 * Plugin Name: Yosh Tools
 * Plugin URI: https://yosh.tools/yosh-tools
 * Description: A collection of custom Elementor widgets by Yosh. Includes Pricing Card with hourly/monthly toggle.
 * Version: 1.0.4
 * Author: Jerel Yoshida
 * Author URI: https://yosh.tools
 * Text Domain: yosh-tools
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

define('YT_VERSION', '1.0.4');
define('YT_FILE', __FILE__);
define('YT_DIR', plugin_dir_path(__FILE__));
define('YT_URL', plugin_dir_url(__FILE__));
define('YT_BASENAME', plugin_basename(__FILE__));

spl_autoload_register('yt_autoloader');

function yt_autoloader($class)
{
    $prefix = 'Yosh_Tools\\';
    $base_dir = YT_DIR . 'src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
}

function yosh_tools()
{
    return \Yosh_Tools\Core\Plugin::get_instance();
}

add_action('plugins_loaded', 'yosh_tools', 5);
