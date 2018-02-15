		<?php
		/**
		 *	The template for displaying Archive.
		 *
		 *	@package ThemeIsle.
		 */
		get_header();
		?>
			<section class="wide-nav">
				<div class="wrapper">
					<h3>
						<?php
							$category_archive = get_the_category();
							$author_archive = get_the_author();
							$search_archive = get_search_query();
							if ( is_day() ) {
								printf( __( 'Daily Archives: %s', 'ti' ), get_the_date() );
							} elseif ( is_month() ) {
								printf( __( 'Monthly Archives: %s', 'ti' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ti' ) ) );
							} elseif ( is_year() ) {
								printf( __( 'Yearly Archives: %s.', 'ti' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ti' ) ) );
							} elseif ( is_category() ) {
								echo _e( 'Category: ', 'ti' ) . single_cat_title();
							} elseif ( is_author() ) {
								echo _e( 'Author: ', 'ti' ) . $author_archive;
							}
						?>
					</h3><!--/h3-->
				</div><!--/div .wrapper-->
			</section><!--/section .wide-nav-->
		</header>
		<section id="content">
			<div class="wrapper cf">
				<div id="posts">
					<?php
						if ( have_posts() ) : while ( have_posts() ) : the_post();
						$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
						<h3 class="post-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_title(); ?>
							</a><!--/a-->
						</h3><!--/h3 .post-title-->
						<div class="post-meta">
							<span>
								<?php echo get_the_date(); ?> - Posted by: <?php the_author_posts_link(); ?> - In category: <?php the_category(', '); ?> - <a href="<?php the_permalink(); ?>#comments-template" title="<?php comments_number( 'No responses', 'One comment', '% comments' ); ?>"><?php comments_number( 'No responses', 'One comment', '% comments' ); ?></a>
							</span><!--/span-->
						</div><!--/div .post-meta-->
						<?php
							if ( $feat_image != NULL ) { ?>
								<div class="post-image">
									<img src="<?php echo $feat_image[0]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
								</div><!--/.post-image-->
							<?php } ?>
						<div class="post-excerpt">
							<?php the_excerpt(); ?>
						</div><!--/div .post-excerpt-->
						<a href="<?php the_permalink(); ?>" title="Read More" class="read-more">
							<span>Read More</span>
						</a><!--/a .read-more-->
					</div><!--/div .post-->
					<?php endwhile; else: ?>
                    	<p><?php _e('Sorry, no posts matched your criteria.', 'ti'); ?></p>
                	<?php endif; ?>
					<div class="posts-navigation">
						<?php next_posts_link(esc_attr__('Prev', 'ti')); ?>
						<?php previous_posts_link(esc_attr__('Next', 'ti')); ?>
					</div><!--/div .posts-navigation-->
				</div><!--/div #posts-->
				<?php get_sidebar(); ?>
			</div><!--/div .wrapper-->
		</section><!--/section #content-->
		<?php get_footer(); ?>