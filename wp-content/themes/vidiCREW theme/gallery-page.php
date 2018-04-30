<?php
/*
Template Name: gallery-page

By J.R.

*/

get_header(); ?>
			
	<div class="content" id="gallery-content">
	
		<div class="inner-content grid-x grid-margin-x grid-padding-x">
	
		    <main class="main small-12 medium-12 large-12 cell" role="main">

			<?php
			/* Is the user in any crews */
			$user_id = get_current_user_id();
			$args = array(
				'user_id' => $user_id
			);
			if ( bp_has_groups( $args) ) :
			?>

			<ul class="your-crews">

			<?php // For each crew the user is a member of... ?>

			<?php while ( bp_groups() ) : bp_the_group(); ?>

			<li>
				<div class="t-m-list">
					
					<?php // Show crew name ?>

					<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=full' ); ?>
					<h5><?php bp_group_name(); ?></h5>
					</a>

					<?php // Get all other users in this crew ?>

					<?php $group_users = array(); ?>

					<?php 

					if ( bp_group_has_members('group_id=' . bp_get_group_id() . '&exclude_admins_mods=false') ) : 

					?>
						<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

							<?php

							$group_users[] = bp_get_group_member_id();

							?>

						<?php endwhile; ?>

					<?php endif; ?>

					<?php // Get all the videos belonging to the users that belong in this group... ?>

					<?php

					// This is what we're asking the database for

					$args = array(
						'post_type' => 'video', // Post type video
						'meta_query' => array(
							array(
								'key'     => 'owner',
								'value'   => $group_users, // The user(s) who's vids we want
								'compare' => 'IN',
							),
						),
						'meta_query' => array(
							array(
								'key'     => 'crew',
								'value'   => bp_get_group_id(), // The group we are in
								'compare' => 'IN',
							),
						)
					);

					$video_query = new WP_Query($args);

					//print_r($video_query);

					?>

					<?php
					while ( $video_query->have_posts() ) : $video_query->the_post();

						get_template_part( 'parts/content-video', 'video' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>						

					</div>
				</li>

				<?php endwhile; ?>

			</ul>

			<?php else: /* If the user is not in any groups */?>

			<p>You are not in any CREWs</p>

			<?php endif; ?>

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php get_footer(); ?>