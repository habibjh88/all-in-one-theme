<?php
/**
 * Helpers methods
 * List all your static functions you wish to use globally on your theme
 *
 * @package newsfit
 */

use RT\NewsFit\Options\Opt;
use RT\NewsFit\Core\Constants;
use RT\NewsFit\Helpers\Fns;


if ( ! function_exists( 'starts_with' ) ) {
	/**
	 * Determine if a given string starts with a given substring.
	 *
	 * @param string $haystack
	 * @param string|array $needles
	 *
	 * @return bool
	 */
	function starts_with( $haystack, $needles ) {
		foreach ( (array) $needles as $needle ) {
			if ( $needle != '' && substr( $haystack, 0, strlen( $needle ) ) === (string) $needle ) {
				return true;
			}
		}

		return false;
	}
}

function newsfit_html( $html, $checked = true ) {
	$allowed_html = [
		'a'      => [
			'href'   => [],
			'title'  => [],
			'class'  => [],
			'target' => [],
		],
		'br'     => [],
		'span'   => [
			'class' => [],
			'id'    => [],
		],
		'em'     => [],
		'strong' => [],
		'i'      => [
			'class' => []
		],
		'iframe' => [
			'class'                 => [],
			'id'                    => [],
			'name'                  => [],
			'src'                   => [],
			'title'                 => [],
			'frameBorder'           => [],
			'width'                 => [],
			'height'                => [],
			'scrolling'             => [],
			'allowvr'               => [],
			'allow'                 => [],
			'allowFullScreen'       => [],
			'webkitallowfullscreen' => [],
			'mozallowfullscreen'    => [],
			'loading'               => [],
		],
	];

	if ( $checked ) {
		return wp_kses( $html, $allowed_html );
	} else {
		return $html;
	}
}

if ( ! function_exists( 'newsfit_custom_menu_cb' ) ) {
	/**
	 * Callback function for the main menu
	 *
	 * @param $args
	 *
	 * @return string|void
	 */
	function newsfit_custom_menu_cb( $args ) {
		extract( $args );
		$add_menu_link = admin_url( 'nav-menus.php' );
		$menu_text     = sprintf( __( "Add %s Menu", "newsfit" ), $theme_location );
		__( 'Add a menu', 'newsfit' );
		if ( ! current_user_can( 'manage_options' ) ) {
			$add_menu_link = home_url();
			$menu_text     = __( 'Home', 'newsfit' );
		}

		// see wp-includes/nav-menu-template.php for available arguments

		$link = $link_before . '<a href="' . $add_menu_link . '">' . $before . $menu_text . $after . '</a>' . $link_after;

		// We have a list
		if ( false !== stripos( $items_wrap, '<ul' ) || false !== stripos( $items_wrap, '<ol' ) ) {
			$link = "<li>$link</li>";
		}

		$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
		if ( ! empty ( $container ) ) {
			$output = "<$container class='$container_class' id='$container_id'>$output</$container>";
		}

		if ( $echo ) {
			echo $output;
		}

		return $output;
	}
}

if ( ! function_exists( 'newsfit_menu_icons_group' ) ) {
	/**
	 * Get menu icon group
	 * @return void
	 */
	function newsfit_menu_icons_group() {
		$menu_classes = '';
		if ( newsfit_option( 'rt_header_separator' ) ) {
			$menu_classes = 'has-separator';
		}
		?>
		<ul class="d-flex gap-15 align-items-center <?php echo esc_attr( $menu_classes ) ?>">
			<?php if ( newsfit_option( 'rt_header_bar' ) ) : ?>
				<li>
					<a class="menu-bar trigger-off-canvas" href="#">
						<svg class="ham_burger" viewBox="0 0 100 100" width="180">
							<path class="line top" d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"/>
							<path class="line middle" d="m 30,50 h 40"/>
							<path class="line bottom" d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"/>
						</svg>
					</a>
				</li>
			<?php endif; ?>

			<?php if ( newsfit_option( 'rt_header_search' ) ) : ?>
				<li class="newsfit-search-popup">
					<a class="menu-search-bar newsfit-search-trigger" href="#">
						<?php echo newsfit_get_svg( 'search' ); ?>
					</a>
					<?php get_search_form(); ?>
				</li>
			<?php endif; ?>

			<?php if ( newsfit_option( 'rt_header_login_link' ) ) : ?>
				<li class="newsfit-user-login">
					<a href="<?php echo esc_url( wp_login_url() ) ?>">
						<?php echo newsfit_get_svg( 'user' ); ?>
					</a>
				</li>
			<?php endif; ?>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'newsfit_require' ) ) {
	/**
	 * Require any file. If the file will available in the child theme, the file will load from the child theme
	 *
	 * @param $filename
	 * @param string $dir
	 *
	 * @return false|void
	 */
	function newsfit_require( $filename, string $dir = 'inc' ) {

		$dir        = trailingslashit( $dir );
		$child_file = get_stylesheet_directory() . DIRECTORY_SEPARATOR . $dir . $filename;

		if ( file_exists( $child_file ) ) {
			$file = $child_file;
		} else {
			$file = get_template_directory() . DIRECTORY_SEPARATOR . $dir . $filename;
		}

		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'newsfit_get_svg' ) ) {
	/**
	 * Get svg icon
	 *
	 * @param $name
	 *
	 * @return string|void
	 */
	function newsfit_get_svg( $name, $rotate = '' ) {
		return Fns::get_svg( $name, $rotate );
	}
}

