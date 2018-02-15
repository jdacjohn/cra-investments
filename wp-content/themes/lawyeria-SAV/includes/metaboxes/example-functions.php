<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'ti_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['testimonials_details_metabox'] = array(
		'id'         => 'testimonials_details',
		'title'      => __( 'Testimonials - Details', 'ti' ),
		'pages'      => array( 'testimonials', ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Position', 'ti' ),
				'desc' => __( 'Description.', 'ti' ),
				'id'   => $prefix . 'testimonials_position',
				'type' => 'text_medium',
			),
			array(
				'name' => __( 'Company Name', 'ti' ),
				'desc' => __( 'Description.', 'ti' ),
				'id'   => $prefix . 'testimonials_company_name',
				'type' => 'text_medium',
			),
			array(
				'name' => __( 'Company URL', 'ti' ),
				'desc' => __( 'Description.', 'ti' ),
				'id'   => $prefix . 'testimonials_company_url',
				'type' => 'text_medium',
			),
		),
	);

	$meta_boxes['lawyers_options_metabox'] = array(
		'id'         => 'lawyers_options',
		'title'      => __( 'Testimonials - Settings', 'ti' ),
		'pages'      => array( 'page', ),
		'show_on'    => array( 'key' => 'page-template', 'value' => 'page-lawyers.php'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' => __( 'Title', 'ti' ),
				'desc' => __( 'Description.', 'ti' ),
				'id'   => $prefix . 'lawyers_options',
				'type' => 'text',
				'std'  => 'Lorem Ipsum is simply dummy text of the printing and type setting industry.'
			),
		),
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
