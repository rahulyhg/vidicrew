<?php
/*
Template Name: Home Page 
*/

get_header(); ?>
			
	<div class="content">
	
		<div class="inner-content grid-x grid-margin-x grid-padding-x">
	
		    <main class="main small-12 medium-12 large-12 cell" role="main">

            <div class="hero-section">
            <div id="color-overlay"></div>
            <div id="video-container">
              <video autoplay loop muted class="fillWidth">
                  <source src="https://storage.googleapis.com/gallery-vidicrew/Beach%20footage.mp4" type="video/mp4"/>
              </video>
            </div><!-- end video-container -->
                <div class="hero-section-text">
                    <h1 id="tag">Real Moments</h1>
                    <h1 id="tag">From Every Perspective</h1>
                    <h4 id="sub">Join forces to capture <strong>real moments</strong> with our new app, and watch as it all comes together</h4>
                    <h5>​Create a CREW of people to capture authentic videos of any occasion, using our free camera app.</h5>
                    <!-- <h5 class="home-content" id="sub">Start Your <strong>Free</strong> Mobile Film CREW Today!</h5> -->
                    <a href="http://localhost:8888/vidicrew/my-account/create/step/group-details/" class="hollow button secondary" id="start"><strong>Start a CREW</strong></a>
                   <!-- <h5 class="home-content" id="sub">Or join a CREW already in action!</h5> -->
                    <!-- THIS LINK NEEDS TO BE UPDATED TO SHOW LIST OF EXISTING CREWS -->
                    <a href="http://localhost:8888/vidicrew/my-account/" class="hollow button secondary" id="join"><strong>Join a CREW</strong></a>
                </div>
                </div>
                
                <!-- How it works section -->

                   <div class="jumbotron jumbotron-fluid" id="how-box">
                            <h1 class="titles">How it Works</h1>
                           <!-- <div class="iphone-mock"></div> -->
                            <div class="how-works">
                                <p>1. Create a CREW</p>
                                <i class="far fa-handshake"></i>
                                <p>Sign up to create a CREW, then send invites to your chosen CREW members.</p>
                            </div>
                            <div class="how-works">
                                <p class="capture">2. Capture video moments</p>
                                <i class="fas fa-mobile-alt"></i>
                                <p>You all download our <strong>free</strong> app and capture moments.</p>
                            </div>
                            <div class="how-works">
                                <p class="upload">3. Upload to gallery</p>
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Choose moments to upload to the online gallery. Where you can download, share, and use for any purpose.</p>
                            </div>
                            
                    </div>


                    <!-- KEY FEATURES SECTION -->
                    <section class="product-feature-section">
                    <div class="product-feature-section-outer">
                        <h1 class="product-feature-section-headline">Key Features</h1>

                        <div class="product-feature-section-inner">

                        <div class="product-feature-section-feature top-left">
                        <i class="fas fa-upload" aria-hidden="true"></i>
                            <div>
                            <h4 class="feature-title"><strong>Collect</strong></h4>
                            <p class="feature-desc">Everything uploaded is instantly collected into a secure, online gallery. So you can see all content from the whole CREW in one place.</p>
                            </div>
                        </div>

                        <div class="product-feature-section-feature top-right">
                        <i class="far fa-calendar-check" aria-hidden="true"></i>
                            <div>
                            <h4 class="feature-title"><strong>Organise</strong></h4>
                            <p class="feature-desc">Your content is organised in time and date order, so it is easy to manage.</p>
                            </div>
                        </div>

                        <div class="product-feature-section-feature bottom-left">
                            <i class="fas fa-video" aria-hidden="true"></i>
                            <div>
                            <h4 class="feature-title"><strong>We can edit your videos</strong></h4>
                            <p class="feature-desc">Our professional editing team can transform your videos into authentic short films.</p>
                            </div>
                        </div>

                        <div class="product-feature-section-feature bottom-right">
                            <div>
                            <a href="http://localhost:8888/vidicrew/edit/" type="button" class="button rounded bordered shadow secondary" id="edit">See more about our video editing service here</a>

                            </div>
                        </div>

                        </div>
                    </div>
                    </section>

                  <!-- Benefits Section -->

                      <div class="jumbotron jumbotron-fluid" id="benefits">
                            <h1 class="titles">Key Benefits</h1>
                            <p class="home-content"><strong>It's FREE!</strong></p>
                            <i class="fas fa-pound-sign"></i>
                            <p>Starting a CREW to capture and collect content is absolutely <strong>free</strong>.</p>
                            <br>
                            <p class="home-content"><strong>Unlimited CREW members</strong></p>
                            <i class="fas fa-users"></i>
                            <p>You can invite as many CREW members as you like, for <strong>any</strong> occasion!</p>
                            <br>
                            <p class="home-content"><strong>Online Storage</strong></p>
                            <i class="fas fa-archive"></i>
                            <p>You can store as much content as you like your secure, online gallery.</p>
                            
                   </div>

                    
