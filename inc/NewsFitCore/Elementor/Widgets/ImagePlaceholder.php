<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\NewsFit\NewsFitCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use RT\NewsFit\NewsFitCore\Elementor\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ImagePlaceholder extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Image Placeholder', 'newsfit-core' );
		$this->rt_base = 'rt-image-placeholder';
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
			'important_note',
			[
				'label' => __( 'Important Note: ', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<div style="border: 1px solid #eee;margin-top: 5px;padding: 5px 10px;">If you would like to use it as a inview animation then add <pre style="color:#93003c;display:inline">has-placeholder</pre> class in the main section.</div>',
			]
		);

		$this->add_control(
			'animated_image',
			[
				'label'   => __( 'Placeholder Image', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'wrap_position',
			[
				'label' => __( 'WrapPosition', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'absolute',
				'selectors'  => [
					'{{WRAPPER}}' => 'position: absolute',
				],
			]
		);

		$this->add_responsive_control(
			'img_top_position',
			[
				'label'      => __( 'Image Top Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -300,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 20,
						'max' => 130,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_left_position',
			[
				'label'      => __( 'Image Left Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -800,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => -100,
						'max' => 180,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_right_position',
			[
				'label'      => __( 'Image Right Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -300,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 20,
						'max' => 130,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_bottom_position',
			[
				'label'      => __( 'Image Bottom Position', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => -300,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 20,
						'max' => 130,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Settings
		//=======================================
		$this->start_controls_section(
			'placeholder_settings',
			[
				'label' => esc_html__( 'Extra Settings', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label'          => __( 'Wrapper Width', 'newsfit-core' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'px', '%' ],
				'range'          => [
					'px' => [
						'min' => 20,
						'max' => 1920,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'      => [
					'{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_control(
			'img_alignment',
			[
				'label' => __( 'Image Alignment', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'newsfit-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'newsfit-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'newsfit-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors'  => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} img' => 'display: inline-block',
				],
			]
		);

		$this->add_control(
			'image_flip',
			[
				'label' => __( 'Flip Image', 'newsfit-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'newsfit-core' ),
					'-1' => __( 'Flip', 'newsfit-core' ),
				],
				'selectors'  => [
					'{{WRAPPER}} img' => 'transform: scaleX({{VALUE}});-webkit-transform: scaleX({{VALUE}});',
				],
			]
		);

		$this->add_responsive_control(
			'img_opacity',
			[
				'label'      => __( 'Image Opacity', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} img',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();
		echo wp_get_attachment_image( $data['animated_image']['id'], 'full', '', [
			'class' => 'rt-image-placeholder',
			'alt' => __('Animated Image', 'newsfit-core'),
		] );
	}

}
