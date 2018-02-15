<?php

/**
 *  Require Once
 */
require_once( 'includes/custom-functions.php' );
require_once( 'includes/metaboxes/example-functions.php' );
require_once( 'includes/customizer.php' );
require_once( 'includes/widgets.php' );
require_once( 'includes/tgm-plugin-activation/tgm-plugin-activation.php' );


if ( ! function_exists( 'lawyeria_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lawyeria_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lawyeria, use a find and replace
	 * to change 'lawyeria' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lawyeria', get_template_directory() . '/languages' );
	
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'our_lawyes_thumb', 300, 300, true );
	}

}

endif;

add_action( 'after_setup_theme', 'lawyeria_setup' );

/**
 *  CWP WP Title
 */
function cwp_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'lawyeria' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'cwp_wp_title', 10, 2 );

/**
 *  Content Width
 */
if ( ! isset( $content_width ) ) $content_width = 634;

add_theme_support( 'automatic-feed-links' );

/**
 *  WP Enqueue Style
 */
function wp_enqueue_style_lawyeria() {
	
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), '1.0' );
	
}

add_action( 'wp_enqueue_scripts', 'wp_enqueue_style_lawyeria' );

/**
 *  WP Enqueue Script
 */
function wp_enqueue_scripts_lawyeria() {
    wp_enqueue_script( 'jquery');
	
    wp_enqueue_script( 'carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array( 'jquery' ), '6.2.1', true );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/jquery.masonry.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0', true );
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}

add_action( 'wp_enqueue_scripts', 'wp_enqueue_scripts_lawyeria' );

/**
 *  Header Menu
 */
function header_menu() {

	$locations = array(
		'header-menu' => __( 'This menu will appear in header.', 'lawyeria' ),
	);
	register_nav_menus( $locations );

}

add_action( 'init', 'header_menu' );

/**
 *  Post Thumbnail
 */
add_theme_support( 'post-thumbnails' );

/**
 *  Add classes for next and previous navigation
 */
add_filter('next_posts_link_attributes', 'posts_link_attributes_prev');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_next');

function posts_link_attributes_prev() {
    return 'class="left-navigation"';
}

function posts_link_attributes_next() {
    return 'class="right-navigation"';
}

/**
 *  Add classes for next and previous post
 */
function posts_link_next_class($format){
     $format = str_replace('href=', 'class="next-post" href=', $format);
     return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="previous-post" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');

/************************************************/
/*************** Sidebars ***********************/
/***********************************************/

add_action( 'widgets_init', 'lawyeria_sidebars' );

function lawyeria_sidebars() {
	
	/**
	 *  Footer Sidebar - One
	 */

    $args_footer = array(
        'id'            => 'footer-sidebar',
        'name'          => __( 'Footer Sidebar', 'lawyeria' ),
        'description'   => __( 'In this sidebar you cand add max. three widgets.', 'lawyeria' ),
        'before_title'  => '<div class="footer-box-title">',
        'after_title'   => '</div>',
        'before_widget' => '<div id="%1$s" class="footer-box %2$s">',
        'after_widget'  => '</div>',
    );
    register_sidebar( $args_footer );
	
	/**
	 *  Right Sidebar
	 */
	$args_right = array(
		'id'            => 'right-sidebar',
		'name'          => __( 'General Sidebar', 'lawyeria' ),
		'description'   => __( 'Use this sidebar to display widgets in your website, including posts and pages.', 'lawyeria' ),
		'before_title'  => '<div class="title-widget">',
		'after_title'   => '</div>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args_right );
}



/**
 *  Shape Comment
 */
if ( ! function_exists( 'shape_comment' ) ) :

function shape_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'lawyeria' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'lawyeria' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <?php echo get_avatar( $comment, 120 ); ?>
            <div class="comment-entry">
                <div class="comment-entry-head">
                    <?php printf( __( '<span>%s</span>', 'lawyeria' ), sprintf( '%s', get_comment_author_link() ) ); ?> -
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-entry-head-date">
                        <time pubdate datetime="<?php comment_time( 'c' ); ?>">
                            <?php printf( __( '%1$s at %2$s', 'lawyeria' ), get_comment_date(), get_comment_time() ); ?>
                        </time>
                    </a><!--/a .comment-entry-head-date-->
                    <?php edit_comment_link( __( 'Edit', 'lawyeria' ), '- ' ); ?>
                </div><!--/div .comment-entry-head-->
                <div class="comment-entry-content">
                    <?php comment_text(); ?>
                </div><!--/div .comment-entry-content-->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="awaiting-moderation cf"><?php _e( 'Your comment is awaiting moderation.', 'lawyeria' ); ?></em><br />
                <?php endif; ?>
                <div class="coment-reply-link-div cf">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!--/div .coment-reply-link-div-->
            </div><!--/div .comment-entry-->
        </article><!--/article-->

    <?php
            break;
    endswitch;
}
endif;

/**
 *  Post Gallery
 */
add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';
    // Here's your actual output, you may customize it to your need
    $output = "<div id='custom-gallery gallery-". $post->ID ."' class='gallery galleryid-". $post->ID ." gallery-columns-". $columns ."'>\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {

        $img = wp_get_attachment_image_src($id, 'full');

        $output .= "<dl class='gallery-item gallery-columns-". $columns ."'>";
        $output .= "<a href=\"{$img[0]}\" rel='post-". $post->ID ."' class=\"fancybox\" title='". $attachment->post_excerpt ."'>\n";
        $output .= "<div class='gallery-item-thumb'><img src=\"{$img[0]}\" alt='". $attachment->post_excerpt ."' /></div>\n";
        $output .= "<div class='wp-caption-text'>";
        $output .= $attachment->post_excerpt;
        $output .= "</div>";
        $output .= "</a>\n";
        $output .= "</dl>";
    }

    $output .= "</div>\n";

    return $output;
}

