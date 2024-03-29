<?php
/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `config/custom/custom.php` to write your custom functions
 *
 * @package newsfit
 */

namespace RT\NewsFit;

use RT\NewsFit\Traits\SingletonTraits;

final class Init {

	use SingletonTraits;

	/**
	 * Class constructor
	 */
	public function __construct() {
		$this->register();
//		add_action( 'setup_theme', [$this, 'setup_theme'] );
	}

	/**
	 * Instantiate all class
	 * @return void
	 */
	public function register() {
		Helpers\Constants::instance();
		Core\Tags::instance();
		Core\Sidebar::instance();
		Options\Opt::instance();
		Options\Layouts::instance();
		Setup\Setup::instance();
		Setup\Menus::instance();
		Setup\Enqueue::instance();
		Custom\Hooks::instance();
		Custom\PostTypes::instance();
		Custom\Extras::instance();
		Custom\DynamicStyles::instance();
		Api\Customizer::instance();
		Api\Gutenberg::instance();
		Plugins\ThemeJetpack::instance();

		//Core Init
		NewsFitCore\CoreInit::instance();
		NewsFitCore\Customize\Customize::instance();
	}

	public function setup_theme(){
		//Customize
		NewsFitCore\Customize\Customize::instance();
//		NewsFitCore\Customize\FieldManager::instance();
	}

}
