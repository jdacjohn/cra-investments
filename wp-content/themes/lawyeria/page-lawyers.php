		<?php
		/**
		 *  The template for displaying Page Lawyers.
		 *
		 *  @package ThemeIsle.
		 *
		 *	Template Name: Lawyers
		 */
		get_header();

		$lawyers_options = get_post_meta($post->ID, 'ti_lawyers_options', true);
		?>
			<section class="wide-nav">
				<div class="wrapper">
					<h3>
						<?php the_title(); ?>
					</h3><!--/h3-->
				</div><!--/div .wrapper-->
			</section><!--/section .wide-nav-->
		</header><!--/header-->
		<section id="content">
			<div class="wrapper cf">
				<div id="lawyers-content" class="cf">
					<div class="lawyers-content-title">
						<?php echo $lawyers_options; ?>
					</div><!--/div .lawyers-content-title-->
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="lawyers-content-entry">
						<?php the_content(); ?>
					</div><!--/div .lawyers-content-entry-->
					<?php endwhile; else: ?>
                    	<p><?php _e('Sorry, no posts matched your criteria.', 'ti'); ?></p>
                	<?php endif; ?>
					<div class="lawyers-content-lawyers cf">
						<?php
							$args = array (
								'post_type'              => 'lawyers',
								'posts_per_page'         => '6',
								'ignore_sticky_posts'    => true,
								'paged'					 => $paged,
							);

							$lawyers = new WP_Query( $args );

							if ( $lawyers->have_posts() ) : while ( $lawyers->have_posts() ) : $lawyers->the_post();
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
						?>
						<div class="lawyer">
							<div class="lawyer-image">
								<?php
									if ( $featured_image != NULL ) { ?>
										<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" />
									<?php } else { ?>
										<div class="lawyer-no-image">
										</div><!--/div .lawyer-no-image-->
									<?php } ?>
								<?php ?>
							</div><!--/div .lawyer-image-->
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="lawyer-name">
								<?php the_title(); ?>
							</a><!--/a .lawyer-name-->
							<div class="lawyer-entry">
								<?php the_excerpt(); ?>
							</div><!--/p .lawyer-entry-->
							<?php echo get_the_term_list( $post->ID, 'practiceareas', '', ', ' ); ?>
						</div><!--/div .lawyer-->
						<?php endwhile; else: ?>
							<p><?php _e('Sorry, no posts matched your criteria.', 'ti'); ?></p>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					</div><!--/div .lawyers-content-lawyers .cf-->
				</div><!--/div #lawyers-content .cf-->
			</div><!--/div .wrapper-->
		</section><!--/section #content-->
		<?php get_footer(); ?>