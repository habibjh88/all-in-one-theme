<?php

namespace RT\NewsFit\NewsFitCore\Controllers;

use RT\NewsFit\NewsFitCore\Traits\SingletonTraits;

/**
 * Enqueue.
 */
class ScriptController {
	use SingletonTraits;

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	/**
	 * Enqueue Scripts
	 * @return void
	 */
	public function enqueue_scripts() {

	}


}