/**
 *  Custom Post Type: Testimonials
 */
function testimonials() {

    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'lawyeria' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'lawyeria' ),
        'menu_name'           => __( 'Testimonials', 'lawyeria' ),
        'parent_item_colon'   => __( 'Parent Testimonial:', 'lawyeria' ),
        'all_items'           => __( 'All Testimonials', 'lawyeria' ),
        'view_item'           => __( 'View Testimonial', 'lawyeria' ),
        'add_new_item'        => __( 'Add New Testimonial', 'lawyeria' ),
        'add_new'             => __( 'Add New Testimonial', 'lawyeria' ),
        'edit_item'           => __( 'Edit Testimonial', 'lawyeria' ),
        'update_item'         => __( 'Update Testimonial', 'lawyeria' ),
        'search_items'        => __( 'Search Testimonial', 'lawyeria' ),
        'not_found'           => __( 'Not found Testimonial', 'lawyeria' ),
        'not_found_in_trash'  => __( 'Not found Testimonial in Trash', 'lawyeria' ),
    );
    $args = array(
        'label'               => __( 'testimonials', 'lawyeria' ),
        'description'         => __( 'Description for testimonials.', 'lawyeria' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'custom-fields', ),
        'taxonomies'          => array(),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-admin-comments',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'testimonials', $args );

}

add_action( 'init', 'testimonials', 0 );

/**
 *  Custom Post Type: Lawyer
 */
function lawyers() {

    $labels = array(
        'name'                => _x( 'Lawyers', 'Post Type General Name', 'lawyeria' ),
        'singular_name'       => _x( 'Lawyer', 'Post Type Singular Name', 'lawyeria' ),
        'menu_name'           => __( 'Lawyers', 'lawyeria' ),
        'parent_item_colon'   => __( 'Parent Lawyer:', 'lawyeria' ),
        'all_items'           => __( 'All Lawyers', 'lawyeria' ),
        'view_item'           => __( 'View Lawyer', 'lawyeria' ),
        'add_new_item'        => __( 'Add New Lawyer', 'lawyeria' ),
        'add_new'             => __( 'Add New Lawyer', 'lawyeria' ),
        'edit_item'           => __( 'Edit Lawyer', 'lawyeria' ),
        'update_item'         => __( 'Update Lawyer', 'lawyeria' ),
        'search_items'        => __( 'Search Lawyer', 'lawyeria' ),
        'not_found'           => __( 'Not found Lawyer', 'lawyeria' ),
        'not_found_in_trash'  => __( 'Not found Lawyer in Trash', 'lawyeria' ),
    );
    $args = array(
        'label'               => __( 'lawyers', 'lawyeria' ),
        'description'         => __( 'Description for lawyers.', 'lawyeria' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
        'taxonomies'          => array(),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-admin-users',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'lawyers', $args );

}

add_action( 'init', 'lawyers', 0 );

/**
 *  Taxonomy: Lawyers Categories
 */
function lawyers_categories() {
    $labels = array(
        'name'              => _x( 'Practice Areas', 'taxonomy general name', 'lawyeria' ),
        'singular_name'     => _x( 'Practice Areas', 'taxonomy singular name', 'lawyeria' ),
        'search_items'      => __( 'Search Practice Areas', 'lawyeria' ),
        'all_items'         => __( 'All Practice Areas', 'lawyeria' ),
        'parent_item'       => __( 'Parent Practice Area', 'lawyeria' ),
        'parent_item_colon' => __( 'Parent Practice Area:', 'lawyeria' ),
        'edit_item'         => __( 'Edit Practice Area', 'lawyeria' ),
        'update_item'       => __( 'Update Practice Area', 'lawyeria' ),
        'add_new_item'      => __( 'Add New Practice Area', 'lawyeria' ),
        'new_item_name'     => __( 'New Practice Area', 'lawyeria' ),
        'menu_name'         => __( 'Practice Areas', 'lawyeria' ),
        'rewrite' => array('slug' => 'practiceareas', 'with_front' => true),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui'           => true,
        'exclude_from_search' => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => false
    );
    register_taxonomy( 'practiceareas', 'lawyers', $args );
}
add_action( 'init', 'lawyers_categories', 0 );


function lawyeria_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'lawyeria_rewrite_flush' );

/**
 *  Testimonials Widget
 */
add_action( 'widgets_init', 'testimonials_widget' );

function testimonials_widget() {
    register_widget( 'Testimonials_Widget' );
}

class Testimonials_Widget extends WP_Widget {

    function Testimonials_Widget() {
        $widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays the latest testimonials.', 'lawyeria') );

        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'testimonials_widget' );

        $this->WP_Widget( 'testimonials_widget', __('Testimonials', 'lawyeria'), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

        //Our variables from the widget settings.
        $title = apply_filters('widget_title', $instance['title'] );
        $testimonials_number_posts = $instance['testimonials_number_posts'];

        echo $before_widget;

        // Display the widget title
        if ( $title )
            echo $before_title . $title . $after_title; ?>

        <div class="widget-testimonials cf">
            <div class="list_carousel">
                <ul id="foo2">
                    <?php
                        $args = array (
                            'post_type'              => 'testimonials',
                            'posts_per_page'         => $testimonials_number_posts,
                            'ignore_sticky_posts'    => true
                        );

                        $testimonials = new WP_Query( $args );

                        if ( $testimonials->have_posts() ) : while ( $testimonials->have_posts() ) : $testimonials->the_post();
                        global $post;

                        $testimonials_position = get_post_meta($post->ID, 'ti_testimonials_position', true);
                        $testimonials_company_name = get_post_meta($post->ID, 'ti_testimonials_company_name', true);
                        $testimonials_company_url = get_post_meta($post->ID, 'ti_testimonials_company_url', true);

                        if ( ( $testimonials_position && $testimonials_company_name ) == NULL ) {
						    $at = '';
					    } else {
						    $at = ' at ';
					    }
                        ?>
                    <li>
                        <div class="list_carousel_entry">
                            <?php echo testimonials_excerpt(50); ?>
                        </div><!--/div .list_carousel_entry-->
                        <div class="list_carousel_customer">
                            <span><?php the_title(); ?></span><br />
                            <?php echo $testimonials_position; ?> <?php echo $at; ?>
                            <?php
        					if ( $testimonials_company_url != false ) {
        						echo '<a href="'. $testimonials_company_url .'" title="'. $testimonials_company_name .'">'. $testimonials_company_name .'</a>';
        					} else {
        						echo $testimonials_company_name;
        					}
					        ?>
                        </div><!--/div .list_carousel_customer-->
                    </li><!--/li-->

                    <?php endwhile; else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.', 'lawyeria'); ?></p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </ul><!--/ul-->
                <div class="clearfix"></div>
                <a id="prev2" class="prev" href="#"></a>
                <a id="next2" class="next" href="#"></a>
            </div><!--/div .list_carousel-->

        </div><!--/div .widget-testimonials-->

        <?php echo $after_widget;
    }

    //Update the widget

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['testimonials_number_posts'] = strip_tags( $new_instance['testimonials_number_posts'] );

        return $instance;
    }


    function form( $instance ) {

        //Set up some default widget settings.
        $defaults = array( 'title' => __('Testimonials', 'lawyeria'), 'testimonials_number_posts' => __('2', 'lawyeria') );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'testimonials_number_posts' ); ?>"><?php _e('Number of testimonials:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'testimonials_number_posts' ); ?>" name="<?php echo $this->get_field_name( 'testimonials_number_posts' ); ?>" value="<?php echo $instance['testimonials_number_posts']; ?>" style="width:100%;" />
        </p>

    <?php
    }
}