if ( ! function_exists( 'newsfit_get_file' ) ) {
	/**
	 * Get File Path
	 *
	 * @param $path
	 *
	 * @return string
	 */
	function newsfit_get_file( $path, $return_path = false ) {
		$file = ( $return_path ? get_stylesheet_directory() : get_stylesheet_directory_uri() ) . $path;
		if ( ! file_exists( $file ) ) {
			$file = ( $return_path ? get_template_directory() : get_template_directory_uri() ) . $path;
		}

		return $file;
	}
}

if ( ! function_exists( 'newsfit_get_img' ) ) {
	/**
	 * Get Image Path
	 *
	 * @param $filename
	 * @param $echo
	 * @param $image_meta
	 *
	 * @return string|void
	 */
	function newsfit_get_img( $filename, $echo = false, $image_meta = '' ) {
		$path      = '/assets/images/' . $filename;
		$image_url = newsfit_get_file( $path );

		if ( $echo ) {
			if ( ! strpos( $filename, '.svg' ) ) {
				$getimagesize = wp_getimagesize( newsfit_get_file( $path, true ) );
				$image_meta   = $getimagesize[3] ?? $image_meta;
			}
			echo '<img ' . $image_meta . ' src="' . esc_url( $image_url ) . '"/>';
		} else {
			return $image_url;
		}
	}
}

if ( ! function_exists( 'newsfit_get_css' ) ) {
	/**
	 * Get CSS Path
	 *
	 * @param $filename
	 * @param bool $check_rtl
	 *
	 * @return string
	 */
	function newsfit_get_css( $filename, $check_rtl = false ) {
		$min    = WP_DEBUG ? '.css' : '.min.css';
		$is_rtl = $check_rtl && is_rtl() ? 'css-rtl' : 'css';
		$path   = "/assets/$is_rtl/" . $filename . $min;

		return newsfit_get_file( $path );
	}
}

if ( ! function_exists( 'newsfit_get_js' ) ) {
	/**
	 * Get JS Path
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	function newsfit_get_js( $filename, $default_path = null ) {
		$min          = WP_DEBUG ? '.js' : '.min.js';
		$default_path = $default_path ?? '/assets/js/';
		$path         = $default_path . $filename . $min;

		return newsfit_get_file( $path );
	}
}


if ( ! function_exists( 'newsfit_option' ) ) {
	/**
	 * Get Customize Options value by key
	 *
	 * @param $key
	 * @param $echo
	 * @param $return_array
	 *
	 * @return mixed
	 */
	function newsfit_option( $key, $echo = false, $return_array = false ) {
		if ( isset( Opt::$options[ $key ] ) ) {
			if ( $echo ) {
				echo newsfit_html( Opt::$options[ $key ] );
			} else {
				$opt_val = Opt::$options[ $key ];
				if ( $return_array && $opt_val ) {
					$opt_val = explode( ',', trim( $opt_val, ', ' ) );
				}

				return $opt_val;
			}
		}

		return '';
	}
}

if ( ! function_exists( 'newsfit_get_social_html' ) ) {
	/**
	 * Get Social markup
	 *
	 * @param $color
	 *
	 * @return void
	 */

	function newsfit_get_social_html( $color = '' ) {
		ob_start();
		$icon_style = newsfit_option( 'rt_social_icon_style' ) ?? '';
		foreach ( Fns::get_socials() as $id => $item ) {
			if ( empty( $item['url'] ) ) {
				continue;
			}
			?>
			<a target="_blank" href="<?php echo esc_url( $item['url'] ) ?>">
				<?php echo newsfit_get_svg( $id . $icon_style ); ?>
			</a>
			<?php
		}

		echo ob_get_clean();
	}
}

