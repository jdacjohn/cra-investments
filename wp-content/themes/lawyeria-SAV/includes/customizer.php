<?php

function lawyeria_customizer( $wp_customize ) {
	
	function lawyeria_check_if_singular_lawyer() {
		
		if( is_singular('lawyers') ):
			return true;
		else:
			return false;
		endif;
		
	}		
	
	function lawyeria_check_not_fronpage() {
		
		if( is_front_page() ):
			return false;
		else:
			return true;
		endif;
		
	}
	
	function lawyeria_check_if_testimonials_page() {
		return is_page_template('page-testimonials.php');
	}
	
	function lawyeria_check_if_singular_practicearea() {
		if( is_tax('practiceareas') ):
			return true;
		else:
			return false;
		endif;
	}
	
	class lawyeria_Theme_Support extends WP_Customize_Control
	{
		public function render_content()
		{
		}
	} 
	
	
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	
	
	/****************************************/
	/*************  COLORS ******************/
	/****************************************/
	
	if ( class_exists( 'WP_Customize_Panel' ) ):
	
		$wp_customize->add_panel( 'panel_colors', array(
			'priority' => 35,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Colors', 'lawyeria' )
		) );
		
		
		/******************************************/
		/************** Menu colors **************/
		/*****************************************/
		
		
		$wp_customize->add_section( 'lawyeria_menu_colors_section' , array(
					'title'       => __( 'Menu', 'lawyeria' ),
					'priority'    => 29,
					'panel' => 'panel_colors'
		));
		
		/************** Menu background color **************/
		
		$wp_customize->add_setting(
			'lawyeria_menu_background',
			array(
				'default'     => '#f3f3f3'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_menu_background',
					array(
						'label'      => __( 'Background color', 'lawyeria' ),
						'section'    => 'lawyeria_menu_colors_section',
						'settings'   => 'lawyeria_menu_background',
						'priority'   => 1
					)
				)
		);
		
		/************** Menu text color **************/
		
		$wp_customize->add_setting(
			'lawyeria_menu_text_color',
			array(
				'default'     => '#394753'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_menu_text_color',
					array(
						'label'      => __( 'Text color', 'lawyeria' ),
						'section'    => 'lawyeria_menu_colors_section',
						'settings'   => 'lawyeria_menu_text_color',
						'priority'   => 2
					)
				)
		);
		
		/************** Menu border color **************/
		
		$wp_customize->add_setting(
			'lawyeria_menu_border_color',
			array(
				'default'     => '#dee0e2'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_menu_border_color',
					array(
						'label'      => __( 'Hover border color', 'lawyeria' ),
						'section'    => 'lawyeria_menu_colors_section',
						'settings'   => 'lawyeria_menu_border_color',
						'priority'   => 3
					)
				)
		);
		/*******************************************/
		/************** Header colors **************/
		/*******************************************/
		
		
		$wp_customize->add_section( 'lawyeria_header_colors_section' , array(
					'title'       => __( 'Header', 'lawyeria' ),
					'priority'    => 30,
					'panel' => 'panel_colors'
					
		));
		
		/************** Background color(if not front page) **************/
		
		$wp_customize->add_setting(
			'lawyeria_header_background',
			array(
				'default'     => '#445d70'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_header_background',
					array(
						'label'      => __( 'Background color', 'lawyeria' ),
						'section'    => 'lawyeria_header_colors_section',
						'settings'   => 'lawyeria_header_background',
						'priority'   => 1,
						'active_callback' => 'lawyeria_check_not_fronpage'
					)
				)
		);
		
		/************** Headings color **************/
		
		$wp_customize->add_setting(
			'lawyeria_header_headings_color',
			array(
				'default'     => '#fff'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_header_headings_color',
					array(
						'label'      => __( 'Headings color', 'lawyeria' ),
						'section'    => 'lawyeria_header_colors_section',
						'settings'   => 'lawyeria_header_headings_color',
						'priority'   => 2
					)
				)
		);
		
		/************** Text color(if front page) **************/
		
		$wp_customize->add_setting(
			'lawyeria_header_text_color',
			array(
				'default'     => '#a8adb1'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_header_text_color',
					array(
						'label'      => __( 'Text color', 'lawyeria' ),
						'section'    => 'lawyeria_header_colors_section',
						'settings'   => 'lawyeria_header_text_color',
						'priority'   => 3,
						'active_callback' => 'is_front_page'
					)
				)
		);
		
		/*******************************************/
		/************** Footer colors **************/
		/*******************************************/
		
		
		$wp_customize->add_section( 'lawyeria_footer_colors_section' , array(
					'title'       => __( 'Footer', 'lawyeria' ),
					'priority'    => 31,
					'panel' => 'panel_colors'
		));
		
		/************** Footer background color **************/
		
		$wp_customize->add_setting(
			'lawyeria_footer_background',
			array(
				'default'     => '#4a5c6b'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_footer_background',
					array(
						'label'      => __( 'Background color', 'lawyeria' ),
						'section'    => 'lawyeria_footer_colors_section',
						'settings'   => 'lawyeria_footer_background',
						'priority'   => 1
					)
				)
		);
		
		/************** Footer headings color **************/
		
		$wp_customize->add_setting(
			'lawyeria_footer_heading_color',
			array(
				'default'     => '#fff'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_footer_heading_color',
					array(
						'label'      => __( 'Headings color', 'lawyeria' ),
						'section'    => 'lawyeria_footer_colors_section',
						'settings'   => 'lawyeria_footer_heading_color',
						'priority'   => 2
					)
				)
		);
		
		/************** Footer text color **************/
		
		$wp_customize->add_setting(
			'lawyeria_footer_text_color',
			array(
				'default'     => '#BFC8D1'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_footer_text_color',
					array(
						'label'      => __( 'Text color', 'lawyeria' ),
						'section'    => 'lawyeria_footer_colors_section',
						'settings'   => 'lawyeria_footer_text_color',
						'priority'   => 3
					)
				)
		);
		
		/****************************************************/
		/************** Frontpage boxes colors **************/
		/****************************************************/
		
		
		$wp_customize->add_section( 'lawyeria_fp_boxes_colors_section' , array(
					'title'       => __( 'Frontpage boxes', 'lawyeria' ),
					'priority'    => 32,
					'panel' => 'panel_colors'
		));
		
		/************** Background color **************/
		
		$wp_customize->add_setting(
			'lawyeria_fp_boxes_background',
			array(
				'default'     => '#fff'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_fp_boxes_background',
					array(
						'label'      => __( 'Background color', 'lawyeria' ),
						'section'    => 'lawyeria_fp_boxes_colors_section',
						'settings'   => 'lawyeria_fp_boxes_background',
						'priority'   => 1,
						'active_callback' => 'is_front_page'
					)
				)
		);
		
		/************** Headings color **************/
		
		$wp_customize->add_setting(
			'lawyeria_fp_boxes_headings_color',
			array(
				'default'     => '#394753'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_fp_boxes_headings_color',
					array(
						'label'      => __( 'Headings color', 'lawyeria' ),
						'section'    => 'lawyeria_fp_boxes_colors_section',
						'settings'   => 'lawyeria_fp_boxes_headings_color',
						'priority'   => 2,
						'active_callback' => 'is_front_page'
					)
				)
		);
		
		/************** Text color **************/
		
		$wp_customize->add_setting(
			'lawyeria_fp_boxes_text_color',
			array(
				'default'     => '#394753'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_fp_boxes_text_color',
					array(
						'label'      => __( 'Text color', 'lawyeria' ),
						'section'    => 'lawyeria_fp_boxes_colors_section',
						'settings'   => 'lawyeria_fp_boxes_text_color',
						'priority'   => 3,
						'active_callback' => 'is_front_page'
					)
				)
		);
		
	else:
	
		$wp_customize->add_section( 'lawyeria_colors_section' , array(

					'title'       => __( 'Colors', 'lawyeria' ),

					'priority'    => 35

		));
		
		/************** Menu background color **************/
		
		$wp_customize->add_setting(
			'lawyeria_menu_background',
			array(
				'default'     => '#f3f3f3'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_menu_background',
					array(
						'label'      => __( 'Menu background color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_menu_background',
						'priority'   => 1
					)
				)
		);
		
		/************** Menu text color **************/
		
		$wp_customize->add_setting(
			'lawyeria_menu_text_color',
			array(
				'default'     => '#394753'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_menu_text_color',
					array(
						'label'      => __( 'Menu text color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_menu_text_color',
						'priority'   => 2
					)
				)
		);
		
		/************** Menu border color **************/
		
		$wp_customize->add_setting(
			'lawyeria_menu_border_color',
			array(
				'default'     => '#dee0e2'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_menu_border_color',
					array(
						'label'      => __( 'Hover border color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_menu_border_color',
						'priority'   => 3
					)
				)
		);
		
		/************** Background color **************/
		
		$wp_customize->add_setting(
			'lawyeria_header_background',
			array(
				'default'     => '#445d70'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_header_background',
					array(
						'label'      => __( 'Header - Background color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_header_background',
						'priority'   => 4
					)
				)
		);
		
		/************** Headings color **************/
		
		$wp_customize->add_setting(
			'lawyeria_header_headings_color',
			array(
				'default'     => '#fff'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_header_headings_color',
					array(
						'label'      => __( 'Header - Headings color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_header_headings_color',
						'priority'   => 5
					)
				)
		);
		
		/************** Text color **************/
		
		$wp_customize->add_setting(
			'lawyeria_header_text_color',
			array(
				'default'     => '#a8adb1'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_header_text_color',
					array(
						'label'      => __( 'Frontpage Header - Text color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_header_text_color',
						'priority'   => 6
					)
				)
		);
		
		/************** Footer background color **************/
		
		$wp_customize->add_setting(
			'lawyeria_footer_background',
			array(
				'default'     => '#4a5c6b'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_footer_background',
					array(
						'label'      => __( 'Footer background color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_footer_background',
						'priority'   => 7
					)
				)
		);
		
		/************** Footer headings color **************/
		
		$wp_customize->add_setting(
			'lawyeria_footer_heading_color',
			array(
				'default'     => '#fff'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_footer_heading_color',
					array(
						'label'      => __( 'Footer headings color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_footer_heading_color',
						'priority'   => 8
					)
				)
		);
		
		/************** Footer text color **************/
		
		$wp_customize->add_setting(
			'lawyeria_footer_text_color',
			array(
				'default'     => '#BFC8D1'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_footer_text_color',
					array(
						'label'      => __( 'Footer text color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_footer_text_color',
						'priority'   => 9
					)
				)
		);
		
		/************** Frontpage box Background color **************/
		
		$wp_customize->add_setting(
			'lawyeria_fp_boxes_background',
			array(
				'default'     => '#fff'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_fp_boxes_background',
					array(
						'label'      => __( 'Frontpage boxes - Background color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_fp_boxes_background',
						'priority'   => 10
					)
				)
		);
		
		/************** Frontpage box Headings color **************/
		
		$wp_customize->add_setting(
			'lawyeria_fp_boxes_headings_color',
			array(
				'default'     => '#394753'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_fp_boxes_headings_color',
					array(
						'label'      => __( 'Frontpage boxes - Headings color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_fp_boxes_headings_color',
						'priority'   => 11
					)
				)
		);
		
		/************** Text color **************/
		
		$wp_customize->add_setting(
			'lawyeria_fp_boxes_text_color',
			array(
				'default'     => '#394753'
			)
		);
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'lawyeria_fp_boxes_text_color',
					array(
						'label'      => __( 'Text color', 'lawyeria' ),
						'section'    => 'lawyeria_colors_section',
						'settings'   => 'lawyeria_fp_boxes_text_color',
						'priority'   => 12
					)
				)
		);
		
	endif;
	
	
	
	
	

    /********************************/
    /******* Header Section *********/
    /********************************/
	
    $wp_customize->add_section( 'lawyers_header' , array(
    	'title'       => __( 'Header', 'lawyeria' ),
    	'priority'    => 29,
	) );

	/* Header - Logo */
	$wp_customize->add_setting( 'ti_header_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_header_logo', array(
		'label'    => __( 'Logo:', 'lawyeria' ),
		'section'  => 'lawyers_header',
		'settings' => 'ti_header_logo',
		'priority' => '1',
	) ) );

	/* Header - Title */
	$wp_customize->add_setting( 'ti_header_title', array('default' => __('Contact us now', 'ti')) );
	$wp_customize->add_control( 'ti_header_title', array(
		'label'    => __( 'Contact Title:', 'lawyeria' ),
		'section'  => 'lawyers_header',
		'settings' => 'ti_header_title',
		'priority' => '2',
	) );

	/* Header - Telephone */
	$wp_customize->add_setting( 'ti_header_subtitle', array('default' => __( '+1-888-846-1732', 'ti' )) );
	$wp_customize->add_control( 'ti_header_subtitle', array(
		'label'    => __( 'Contact telephone:', 'lawyeria' ),
		'section'  => 'lawyers_header',
		'settings' => 'ti_header_subtitle',
		'priority' => '3',
	) );
	
	/* Header - Email */
	$wp_customize->add_setting( 'ti_header_email' );
	$wp_customize->add_control( 'ti_header_email', array(
		'label'    => __( 'Email address:', 'lawyeria' ),
		'section'  => 'lawyers_header',
		'settings' => 'ti_header_email',
		'priority' => '4',
	) );

    /****************************************************/
    /*********** Front Page Customizer ******************/
	/****************************************************/
	
	
	if ( class_exists( 'WP_Customize_Panel' ) ):
	
		$wp_customize->add_panel( 'panel_fronpage', array(
			'priority' => 30,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => __( 'Front Page', 'lawyeria' )
		) );
	
		/*******************/
		/***** header ******/
		/*******************/
	
		$wp_customize->add_section( 'lawyers_frontpage_header' , array(
			'title'       => __( 'Header', 'lawyeria' ),
			'priority'    => 1,
			'panel' => 'panel_fronpage'
		) );
		
		/* transparency */
		$wp_customize->add_setting( 'ti_frontpage_header_opacity', array( 'default' => 'rgba(21, 52, 76, 0.85)' ) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ti_frontpage_header_opacity',
				array(
					'label'      => __( 'Header background transparency', 'lawyeria' ),
					'section'    => 'lawyers_frontpage_header',
					'settings'   => 'ti_frontpage_header_opacity',
					'priority'   => 1
				)
			)
		);
		
		/* Title */
		$wp_customize->add_setting( 'ti_frontpage_header_title' );
		$wp_customize->add_control( 'ti_frontpage_header_title', array(
		    'label'    => __( 'Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_header',
		    'settings' => 'ti_frontpage_header_title',
			'priority' => 2,
			'active_callback' => 'is_front_page'
		) );

		/* Content */
		$wp_customize->add_setting( 'ti_frontpage_header_content' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_header_content', array(
			'label' 	=> __( 'Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage_header',
		    'settings' 	=> 'ti_frontpage_header_content',
		    'priority' 	=> 3,
			'active_callback' => 'is_front_page'
		)));
		
		/* Background */
		$wp_customize->add_setting( 'ti_frontpage_subheader_bg' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_subheader_bg', array(
		    'label'    => __( 'Background image:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_header',
		    'settings' => 'ti_frontpage_subheader_bg',
		    'priority' => 4,
			'active_callback' => 'is_front_page'
		) ) );
		
		/* Contact Form 7 - Title */
		$wp_customize->add_setting( 'ti_frontpage_contactform7_title' );
		$wp_customize->add_control( 'ti_frontpage_contactform7_title', array(
		    'label'    => __( 'Contact Form 7 - Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_header',
		    'settings' => 'ti_frontpage_contactform7_title',
			'priority' => 5,
			'active_callback' => 'is_front_page'
		) );

		/* Contact Form 7 - Shortcode */
		$wp_customize->add_setting( 'ti_frontpage_contactform7_shortcode' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_contactform7_shortcode', array(
			'label' 	=> __( 'Contact Form 7 - Shortcode:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage_header',
		    'settings' 	=> 'ti_frontpage_contactform7_shortcode',
		    'priority' 	=> 6,
			'active_callback' => 'is_front_page'
		)));
		
		/**********************/
		/***** subheader ******/
		/**********************/
	
		$wp_customize->add_section( 'lawyers_frontpage_subheader' , array(
			'title'       => __( 'Subheader', 'lawyeria' ),
			'priority'    => 2,
			'panel' => 'panel_fronpage'
		) );
		
		/* Title */
		$wp_customize->add_setting( 'ti_frontpage_subheader_title' );
		$wp_customize->add_control( 'ti_frontpage_subheader_title', array(
		    'label'    => __( 'Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_subheader',
		    'settings' => 'ti_frontpage_subheader_title',
			'priority' => 1,
			'active_callback' => 'is_front_page'
		) );
		
		/************************/
		/******* box #1 *********/
		/************************/
		
		$wp_customize->add_section( 'lawyers_frontpage_box1' , array(
			'title'       => __( 'Box #1', 'lawyeria' ),
			'priority'    => 3,
			'panel' => 'panel_fronpage'
		) );
		
		/* Icon */
		$wp_customize->add_setting( 'ti_frontpage_firstlybox_icon', array('default' => get_template_directory_uri().'/images/features-box-icon-one.png') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_firstlybox_icon', array(
		    'label'    => __( 'Icon:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box1',
		    'settings' => 'ti_frontpage_firstlybox_icon',
		    'priority' => 1,
			'active_callback' => 'is_front_page'
		) ) );

		/* Title */
		$wp_customize->add_setting( 'ti_frontpage_firstlybox_title', array('default' => __('Lorem','ti')) );
		$wp_customize->add_control( 'ti_frontpage_firstlybox_title', array(
		    'label'    => __( 'Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box1',
		    'settings' => 'ti_frontpage_firstlybox_title',
			'priority' => 2,
			'active_callback' => 'is_front_page'
		) );

		/* Content */
		$wp_customize->add_setting( 'ti_frontpage_firstlybox_content', array('default' => __( 'Go to Appearance - Customize, to add content.', 'ti' )) );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_firstlybox_content', array(
			'label' 	=> __( 'Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage_box1',
		    'settings' 	=> 'ti_frontpage_firstlybox_content',
		    'priority' 	=> 3,
			'active_callback' => 'is_front_page'
		)));
		
		/* Link */
		$wp_customize->add_setting( 'ti_frontpage_firstlybox_link' );
		$wp_customize->add_control( 'ti_frontpage_firstlybox_link', array(
		    'label'    => __( 'Link:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box1',
		    'settings' => 'ti_frontpage_firstlybox_link',
			'priority' => 4,
			'active_callback' => 'is_front_page'
		) );
		
		/************************/
		/******* box #2 *********/
		/************************/
		
		$wp_customize->add_section( 'lawyers_frontpage_box2' , array(
			'title'       => __( 'Box #2', 'lawyeria' ),
			'priority'    => 4,
			'panel' => 'panel_fronpage'
		) );
		
		/* Icon */
		$wp_customize->add_setting( 'ti_frontpage_secondlybox_icon', array('default' => get_template_directory_uri().'/images/features-box-icon-two.png') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_secondlybox_icon', array(
		    'label'    => __( 'Box (two) - Icon:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box2',
		    'settings' => 'ti_frontpage_secondlybox_icon',
		    'priority' => 1,
			'active_callback' => 'is_front_page'
		) ) );

		/* Title */
		$wp_customize->add_setting( 'ti_frontpage_secondlybox_title', array('default' => __( 'Ipsum', 'ti' )) );
		$wp_customize->add_control( 'ti_frontpage_secondlybox_title', array(
		    'label'    => __( 'Box (two) - Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box2',
		    'settings' => 'ti_frontpage_secondlybox_title',
			'priority' => 2,
			'active_callback' => 'is_front_page'
		) );

		/* Content */
		$wp_customize->add_setting( 'ti_frontpage_secondlybox_content', array('default' => __( 'Go to Appearance - Customize, to add content.', 'ti' )) );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_secondlybox_content', array(
			'label' 	=> __( 'Box (two) - Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage_box2',
		    'settings' 	=> 'ti_frontpage_secondlybox_content',
		    'priority' 	=> 3,
			'active_callback' => 'is_front_page'
		)));
		
		/* Link */
		$wp_customize->add_setting( 'ti_frontpage_secondlybox_link' );
		$wp_customize->add_control( 'ti_frontpage_secondlybox_link', array(
		    'label'    => __( 'Link:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box2',
		    'settings' => 'ti_frontpage_secondlybox_link',
			'priority' => 4,
			'active_callback' => 'is_front_page'
		) );
		
		/************************/
		/******* box #3 *********/
		/************************/
		
		$wp_customize->add_section( 'lawyers_frontpage_box3' , array(
			'title'       => __( 'Box #3', 'lawyeria' ),
			'priority'    => 5,
			'panel' => 'panel_fronpage'
		) );

		/* Icon */
		$wp_customize->add_setting( 'ti_frontpage_thirdlybox_icon', array('default' => get_template_directory_uri().'/images/features-box-three.png') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_thirdlybox_icon', array(
		    'label'    => __( 'Icon:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box3',
		    'settings' => 'ti_frontpage_thirdlybox_icon',
		    'priority' => 1,
			'active_callback' => 'is_front_page'
		) ) );

		/* Title */
		$wp_customize->add_setting( 'ti_frontpage_thirdlybox_title', array('default' => __( 'Dolor', 'ti' )) );
		$wp_customize->add_control( 'ti_frontpage_thirdlybox_title', array(
		    'label'    => __( 'Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box3',
		    'settings' => 'ti_frontpage_thirdlybox_title',
			'priority' => 2,
			'active_callback' => 'is_front_page'
		) );

		/* Content */
		$wp_customize->add_setting( 'ti_frontpage_thirdlybox_content', array('default' => __( 'Go to Appearance - Customize, to add content.', 'ti' )) );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_thirdlybox_content', array(
			'label' 	=> __( 'Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage_box3',
		    'settings' 	=> 'ti_frontpage_thirdlybox_content',
		    'priority' 	=> 3,
			'active_callback' => 'is_front_page'
		)));
		
		/* Link */
		$wp_customize->add_setting( 'ti_frontpage_thirdlybox_link' );
		$wp_customize->add_control( 'ti_frontpage_thirdlybox_link', array(
		    'label'    => __( 'Link:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage_box3',
		    'settings' => 'ti_frontpage_thirdlybox_link',
			'priority' => 4,
			'active_callback' => 'is_front_page'
		) );
		
		/***********************************************/
		/**************** Main content *****************/
		/***********************************************/
		
		$wp_customize->add_section( 'lawyers_main_content' , array(
			'title'       => __( 'Main content', 'lawyeria' ),
			'priority'    => 6,
			'panel' => 'panel_fronpage'
		) );
		
		/* Front Page - The Content - Image */
		$wp_customize->add_setting( 'ti_frontpage_thecontent_image' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_thecontent_image', array(
		    'label'    => __( 'Image:', 'lawyeria' ),
		    'section'  => 'lawyers_main_content',
		    'settings' => 'ti_frontpage_thecontent_image',
		    'priority' => 1,
			'active_callback' => 'is_front_page'
		) ) );

		/* Front Page - The Content - Title */
		$wp_customize->add_setting( 'ti_frontpage_thecontent_title' );
		$wp_customize->add_control( 'ti_frontpage_thecontent_title', array(
		    'label'    => __( 'Title:', 'lawyeria' ),
		    'section'  => 'lawyers_main_content',
		    'settings' => 'ti_frontpage_thecontent_title',
			'priority' => 2,
			'active_callback' => 'is_front_page'
		) );

		/* Front Page - The Content - Content */
		$wp_customize->add_setting( 'ti_frontpage_thecontent_content' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_thecontent_content', array(
			'label' 	=> __( 'Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_main_content',
		    'settings' 	=> 'ti_frontpage_thecontent_content',
		    'priority' 	=> 3,
			'active_callback' => 'is_front_page'
		)));
		
		/* Front page - bottom part */
		$wp_customize->add_section( 'ti_frontpage_bottom_setting' , array(
			'title'      => __('Bootom section','lawyeria'),
			'description' => __( "You can modify the bottom part of the front page using widgets by going <a href='".admin_url()."widgets.php'>here</a> to the Frontpage widgets area",'lawyeria'),
			'priority'   => 7,
			'panel' => 'panel_fronpage'
		));
		
		$wp_customize->add_setting('ti_frontpage_bottom_setting');
		
		$wp_customize->add_control( new lawyeria_Theme_Support( $wp_customize, 'ti_frontpage_bottom_setting',
			array(
				'section' => 'ti_frontpage_bottom_setting',
	    )));
		
		
	
	else:
    
		$wp_customize->add_section( 'lawyers_frontpage' , array(
			'title'       => __( 'Front Page', 'lawyeria' ),
			'priority'    => 30,
		) );
		
		/* Front Page - Header Title */
		$wp_customize->add_setting( 'ti_frontpage_header_title' );
		$wp_customize->add_control( 'ti_frontpage_header_title', array(
		    'label'    => __( 'Header Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_header_title',
			'priority' => 1,
		) );

		/* Front Page - Header Content */
		$wp_customize->add_setting( 'ti_frontpage_header_content' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_header_content', array(
			'label' 	=> __( 'Header Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage',
		    'settings' 	=> 'ti_frontpage_header_content',
		    'priority' 	=> 2
		)));
		
		/* Front Page - Header Background */
		$wp_customize->add_setting( 'ti_frontpage_subheader_bg' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_subheader_bg', array(
		    'label'    => __( 'Header Background:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_subheader_bg',
		    'priority' => 3,
		) ) );
	
		/* Front Page - Contact Form 7 - Title */
		$wp_customize->add_setting( 'ti_frontpage_contactform7_title' );
		$wp_customize->add_control( 'ti_frontpage_contactform7_title', array(
		    'label'    => __( 'Contact Form 7 - Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_contactform7_title',
			'priority' => 4
		) );

		/* Front Page - Contact Form 7 - Shortcode */
		$wp_customize->add_setting( 'ti_frontpage_contactform7_shortcode' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_contactform7_shortcode', array(
			'label' 	=> __( 'Contact Form 7 - Shortcode:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage',
		    'settings' 	=> 'ti_frontpage_contactform7_shortcode',
		    'priority' 	=> 5
		)));
		
		/* Front Page - Subheader Title */
		$wp_customize->add_setting( 'ti_frontpage_subheader_title' );
		$wp_customize->add_control( 'ti_frontpage_subheader_title', array(
		    'label'    => __( 'Subheader Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_subheader_title',
			'priority' => 6,
		) );

		/* Front Page - Firstly Box - Icon */
		$wp_customize->add_setting( 'ti_frontpage_firstlybox_icon' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_firstlybox_icon', array(
		    'label'    => __( 'Box (first) - Icon:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_firstlybox_icon',
		    'priority' => 7,
		) ) );

		/* Front Page - Firstly Box - Title */
		$wp_customize->add_setting( 'ti_frontpage_firstlybox_title' );
		$wp_customize->add_control( 'ti_frontpage_firstlybox_title', array(
		    'label'    => __( 'Box (first) - Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_firstlybox_title',
			'priority' => 8,
		) );

		/* Front Page - Firstly Box - Content */
		$wp_customize->add_setting( 'ti_frontpage_firstlybox_content' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_firstlybox_content', array(
			'label' 	=> __( 'Box (first) - Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage',
		    'settings' 	=> 'ti_frontpage_firstlybox_content',
		    'priority' 	=> 9
		)));

		/* Front Page - Secondly Box - Icon */
		$wp_customize->add_setting( 'ti_frontpage_secondlybox_icon' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_secondlybox_icon', array(
		    'label'    => __( 'Box (two) - Icon:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_secondlybox_icon',
		    'priority' => 10,
		) ) );

		/* Front Page - Secondly Box - Title */
		$wp_customize->add_setting( 'ti_frontpage_secondlybox_title' );
		$wp_customize->add_control( 'ti_frontpage_secondlybox_title', array(
		    'label'    => __( 'Box (two) - Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_secondlybox_title',
			'priority' => 11,
		) );

		/* Front Page - Secondly Box - Content */
		$wp_customize->add_setting( 'ti_frontpage_secondlybox_content' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_secondlybox_content', array(
			'label' 	=> __( 'Box (two) - Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage',
		    'settings' 	=> 'ti_frontpage_secondlybox_content',
		    'priority' 	=> 12
		)));

		/* Front Page - Thirdly Box - Icon */
		$wp_customize->add_setting( 'ti_frontpage_thirdlybox_icon' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_thirdlybox_icon', array(
		    'label'    => __( 'Box (three) - Icon:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_thirdlybox_icon',
		    'priority' => 13,
		) ) );

		/* Front Page - Thirdly Box - Title */
		$wp_customize->add_setting( 'ti_frontpage_thirdlybox_title' );
		$wp_customize->add_control( 'ti_frontpage_thirdlybox_title', array(
		    'label'    => __( 'Box (three) - Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_thirdlybox_title',
			'priority' => 14,
		) );

		/* Front Page - Thirdly Box - Content */
		$wp_customize->add_setting( 'ti_frontpage_thirdlybox_content' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_thirdlybox_content', array(
			'label' 	=> __( 'Box (three) - Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage',
		    'settings' 	=> 'ti_frontpage_thirdlybox_content',
		    'priority' 	=> 15
		)));

		/* Front Page - The Content - Image */
		$wp_customize->add_setting( 'ti_frontpage_thecontent_image' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ti_frontpage_thecontent_image', array(
		    'label'    => __( 'The Content - Image:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_thecontent_image',
		    'priority' => 16
		) ) );

		/* Front Page - The Content - Title */
		$wp_customize->add_setting( 'ti_frontpage_thecontent_title' );
		$wp_customize->add_control( 'ti_frontpage_thecontent_title', array(
		    'label'    => __( 'The Content - Title:', 'lawyeria' ),
		    'section'  => 'lawyers_frontpage',
		    'settings' => 'ti_frontpage_thecontent_title',
			'priority' => 17
		) );

		/* Front Page - The Content - Content */
		$wp_customize->add_setting( 'ti_frontpage_thecontent_content' );
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_frontpage_thecontent_content', array(
			'label' 	=> __( 'The Content - Content:', 'lawyeria' ),
		    'section' 	=> 'lawyers_frontpage',
		    'settings' 	=> 'ti_frontpage_thecontent_content',
		    'priority' 	=> 18
		)));
		
		/* Front page - bottom part */
		$wp_customize->add_section( 'ti_frontpage_bottom_setting' , array(
			'title'      => __('Front Page Bootom section','lawyeria'),
			'description' => __( "You can modify the bottom part of the front page using widgets by going here",'lawyeria'),
			'priority'   => 31
		));
		
		$wp_customize->add_setting('ti_frontpage_bottom_setting');
		
		$wp_customize->add_control( new lawyeria_Theme_Support( $wp_customize, 'ti_frontpage_bottom_setting',
			array(
				'section' => 'ti_frontpage_bottom_setting',
	    )));

	endif;	

    /*******************************************/
	/***** Single page for Practice Area *******/
	/*******************************************/
    
    $wp_customize->add_section( 'lawyers_practiceareas' , array(
    	'title'       => __( 'Single page for Practice Area', 'lawyeria' ),
    	'priority'    => 38,
		'description' => __('Lawyeria theme - single page for practice area','lawyeria')
	) );

	/* Title */
	$wp_customize->add_setting( 'ti_practicearea_navigation_title' );
	$wp_customize->add_control( 'ti_practicearea_navigation_title', array(
		'label'    => __( 'Navigation Title:', 'lawyeria' ),
		'section'  => 'lawyers_practiceareas',
		'settings' => 'ti_practicearea_navigation_title',
		'priority' => 1,
		'active_callback' => 'lawyeria_check_if_singular_practicearea'
	) );

	/* Content */
	$wp_customize->add_setting( 'ti_practicearea_content' );
	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_practicearea_content', array(
		 'label' 	=> __( 'Content:', 'lawyeria' ),
		 'section' 	=> 'lawyers_practiceareas',
		 'settings' 	=> 'ti_practicearea_content',
		 'priority' 	=> 2,
		 'active_callback' => 'lawyeria_check_if_singular_practicearea'
	)));

	/* Categories Title */
	$wp_customize->add_setting( 'ti_practicearea_categories_title' );
	$wp_customize->add_control( 'ti_practicearea_categories_title', array(
		'label'    => __( 'Categories Title:', 'lawyeria' ),
		'section'  => 'lawyers_practiceareas',
		'settings' => 'ti_practicearea_categories_title',
		'priority' => 3,
		'active_callback' => 'lawyeria_check_if_singular_practicearea'
	) );

	/**************************************/
	/******* Single page for lawyers ******/
	/**************************************/	
		
	$wp_customize->add_section( 'lawyers_lawyer_single' , array(
    	'title'       => __( 'Single page for lawyers', 'lawyeria' ),
    	'priority'    => 39,
		'description' => __('Lawyeria theme - single page for lawyers','lawyeria')
	) );

	/* Title for practice areas */
	$wp_customize->add_setting( 'ti_lawyer_categories_title' );
	$wp_customize->add_control( 'ti_lawyer_categories_title', array(
		'label'    => __( 'Title for practice areas:', 'lawyeria' ),
		'section'  => 'lawyers_lawyer_single',
		'settings' => 'ti_lawyer_categories_title',
		'priority' => 1,
		'active_callback' => 'lawyeria_check_if_singular_lawyer'
	) );

	
	/****************************************/
	/******* Testimonials - Page ************/
    /****************************************/
	
    $wp_customize->add_section( 'lawyers_testimonials_page' , array(
    	'title'       => __( 'Testimonials Page', 'lawyeria' ),
    	'priority'    => 40,
		'description' => __( 'Lawyeria theme - testimonials page','lawyeris' )
	) );

	/* Number of posts */
	$wp_customize->add_setting( 'ti_testimonials_page_numberofposts' );
	$wp_customize->add_control( 'ti_testimonials_page_numberofposts', array(
		'label'    => __( 'Number of posts:', 'lawyeria' ),
		'section'  => 'lawyers_testimonials_page',
		'settings' => 'ti_testimonials_page_numberofposts',
		'priority' => 1,
		'active_callback' => 'lawyeria_check_if_testimonials_page'
	) );
	
	/*****************************************/
    /************ 404 Page *******************/
	/*****************************************/
    
    $wp_customize->add_section( 'constructzine_404' , array(
    	'title'       => __( '404 (Not found) Page', 'lawyeria' ),
    	'priority'    => 41,
		'description' => __('Lawyeria theme - not found page','lawyeria')
	) );

	/* 404 - Title */
	$wp_customize->add_setting( 'ti_404_title' );
	$wp_customize->add_control( 'ti_404_title', array(
		'label'    => __( 'Title:', 'lawyeria' ),
		'section'  => 'constructzine_404',
		'settings' => 'ti_404_title',
		'priority' => 1
	) );

	/* 404 - Content */
	$wp_customize->add_setting( 'ti_404_content' );
	$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'ti_404_content', array(
		'label' 	=> __( 'Content', 'lawyeria' ),
		'section' 	=> 'constructzine_404',
		'settings' 	=> 'ti_404_content',
		'priority' 	=> 2
	)));

}
add_action( 'customize_register', 'lawyeria_customizer' );

if( class_exists( 'WP_Customize_Control' ) ):
	class Example_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';

	    public function render_content() { ?>

	        <label>
	        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>

	        <?php
	    }
	}
endif;

function lawyeria_registers() {
	
	wp_enqueue_script( 'lawyeria_jquery_ui', '//code.jquery.com/ui/1.10.4/jquery-ui.js', array("jquery"), '20120206', true  );

	wp_enqueue_style( 'lawyeria_jquery_ui_css', '//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css');	

	wp_enqueue_script( 'lawyeria_customizer_script', get_template_directory_uri() . '/js/lawyeria_customizer.js', array("jquery","lawyeria_jquery_ui"), '20120206', true  );

}

add_action( 'customize_controls_enqueue_scripts', 'lawyeria_registers' );

?>