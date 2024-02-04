<?php

namespace RT\NewsFit\Setup;

use RT\NewsFit\Helpers\Constants;
use RT\NewsFit\Traits\SingletonTraits;

/**
 * Enqueue.
 */
class Enqueue {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct() {
//		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ], 12 );
//		if ( did_action( 'elementor/loaded' ) ) {
//			add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
//		}
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 15 );
	}


	/**
	 * Enqueue all necessary scripts and styles for the theme
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		// CSS
		wp_enqueue_style( 'newsfit-main', newsfit_get_css( 'style', true ), [], Constants::get_version() );
		// JS
		wp_register_script( 'slick', newsfit_get_file( '/assets/vendor/slick.min.js' ), [ 'jquery' ], Constants::get_version(), true );
		
		wp_enqueue_script( 'newsfit-main', newsfit_get_js( 'scripts' ), [ 'jquery' ], Constants::get_version(), true );

		// Extra
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

}