if ( ! function_exists( 'newsfit_site_logo' ) ) {
	/**
	 * Newfit Site Logo
	 *
	 */
	function newsfit_site_logo( $with_h1 = false ) {
		$main_logo       = newsfit_option( 'rt_logo' );
		$logo_light      = newsfit_option( 'rt_logo_light' );
		$logo_mobile     = newsfit_option( 'rt_logo_mobile' );
		$site_logo       = Opt::$has_tr_header ? $logo_light : $main_logo;
		$mobile_logo     = $logo_mobile ?? $site_logo;
		$has_mobile_logo = ! empty( $logo_mobile ) ? 'has-mobile-logo' : '';
		ob_start();

		if ( $with_h1 ) {
			echo '<h1 class="site-title">';
		}
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link <?php echo esc_attr( $has_mobile_logo ) ?>">
			<?php
			if ( ! empty( $site_logo ) ) {
				echo wp_get_attachment_image( $site_logo, 'full', null, [ 'id' => 'rt-site-logo' ] );
				if ( ! empty( $mobile_logo ) ) {
					echo wp_get_attachment_image( $mobile_logo, 'full', null, [ 'id' => 'rt-mobile-logo' ] );
				}
			} else {
				bloginfo( 'name' );
			}
			?>
		</a>
		<?php
		if ( $with_h1 ) {
			echo '</h1>';
		}

		return ob_get_clean();
	}
}

if ( ! function_exists( 'newsfit_footer_logo' ) ) {
	/**
	 * Newfit Site Logo
	 *
	 */
	function newsfit_footer_logo() {
		$main_logo  = newsfit_option( 'rt_logo' );
		$logo_light = newsfit_option( 'rt_logo_light' );
		$site_logo  = $main_logo;

		if ( 'footer-dark' === Opt::$footer_schema ) {
			$site_logo = $logo_light;
		}

		if ( '2' == Opt::$footer_style && 'schema-default' === Opt::$footer_schema ) {
			$site_logo = $logo_light;
		}

		ob_start();
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php
			if ( ! empty( $site_logo ) ) {
				echo wp_get_attachment_image( $site_logo, 'full', null, [ 'class' => 'footer-logo' ] );
			} else {
				bloginfo( 'name' );
			}
			?>
		</a>
		<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'newsfit_classes' ) ) {
	/**
	 * Merge all classes
	 *
	 * @param $clsses
	 *
	 * @return string
	 */
	function newsfit_classes( $clsses ) {
		return implode( ' ', $clsses );
	}
}

if ( ! function_exists( 'newsfit_scroll_top' ) ) {
	/**
	 * Back-to-top button
	 * @return void
	 */
	function newsfit_scroll_top( $class = '', $icon = 'scroll-top' ) {
		if ( newsfit_option( 'rt_back_to_top' ) ) {
			?>
			<a href="#" class="scrollToTop <?php echo esc_attr( $class ) ?>">
				<?php echo newsfit_get_svg( $icon ); ?>
			</a>
			<?php
		}
	}
}


if ( ! function_exists( 'newsfit_post_meta' ) ) {
	/**
	 * Get post meta
	 *
	 * @return string
	 */
	function newsfit_post_meta( $args ) {
		$default_args = [
			'with_list'     => true,
			'include'       => [],
			'class'         => '',
			'author_prefix' => __( 'By', 'newsfit' )
		];

		$args = wp_parse_args( $args, $default_args );

		$comments_number = get_comments_number();
		$comments_text   = sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'newsfit' ), number_format_i18n( $comments_number ) );

		$_meta_data = [];
		$output     = '';

		$_meta_data['author']   = Fns::posted_by( $args['author_prefix'] );
		$_meta_data['date']     = Fns::posted_on();
		$_meta_data['category'] = Fns::posted_in();
		$_meta_data['tag']      = Fns::posted_in( 'tag' );
		$_meta_data['comment']  = esc_html( $comments_text );

		$meta_list = $args['include'] ?? array_keys( $_meta_data );

		if ( $args['with_list'] ) {
			$output .= '<div class="newsfit-post-meta ' . $args['class'] . '"><ul class="entry-meta">';
		}
		foreach ( $meta_list as $key ) {
			$meta = $_meta_data[ $key ];
			if ( ! $meta ) {
				continue;
			}
			$output .= ( $args['with_list'] ) ? '<li class="' . $key . '">' : '';
			$output .= $meta;
			$output .= ( $args['with_list'] ) ? '</li>' : '';
		}

		if ( $args['with_list'] ) {
			$output .= '</ul></div>';
		}

		return $output;
	}
}


if ( ! function_exists( 'newsfit_post_thumbnail' ) ) {
	/**
	 * Displays post thumbnail.
	 * @return void
	 */
	function newsfit_post_thumbnail() {
		if ( ! Fns::can_show_post_thumbnail() ) {
			return;
		}
		?>
		<div class="post-thumbnail-wrap">
			<figure class="post-thumbnail">
				<a class="post-thumb-link alignwide" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( 'newsfit-500-500', [ 'loading' => 'lazy' ] ); ?>
				</a>
				<?php edit_post_link( 'Edit' ); ?>
			</figure><!-- .post-thumbnail -->
		</div>
		<?php
	}
}

