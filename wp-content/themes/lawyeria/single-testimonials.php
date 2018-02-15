<?php
/**
 *  The template for displaying Single Testimonials.
 *
 *  @package ThemeIsle.
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
        <?php
        $page_testimonials = get_page_by_title( 'Testimonials' );
		$page_testimonials_id = $page_testimonials->ID;
		$page_testimonials_link =  get_page_link($page_testimonials_id);
        ?>
        <meta http-equiv="refresh" content="0;URL='<?php echo $page_testimonials_link; ?>'" />
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    </head>
    <body>
    </body>
</html>