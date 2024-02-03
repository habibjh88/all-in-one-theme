<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFit\NewsFitCore\Controllers;

use Elementor\Plugin;
use RT\NewsFit\Helpers\Constants;
use RT\NewsFit\NewsFitCore\Helper\Fns;
use RT\NewsFit\NewsFitCore\Traits\SingletonTraits;
use RT\NewsFit\NewsFitCore\Elementor\Core\ElementorCore;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\ImageBox;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\Button;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\ContactForm;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\ImagePlaceholder;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\InfoBox;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\Parallax;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\Post;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\PricingTable;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\ProgressBar;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\Slider;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\Team;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\Testimonial;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\Title;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\TitleAnimated;
use RT\NewsFit\NewsFitCore\Elementor\Widgets\VideoIcon;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class ElementorController {
	use SingletonTraits;

	public function __construct() {
		ElementorCore::instance();
		add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
		//add_action( 'elementor/icons_manager/additional_tabs', [ $this, 'flaticon_support' ] );
		//add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		//add_action( "elementor/frontend/after_enqueue_scripts", [ $this, 'rt_load_scripts' ] );
	}

	/**
	 * Register Elementor Widget.
	 * Just put the widget class reference here
	 * @return void
	 */
	public function register_widget() {

		$widgets = [
			Button::class,
			ImageBox::class,
			ContactForm::class,
			ImagePlaceholder::class,
			InfoBox::class,
			Parallax::class,
			Post::class,
			PricingTable::class,
			ProgressBar::class,
			Slider::class,
			Team::class,
			Testimonial::class,
			Title::class,
			TitleAnimated::class,
			VideoIcon::class,
		];

		foreach ( $widgets as $class ) {
			Plugin::instance()->widgets_manager->register( new $class );
		}
	}

	/**
	 * Elementor Editor Style
	 * @return void
	 */
	public function editor_style(): void {
		$icon         = newsfit_get_img( 'icon.png' );
		$editor_style = '.elementor-element .icon .rdtheme-el-custom{content: url(' . $icon . ');width: 28px;}';
		$editor_style .= '.elementor-panel .select2-container {min-width: 100px !important; min-height: 30px !important;}';
		$editor_style .= '.elementor-panel .elementor-control-type-heading .elementor-control-title {color: #93013d !important}';

		wp_add_inline_style( 'elementor-editor', $editor_style );
	}

	/**
	 * Register Elementor category
	 *
	 * @param $elements_manager
	 *
	 * @return void
	 */
	public function widget_category( $elements_manager ) {
		$id                = 'newsfit-widgets';
		$categories[ $id ] = [
			'title' => __( 'RadiusTheme Elements', 'newsfit-core' ),
			'icon'  => 'fa fa-plug',
		];

		$get_all_categories = $elements_manager->get_categories();
		$categories         = array_merge( $categories, $get_all_categories );
		$set_categories     = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );
	}

	//load editor script
	public function editor_scripts() {
		wp_enqueue_script( 'select2' );
		wp_enqueue_script( 'rt-el-editor-script', newsfit_get_js('/elementor/assets/el_editor.js'), [ 'jquery' ], Constants::get_version(), true );
	}

	//load frontend script
	public function rt_load_scripts() {
		//wp_enqueue_script( 'imagesloaded' );
		//wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'select2' );
		wp_enqueue_script( 'elementor-script', newsfit_get_js('elementor/assets/scripts.js'), [ 'jquery' ], Constants::get_version(), true );
	}


	/**
	 * Adding custom icon to icon control in Elementor
	 */
	public function flaticon_support( $tabs = [] ) {
		// Append new icons
		$flat_icons = newsfit_flaticon_icons();

		$tabs['newsfit-flaticon-icons'] = [
			'name'          => 'newsfit-flaticon-icons',
			'label'         => esc_html__( 'Flat Icons', 'newsfit-core' ),
			'labelIcon'     => 'fab fa-elementor',
			'prefix'        => '',
			'displayPrefix' => '',
			'url'           => newsfit_get_css( 'flaticon' ),
			'icons'         => $flat_icons,
			'ver'           => '1.0',
		];

		return $tabs;
	}

}