if ( ! function_exists( 'newsfit_post_single_thumbnail' ) ) {
	/**
	 * Display post details thumbnail
	 * @return void
	 */
	function newsfit_post_single_thumbnail() {
		if ( ! Fns::can_show_post_thumbnail() ) {
			return;
		}
		?>
		<div class="post-thumbnail-wrap">
			<figure class="post-thumbnail">
				<?php the_post_thumbnail( 'full', [ 'loading' => true ] ); ?>
				<?php edit_post_link( 'Edit' ); ?>
			</figure><!-- .post-thumbnail -->
			<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) : ?>
				<figcaption class="wp-caption-text">
					<?php echo newsfit_get_svg( 'camera' ); ?>
					<span><?php echo newsfit_html( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></span>
				</figcaption>
			<?php endif; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'newsfit_entry_footer' ) ) {
	/**
	 * NewsFit Entry Footer
	 *
	 * @return void
	 *
	 */
	function newsfit_entry_footer() {

		if ( ! is_single() ) {
			if ( newsfit_option( 'rt_blog_footer_visibility' ) ) { ?>
				<footer class="entry-footer">
				<a class="read-more" href="<?php echo esc_url( get_permalink() ) ?>"><?php echo Fns::continue_reading_text() ?></a>
				</footer><?php
			}
		} else {
			if ( 'post' === get_post_type() && has_tag() ) { ?>
				<footer class="entry-footer">
					<div class="post-tags">
						<?php if ( $tags_label = newsfit_option( 'rt_tags' ) ) {
							printf( "<span>%s</span>", esc_html( $tags_label ) );
						} ?>
						<?php newsfit_separate_meta( 'content-below-meta', [ 'tag' ] ); ?>
					</div>
				</footer>
				<?php
			}
		}

	}
}

if ( ! function_exists( 'newsfit_entry_content' ) ) {
	/**
	 * Entry Content
	 * @return void
	 */
	function newsfit_entry_content() {
		if ( ! is_single() ) {
			$length = newsfit_option( 'rt_excerpt_limit' );
			echo wp_trim_words( get_the_excerpt(), $length );
		} else {
			the_content();
		}
	}
}

if ( ! function_exists( 'newsfit_sidebar' ) ) {
	/**
	 * Get Sidebar conditionally
	 *
	 * @param $sidebar_id
	 *
	 * @return false|void
	 */
	function newsfit_sidebar( $sidebar_id ) {
		$sidebar_from_layout = Opt::$sidebar;


		if ( 'default' !== $sidebar_from_layout && is_active_sidebar( $sidebar_from_layout ) ) {
			$sidebar_id = $sidebar_from_layout;
		}
		if ( ! is_active_sidebar( $sidebar_id ) ) {
			return false;
		}

		if ( Opt::$layout == 'full-width' || Opt::$single_style == '4' ) {
			return false;
		}

		$sidebar_cols = Fns::sidebar_columns();
		?>
		<aside id="sidebar" class="newsfit-widget-area <?php echo esc_attr( $sidebar_cols ) ?>" role="complementary">
			<?php dynamic_sidebar( $sidebar_id ); ?>
		</aside><!-- #sidebar -->
		<?php
	}
}


if ( ! function_exists( 'newsfit_post_class' ) ) {
	/**
	 * Get dynamic article classes
	 * @return string
	 */
	function newsfit_post_class( $default_class = 'newsfit-post-card' ) {
		$above_meta_style = 'above-' . newsfit_option( 'rt_single_above_meta_style' );

		if ( is_single() ) {
			$meta_style   = newsfit_option( 'rt_single_meta_style' );
			$post_classes = newsfit_classes( [ $meta_style, $above_meta_style ] );
		} else {
			$meta_style   = newsfit_option( 'rt_blog_meta_style' );
			$post_classes = newsfit_classes( [ $meta_style, $above_meta_style, Fns::blog_column() ] );
		}

		if ( $default_class ) {
			return $post_classes . ' ' . $default_class;
		}

		return $post_classes;
	}
}

if ( ! function_exists( 'newsfit_separate_meta' ) ) {
	/**
	 * Get above title meta
	 * @return string
	 */
	function newsfit_separate_meta( $class = '', $includes = [ 'category' ] ) {
		if ( ( ! is_single() && newsfit_option( 'rt_blog_above_cat_visibility' ) ) || ( is_single() && newsfit_option( 'rt_single_above_cat_visibility' ) ) ) : ?>
		<div class="separate-meta <?php echo esc_attr( $class ) ?>">
			<?php echo newsfit_post_meta( [
				'with_list' => false,
				'include'   => $includes,
			] ); ?>
			</div><?php
		endif;
	}
}

