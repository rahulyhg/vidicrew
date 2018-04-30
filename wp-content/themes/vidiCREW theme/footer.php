<?php
/**
 * The template for displaying the footer. 
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */			
 ?>
					
				<footer class="footer" role="contentinfo">
					
					<div class="inner-footer grid-x grid-margin-x grid-padding-x">
						
						<div class="small-12 medium-12 large-12 cell">
							<nav role="navigation">
	    						<?php joints_footer_links(); ?>
	    					</nav>
	    				</div>
				
						<!-- copyright info -->
							
							<p id = "copyright" class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
							
							<div id="love">
								<p>Made with<i class="fas fa-heart" id="heart"></i>in London</p>
							</div>


					<!-- app store links -->
					<a class="apps" href="https://play.google.com/store/apps/details?id=com.vidicrew.android">
						<img class ="and-app"alt="Get it on Google Play"
						src="https://developer.android.com/images/brand/en_generic_rgb_wo_60.png" />
					</a>

					<a class="apps" href="https://itunes.apple.com/gb/app/vidicrew/id1234364242?mt=8" style="display:inline-block;background:url(https://linkmaker.itunes.apple.com/assets/shared/badges/en-us/appstore-lrg.svg) no-repeat;width:135px;height:40px;background-size:contain;overflow:hidden;margin-left:70px;"></a>


						</div> <!-- end #inner-footer -->
				
				</footer> <!-- end .footer -->
			
			</div>  <!-- end .off-canvas-content -->
					
		</div> <!-- end .off-canvas-wrapper -->
		
		<?php wp_footer(); ?>
		
	</body>
	
</html> <!-- end page -->