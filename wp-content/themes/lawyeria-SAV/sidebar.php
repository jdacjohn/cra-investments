<?php
/**
 *  The template for displaying Sidebar.
 *
 *  @package ThemeIsle.
 */
?>
<?php if ( is_active_sidebar( 'right-sidebar' ) ) { ?>
	<aside id="sidebar-right">
		<?php dynamic_sidebar( 'right-sidebar' ); ?>
	</aside><!--/aside #sidebar-right-->
<?php } ?>