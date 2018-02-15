		<?php
		/**
		 *  The template for displaying Front Page.
		 *
		 *  @package ThemeIsle.
		 */
		get_header();
		?>
<?php if ( function_exists( 'soliloquy' ) ) { soliloquy( '569' ); } ?>		
	<div id="subheader" style="background-image: url('<?php
				if ( get_theme_mod( 'ti_frontpage_subheader_bg' ) != false ) {
				    echo get_theme_mod( 'ti_frontpage_subheader_bg' );
			     } else {
				    echo get_template_directory_uri() . "/images/full-header.jpg";
			    }
			 ?>');">
				<div class="subheader-color cf">
					<div class="wrapper cf">
						<div class="full-header-content <?php if ( get_theme_mod( 'ti_frontpage_contactform7_shortcode' ) ) { } else { echo 'full-header-content-no-sidebar'; } ?>">
							<h3>
								<?php
									if ( get_theme_mod( 'ti_frontpage_header_title' ) != false ) {
										echo get_theme_mod( 'ti_frontpage_header_title' );
									} else {
										echo _e( 'Lorem ipsum dolor sit amet, consectetur adipscing elit.', 'ti' );
									}
								?>
							</h3><!--/h3-->
							<p>
								<?php
									if ( get_theme_mod( 'ti_frontpage_header_content' ) != false ) {
										echo get_theme_mod( 'ti_frontpage_header_content' );
									} else {
										echo _e( 'Ut fermentum aliquam neque, sit amet molestie orci porttitor sit amet. Mauris venenatis et tortor ut ultrices. Nam a neque venenatis, tristique lacus id, congue augue. In id tellus lacus. In porttitor sagittis tellus nec iaculis. Nunc sem odio, placerat a diam vel, varius.', 'ti' );
									}
								?>
							</p><!--/p-->
						</div><!--/div .header-content-->
						<?php
						if ( get_theme_mod( 'ti_frontpage_contactform7_shortcode' ) ) {
							echo '<div class="header-form">';

							if ( get_theme_mod( 'ti_frontpage_contactform7_title' ) ) {
								echo '<p>'. get_theme_mod( 'ti_frontpage_contactform7_title' ) .'</p>';
							}

							echo do_shortcode( get_theme_mod( 'ti_frontpage_contactform7_shortcode' ) );
							echo '</div>';
						}
						?>
					</div><!--/div .wrapper-->
				</div><!--/div .full-header-color-->
				<div class="second-subheader">
					<div class="wrapper">
						<h3>
							<?php
								if ( get_theme_mod( 'ti_frontpage_subheader_title' ) != false ) {
									echo get_theme_mod( 'ti_frontpage_subheader_title' );
								} else {
									echo _e( 'Lorem Ipsum is simply dummy text of the printing and type setting industry.', 'ti' );
								}
							?>
						</h3><!--/h3-->
					</div><!--/div .wrapper-->
				</div><!--/div .second-subheader-->
			</div><!--/div #subheader-->
		</header><!--/header-->

		<?php
						
					$ti_frontpage_firstlybox_icon = get_theme_mod( 'ti_frontpage_firstlybox_icon',get_template_directory_uri().'/images/features-box-icon-one.png' );
					$ti_frontpage_firstlybox_title = get_theme_mod( 'ti_frontpage_firstlybox_title', __('Lorem','ti') );
					$ti_frontpage_firstlybox_content = get_theme_mod( 'ti_frontpage_firstlybox_content', __( 'Go to Appearance - Customize, to add content.', 'ti' ) );	
					$ti_frontpage_firstlybox_link = get_theme_mod( 'ti_frontpage_firstlybox_link' );					
					
					$ti_frontpage_secondlybox_icon = get_theme_mod( 'ti_frontpage_secondlybox_icon',get_template_directory_uri().'/images/features-box-icon-two.png' );
					$ti_frontpage_secondlybox_title = get_theme_mod( 'ti_frontpage_secondlybox_title', __( 'Ipsum', 'ti' ) );
					$ti_frontpage_secondlybox_content = get_theme_mod( 'ti_frontpage_secondlybox_content', __( 'Go to Appearance - Customize, to add content.', 'ti' ) );
					$ti_frontpage_secondlybox_link = get_theme_mod( 'ti_frontpage_secondlybox_link' );
					
					$ti_frontpage_thirdlybox_icon = get_theme_mod( 'ti_frontpage_thirdlybox_icon',get_template_directory_uri().'/images/features-box-three.png' );
					$ti_frontpage_thirdlybox_title = get_theme_mod( 'ti_frontpage_thirdlybox_title',__( 'Dolor', 'ti' ) );
					$ti_frontpage_thirdlybox_content = get_theme_mod( 'ti_frontpage_thirdlybox_content',__( 'Go to Appearance - Customize, to add content.', 'ti' ) );
					$ti_frontpage_thirdlybox_link = get_theme_mod( 'ti_frontpage_thirdlybox_link' );
						
					if ( !empty($ti_frontpage_firstlybox_icon) || !empty($ti_frontpage_firstlybox_title) || !empty($ti_frontpage_firstlybox_content) ||
					!empty($ti_frontpage_secondlybox_icon) || !empty($ti_frontpage_secondlybox_title) || !empty($ti_frontpage_secondlybox_content) ||
					!empty($ti_frontpage_thirdlybox_icon) || !empty($ti_frontpage_thirdlybox_title) || !empty($ti_frontpage_thirdlybox_content) ||
					!empty($ti_frontpage_firstlybox_link) || !empty($ti_frontpage_secondlybox_link) || !empty($ti_frontpage_thirdlybox_link)
					):
					
						echo '<section id="features">';
							echo '<div class="wrapper cf">';
						
							/* box 1 */
						
							if ( !empty($ti_frontpage_firstlybox_icon) || !empty($ti_frontpage_firstlybox_title) || !empty($ti_frontpage_firstlybox_content) ):
						
								echo '<div class="features-box">';
						
								if( !empty($ti_frontpage_firstlybox_link) ):
									echo '<a href="'.$ti_frontpage_firstlybox_link.'">';
								endif;	
							
								if ( !empty($ti_frontpage_firstlybox_icon) ) { ?>
									<div class="features-box-icon"><img src="<?php echo $ti_frontpage_firstlybox_icon; ?>" alt="" title="" /></div>
								<?php 
								}

								if ( !empty($ti_frontpage_firstlybox_title) ) {
									echo '<h4>'.$ti_frontpage_firstlybox_title.'</h4>';
								}
			
								if ( !empty($ti_frontpage_firstlybox_content) ) {
									echo '<p>'.$ti_frontpage_firstlybox_content.'</p>';
								}
								
								if( !empty($ti_frontpage_firstlybox_link) ):
									echo '</a>';
								endif;
								
								echo '</div>';
								
							endif;	
						
							/* box 2 */
						
							if ( !empty($ti_frontpage_secondlybox_icon) || !empty($ti_frontpage_secondlybox_title) || !empty($ti_frontpage_secondlybox_content) ):
							
								echo '<div class="features-box">';

								if( !empty($ti_frontpage_secondlybox_link) ):
									echo '<a href="'.$ti_frontpage_secondlybox_link.'">';
								endif;	
								
								if ( !empty($ti_frontpage_secondlybox_icon) ) { ?>
									<div class="features-box-icon"><img src="<?php echo $ti_frontpage_secondlybox_icon; ?>" alt="" title="" /></div>
								<?php 
								}
							
								
								if ( !empty($ti_frontpage_secondlybox_title) ) {
									echo '<h4>'.$ti_frontpage_secondlybox_title.'</h4>';
								}
							
								
								if ( !empty($ti_frontpage_secondlybox_content) ) {
									echo '<p>'.$ti_frontpage_secondlybox_content.'</p>';
								}
								
								if( !empty($ti_frontpage_secondlybox_link) ):
									echo '</a>';
								endif;
								
								echo '</div>';
						
							endif;
							
							/* box 3 */
							
							if ( !empty($ti_frontpage_thirdlybox_icon) || !empty($ti_frontpage_thirdlybox_title) || !empty($ti_frontpage_thirdlybox_content) ):
							
								echo '<div class="features-box">';
								
								if( !empty($ti_frontpage_thirdlybox_link) ):
									echo '<a href="'.$ti_frontpage_thirdlybox_link.'">';
								endif;
							
								if ( !empty($ti_frontpage_thirdlybox_icon) ) { ?>
									<div class="features-box-icon"><img src="<?php echo $ti_frontpage_thirdlybox_icon; ?>" alt="" title="" /></div>
								<?php 
								}
								
								if ( !empty($ti_frontpage_thirdlybox_title) ) {
									echo '<h4>'.$ti_frontpage_thirdlybox_title.'</h4>';
								}
								
								if ( !empty($ti_frontpage_thirdlybox_content) ) {
									echo '<p>'.$ti_frontpage_thirdlybox_content.'</p>';
								}
								
								if( !empty($ti_frontpage_thirdlybox_link) ):
									echo '</a>';
								endif;
								
								echo '</div>';
								
							endif;	
						echo '</div>';
					echo '</section>';	
					
				endif;	
						
		?>
			
		<section id="content">
			<div class="wrapper">
				<div class="content-article cf" role="main">
					<div class="content-article-image">
						<?php
							if ( get_theme_mod( 'ti_frontpage_thecontent_image' ) != false ) { ?>
								<img src="<?php echo get_theme_mod( 'ti_frontpage_thecontent_image' ); ?>" alt="<?php echo get_theme_mod( 'ti_frontpage_thecontent_title' ); ?>" title="<?php echo get_theme_mod( 'ti_frontpage_thecontent_title' ); ?>" />
							<?php } else { ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/content-article-image.png" alt="<?php echo get_theme_mod( 'ti_frontpage_thecontent_title' ); ?>" title="<?php echo get_theme_mod( 'ti_frontpage_thecontent_title' ); ?>" />
							<?php } ?>
						<?php ?>
					</div><!--/div .content-article-image-->
					<h3>
						<?php
							if ( get_theme_mod( 'ti_frontpage_thecontent_title' ) != false ) {
								echo get_theme_mod( 'ti_frontpage_thecontent_title' );
							} else {
								echo _e( 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.', 'ti' );
							}
						?>
					</h3><!--/h3-->
					<p>
						<?php
							if ( get_theme_mod( 'ti_frontpage_thecontent_content' ) != false ) {
								echo get_theme_mod( 'ti_frontpage_thecontent_content' );
							} else {
								echo _e( 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.', 'ti' );
							}
						?>
					</p><!--/p--><!--/div .content-article .cf-->
				<div class="content-about cf">
					<?php
						dynamic_sidebar( 'Frontpage widgets area' ); 
					?>
				</div><!--/div .content-about-->

				
				
			</div><!--/div .wrapper-->
		</section><!--/section #content-->
		<?php get_footer(); ?>