if ( ! function_exists( 'newsfit_single_entry_header' ) ) {
	/**
	 * Get above title meta
	 * @return string
	 */
	function newsfit_single_entry_header() {
		?>
		<header class="entry-header">
			<?php
			newsfit_separate_meta( 'title-above-meta' );

			the_title( '<h1 class="entry-title default-max-width">', '</h1>' );

			if ( ! empty( Fns::single_meta_lists() ) && newsfit_option( 'rt_single_meta_visibility' ) ) {
				echo newsfit_post_meta( [
					'with_list'     => true,
					'include'       => Fns::single_meta_lists(),
					'author_prefix' => newsfit_option( 'rt_author_prefix' ),
				] );
			}
			?>
		</header>
		<?php
	}
}

if ( ! function_exists( 'newsfit_breadcrumb' ) ) {
	/**
	 * Newsfit breadcrumb
	 * @return void
	 */
	function newsfit_breadcrumb() {
		?>
		<nav aria-label="breadcrumb">
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<?php echo newsfit_get_svg( 'home' ); ?>
					<a href="<?php echo esc_url( site_url() ); ?>"><?php esc_html_e( 'Home', 'newsfit' ) ?></a>
					<span class="raquo">/</span>
				</li>
				<li class="breadcrumb-item active" aria-current="page">
					<?php
					if ( is_tag() ) {
						esc_html_e( 'Posts Tagged ', 'newsfit' );
						?><span class="raquo">/</span>
						<span class="title"><?php single_tag_title(); ?></span>
						<?php

					} elseif ( is_day() || is_month() || is_year() ) {
						echo '<span class="title">';
						esc_html_e( 'Posts made in', 'newsfit' );
						echo esc_html( get_the_time( is_year() ? 'Y' : ( is_month() ? 'F, Y' : 'F jS, Y' ) ) );
						echo '</span>';
					} elseif ( is_search() ) {
						echo '<span class="title">';
						esc_html_e( 'Search results for', 'newsfit' );
						the_search_query();
						echo '</span>';
					} elseif ( is_404() ) {
						echo '<span class="title">';
						esc_html_e( '404', 'newsfit' );
						echo '</span>';
					} elseif ( is_single() ) {
						$category = get_the_category();
						if ( $category ) {
							$catlink = get_category_link( $category[0]->cat_ID );
							echo '<a href="' . esc_url( $catlink ) . '">' . esc_html( $category[0]->cat_name ) . '</a> <span class="raquo"> /</span> ';
						}
						echo '<span class="title">';
						echo get_the_title();
						echo '</span>';
					} elseif ( is_category() ) {
						echo '<span class="title">';
						single_cat_title();
						echo '</span>';
					} elseif ( is_tax() ) {
						$tt_taxonomy_links = [];
						$tt_term           = get_queried_object();
						$tt_term_parent_id = $tt_term->parent;
						$tt_term_taxonomy  = $tt_term->taxonomy;

						while ( $tt_term_parent_id ) {
							$tt_current_term     = get_term( $tt_term_parent_id, $tt_term_taxonomy );
							$tt_taxonomy_links[] = '<a href="' . esc_url( get_term_link( $tt_current_term, $tt_term_taxonomy ) ) . '" title="' . esc_attr( $tt_current_term->name ) . '">' . esc_html( $tt_current_term->name ) . '</a>';
							$tt_term_parent_id   = $tt_current_term->parent;
						}

						if ( ! empty( $tt_taxonomy_links ) ) {
							echo implode( ' <span class="raquo">/</span> ', array_reverse( $tt_taxonomy_links ) ) . ' <span class="raquo">/</span> ';
						}

						echo '<span class="title">';
						echo esc_html( $tt_term->name );
						echo '</span>';
					} elseif ( is_author() ) {
						global $wp_query;
						$current_author = $wp_query->get_queried_object();

						echo '<span class="title">';
						esc_html_e( 'Posts by: ', 'newsfit' );
						echo ' ', esc_html( $current_author->nickname );
						echo '</span>';
					} elseif ( is_page() ) {
						echo '<span class="title">';
						echo get_the_title();
						echo '</span>';
					} elseif ( is_home() ) {
						echo '<span class="title">';
						esc_html_e( 'Blog', 'newsfit' );
						echo '</span>';
					} elseif ( class_exists( 'WooCommerce' ) and is_shop() ) {
						echo '<span class="title">';
						esc_html_e( 'Shop', 'newsfit' );
						echo '</span>';
					}
					?>
				</li>
			</ul>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'newsfit_get_avatar_url' ) ) :
	function newsfit_get_avatar_url( $get_avatar ) {
		preg_match( "/src='(.*?)'/i", $get_avatar, $matches );

		return $matches[1];
	}
endif;


