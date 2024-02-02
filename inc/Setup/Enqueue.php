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
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 15 );
	}

	/**
	 * Enqueue all necessary scripts and styles for the theme
	 * @return void
	 */
	public function enqueue_scripts() {
		// CSS
		wp_enqueue_style( 'newsfit-main', newsfit_get_css( 'style', true ), [], Constants::get_version() );

		// JS
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'newsfit-main', newsfit_get_js( 'app' ), [ 'jquery' ], Constants::get_version(), true );

		// Extra
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

}
