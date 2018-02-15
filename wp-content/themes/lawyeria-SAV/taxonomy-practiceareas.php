		<?php
		/**
		 *  The template for displaying Taxonmy Practice Areas.
		 *
		 *  @package ThemeIsle.
		 */
		get_header();
		?>
			<section class="wide-nav">
				<div class="wrapper">
					<h3>
						<?php
							if ( get_theme_mod( 'ti_practicearea_navigation_title' ) != false ) {
								echo get_theme_mod( 'ti_practicearea_navigation_title' );
							} else {
								echo _e( 'Practice Area', 'ti' );
							}
						?> -
						<span>
							<?php
								$taxonomy_category = $wp_query->queried_object;
								echo $taxonomy_category->name;
							?>
						</span><!--/span-->
					</h3><!--/h3-->
				</div><!--/div .wrapper-->
			</section><!--/section .wide-nav-->
		</header><!--/header-->
		<section id="content">
			<div class="wrapper cf">
				<div class="practice-areas-content">
					<?php
						if ( get_theme_mod( 'ti_practicearea_content' ) != false ) {
							echo get_theme_mod( 'ti_practicearea_content' );
						} else {
							echo 'Enter in Customizer page from admin panel and add the content.';
						}
					?>
				</div><!--/div .practice-areas-content-->
				<div id="lawyers-post-type">
					<h3>
						<?php $taxonomy_category = $wp_query->queried_object; echo $taxonomy_category->name; ?> <?php _e( 'lawyers', 'ti' ); ?>
					</h3><!--/h3-->
					<div class="lawyers-posts cf">

						<?php
							if ( have_posts() ) : while ( have_posts() ) :the_post();
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
						?>

						<article>
							<?php
								if ( $featured_image != NULL ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-image: url('<?php echo $featured_image[0]; ?>');" class="lawyers-posts-image">
									</a><!--/a-->
								<?php } else { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="lawyers-posts-no-image">
									</a><!--/a .lawyers-posts-no-image-->
								<?php } ?>
							<?php ?>
							<div class="lawyer-post-name">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a><!--/a-->
							</div><!--/div .lawyer-post-name-->
							<div class="lawyer-post-description">
								<?php the_excerpt(); ?>
							</div><!--/div .lawyer-post-description-->
						</article><!--/article-->

						<?php endwhile; else: ?>
							<p class="lawyers-no-posts">
	                    		<?php _e('Sorry, no posts matched your criteria.', 'ti'); ?>
	                    	</p><!--/p .lawyers-no-posts-->
	                	<?php endif; ?>

					</div><!--/div .lawyers-post-->
					<h3>
						<?php
							if ( get_theme_mod( 'ti_practicearea_categories_title' ) != false ) {
								echo get_theme_mod( 'ti_practicearea_categories_title' );
							} else {
								echo _e( 'See lawyers from other practice areas:', 'ti' );
							}
						?>
					</h3><!--/h3-->
					<ul class="practice-areas-lists cf">
						<?php
							$get_taxonomy = get_terms( 'practiceareas' );
							foreach ( $get_taxonomy as $taxonomy_category ) {
								$taxonomy_category = sanitize_term( $taxonomy_category, 'lawyers' );
								$term_link = get_term_link( $taxonomy_category, 'lawyers' ); ?>
								<li>
									<a href="<?php echo esc_url( $term_link ); ?>" title="<?php echo $taxonomy_category->name; ?>" class="tooltip">
										<?php echo $taxonomy_category->name; ?>
									</a><!--/a-->
								</li><!--/li-->
							<?php } ?>
						<?php ?>
					</ul><!--/ul .practice-areas-lists .cf-->
				</div><!--/div #lawyers-post-type-->
			</div><!--/div .wrapper-->
		</section><!--/section #content-->
<?php get_footer(); ?>