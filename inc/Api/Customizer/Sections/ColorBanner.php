<?php
/**
 * Theme Customizer - Header
 *
 * @package newsfit
 */

namespace RT\NewsFit\Api\Customizer\Sections;

use RT\NewsFit\Api\Customizer;
use RT\NewsFit\NewsFitCore\Customize\Customize;

/**
 * Customizer class
 */
class ColorBanner extends Customizer {

	protected string $section_banner_color = 'newsfit_banner_color_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_banner_color,
			'panel'       => 'rt_color_panel',
			'title'       => __( 'Banner / Breadcrumb Colors', 'newsfit' ),
			'description' => __( 'NewsFit Banner Color Section', 'newsfit' ),
			'priority'    => 6
		] );

		Customize::add_controls( $this->section_banner_color, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls(): array {

		return apply_filters( 'newsfit_site_color_controls', [

			'rt_banner_bg' => [
				'type'    => 'color',
				'label'   => __( 'Banner Background', 'newsfit' ),
			],

			'rt_breadcrumb_color' => [
				'type'    => 'color',
				'label'   => __( 'Link Color', 'newsfit' ),
			],

			'rt_breadcrumb_active' => [
				'type'    => 'color',
				'label'   => __( 'Link Active Color', 'newsfit' ),
			],


		] );


	}

}
