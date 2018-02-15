		<?php
		/**
		 *  The template for displaying 404.
		 *
		 *  @package ThemeIsle.
		 */
		get_header();
		?>
			<section class="wide-nav">
				<div class="wrapper">
					<h3>
						<?php
						if ( get_theme_mod( 'ti_404_title' ) ) {
							echo get_theme_mod( 'ti_404_title' );
						} else {
							echo __( '404 Error', 'ti' );
						}
						?>
					</h3><!--/h3-->
				</div><!--/div .wrapper-->
			</section><!--/section .wide-nav-->
		</header>
		<section id="content">
			<div class="wrapper cf">
				<div id="posts">
					<div class="post">
						<div class="post-excerpt">
							<?php
							if ( get_theme_mod( 'ti_404_content' ) ) {
								echo get_theme_mod( 'ti_404_content' );
							} else {
								echo __( 'Oops, I screwed up and you discovered my fatal flaw. Well, we\'re not all perfect, but we try.  Can you try this again or maybe visit our <a title="themeIsle" href="'. home_url() .'">Home Page</a> to start fresh.  We\'ll do better next time.', 'ti' );
							}
							?>
						</div><!--/.post-excerpt-->
					</div><!--/div .post-->
				</div><!--/div #posts-->
				<?php get_sidebar(); ?>
			</div><!--/div .wrapper-->
		</section><!--/section #content-->
		<?php get_footer(); ?>