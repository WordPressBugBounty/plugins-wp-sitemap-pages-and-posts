<?php
/**
 * Plugin Name:       WP Sitemap Pages and Posts
 * Plugin URI:        http://shuvo.work/wp-stemap
 * Description:       Automatically generate a human-readable sitemap of your pages and posts using the shortcode [wpspap_sitemap]
 * Version:           1.2.0
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * Author:            Shuvo Islam
 * Author URI:        http://shuvo.work/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-sitemap
 * Domain Path:       /languages
 */

// SECURITY: Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render the [wpspap_sitemap] shortcode.
 *
 * Supported attributes:
 *   count   - number of items to show. Default -1 (all).
 *   type    - one or more public post types, comma separated. Default "page".
 *   orderby - WP_Query orderby value. Default "title".
 *   order   - ASC or DESC. Default "ASC".
 *   exclude - comma separated list of post IDs to leave out.
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML markup for the sitemap list.
 */
function wpspap_page_list_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'count'   => -1,
			'type'    => 'page',
			'orderby' => 'title',
			'order'   => 'ASC',
			'exclude' => '',
		),
		$atts,
		'wpspap_sitemap'
	);

	// Sanitize post types: allow a comma separated list, only public, registered types.
	$requested_types = array_map( 'trim', explode( ',', $atts['type'] ) );
	$post_types      = array();
	foreach ( $requested_types as $requested_type ) {
		$requested_type = sanitize_key( $requested_type );
		if ( post_type_exists( $requested_type ) && is_post_type_viewable( $requested_type ) ) {
			$post_types[] = $requested_type;
		}
	}
	if ( empty( $post_types ) ) {
		$post_types = array( 'page' );
	}

	// Sanitize the remaining attributes.
	$count   = intval( $atts['count'] );
	$orderby = sanitize_key( $atts['orderby'] );
	$order   = strtoupper( $atts['order'] ) === 'DESC' ? 'DESC' : 'ASC';
	$exclude = array_filter( array_map( 'intval', explode( ',', $atts['exclude'] ) ) );

	$query_args = array(
		'posts_per_page' => $count,
		'post_type'      => $post_types,
		'post_status'    => 'publish',
		'orderby'        => $orderby,
		'order'          => $order,
		'no_found_rows'  => true,
	);

	if ( ! empty( $exclude ) ) {
		$query_args['post__not_in'] = $exclude;
	}

	$q = new WP_Query( $query_args );

	if ( ! $q->have_posts() ) {
		return '';
	}

	$list = '<ul class="wpspap-sitemap">';
	while ( $q->have_posts() ) {
		$q->the_post();
		$list .= sprintf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( get_permalink() ),
			esc_html( get_the_title() )
		);
	}
	$list .= '</ul>';

	wp_reset_postdata();

	return $list;
}
add_shortcode( 'wpspap_sitemap', 'wpspap_page_list_shortcode' );  