function newsfit_comments_cbf( $comment, $args, $depth ) {

	// Get correct tag used for the comments
	if ( 'div' === $args['style'] ) {
		$tag       = 'div ';
		$add_below = 'comment';
	} else {
		$tag       = 'li ';
		$add_below = 'div-comment';
	} ?>

	<<?php echo $tag; ?><?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">

	<?php
	// Switch between different comment types
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
			<div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'newsfit' ); ?></span> <?php comment_author_link(); ?></div>
			<?php
			break;
		default :

			if ( 'div' != $args['style'] ) { ?>
				<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
			<?php } ?>
			<div class="comment-author">
				<div class="vcard">
					<?php
					// Display avatar unless size is set to 0
					if ( $args['avatar_size'] != 0 ) {
						$avatar_size = ! empty( $args['avatar_size'] ) ? $args['avatar_size'] : 70; // set default avatar size
						echo get_avatar( $comment, $avatar_size );
					} ?>
				</div>
				<div class="author-info">
					<?php
					// Display author name
					printf( __( '<cite class="fn">%s</cite>', 'newsfit' ), get_comment_author_link() ); ?>

					<div class="comment-meta commentmetadata">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
							/* translators: 1: date, 2: time */
							printf(
								__( '%1$s at %2$s', 'newsfit' ),
								get_comment_date(),
								get_comment_time()
							); ?>
						</a><?php
						edit_comment_link( __( 'Edit', 'newsfit' ), '  ', '' ); ?>
					</div><!-- .comment-meta -->
				</div>

			</div><!-- .comment-author -->
			<div class="comment-details">

				<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
				<?php
				// Display comment moderation text
				if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'newsfit' ); ?></em><br/><?php
				} ?>

				<?php
				$icon = newsfit_get_svg( 'share' );
				// Display comment reply link
				comment_reply_link( array_merge( $args, [
					'add_below'  => $add_below,
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'reply_text' => $icon . __( 'Reply', 'newsfit' )
				] ) ); ?>

			</div><!-- .comment-details -->
			<?php
			if ( 'div' != $args['style'] ) { ?>
				</div>
			<?php }
			// IMPORTANT: Note that we do NOT close the opening tag, WordPress does this for us
			break;
	endswitch; // End comment_type check.
}