<!-- Latest crews -->

 <div class="orbit clean-hero-slider" role="region" aria-label="Favorite Space Pictures" data-orbit>
  <div class="orbit-wrapper">
    <div class="orbit-controls">
      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
      <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
    </div>
    <ul class="orbit-container">
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="http://via.placeholder.com/1350x600" alt="image alt text">
          <figcaption class="orbit-caption">
            <h3>Lorem Ipsum Etiam</h3>
            <p>Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper.</p>
            <a href="#" class="button yellow">Mattis Elit</a>
          </figcaption>
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="http://via.placeholder.com/1350x600" alt="image alt text">
          <figcaption class="orbit-caption">
            <h3>Ipsum Ornare Ultricies</h3>
            <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <a href="#" class="button yellow">Egestas Amet</a>
          </figcaption>
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="http://via.placeholder.com/1350x600" alt="image alt text">
          <figcaption class="orbit-caption">
            <h3>Malesuada Parturient</h3>
            <p>Fusce dapibus, tellus ac cursus commodo, sit amet risus. Cras mattis consectetur purus sit amet fermentum. Maecenas sed diam sit amet non magna.</p>
            <a href="#" class="button yellow">Sollicitudin</a>
          </figcaption>
        </figure>
      </li>
    </ul>
  </div>
  <nav class="orbit-bullets">
    <button class="is-active" data-slide="1"><span class="show-for-sr">Lorem Ipsum Etiam</span></button>
    <button data-slide="2"><span class="show-for-sr">Lorem Ipsum Etiam</span></button>
    <button data-slide="3"><span class="show-for-sr">Lorem Ipsum Etiam</span></button>
  </nav>
</div>

                    <!-- FAQ Section -->

                    <div class="jumbotron jumbotron-fluid" id="faq">
                    <div class="divider"></div>

                        <h1 class="titles">FAQ</h1>
                        <p class="home-content"><strong>How much content can I store in my vidiCREW online gallery?</strong></p>
                        <p>As much as you like! :-)</p>
                        <br>
                        <p class="home-content"><strong>Is there a cut-off point for uploading videos and photos?</strong></em></p>
                        <p>The cut off point is 12 months after you start your CREW.</p>
                        <br>
                        <p class="home-content"><strong>Can I share my content on social media?</strong></p>
                        <p>Yes, we know how engaging this kind of content is on social, so we have made it really simple for you to share to the best-known platforms via our app or website.</p>
                        <br>
                        <p class="home-content"><strong>How much does vidiCREW cost?</strong></p>
                        <p>It’s free! Then once you’re logged on, exciting premium features are available.</p>
                        <br>
                        <p class="home-content"><strong>Can I include photos?</strong></p>
                        <p>So many of you asked for this feature, so it's currently in development.</p>
                        <br>
                        <a href="http://localhost:8888/vidicrew/faq/" type="button" class="button rounded bordered shadow secondary" id="more-faq">MORE FAQ</a>
                    </div>
                
                    <div class="jumbotron jumbotron-fluid">
                        <div id="over-hill-still">

                        </div>
                    </div>

			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php get_footer(); ?>
