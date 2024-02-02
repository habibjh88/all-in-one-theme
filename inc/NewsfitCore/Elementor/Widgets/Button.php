<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFit\NewsFitCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\NewsFit\Helpers\Fns;
use RT\NewsFit\NewsFitCore\Elementor\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Button extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Button', 'newsfit-core' );
		$this->rt_base = 'rt-btn';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btntext',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Button Text', 'newsfit-core' ),
				'default' => 'LOREM IPSUM',
			]
		);

		$this->add_control(
			'btnurl',
			[
				'type'        => Controls_Manager::URL,
				'label'       => esc_html__( 'Button URL', 'newsfit-core' ),
				'placeholder' => 'https://your-link.com',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'newsfit-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'newsfit-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banner-btn' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box',
			[
				'label' => __( 'General', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'     => __( 'Border Radius', 'newsfit-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 0,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .banner-btn .item-btn' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .banner-btn .item-btn',
			]
		);

		$this->start_controls_tabs( 'cat_box_style' );

		// Normal tab.
		$this->start_controls_tab(
			'box_style_normal',
			[
				'label' => __( 'Normal', 'newsfit-core' ),
			]
		);

		// Normal background color.
		$this->add_control(
			'box_style_normal_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'newsfit-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .banner-btn .item-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Normal Text color.
		$this->add_control(
			'box_style_normal_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Text Color', 'newsfit-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .banner-btn .item-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'box_style_hover',
			[
				'label' => __( 'Hover', 'newsfit-core' ),
			]
		);

		// Hover background color.
		$this->add_control(
			'box_style_hover_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Background Color', 'newsfit-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .banner-btn .item-btn:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Hover Text color.
		$this->add_control(
			'box_style_hover_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => __( 'Text Color', 'newsfit-core' ),
				'separator' => '',
				'selectors' => [
					'{{WRAPPER}} .banner-btn .item-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'sec_spacing',
			[
				'label' => esc_html__( 'Spacing', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'btn_margin',
			[
				'label'      => __( 'Margin', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn .item-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'newsfit-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn .item-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/button/$template", $data );
	}

}