if ( ! function_exists( 'newsfit_about_social' ) ) {
	/**
	 * Get about social icon list
	 * @return void
	 */
	function newsfit_about_social( $instance ) {
		$icon_style = newsfit_option( 'rt_social_icon_style' ) ?? '';
		?>
		<ul class="footer-social">
			<?php if ( ! empty( $instance['facebook'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'facebook' . $icon_style ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['twitter'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'twitter' . $icon_style ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['linkedin'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'linkedin' . $icon_style ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['pinterest'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'pinterest' . $icon_style ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['instagram'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'instagram' . $icon_style ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['youtube'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'youtube' . $icon_style ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['rss'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['rss'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'rss' . $icon_style ) ?></a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['zalo'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['zalo'] ); ?>" target="_blank">
                    <span class="rticon-zalo">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="black" xmlns="http://www.w3.org/2000/svg">
                        <path
							d="M3.60001 1.60001C2.5002 1.60001 1.60001 2.5002 1.60001 3.60001V16.4C1.60001 17.4998 2.5002 18.4 3.60001 18.4H16.4C17.4998 18.4 18.4 17.4998 18.4 16.4V3.60001C18.4 2.5002 17.4998 1.60001 16.4 1.60001H3.60001ZM3.60001 2.40001H6.23047C4.84722 3.83925 4.00001 5.72946 4.00001 7.80001C4.00001 9.94455 4.90726 11.8994 6.37969 13.3555C6.32617 13.3045 6.39546 13.3932 6.40235 13.55C6.40946 13.7119 6.38508 13.9344 6.31954 14.1547C6.18845 14.5953 5.91427 15.0015 5.47344 15.1484C5.38972 15.1763 5.31757 15.2312 5.26823 15.3043C5.21889 15.3775 5.19514 15.4649 5.20067 15.553C5.20619 15.6411 5.24069 15.7249 5.29879 15.7913C5.35689 15.8577 5.43532 15.9031 5.52188 15.9203C6.62576 16.1411 7.40659 15.8087 7.98204 15.5445C8.55748 15.2803 8.86842 15.1026 9.45001 15.3375C9.45156 15.338 9.45313 15.3386 9.45469 15.3391C10.5436 15.7647 11.7425 16 13 16C14.6789 16 16.2525 15.5805 17.6 14.8492V16.4C17.6 17.0674 17.0674 17.6 16.4 17.6H3.60001C2.93261 17.6 2.40001 17.0674 2.40001 16.4V3.60001C2.40001 2.93261 2.93261 2.40001 3.60001 2.40001ZM7.39844 2.40001H16.4C17.0674 2.40001 17.6 2.93261 17.6 3.60001V13.9219C16.2908 14.7251 14.7099 15.2 13 15.2C11.8441 15.2 10.7455 14.9838 9.75001 14.5953C8.90479 14.2539 8.2163 14.5565 7.64844 14.8172C7.34091 14.9584 7.03749 15.0758 6.69454 15.1406C6.86421 14.8987 7.00934 14.6403 7.08594 14.3828C7.17645 14.0786 7.21324 13.7807 7.20157 13.5148C7.18993 13.2499 7.16678 13.0073 6.94297 12.7875L6.94219 12.7867C5.60678 11.4661 4.80001 9.7195 4.80001 7.80001C4.80001 5.67097 5.79448 3.75506 7.39844 2.40001ZM13.1938 5.99454C13.0878 5.99619 12.9868 6.03982 12.913 6.11583C12.8392 6.19185 12.7986 6.29405 12.8 6.40001V10C12.7993 10.053 12.809 10.1056 12.8288 10.1548C12.8486 10.204 12.8779 10.2488 12.9151 10.2865C12.9524 10.3243 12.9967 10.3542 13.0456 10.3747C13.0945 10.3952 13.147 10.4057 13.2 10.4057C13.253 10.4057 13.3055 10.3952 13.3544 10.3747C13.4033 10.3542 13.4477 10.3243 13.4849 10.2865C13.5221 10.2488 13.5514 10.204 13.5712 10.1548C13.591 10.1056 13.6008 10.053 13.6 10V6.40001C13.6007 6.34649 13.5907 6.29337 13.5706 6.2438C13.5504 6.19422 13.5205 6.14919 13.4826 6.11139C13.4447 6.07358 13.3996 6.04375 13.35 6.02368C13.3004 6.00361 13.2473 5.9937 13.1938 5.99454ZM7.20001 6.40001C7.147 6.39926 7.09438 6.40905 7.04519 6.42881C6.996 6.44858 6.95123 6.47792 6.91348 6.51514C6.87574 6.55236 6.84576 6.59671 6.8253 6.64561C6.80484 6.69451 6.79431 6.747 6.79431 6.80001C6.79431 6.85302 6.80484 6.9055 6.8253 6.9544C6.84576 7.0033 6.87574 7.04765 6.91348 7.08487C6.95123 7.12209 6.996 7.15143 7.04519 7.1712C7.09438 7.19096 7.147 7.20076 7.20001 7.20001H8.47891L6.86094 9.78829C6.82319 9.84882 6.80232 9.91835 6.80048 9.98967C6.79865 10.061 6.81592 10.1315 6.8505 10.1939C6.88509 10.2563 6.93573 10.3083 6.99718 10.3446C7.05864 10.3808 7.12866 10.3999 7.20001 10.4H9.20001C9.25301 10.4008 9.30564 10.391 9.35482 10.3712C9.40401 10.3514 9.44878 10.3221 9.48653 10.2849C9.52427 10.2477 9.55425 10.2033 9.57471 10.1544C9.59517 10.1055 9.6057 10.053 9.6057 10C9.6057 9.947 9.59517 9.89451 9.57471 9.84561C9.55425 9.79671 9.52427 9.75236 9.48653 9.71514C9.44878 9.67792 9.40401 9.64858 9.35482 9.62881C9.30564 9.60905 9.25301 9.59926 9.20001 9.60001H7.9211L9.53907 7.01172C9.57682 6.95119 9.59769 6.88166 9.59953 6.81034C9.60136 6.73902 9.58409 6.66851 9.54951 6.60611C9.51492 6.54371 9.46428 6.4917 9.40283 6.45546C9.34137 6.41922 9.27135 6.40007 9.20001 6.40001H7.20001ZM11.9938 7.59454C11.9281 7.59569 11.8638 7.61298 11.8065 7.64486C11.7491 7.67674 11.7005 7.72224 11.6648 7.77735C11.4658 7.66806 11.2414 7.60001 11 7.60001C10.2315 7.60001 9.60001 8.23154 9.60001 9.00001C9.60001 9.76847 10.2315 10.4 11 10.4C11.2411 10.4 11.4652 10.3318 11.6641 10.2227C11.7112 10.2956 11.7808 10.3511 11.8623 10.381C11.9438 10.4109 12.0328 10.4135 12.1158 10.3884C12.1989 10.3632 12.2716 10.3117 12.3228 10.2417C12.3741 10.1716 12.4012 10.0868 12.4 10V9.00001V8.00001C12.4007 7.94649 12.3907 7.89337 12.3706 7.8438C12.3504 7.79422 12.3205 7.74919 12.2826 7.71138C12.2447 7.67358 12.1996 7.64375 12.15 7.62368C12.1004 7.60361 12.0473 7.5937 11.9938 7.59454ZM15.4 7.60001C14.6315 7.60001 14 8.23154 14 9.00001C14 9.76847 14.6315 10.4 15.4 10.4C16.1685 10.4 16.8 9.76847 16.8 9.00001C16.8 8.23154 16.1685 7.60001 15.4 7.60001ZM11 8.40001C11.3361 8.40001 11.6 8.6639 11.6 9.00001C11.6 9.33611 11.3361 9.60001 11 9.60001C10.6639 9.60001 10.4 9.33611 10.4 9.00001C10.4 8.6639 10.6639 8.40001 11 8.40001ZM15.4 8.40001C15.7361 8.40001 16 8.6639 16 9.00001C16 9.33611 15.7361 9.60001 15.4 9.60001C15.0639 9.60001 14.8 9.33611 14.8 9.00001C14.8 8.6639 15.0639 8.40001 15.4 8.40001Z"/>
                    </svg>
                        </span>
				</a>
			<?php endif; ?>

			<?php if ( ! empty( $instance['telegram'] ) ) : ?>
				<a href="<?php echo esc_url( $instance['telegram'] ); ?>" target="_blank"><?php echo newsfit_get_svg( 'telegram' . $icon_style ) ?></a>
			<?php endif; ?>

		</ul>
		<?php
	}
}

if ( ! function_exists( 'newsfit_contact_render' ) ) {
	function newsfit_contact_render( $instance ) {
		ob_start();
		?>
		<div class="newsfit-contact-widget-wrapper">
			<ul>
				<?php if ( ! empty( $instance['address'] ) ) : ?>
					<li>
						<?php echo newsfit_get_svg( 'map-pin' ) ?>
						<p><?php echo esc_html( $instance['address'] ); ?></p>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $instance['mail'] ) ) : ?>
					<li>
						<?php echo newsfit_get_svg( 'email' ) ?>
						<p><a target="_blank" href="mailto:<?php echo esc_html( $instance['mail'] ); ?>"><?php echo esc_html( $instance['mail'] ); ?></a></p>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $instance['phone'] ) ) : ?>
					<li>
						<?php echo newsfit_get_svg( 'phone' ) ?>
						<p><a target="_blank" href="tel:<?php echo esc_attr( $instance['phone'] ); ?>"><?php echo esc_html( $instance['phone'] ); ?></a></p>
					</li>
				<?php endif; ?>

				<?php if ( ! empty( $instance['website'] ) ) : ?>
					<li>
						<?php echo newsfit_get_svg( 'globe' ) ?>
						<p><a target="_blank" href="<?php echo esc_url( $instance['website'] ); ?>"><?php echo esc_html( $instance['website'] ); ?></a></p>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php
		return ob_get_clean();
	}
}


function newsfit_flaticon_icons() {
	return [
		"flaticon-user",
		"flaticon-user-1",
		"flaticon-speech-bubble",
		"flaticon-next",
		"flaticon-share",
		"flaticon-share-1",
		"flaticon-left-and-right-arrows",
		"flaticon-heart",
		"flaticon-camera",
		"flaticon-video-player",
		"flaticon-maps-and-flags",
		"flaticon-check",
		"flaticon-envelope",
		"flaticon-phone-call",
		"flaticon-call",
		"flaticon-clock",
		"flaticon-play",
		"flaticon-loupe",
		"flaticon-user-2",
		"flaticon-bed",
		"flaticon-shower",
		"flaticon-pencil",
		"flaticon-two-overlapping-square",
		"flaticon-printer",
		"flaticon-comment",
		"flaticon-home",
		"flaticon-garage",
		"flaticon-full-size",
		"flaticon-tag",
		"flaticon-right-arrow",
		"flaticon-left-arrow",
		"flaticon-left-arrow-1",
		"flaticon-left-arrow-2",
		"flaticon-right-arrow-1",
	];
}


//post category list
function rt_category_list() {
	$categories = get_categories( [ 'hide_empty' => false ] );
	$lists      = [];
	foreach ( $categories as $category ) {
		$lists[ $category->cat_ID ] = $category->name;
	}

	return $lists;
}


// post tags lists
function rt_tag_list() {
	$tags     = get_tags( [ 'hide_empty' => false ] );
	$tag_list = [];
	foreach ( $tags as $tag ) {
		$tag_list[ $tag->slug ] = $tag->name;
	}

	return $tag_list;
}

//Get all thumbnail size
function rt_get_all_image_sizes() {
	global $_wp_additional_image_sizes;
	$image_sizes = [ '0' => __( 'Default Image Size', 'newsfit-core' ) ];
	foreach ( $_wp_additional_image_sizes as $index => $item ) {
		$image_sizes[ $index ] = __( ucwords( $index . ' - ' . $item['width'] . 'x' . $item['height'] ), 'newsfit-core' );
	}
	$image_sizes['full'] = __( "Full Size", 'newsfit-core' );

	return $image_sizes;
}