/**
 *  Practice Areas Widget
 */
add_action( 'widgets_init', 'practiceareas_widget' );


function practiceareas_widget() {
    register_widget( 'PracticeAreas_Widget' );
}

class PracticeAreas_Widget extends WP_Widget {

    function PracticeAreas_Widget() {
        $widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays the Practice Areas.', 'lawyeria') );

        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'practiceareas_widget' );

        $this->WP_Widget( 'practiceareas_widget', __('Practice Areas', 'lawyeria'), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

        //Our variables from the widget settings.
		if( !empty($instance['title']) ):
			$title = apply_filters('widget_title', $instance['title'] );
		endif;	

        echo $before_widget;

        // Display the widget title
        if ( !empty($title) ):
            echo $before_title . $title . $after_title;
		endif;
		?>

        <div class="widget-practice-area">
            <ul>
                <?php
                    $get_taxonomy = get_terms( 'practiceareas' );
                    foreach ( $get_taxonomy as $taxonomy_category ) {
                        $taxonomy_category = sanitize_term( $taxonomy_category, 'lawyers' );
                        $term_link = get_term_link( $taxonomy_category, 'lawyers' ); ?>
                        <li>
                            <a href="<?php echo esc_url( $term_link ); ?>" title="<?php echo $taxonomy_category->name; ?>" class="tooltip">
                                <?php echo $taxonomy_category->name; ?>
                                <span>
                                    <?php echo $taxonomy_category->description; ?>
                                </span><!--/span-->
                            </a><!--/a-->
                        </li><!--/li-->
                    <?php } ?>
                <?php ?>
            </ul><!--/ul-->
        </div><!--/div .widget-practice-area-->

        <?php echo $after_widget;
    }

    //Update the widget

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }


    function form( $instance ) {

        //Set up some default widget settings.
        $defaults = array( 'title' => __('Practice Areas', 'lawyeria') );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Titlee:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>" style="width:100%;" />
        </p>

    <?php
    }
}

/**
 *  Our Lawyers Widget
 */

class OurLawyers_Widget extends WP_Widget {

    function OurLawyers_Widget() {
        $widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays the latest lawyers.', 'lawyeria') );

        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'ourlawyers_widget' );

