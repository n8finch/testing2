<?php

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'footer_content', 12 );

function footer_content(){ ?>
	<footer id="footer">
		<div class="row" id="being-social">
			<div class="medium-4 columns twitter-feed">
				<div class="icon blue-icon twitter">
					<i class="fa fa-twitter"></i>
				</div>
				<?php echo do_shortcode('[custom-twitter-feeds]') ?>
			</div>
			<div class="medium-4 columns maillist">
        <form action="">
          <h5>
            <div class="icon orange-icon envelope">
              <i class="fa fa-envelope"></i>
            </div>
            <span>Get Updates</span>
          </h5>
          <input type="email" placeholder="your email address" />
          <button class="button on-dark-bg">Sign Up</button>
        </form>
      </div>
			<div class="medium-4 columns discuss-project">
				<h3>Let's Discuss Your<br />Next Project</h3>
				<a href="/contact" class="button on-dark-bg">Contact Us</a>
			</div>
		</div>
		<div class="row tagline-credits">
			<div class="medium-5 columns">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php endif; ?>
			</div>
			<div class="medium-7 columns">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</footer>

<?php }
