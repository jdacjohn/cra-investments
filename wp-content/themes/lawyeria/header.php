<?php
/**
 *  The template for displaying Header.
 *
 *  @package ThemeIsle.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta http-equiv="<?php echo get_template_directory_uri();?>/content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta charset="UTF-8">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<!--[if lt IE 9]>
		    <style>
		        #subheader {
                    filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(
                        src='<?php echo get_template_directory_uri(); ?>/images/full-header.jpg',
                        sizingMethod='scale'
                    );
                    -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(
                        src='<?php echo get_template_directory_uri(); ?>/images/full-header.jpg',
                        sizingMethod='scale'
                    )";
                }
		    </style>
		    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="wide-header">
				<div class="wrapper cf">
					<div class="header-left cf">
						<a class="logo" href="<?php echo home_url(); ?>" title="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
                            <?php
                            if ( get_theme_mod( 'ti_header_logo' ) ) {
                                echo '<img src="'. get_theme_mod( 'ti_header_logo' ) .'" alt="'. get_bloginfo( 'name' ) .'" title="'. get_bloginfo( 'name' ) .'" />';
                            } else {
                                echo '<img src="'. get_template_directory_uri() .'/images/header-logo.png" alt="'. get_bloginfo( 'name' ) .'" title="'. get_bloginfo( 'name' ) .'" />';
                            }
                            ?>
						</a><!--/a .logo-->
					</div><!--/div .header-left .cf-->
					<div class="header-contact">
    					<?php
						
							/* contact title */
							
							$ti_header_title = get_theme_mod( 'ti_header_title', __('Contact us now', 'ti') );
    						if ( !empty($ti_header_title) ) {
    							echo $ti_header_title.'<br />';
    						}
    			
							/* contact number */
							
							$ti_header_subtitle = get_theme_mod( 'ti_header_subtitle', __( '+1-888-846-1732', 'ti' ) );
							
    						if ( !empty($ti_header_subtitle) ) {
								echo '<span>';
                                    echo '<a href="tel:'.$ti_header_subtitle.'" title="">'.$ti_header_subtitle.'</a>';
								echo '</span>';
							}

							/* email address */
							$ti_header_email = get_theme_mod('ti_header_email');
							if( !empty($ti_header_email) ):
								echo '<br />';
								echo '<span><a href="mailto:'.$ti_header_email.'">'.$ti_header_email.'</a></span>';
							endif;
						?>
						 
					</div><!--/.header-contact-->
				</div><!--/div .wrapper-->
			</div><!--/div .wide-header-->
			<div class="wrapper cf">
			    <nav>
    				<div class="openresponsivemenu">
    					Open Menu
    				</div><!--/div .openresponsivemenu-->
    				<div class="container-menu cf">
        				<?php
        					wp_nav_menu(
        					    array(
        						        'theme_location' => 'header-menu',
        							)
        						);
        					?>
    				</div><!--/div .container-menu .cf-->
    			</nav><!--/nav .navigation-->
		    </div>