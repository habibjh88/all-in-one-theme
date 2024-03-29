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
class ColorSite extends Customizer {
	protected string $section_site_color = 'newsfit_site_color_section';

	/**
	 * Register controls
	 * @return void
	 */
	public function register() {
		Customize::add_section( [
			'id'          => $this->section_site_color,
			'panel'       => 'rt_color_panel',
			'title'       => __( 'Site Colors', 'newsfit' ),
			'description' => __( 'NewsFit Site Color Section', 'newsfit' ),
			'priority'    => 2
		] );
		Customize::add_controls( $this->section_site_color, $this->get_controls() );
	}

	/**
	 * Get controls
	 * @return array
	 */
	public function get_controls(): array {

		return apply_filters( 'newsfit_site_color_controls', [

			'rt_site_color1'   => [
				'type'  => 'heading',
				'label' => __( 'Site Ascent Color', 'newsfit' ),
			],
			'rt_primary_color' => [
				'type'    => 'color',
				'label'   => __( 'Primary Color', 'newsfit' ),
				'default' => '#4c353c'
			],

			'rt_primary_dark_color' => [
				'type'    => 'color',
				'label'   => __( 'Primary Dark Color', 'newsfit' ),
				'default' => '#341f26'
			],

			'rt_primary_light_color' => [
				'type'    => 'color',
				'label'   => __( 'Primary Light Color', 'newsfit' ),
				'default' => '#765761'
			],

			'rt_color_separator2' => [
				'type' => 'separator',
			],

			'rt_secondary_color' => [
				'type'    => 'color',
				'label'   => __( 'Secondary Color', 'newsfit' ),
				'default' => '#ede3de'
			],

			'rt_site_color2' => [
				'type'  => 'heading',
				'label' => __( 'Others Color', 'newsfit' ),
			],

			'rt_body_color' => [
				'type'    => 'color',
				'label'   => __( 'Body Color', 'newsfit' ),
				'default' => '#4a3f4e'
			],

			'rt_title_color' => [
				'type'    => 'color',
				'label'   => __( 'Title Color', 'newsfit' ),
				'default' => '#4a3f4e'
			],

			'rt_meta_color' => [
				'type'    => 'color',
				'label'   => __( 'Meta Color', 'newsfit' ),
				'default' => '#808993'
			],

			'rt_meta_light' => [
				'type'    => 'color',
				'label'   => __( 'Meta Light', 'newsfit' ),
				'default' => '#F2F8FF'
			],

			'rt_gray20_color' => [
				'type'    => 'color',
				'label'   => __( 'Gray # 1', 'newsfit' ),
				'default' => '#d9d8dd'
			],

			'rt_gray40_color' => [
				'type'    => 'color',
				'label'   => __( 'Gray # 2', 'newsfit' ),
				'default' => '#afaab3'
			],

		] );


	}

}
