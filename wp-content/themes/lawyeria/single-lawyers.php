<?php
/**
 *  The template for displaying Single Lawyers.
 *
 *  @package ThemeIsle.
 */
get_header();
?>
	<section class="wide-nav">
		<div class="wrapper">
			<h3>
				Lawyer: <?php the_title(); ?>
			</h3><!--/h3-->
		</div><!--/div .wrapper-->
	</section><!--/section .wide-nav-->
</header><!--/header-->
<section id="content">
	<div class="wrapper cf">
		<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		?>
		<div id="lawyers-single">
			<div class="lawyers-single-image">
				<?php
					if ( $featured_image != NULL ) { ?>
						<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
					<?php } else { ?>
						<div class="lawyer-single-no-image">
						</div><!--/div .lawyer-single-no-image-->
					<?php } ?>
				<?php ?>
			</div><!--/div .lawyers-single-image-->
			<div class="lawyers-single-content">
				<?php the_content(); ?>
			</div><!--/div .lawyers-single-content-->
			<div class="lawyers-practice-areas cf">
				<h3>
					<?php
						if ( get_theme_mod( 'ti_lawyer_categories_title' ) != false ) {
							echo get_theme_mod( 'ti_lawyer_categories_title' );
						} else {
							echo _e( 'Practice Areas:', 'ti' );
						}
					?>
				</h3><!--/h3-->
				<ul>
					<?php echo get_the_term_list( $post->ID, 'practiceareas', '<li>', ',</li><li>', '</li>' ); ?>
				</ul><!--/ul-->
			</div><!--/div .lawyers-practice-areas-->
		</div><!--/div #lawyers-single-->
		<?php endwhile; else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.', 'ti'); ?></p>
        <?php endif; ?>
	</div><!--/div .wrapper .cf-->
</section><!--/section #content-->
<?php get_footer(); ?>