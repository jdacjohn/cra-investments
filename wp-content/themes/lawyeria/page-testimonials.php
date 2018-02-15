		<?php
		/**
		 *  The template for displaying Testimonials.
		 *
		 *  @package ThemeIsle.
		 *
		 *	Template Name: Testimonials
		 */
		get_header();

		?>
			<section class="wide-nav">
				<div class="wrapper">
					<h3>
						<?php the_title(); ?>
					</h3><!--/h3-->
				</div><!--/div .wrapper-->
			</section><!--/section .wide-nav-->
		</header>
		<section id="content">
			<div class="wrapper cf">
				<?php
				    $numberofposts_customizer = get_theme_mod( 'ti_testimonials_page_numberofposts' );
				    $testimonials_number_posts = get_post_meta($post->ID, 'ti_testimonials_number_posts', true);

					if($numberofposts_customizer != NULL) {
						$numberofposts = $numberofposts_customizer;
					} elseif($testimonials_number_posts != NULL) {
						$numberofposts = $testimonials_number_posts;
					} else {
						$numberofposts = "99999";
					}
					
					$args = array (
						'post_type'              => 'testimonials',
						'posts_per_page'         => $numberofposts,
						'ignore_sticky_posts'    => true,
						'paged'					 => $paged,
					);

					$testimonials = new WP_Query( $args );

					if ( $testimonials->have_posts() ) : while ( $testimonials->have_posts() ) : $testimonials->the_post();

					$testimonials_position = get_post_meta($post->ID, 'ti_testimonials_position', true);
					$testimonials_company_name = get_post_meta($post->ID, 'ti_testimonials_company_name', true);
					$testimonials_company_url = get_post_meta($post->ID, 'ti_testimonials_company_url', true);

					if ( ( $testimonials_position && $testimonials_company_name ) == NULL ) {
						$at = '';
					} else {
						$at = ' at ';
					}

					if ( ( $testimonials_position && $testimonials_company_name ) == NULL ) {
						$line = '';
					} else {
						$line = '-';
					}
				?>
				<div class="testimonials-post">
					<?php echo testimonials_excerpt(1000); ?>
					<div class="testimonials-client">
					<span><?php the_title(); ?> <?php echo $line; ?> </span>
					<?php echo $testimonials_position; ?> <?php echo $at; ?>
					<?php
					if ( $testimonials_company_url != false ) {
						echo '<a href="'. $testimonials_company_url .'" title="'. $testimonials_company_name .'">'. $testimonials_company_name .'</a>';
					} else {
						echo $testimonials_company_name;
					}
					?>
					</div><!--/div .testimonials-client-->
				</div><!--/div .testimonials-post-->
				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.', 'ti'); ?></p>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div><!--/div .wrapper-->
		</section><!--/section #content-->
		<?php get_footer(); ?>