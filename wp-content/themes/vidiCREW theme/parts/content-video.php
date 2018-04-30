<?php
/**
 * Template part for displaying page content in gallery_page_template.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage JointsWP-CSS-master
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="vid-wrapper">
	<header class="entry-header" id="vid-title">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php $src = get_post_meta(get_the_ID(), 'wpcf-video-clip', 'true'); ?>

		<?php //twentyseventeen_edit_link( get_the_ID() ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<video class "video" src="<?php echo $src; ?>" controls></video>
	</div><!-- .entry-content -->
</div>
</article><!-- #post-## -->