        $this->WP_Widget( 'ourlawyers_widget', __('Our Lawyers', 'lawyeria'), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

        //Our variables from the widget settings.
        $title = apply_filters('widget_title', $instance['title'] );
        $ourlawyers_number_posts = $instance['ourlawyers_number_posts'];

        echo $before_widget;

        // Display the widget title
        if ( $title )
            echo $before_title . $title . $after_title; ?>

        <div class="widget-our-lawyers cf">

            <?php
                $args_lawyers = array (
                    'post_type'              => 'lawyers',
                    'posts_per_page'         => $ourlawyers_number_posts,
                    'ignore_sticky_posts'    => true
                );

                $lawyers = new WP_Query( $args_lawyers );

                if ( $lawyers->have_posts() ) : while ( $lawyers->have_posts() ) : $lawyers->the_post();
				
                $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
            ?>

            <?php
                if ( $featured_image != NULL ) { ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="lawyer" style="background-image: url('<?php echo $featured_image[0]; ?>'); ?>"></a><!--/a.lawyer-->
                <?php } else { ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="lawyer lawyer-no-image"></a><!--/a .lawyer .lawyer-no-image-->
                <?php }
            ?>

            <?php endwhile; else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.', 'lawyeria'); ?></p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

        </div><!--/div .widget-our-lawyers-->

        <?php echo $after_widget;
    }

    //Update the widget

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['ourlawyers_number_posts'] = strip_tags( $new_instance['ourlawyers_number_posts'] );

        return $instance;
    }


    function form( $instance ) {

        //Set up some default widget settings.
        $defaults = array( 'title' => __('Our Lawyers', 'lawyeria'), 'ourlawyers_number_posts' => __('4', 'lawyeria') );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'ourlawyers_number_posts' ); ?>"><?php _e('Number of posts:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'ourlawyers_number_posts' ); ?>" name="<?php echo $this->get_field_name( 'ourlawyers_number_posts' ); ?>" value="<?php echo $instance['ourlawyers_number_posts']; ?>" style="width:100%;" />
        </p>

    <?php
    }
}

/**
 *  About Us Widget
 */
add_action( 'widgets_init', 'aboutus_widget' );


function aboutus_widget() {
    register_widget( 'AboutUs_Widget' );
}

class AboutUs_Widget extends WP_Widget {

    function AboutUs_Widget() {
        $widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays the "about us".', 'lawyeria') );

        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'aboutus_widget_one' );

        $this->WP_Widget( 'aboutus_widget_one', __('About us', 'lawyeria'), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

        //Our variables from the widget settings.
        $title = apply_filters('widget_title', $instance['title'] );
        $aboutus_content = $instance['aboutus_content'];

        echo $before_widget;

        // Display the widget title
        if ( $title )
            echo $before_title . $title . $after_title; ?>

        <div class="footer-box-entry">
            <?php if( !empty($aboutus_content) ): echo $aboutus_content; endif; ?>
        </div><!--/div .footer-box-entry-->

        <?php echo $after_widget;
    }

    //Update the widget

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['aboutus_content'] = strip_tags( $new_instance['aboutus_content'] );

        return $instance;
    }


    function form( $instance ) {

        //Set up some default widget settings.
        $defaults = array( 'title' => __('About us', 'lawyeria'), 'aboutus_content' => __('Lorem Ipsum description.', 'lawyeria') );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'aboutus_content' ); ?>"><?php _e('Content:', 'lawyeria'); ?></label>
            <textarea id="<?php echo $this->get_field_id( 'aboutus_content' ); ?>" name="<?php echo $this->get_field_name( 'aboutus_content' ); ?>" value="<?php echo $instance['aboutus_content']; ?>" style="width:100%; height: 200px;">
                <?php if( !empty($aboutus_content) ): echo $aboutus_content; endif; ?>
            </textarea>
        </p>

    <?php
    }
}

/**
 *  Contact Us Widget
 */
add_action( 'widgets_init', 'contactus_widget' );


function contactus_widget() {
    register_widget( 'ContactUs_Widget' );
}

class ContactUs_Widget extends WP_Widget {

