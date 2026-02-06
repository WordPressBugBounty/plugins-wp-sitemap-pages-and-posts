<?php
/**
 * Plugin Name:       WP Sitemap Pages and Posts
 * Plugin URI:        http://shuvo.work/wp-stemap
 * Description:       This will automatically generate a sitemap of all your pages and posts shortcode [wpspap_sitemap]
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shuvo Islam
 * Author URI:        http://shuvo.work/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-sitemap
 * Domain Path:       /languages
 */

// SECURITY : Exit if accessed directly
if ( !defined('ABSPATH') ) {
	exit;
}


function wpspap_page_list_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '-1',
        'type' => 'page',
    ), $atts) );
     
    $q = new WP_Query(
        array(

        	'posts_per_page' => $count, 
        	'post_type' => $type, 
        )
        );      
         
    $list = '<ul>';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $post_content = get_the_content();
        $list .= '
        	<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>
        ';        
    endwhile;
    $list.= '</ul>';
    wp_reset_query();
    return $list;
}
add_shortcode('wpspap_sitemap', 'wpspap_page_list_shortcode');  