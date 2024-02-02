<?php
/** Core
 * @package newsfit
 */

namespace RT\NewsFit\NewsFitCore;

use RT\NewsFit\NewsFitCore\Traits\SingletonTraits;

final class CoreInit {

	use SingletonTraits;

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'newsfit_theme_init', [ $this, 'after_theme_loaded' ] );
		add_action( 'plugins_loaded', [ $this, 'load_textdomain' ], 20 );
		add_action( 'plugins_loaded', [ $this, 'demo_importer' ], 17 );
	}

	/**
	 * Instantiate all class
	 * @return void
	 */
	public function after_theme_loaded() {
		Hooks\FilterHooks::instance();
		Hooks\ActionHooks::instance();
		Controllers\ScriptController::instance();
		if ( defined( 'RT_FRAMEWORK_VERSION' ) ) {
			Controllers\PostMetaController::instance();
			Api\WidgetInit::instance();
		}
		if ( did_action( 'elementor/loaded' ) ) {
			Controllers\ElementorController::instance();
			Controllers\ElmentorBuilderController::instance();
		}
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'newsfit-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public function demo_importer() {
		Controllers\DemoImportController::instance();
	}
}
