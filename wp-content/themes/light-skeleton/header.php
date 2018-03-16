<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package light_skeleton
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'light-skeleton' ); ?></a>

	<header id="masthead" class="site-header ">
		<div class="site-branding container">
			<?php
			if(!empty(the_custom_logo())){

			    echo the_custom_logo();

            }
            else { ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                          rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	            <?php }


			$description = get_bloginfo( 'description', 'display' );

			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation navbar">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <?php esc_html_e( 'Menu', 'light-skeleton' ); ?>
            </button>



			<?php
            if(has_nav_menu('menu-1')) {
	            wp_nav_menu( array(
		            'theme_location'  => 'menu-1',
		            'menu_id'         => 'primary-menu',
		            'container'       => 'div',
		            'container_class' => 'container',
		            'container_id'    => '',
		            'menu_class'      => 'menu',
		            'menu_id'         => '',
		            'echo'            => true,
		            'fallback_cb'     => 'wp_page_menu',
		            'before'          => '',
		            'after'           => '',
		            'link_before'     => '',
		            'link_after'      => '',
		            'items_wrap'      => '<ul class="navbar-list">%3$s</ul>',
		            'depth'           => 0,
		            'walker'          => ''
	            ) );

            }

            else {

                echo '<div class="container no-menu"> ' .esc_html_e( "Add primary Menu", "light-skeleton" ). '</div>';
            }

			?>
		</nav><!-- #site-navigation -->
        <div class="clear"></div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
