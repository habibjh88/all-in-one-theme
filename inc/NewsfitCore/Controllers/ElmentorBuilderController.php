<?php
/**
 * Elmentor Header Footer Builder Controller
 *
 * @package newsfit-core
 */

namespace RT\NewsFit\NewsFitCore\Controllers;

use RT\NewsFit\NewsFitCore\Traits\SingletonTraits;
use RT\NewsFit\NewsFitCore\Builder\Builder;

class ElmentorBuilderController {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'header_footer_posttype' ] );
	}


	/**
	 * Register Post type for Elementor Header & Footer Builder templates
	 */
	public function header_footer_posttype() {
		$labels = [
			'name'               => __( 'Header & Footer Builder', 'newsfit-core' ),
			'singular_name'      => __( 'Header & Footer Builder', 'newsfit-core' ),
			'menu_name'          => __( 'Header & Footer Builder', 'newsfit-core' ),
			'name_admin_bar'     => __( 'Header & Footer Builder', 'newsfit-core' ),
			'add_new'            => __( 'Add New', 'newsfit-core' ),
			'add_new_item'       => __( 'Add New Header or Footer', 'newsfit-core' ),
			'new_item'           => __( 'New Template', 'newsfit-core' ),
			'edit_item'          => __( 'Edit Template', 'newsfit-core' ),
			'view_item'          => __( 'View Template', 'newsfit-core' ),
			'all_items'          => __( 'All Templates', 'newsfit-core' ),
			'search_items'       => __( 'Search Templates', 'newsfit-core' ),
			'parent_item_colon'  => __( 'Parent Templates:', 'newsfit-core' ),
			'not_found'          => __( 'No Templates found.', 'newsfit-core' ),
			'not_found_in_trash' => __( 'No Templates found in Trash.', 'newsfit-core' ),
		];

		$args = [
			'labels'              => $labels,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-open-folder',
			'supports'            => [ 'title', 'thumbnail', 'elementor' ],
		];

		register_post_type( 'elementor-newsfit', $args );

	}


}
