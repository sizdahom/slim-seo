<?php
/**
 * Plugin Name: Slim SEO
 * Plugin URI:  https://elightup.com/products/slim-seo/
 * Description: A fast and automated SEO plugin for WordPress.
 * Author:      eLightUp
 * Author URI:  https://elightup.com
 * Version:     1.5.1
 * Text Domain: slim-seo
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) || die;

define( 'SLIM_SEO_DIR', plugin_dir_path( __FILE__ ) );
define( 'SLIM_SEO_URL', plugin_dir_url( __FILE__ ) );

require __DIR__ . '/vendor/autoload.php';

$slim_seo_title = new SlimSEO\MetaTags\Title();
$slim_seo_description = new SlimSEO\MetaTags\Description();
new SlimSEO\MetaTags\OpenGraph( $slim_seo_title, $slim_seo_description );
new SlimSEO\MetaTags\Twitter();
new SlimSEO\Sitemaps\Manager();
new SlimSEO\ImagesAlt();
$slim_seo_breadcrumbs = new SlimSEO\Breadcrumbs();
if ( is_admin() ) {
	new SlimSEO\Notification();
} else {
    new SlimSEO\AutoRedirection();
	new SlimSEO\Feed();
	new SlimSEO\MetaTags\Robots();
	new SlimSEO\Cleaner();

	new SlimSEO\Schema\Manager();
	( new SlimSEO\Schema\Website() )->register();
	( new SlimSEO\Schema\WebPage( $slim_seo_title, $slim_seo_description ) )->register();
	( new SlimSEO\Schema\Breadcrumbs( $slim_seo_breadcrumbs ) )->register();
}

new SlimSEO\Activator( __FILE__ );
new SlimSEO\Deactivator( __FILE__ );

load_plugin_textdomain( 'slim-seo', false, basename( __DIR__ ) . '/languages/' );