    function ContactUs_Widget() {
        $widget_ops = array( 'classname' => 'example', 'description' => __('A widget that displays the "contact us".', 'lawyeria') );

        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contactus_widget_two' );

        $this->WP_Widget( 'contactus_widget_two', __('Contact Us', 'lawyeria'), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );

        //Our variables from the widget settings.
		if( !empty($instance['title']) ):
			$title = apply_filters('widget_title', $instance['title'] );
		endif;
		if( !empty($instance['contactus_address_one']) ):
			$contactus_address_one = $instance['contactus_address_one'];
		endif;
		if( !empty($instance['contactus_address_two']) ):
			$contactus_address_two = $instance['contactus_address_two'];
		endif;
		if( !empty($instance['contactus_address_telephone']) ):
			$contactus_address_telephone = $instance['contactus_address_telephone'];
		endif;
		if( !empty($instance['contactus_address_email']) ):
			$contactus_address_email = $instance['contactus_address_email'];
		endif;
		if( !empty($instance['contactus_linkedin_link']) ):
			$contactus_linkedin_link = $instance['contactus_linkedin_link'];
		endif;
		if( !empty($instance['contactus_twitter_link']) ):
			$contactus_twitter_link = $instance['contactus_twitter_link'];
		endif;
		if( !empty($instance['contactus_facebook_link']) ):
			$contactus_facebook_link = $instance['contactus_facebook_link'];
		endif;
		if( !empty($instance['contactus_googleplus_link']) ):
			$contactus_googleplus_link = $instance['contactus_googleplus_link'];
		endif;
		if( !empty($instance['contactus_vimeo_link']) ):
			$contactus_vime_link = $instance['contactus_vimeo_link'];
		endif;
		
        echo $before_widget;

        // Display the widget title
        if ( !empty($title) ):
            echo $before_title . $title . $after_title; 
		endif;	
		?>

        <div class="footer-box-entry">
            <span>
                <?php
                    if ( !empty($contactus_address_one) ) {
                        echo $contactus_address_one . '<br />';
                    }

                    if ( !empty($contactus_address_two) ) {
                        echo $contactus_address_two;
                    }
                ?>
            </span><!--/p-->
            <span>
                <?php
                    if ( !empty($contactus_address_telephone) ) {
                        echo $contactus_address_telephone . '<br />';
                    }

                    if ( !empty($contactus_address_email) ) {
                        echo $contactus_address_email;
                    }
                ?>
            </span><!--/p-->
            <div class="footer-socials">
                <?php
                    if ( !empty($contactus_linkedin_link) ) {
                        echo '<a href="' . $contactus_linkedin_link . '" title="LinkedIn" class="social-button icon-linkedin" target="_blank"></a>';
                    }

                    if ( !empty($contactus_twitter_link) ) {
                        echo '<a href="' . $contactus_twitter_link . '" title="Twitter" class="social-button icon-twitter" target="_blank"></a>';
                    }

                    if ( !empty($contactus_facebook_link) ) {
                        echo '<a href="' . $contactus_facebook_link . '" title="Facebook" class="social-button icon-facebook" target="_blank"></a>';
                    }

                    if ( !empty($contactus_googleplus_link) ) {
                        echo '<a href="' . $contactus_googleplus_link . '" title="Google+" class="social-button icon-googleplus" target="_blank"></a>';
                    }

                    if ( !empty($contactus_vime_link) ) {
                        echo '<a href="' . $contactus_vime_link . '" title="Vimeo" class="social-button icon-vimeo" target="_blank"></a>';
                    }
                ?>
            </div><!--/div .footer-socials-->
        </div><!--/div .footer-box-entry-->

        <?php echo $after_widget;
    }

    //Update the widget

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['contactus_address_one'] = strip_tags( $new_instance['contactus_address_one'] );
        $instance['contactus_address_two'] = strip_tags( $new_instance['contactus_address_two'] );
        $instance['contactus_address_telephone'] = strip_tags( $new_instance['contactus_address_telephone'] );
        $instance['contactus_address_email'] = strip_tags( $new_instance['contactus_address_email'] );
        $instance['contactus_linkedin_link'] = strip_tags( $new_instance['contactus_linkedin_link'] );
        $instance['contactus_twitter_link'] = strip_tags( $new_instance['contactus_twitter_link'] );
        $instance['contactus_facebook_link'] = strip_tags( $new_instance['contactus_facebook_link'] );
        $instance['contactus_googleplus_link'] = strip_tags( $new_instance['contactus_googleplus_link'] );
        $instance['contactus_vimeo_link'] = strip_tags( $new_instance['contactus_vimeo_link'] );

        return $instance;
    }


    function form( $instance ) {

        //Set up some default widget settings.
        $defaults = array(
                'title' => __('Contact', 'lawyeria'),
                'contactus_address_one'         => __('Romania, Bucuresti', 'lawyeria'),
                'contactus_address_two'         => __( 'Str. Lorem Ipsum, nr. 2', 'lawyeria' ),
                'contactus_address_telephone'   => __( 'Tel: (+4) 0746123456', 'lawyeria' ),
                'contactus_address_email'       => __( 'E-mail: office@themeisle.com', 'lawyeria' ),
                'contactus_linkedin_link'       => __( 'http://www.linkedin.com', 'lawyeria' ),
                'contactus_twitter_link'        => __( 'http://www.twitter.com', 'lawyeria' ),
                'contactus_facebook_link'       => __( 'http://www.facebook.com', 'lawyeria' ),
                'contactus_googleplus_link'     => __( 'http://www.google.com', 'lawyeria' ),
                'contactus_vimeo_link'          => __( 'http://www.vimeo.com', 'lawyeria' )
            );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_address_one' ); ?>"><?php _e('Address 1:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_address_one' ); ?>" name="<?php echo $this->get_field_name( 'contactus_address_one' ); ?>" value="<?php echo $instance['contactus_address_one']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_address_two' ); ?>"><?php _e('Address 2:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_address_two' ); ?>" name="<?php echo $this->get_field_name( 'contactus_address_two' ); ?>" value="<?php echo $instance['contactus_address_two']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_address_telephone' ); ?>"><?php _e('Telephone:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_address_telephone' ); ?>" name="<?php echo $this->get_field_name( 'contactus_address_telephone' ); ?>" value="<?php echo $instance['contactus_address_telephone']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_address_email' ); ?>"><?php _e('E-mail:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_address_email' ); ?>" name="<?php echo $this->get_field_name( 'contactus_address_email' ); ?>" value="<?php echo $instance['contactus_address_email']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_linkedin_link' ); ?>"><?php _e('LinkedIn link:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_linkedin_link' ); ?>" name="<?php echo $this->get_field_name( 'contactus_linkedin_link' ); ?>" value="<?php echo $instance['contactus_linkedin_link']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_twitter_link' ); ?>"><?php _e('Twitter link:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_twitter_link' ); ?>" name="<?php echo $this->get_field_name( 'contactus_twitter_link' ); ?>" value="<?php echo $instance['contactus_twitter_link']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_facebook_link' ); ?>"><?php _e('Facebook link:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_facebook_link' ); ?>" name="<?php echo $this->get_field_name( 'contactus_facebook_link' ); ?>" value="<?php echo $instance['contactus_facebook_link']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_googleplus_link' ); ?>"><?php _e('Google+ link:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_googleplus_link' ); ?>" name="<?php echo $this->get_field_name( 'contactus_googleplus_link' ); ?>" value="<?php echo $instance['contactus_googleplus_link']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'contactus_vimeo_link' ); ?>"><?php _e('Vimeo link:', 'lawyeria'); ?></label>
            <input id="<?php echo $this->get_field_id( 'contactus_vimeo_link' ); ?>" name="<?php echo $this->get_field_name( 'contactus_vimeo_link' ); ?>" value="<?php echo $instance['contactus_vimeo_link']; ?>" style="width:100%;" />
        </p>

    <?php
    }
}

