<?php
/*
Template Name: my-account-page

By J.R.

*/

get_header(); ?>
	<div class="content">
	<!-- User card example #1 -->
<div class="card-user-container">
<h3>Welcome</h3>

<!--user info name, bio and location-->
<div class="card-user-bio">
  <h4><?php echo $user_identity; ?></h4>
</div>
<!--card's image-->
<div class="card-user-avatar">
	<?php global $userdata; echo get_avatar($userdata->ID, 60); ?>
	<p><a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> | 
			<?php if (current_user_can('manage_options')) {
				echo '<a href="' . admin_url() . '">' . __('Admin') . '</a>';
			} ?>
</p>
</div>
</div>

</div>
<!--

	<h3>Welcome <?php echo $user_identity; ?></h3>
	<div class="usericon">
		<?php global $userdata; echo get_avatar($userdata->ID, 60); ?>
	</div>
	<div class="userinfo">
		<p>You&rsquo;re logged in as <strong><?php echo $user_identity; ?></strong></p>
		<p>
			<a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> | 
			<?php if (current_user_can('manage_options')) {
				echo '<a href="' . admin_url() . '">' . __('Admin') . '</a>';
			} ?>

		</p>
	</div>
		-->
	<div class="content" id="fix">

		<div class="inner-content grid-x grid-margin-x grid-padding-x">

		    <main class="main small-12 large-8 medium-8 cell" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>
			    
			    <?php endwhile; endif; ?>							
			    					
			</main> <!-- end #main -->

		    <?php get_sidebar(); ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
