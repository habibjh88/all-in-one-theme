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

class Slider extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Main Slider', 'newsfit-core' );
		$this->rt_base = 'rt-main-slider';
		parent::__construct( $data, $args );
	}

	public function get_script_depends() {
		return [ 'slick' ];
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
			'layout',
			[
				'label'   => __( 'Layout', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( 'Style # 01', 'newsfit-core' ),
				],
			]
		);

		$repeater = new \Elementor\Repeater();


		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'newsfit-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Enter Designation', 'newsfit-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'   => __( 'Content', 'newsfit-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __( 'Enter Designation', 'newsfit-core' ),
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'       => __( 'Button Text', 'newsfit-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'READ ARTICLE', 'newsfit-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'type'        => Controls_Manager::URL,
				'label'       => esc_html__( 'Button URL', 'newsfit-core' ),
				'placeholder' => 'https://your-link.com',
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Slider List', 'newsfit-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'   => __( 'CEO, PSDBOSS', 'newsfit-core' ),
						'content' => __( 'Engage with our professional real estate agents sell Following buy or rent your home.Get emails directly to your area reach inbox and manage the lead with.',
							'newsfit-core' ),
						'button_text'    => __( 'Details', 'newsfit-core' ),
						'button_link'    => '#',
					],
					[
						'title'   => __( 'WordPress Developer', 'newsfit-core' ),
						'content' => __( 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a',
							'newsfit-core' ),
						'button_text'    => __( 'Read More', 'newsfit-core' ),
						'button_link'    => '#',
					],
					[
						'title'   => __( 'Web Designer', 'newsfit-core' ),
						'content' => __( 'Aliquid expedita recusandae ipsam quas fugit aperiam nihil nemo delectus laudantium? Enim est quibusdam dicta a', 'newsfit-core' ),
						'button_text'    => __( 'Details', 'newsfit-core' ),
						'button_link'    => '#',
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();


		//Settings
		//=======================================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'newsfit-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumb_style_heading',
			[
				'label' => __( 'Thumb Style', 'newsfit-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
				//				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'thumb_size',
			[
				'label'      => __( 'Thumb Size', 'newsfit-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 2000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-main-carousel .slider-img img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'title_style_heading',
			[
				'label'     => __( 'Title Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typography', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .content-inner .item-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .content-inner .item-title' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'content_style_heading',
			[
				'label'     => __( 'Content Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typo',
				'label'    => esc_html__( 'Content', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .content-inner .item-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Content', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .content-inner .item-content' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'button_style_heading',
			[
				'label'     => __( 'Button Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Button Typo', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .content-inner .btn',
			]
		);

		$this->add_control(
			'button_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button BG', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .content-inner .btn' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button BG Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .content-inner .btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button Color', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .content-inner .btn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Button Color Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .content-inner .btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'overlay_style',
			[
				'label'     => __( 'Overlay Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'overlay_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Overlay Background', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-content .overlay' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'overlay_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Overlay Background Hover', 'newsfit-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-content:hover .overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'slider_style',
			[
				'label'     => __( 'Slider Style', 'newsfit-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __('Slider Border', 'newsfit-core'),
				'selector' => '{{WRAPPER}} .slick-list',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'newsfit-core' ),
				'selector' => '{{WRAPPER}} .slick-list',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$data = $this->get_settings();

		$data['slider_data'] = array(
			'type'          => 'fade',
			'rewind'        => true,
			'speed'         => 50,
			'perPage'       => 1,
			'arrows'        => false,
			'autoplay'      => true,
			'interval'      => 15000,
			'pauseOnHover'  => false,
			'pauseOnFocus'  => false,
			'resetProgress' => false
		);
		$layout              = $data['layout'];

		Fns::get_template( "elementor/slider/view-$layout", $data );
	}

}