/*************************************************/
/*********** Custom colors **********************/
/************************************************/

add_action('wp_print_scripts','lawyeria_php_style');

function lawyeria_php_style() {
	
	echo ' <style type="text/css">';
	
	/********* footer colors ********/
	echo ' #footer { background: '. get_theme_mod('lawyeria_footer_background') .'}';
	echo ' #footer .footer-box .footer-box-title {color: '.get_theme_mod('lawyeria_footer_heading_color').' }';
	echo ' #footer .footer-box ul li a, #footer .footer-box ul li {color: '.get_theme_mod('lawyeria_footer_text_color').' }';
	
	/******* menu colors ***********/
	echo ' header { background: '.get_theme_mod('lawyeria_menu_background').' }';
	echo ' nav li a { color: '.get_theme_mod('lawyeria_menu_text_color').' }';
	echo ' nav li a:hover { border-color: '.get_theme_mod('lawyeria_menu_border_color').' }';
	
	/******* header colors ***********/
	echo ' #subheader .subheader-color .full-header-content h3, .wide-nav h3 { color: '.get_theme_mod('lawyeria_header_headings_color').' }';
	echo ' .wide-nav { background: '.get_theme_mod('lawyeria_header_background').' }';
	echo ' #subheader .subheader-color .full-header-content p { color: '.get_theme_mod('lawyeria_header_text_color').' }';
	
	/******* fp boxes colors ***********/
	echo ' #features .features-box { background: '.get_theme_mod('lawyeria_fp_boxes_background').' }';
	echo ' #features .features-box h4 { color: '.get_theme_mod('lawyeria_fp_boxes_headings_color').' }';
	echo ' #features .features-box p { color: '.get_theme_mod('lawyeria_fp_boxes_text_color').' }';
	
	/********** ti_frontpage_header_opacity  ************/
	$ti_frontpage_header_opacity = get_theme_mod('ti_frontpage_header_opacity');
	
	if( !empty($ti_frontpage_header_opacity) ):
		echo '	#subheader .subheader-color { background: '.$ti_frontpage_header_opacity.'}';
	endif;
	
	echo '</style>';
}

/************************************************/
/********* Practice areas widget ****************/
/************************************************/

class lawyeria_practiceareas extends WP_Widget {
 
    function lawyeria_practiceareas() {
        $this->WP_Widget('practiceareas-widget', 'Lawyeria Frontpage - Practice areas widget');
    }
 
    function widget($args, $instance) {
		
        extract($args);
 
        echo $before_widget;
		
		echo '<h4>'.apply_filters('widget_title', $instance['title'] ).'</h4>';
		
		if( !empty($instance['number']) ):
			$get_taxonomy = get_terms( 'practiceareas', array('number' => esc_attr($instance['number']) ));
		else:
			$get_taxonomy = get_terms( 'practiceareas' );
		endif;
		
		
		
		if( !empty($get_taxonomy) ):
		
			echo '<ul>';
			
				foreach ( $get_taxonomy as $taxonomy_category ) {
					
					$taxonomy_category = sanitize_term( $taxonomy_category, 'lawyers' );
					$term_link = get_term_link( $taxonomy_category, 'lawyers' );
					
					echo '<li>';
						echo '<a href="'.esc_url( $term_link ).'" title="'.$taxonomy_category->name.'">';
							echo $taxonomy_category->name;
						echo '</a>';
					echo '</li>';
				}
				
			echo '</ul>';
			
		endif;	

        echo $after_widget;
 
    }
 
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
        return $instance;
    }
 
    function form($instance) {

		echo '<p>';
			echo '<label for="'.$this->get_field_id('title').'">'.__('Title','lawyeria').'</label><br />';
			if( !empty($instance['title']) ):
				$pa_title = $instance['title'];
			else:
				$pa_title = '';
			endif;
			echo '<input type="text" name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'" value="'.$pa_title.'" class="widefat" />';
		echo '</p>';
		
		echo '<p>';
			echo '<label for="'.$this->get_field_id('number').'">'.__('Number of practice area to show','lawyeria').'</label><br />';
			if( !empty($instance['number']) ):
				$pa_number = $instance['number'];
			else:
				$pa_number = '';
			endif;
			echo '<input type="text" name="'.$this->get_field_name('number').'" id="'.$this->get_field_id('number').'" value="'.$pa_number.'" class="widefat" />';
		echo '</p>';
		
    }
}

