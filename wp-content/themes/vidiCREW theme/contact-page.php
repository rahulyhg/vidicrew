<?php
/*
Template Name: Contact Page
*/

get_header(); ?>
			
	<div class="content" id="contact-page">
	
	<h2>How can we help you?</h2>
		<div class="inner-content grid-x grid-margin-x grid-padding-x">
	
		    <main class="main small-12 medium-12 large-12 cell" role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php get_template_part( 'parts/loop', 'page' ); ?>
					
				<?php endwhile; endif; ?>							

			</main> <!-- end #main -->
		    
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.3029951732788!2d0.05993195109562039!3d51.50765697953519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a89baf0e93a7%3A0x52af2cd7e63cfe1f!2svidiCREW!5e0!3m2!1sen!2suk!4v1524149923339" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