/*********************************************************/
/********* Our lawyers widget - frontpage ****************/
/*********************************************************/

class lawyeria_ourlawyers extends WP_Widget {
 
    function lawyeria_ourlawyers() {
        $this->WP_Widget('ourlawyers-widget', 'Lawyeria Frontpage - Our lawyers widget');
    }
 
    function widget($args, $instance) {
		
        extract($args);
 
        echo $before_widget;
		
		if( !empty($instance['title']) ):
			echo '<h4>'.apply_filters('widget_title', $instance['title'] ).'</h4>';
		endif;	
		
		if( !empty($instance['number']) ):
			$args = array (
				'post_type' => 'lawyers',
				'posts_per_page' => esc_attr($instance['number']),
				'ignore_sticky_posts' => true,
			);
		else:
			$args = array (
				'post_type' => 'lawyers',
				'posts_per_page' => '5',
				'ignore_sticky_posts' => true,
			);
		endif;
		
		

		$lawyers = new WP_Query( $args );

		if ( $lawyers->have_posts() ) : 
		
			while ( $lawyers->have_posts() ) : 
			
				$lawyers->the_post();
				
				if ( has_post_thumbnail(get_the_ID()) ) {
					
					echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="lawyer">'.get_the_post_thumbnail(get_the_ID(), 'our_lawyes_thumb').'</a>'; 
					
					
				}
				else { 
					
					echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="lawyer lawyer-no-image"></a>';
                                    
                }
			
			endwhile; 
			
		else: 
			
			echo '<p>'.__('Sorry, no posts matched your criteria.', 'lawyeria').'</p>';
		
		endif; 
		
		wp_reset_postdata();

        echo $after_widget;
 
    }
 
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
        return $instance;
    }
 
    function form($instance) {

		echo '<p>';
			echo '<label for="'.$this->get_field_id('title').'">'.__('Title','lawyeria').'</label><br />';
			if( !empty($instance['title']) ):
				$l_title = $instance['title'];
			else:
				$l_title = '';
			endif;
			echo '<input type="text" name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'" value="'.$l_title.'" class="widefat" />';
		echo '</p>';
		
		echo '<p>';
			echo '<label for="'.$this->get_field_id('number').'">'.__('Number of lawyers to show','lawyeria').'</label><br />';
			if( !empty($instance['number']) ):
				$l_number = $instance['number'];
			else:
				$l_number = '';
			endif;
			echo '<input type="text" name="'.$this->get_field_name('number').'" id="'.$this->get_field_id('number').'" value="'.$l_number.'" class="widefat" />';
		echo '</p>';
		
    }
}


/*********************************************************/
/********* Testimonials widget - frontpage ****************/
/*********************************************************/

class lawyeria_testimonials extends WP_Widget {
 
    function lawyeria_testimonials() {
        $this->WP_Widget('testimonials-widget', 'Lawyeria - Testimonials widget');
    }
 
    function widget($args, $instance) {
		
        extract($args);
 
        echo $before_widget;
		
		if( !empty($instance['title']) ):
			echo '<h4>'.apply_filters('widget_title', $instance['title'] ).'</h4>';
		endif;	
			
				if( !empty($instance['number']) ):
					if( !empty($instance['offset']) ):
						$args = array (
							'post_type' => 'testimonials',
							'posts_per_page' => esc_attr($instance['number']),
							'ignore_sticky_posts'    => true,
							'offset'                 => esc_attr($instance['offset'])
						);
					else:
						$args = array (
							'post_type' => 'testimonials',
							'posts_per_page' => esc_attr($instance['number']),
							'ignore_sticky_posts'    => true
						);
					endif;
				else:
					$args = array (
						'post_type' => 'testimonials',
						'posts_per_page' => -1,
						'ignore_sticky_posts'    => true
					);
				endif;

				$testimonials = new WP_Query( $args );

				if ( $testimonials->have_posts() ) : 
				
					echo '<div class="list_carousel">';
		
						echo '<ul id="foo2">';
				
							while ( $testimonials->have_posts() ) : 
					
								$testimonials->the_post();

								$testimonials_position = get_post_meta(get_the_ID(), 'ti_testimonials_position', true);
								$testimonials_company_name = get_post_meta(get_the_ID(), 'ti_testimonials_company_name', true);
								$testimonials_company_url = get_post_meta(get_the_ID(), 'ti_testimonials_company_url', true);

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
						
								echo '<li>';
									echo '<div class="list_carousel_entry">';
										echo testimonials_excerpt(65);
									echo '</div>';
								
									echo '<div class="list_carousel_customer">';
										echo '<span>'.get_the_title().$line.'</span>';
										echo $testimonials_position.$at;
									
										if ( $testimonials_company_url != false ) {
											echo '<a href="'. $testimonials_company_url .'" title="'. $testimonials_company_name .'">'. $testimonials_company_name .'</a>';
										} else {
											echo $testimonials_company_name;
										}
									
									echo '</div>';
								echo '</li>';

							endwhile; 
						
						echo '</ul>';
						echo '<div class="clearfix"></div>';
						echo '<a id="prev2" class="prev" href="#"></a>';
						echo '<a id="next2" class="next" href="#"></a>';
					echo '</div>';
							
				else: 
				
					echo '<p>'.__('Sorry, no posts matched your criteria.', 'lawyeria').'</p>';
					
				endif;
				
				wp_reset_postdata();
				
        echo $after_widget;
 
    }
 
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['offset'] = strip_tags( $new_instance['offset'] );
        return $instance;
    }
 
    function form($instance) {

		echo '<p>';
			echo '<label for="'.$this->get_field_id('title').'">'.__('Title','lawyeria').'</label><br />';
			if( !empty($instance['title']) ):
				$testim_title = $instance['title'];
			else:
				$testim_title = '';
			endif;
			echo '<input type="text" name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'" value="'.$testim_title.'" class="widefat" />';
		echo '</p>';
		
		echo '<p>';
			echo '<label for="'.$this->get_field_id('number').'">'.__('Number of testimonials to show','lawyeria').'</label><br />';
			if( !empty($instance['number']) ):
				$testim_number = $instance['number'];
			else:
				$testim_number = '';
			endif;
			echo '<input type="text" name="'.$this->get_field_name('number').'" id="'.$this->get_field_id('number').'" value="'.$testim_number.'" class="widefat" />';
		echo '</p>';
		
		echo '<p>';
			echo '<label for="'.$this->get_field_id('offset').'">'.__('Number of testimonials to skip','lawyeria').'</label><br />';
			if( !empty($instance['offset']) ):
				$testim_offset = $instance['offset'];
			else:
				$testim_offset = '';
			endif;
			echo '<input type="text" name="'.$this->get_field_name('offset').'" id="'.$this->get_field_id('offset').'" value="'.$testim_offset.'" class="widefat" />';
		echo '</p>';
		
    }
}

/* Default widgets on frontpage sidebar */

add_action( 'widgets_init', 'lawyeria_default_widgets_frontpage' );

function lawyeria_default_widgets_frontpage()
{
	register_widget( 'OurLawyers_Widget' );
	register_widget( 'lawyeria_practiceareas' );
	register_widget( 'lawyeria_ourlawyers' );
	register_widget( 'lawyeria_testimonials' );
	
	$active_widgets = get_option( 'sidebars_widgets' );
	$sidebars = array ( 'fp-sidebar' => 'Frontpage widgets area' );
	
	foreach ( $sidebars as $sidebar ):
        register_sidebar(
            array (
                'name'          => $sidebar,
                'id'            => $sidebar,
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>'
            )
        );
    endforeach;
	
}

add_action( 'after_switch_theme', 'lawyeria_register_sidebar_frontpage' );

function lawyeria_register_sidebar_frontpage()
{
	
	$active_widgets = get_option( 'sidebars_widgets' );
	$sidebars = array ( 'fp-sidebar' => 'Frontpage widgets area' );
	
    if ( ! empty ( $active_widgets[ $sidebars['fp-sidebar'] ] )):
		/* There is already some content. */
        return;
    endif;
	
    $counter = 1;

	/* Default practice areas widget */
    $active_widgets[ $sidebars['fp-sidebar'] ][0] = 'practiceareas-widget-' . $counter;
    
	$ti_frontpage_practiceareas_title = get_theme_mod('ti_frontpage_practiceareas_title');
						
	if( !empty($ti_frontpage_practiceareas_title) ):
		$pa_widget_content[ $counter ] = array ( 'title' => $ti_frontpage_practiceareas_title );
	else:
		$pa_widget_content[ $counter ] = array ( 'title' => __( 'Practice Areas', 'lawyeria' ) );
	endif;
	
    update_option( 'widget_practiceareas-widget', $pa_widget_content );

    $counter++;
	
	
	/* Default Our lawyers widget */
	$active_widgets[ $sidebars['fp-sidebar'] ][] = 'ourlawyers-widget-' . $counter;
    
	$ti_frontpage_ourlawyers_title = get_theme_mod('ti_frontpage_ourlawyers_title');
						
	if( !empty($ti_frontpage_ourlawyers_title) ):
		$ourlawyers_content[ $counter ] = array ( 'title' => $ti_frontpage_ourlawyers_title );
	else:
		$ourlawyers_content[ $counter ] = array ( 'title' => __('Our Lawyers','lawyeria') );
	endif;
    update_option( 'widget_ourlawyers-widget', $ourlawyers_content );

    $counter++;
	
	/* Default testimonials widget */
	$active_widgets[ $sidebars['fp-sidebar'] ][] = 'testimonials-widget-' . $counter;
    
	$testiomianls_param = array();
	
	if(!empty($ti_frontpage_testimonials_offset)):
		$testiomianls_param['offset'] = $ti_frontpage_testimonials_offset;
	endif;
	if(!empty($ti_frontpage_testimonials_numberofposts)):
		$testiomianls_param['number'] = $ti_frontpage_testimonials_numberofposts;
	endif;
	if(!empty($ti_frontpage_testimonials_title)):
		$testiomianls_param['title'] = $ti_frontpage_testimonials_title;
	else:
		$testiomianls_param['title'] = __('What customers say','lawyeria');
	endif;
						
	$testimon_content[ $counter ] = $testiomianls_param;
	
    update_option( 'widget_testimonials-widget', $testimon_content );

    $counter++;
	

    update_option( 'sidebars_widgets', $active_widgets );
}

 require 'inc/cwp-update.php'; 

add_filter('widget_text', 'do_shortcode');
add_filter('content', 'do_shortcode');
add_filter('the_content', 'do_shortcode');
add_filter('content_article_cf', 'do_shortcode');


