<?php
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/*  Add Config
/* ------------------------------------ */
Kirki::add_config( 'refib_theme', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/*  Add Panels
/* ------------------------------------ */
Kirki::add_panel( 'customizer_panel_id', array(
	'priority'    => 10,
	'title'       => esc_attr__( 'Theme Options', 'refib-tidytheme' ), 
) );

/*  Add Sections
/* ------------------------------------ */
Kirki::add_section( 'header_sec', array(
    'priority'    => 30,
	'title'       => esc_html__( 'Header Settings', 'curver' ), 
	'panel'       => 'customizer_panel_id',
) );
Kirki::add_section( 'styling', array(
    'priority'    => 80,
    'title'       => esc_html__( 'Styling', 'curver' ),
	'panel'       => 'customizer_panel_id',
) );


/*  Fields : Header   
/* ================================================================= */
// 1// Logo
Kirki::add_field( 'refib_theme', [
	'type'        => 'image',
	'settings'    => 'logo_setting3',
	'label'       => esc_html__( 'Upload Logo', 'kirki' ), 
	'section'     => 'header_sec',
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
] );
// 1// Output ::: Logo
<div class="logo">
	<a href="<?php echo esc_url(home_url('/')); ?>">
	<?php if ( get_theme_mod('logo_setting3') ): ?>
	<img id="header-logo" src="<?php echo esc_url( get_theme_mod('logo_setting3') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name')); ?>">
	<?php else : ?>
		<?php echo esc_html(bloginfo('name')); ?>
	<?php endif ; ?>
	</a>
</div>
					
// 2// Header Info box
Kirki::add_field( 'refib_theme', array(
	'type'			=> 'repeater',
	'label'			=> esc_html__( 'Info Box', 'curver' ), 
	'section'		=> 'header_sec',
	'row_label'		=> array(
		'type'	=> 'text',
		'value'	=> esc_html__('Info Box', 'curver' ),
	),
	'settings'		=> 'header_infobox3', 
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
	'partial_refresh'    => [
		'info_edit_icon' => [
			'selector'        => '.header_wrp_thr ul',
			'render_callback' => function() {
				return get_theme_mod('header_infobox3');
			},
		],
	],
	'fields'		=> array(
		'title'	=> array(
			'type'			=> 'text',
			'label'			=> esc_html__( 'Add Title', 'curver' ),
			'default'  => esc_attr__( 'Opening Hours', 'customizer' ),
		),
		'des'	=> array(
			'type'			=> 'text',
			'label'			=> esc_html__( 'Add Hours/Phone', 'curver' ),
			'default'  => esc_attr__( ' Mon - Fri 12AM - 7PM ', 'customizer' ),
		),
 
		'info_icon'	=> array(
			'type'        => 'select', 
			'label'       => esc_html__( 'Fontawesome', 'kirki' ),
			'default'     => 'clock-o', 
			'choices'     => [
				'phone-square' => esc_html__( 'Phone Square', 'kirki' ),
				'phone' => esc_html__( 'Phone', 'kirki' ),
				'tty' => esc_html__( 'Phone tty', 'kirki' ),
				'mobile' => esc_html__( 'Mobile', 'kirki' ),
				'home' => esc_html__( 'Home', 'kirki' ),
				'envelope' => esc_html__( 'Envelope', 'kirki' ),
				'headphones' => esc_html__( 'Headphones', 'kirki' ),
				'clock-o' => esc_html__( 'Clock', 'kirki' ),
				'globe' => esc_html__( 'Globe', 'kirki' ), 
				'map' => esc_html__( 'Map', 'kirki' ), 
				'map-signs' => esc_html__( 'Map Signs', 'kirki' ), 
				'compass' => esc_html__( 'Compass', 'kirki' ), 
				'street-view' => esc_html__( 'Street View', 'kirki' ), 
				'location-arrow' => esc_html__( 'Location Arrow', 'kirki' ), 
				'map-marker' => esc_html__( 'Map Marker', 'kirki' ), 
				'address-book' => esc_html__( 'Address Book', 'kirki' ), 
				'address-card' => esc_html__( 'Address Card', 'kirki' ), 
				'trophy' => esc_html__( 'Trophy', 'kirki' ), 
				'shield' => esc_html__( 'Shield', 'kirki' ), 
				'heart' => esc_html__( 'Heart', 'kirki' ), 
				'suitcase' => esc_html__( 'Suitcase', 'kirki' ), 
				'wrench' => esc_html__( 'Wrench', 'kirki' ), 
			],
		),

	)
) );

// Info Icon box Color:::
Kirki::add_field( 'refib_theme', [
	'type'        => 'color',
	'settings'    => 'info_icon_color_setting',
	'label'       => esc_html__( 'Info Icon Color', 'kirki' ),
	'section'     => 'header_sec', 
	'default'     => '#d4b068', 
	'transport'   => 'auto',
	'choices'     => [
		'alpha' => true,
	],
	'output'      => [
		[
			'element' => '.header i', 
			'property' => 'color',
		],
	],
] );
 
// 2// Output ::: iNFO bOX
<?php if ( get_theme_mod('header_infobox3') ): ?> 
<?php $settings = get_theme_mod( 'header_infobox3' );  ?>
<ul> 
	<?php foreach($settings as $box) : ?>
		<li>
		<?php if ( get_theme_mod('header_infobox3') ): ?> 
		 <i class="fa fa-<?php echo esc_attr($box['info_icon']); ?>"></i>
		<?php endif ; ?> 
		<span><?php echo esc_html($box['title']); ?><span> <?php echo esc_html($box['des']); ?> </span> </span>
	</li> 
<?php endforeach; ?>  
</ul>	
<?php endif ; ?> 


// 3// Get Quote Button
Kirki::add_field( 'refib_theme', array(
	'type'     => 'text',
	'settings' => 'btn_text3',
	'label'    => __( 'Quote Button Text', 'customizer' ),
	'section'  => 'header_sec', 
	'default'  => esc_attr__( 'Free Quote', 'customizer' ),
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
) );

// Get Quote Button link
Kirki::add_field( 'refib_theme', array(
	'type'     => 'text',
	'settings' => 'btn_link3',
	'label'    => __( 'Quote Button Link', 'customizer' ),
	'section'  => 'header_sec',
	'default'  => esc_attr__( 'http://', 'customizer' ),
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
	'partial_refresh'    => [
		'quote_edit_icon' => [
			'selector'        => '.header_qut_btn',
			'render_callback' => function() {
				return get_theme_mod('btn_link3');
			},
		],
	],
) );
//  Button link Open new window
Kirki::add_field( 'refib_theme', array(
	'type'			=> 'checkbox',
	'section'  => 'header_sec',
	'settings' => 'link_target3',
	'label'			=> esc_html__( 'Open in new window', 'curver' ),
	'default'		=> false,
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
) );

// Quote Button Color
Kirki::add_field( 'refib_theme', [
	'type'        => 'color',
	'settings'    => 'quote_bg_color_setting',
	'label'       => esc_html__( 'Quote Button BG Color', 'kirki' ),
	'section'     => 'header_sec', 
	'default'     => '#d4b068', 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.header_qut_btn a', 
			'property' => 'background-color',
		],
		[
			'element' => '.header_qut_btn a', 
			'property' => 'border-color',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
	'choices'     => [
		'alpha' => true,
	],
] );

// Quote Button Text Color
Kirki::add_field( 'refib_theme', [
	'type'        => 'color',
	'settings'    => 'quote_txt_color_setting',
	'label'       => esc_html__( 'Quote Button Text Color', 'kirki' ),
	'section'     => 'header_sec', 
	'default'     => '#fff', 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.header_qut_btn a', 
			'property' => 'color',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
] );

// 3// Output::: Quote Button
<?php
if ( get_theme_mod('btn_text3') ||  get_theme_mod('btn_link3') || get_theme_mod('link_target3') ):  
$btn_text3 = get_theme_mod( 'btn_text3' ); 
$btn_link3 = get_theme_mod( 'btn_link3' ); 
$link_target3 = get_theme_mod( 'link_target3' ); 

if ( isset($link_target3) && !empty($link_target3) )
{ $target = 'target="_blank"'; } else $target = '';  
?>
<a <?php echo esc_attr($target); ?> href="<?php echo esc_url($btn_link3); ?>" class="more-link"><?php echo esc_html($btn_text3); ?></a>
<?php endif ; ?> 


// 4// Social Links: List
Kirki::add_field( 'refib_theme', array(
	'type'			=> 'repeater',
	'label'			=> esc_html__( 'Create Social Links', 'curver' ), 
	'section'		=> 'header_sec',
	'row_label'		=> array(
		'type'	=> 'text',
		'value'	=> esc_html__('social link', 'curver' ),
	),
	'settings'		=> 'header_social3',
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'header3',
		]
	],
	'partial_refresh'    => [
		'social_edit_icon' => [
			'selector'        => '.social-nav ul',
			'render_callback' => function() {
				return get_theme_mod('header_social3');
			},
		],
	],
	'fields'		=> array(

		'my_radio'	=> array(
			'type'      => 'radio', 
			'label'     => esc_html__( 'My Radio', 'kirki' ), 
			'default'   => 'option-1', 
			'choices'   => [
				'option-1' => esc_html__( 'Option 1', 'kirki' ),
				'option-2' => esc_html__( 'Option 2', 'kirki' ), 
			]
		),
		'social_icon'	=> array(
			'type'        => 'select', 
			'label'       => esc_html__( 'Fontawesome', 'kirki' ),
			'default'     => 'facebook', 
			'choices'     => [
				'facebook' => esc_html__( 'Facebook', 'kirki' ),
				'twitter' => esc_html__( 'Twitter', 'kirki' ),
				'youtube' => esc_html__( 'Youtube', 'kirki' ),
				'linkedin' => esc_html__( 'Linkedin', 'kirki' ),
				'pinterest' => esc_html__( 'Pinterest', 'kirki' ),
				'instagram' => esc_html__( 'Instagram', 'kirki' ),
				'stumbleupon' => esc_html__( 'Stumbleupon', 'kirki' ), 
				'envelope' => esc_html__( 'Envelope', 'kirki' ), 
				'whatsapp' => esc_html__( 'Whatsapp', 'kirki' ), 
				'at' => esc_html__( 'Email at', 'kirki' ), 
			],
			'active_callback'  => [
				[
					'setting'  => 'my_radio',
					'operator' => '===',
					'value'    => 'option-1',
				],
			]
		),

		'icon_upload'	=> array(
			'type'			=> 'image',
			'label'			=> esc_html__( 'image', 'curver' ), 
			'active_callback'  => [
				[
					'setting'  => 'my_radio',
					'operator' => '===',
					'value'    => 'option-2',
				],
			]
		),

		'social-link'	=> array(
			'type'			=> 'link',
			'label'			=> esc_html__( 'Link', 'curver' ),
			'description'	=> esc_html__( 'Enter the full url for your icon button', 'curver' ),
			'default'		=> 'http://',
		),
		'social-target'	=> array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Open in new window', 'curver' ),
			'default'		=> false,
		),

	)
) );
 
// Social Icon Color:::
Kirki::add_field( 'refib_theme', [
	'type'        => 'color',
	'settings'    => 'socail_icon_color_setting',
	'label'       => esc_html__( 'Social Icon Color', 'kirki' ),
	'section'     => 'header_sec', 
	'default'     => '#fff', 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '#page .social-nav ul li a i', 
			'property' => 'color',
		],
		[
			'element' => '#page .social-nav ul li a i', 
			'property' => 'border-color',
		],
	],
] );

// Icon Icon BG Color:::
Kirki::add_field( 'refib_theme', [
	'type'        => 'color',
	'settings'    => 'socail_icon_bg_color_setting',
	'label'       => esc_html__( 'Social Icon Background Color', 'kirki' ),
	'section'     => 'header_sec', 
	'default'     => '#d4b068', 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '#page .social-nav ul li a i', 
			'property' => 'background-color',
		],
	],
	'choices'     => [
		'alpha' => true,
	],
	'active_callback' => [
		[
			'setting'  => 'header_layout',
			'operator' => '!==',
			'value'    => 'header1',
		]
	],
] );
 
// 4// Output ::: Socail Icon 
<?php if ( get_theme_mod('header_social3') ): ?>     
<div class="social-nav col-sm-3">
	<ul class="listnone">
	<?php $settings = get_theme_mod( 'header_social3' ); ?>
		<?php foreach( $settings as $setting ) : 
			if ( isset($setting['social-target']) && !empty($setting['social-target']) ) 
				{ $target = 'target="_blank"'; } else $target = '';                              
		?>  
		<li>
			<a <?php echo esc_attr($target); ?> href="<?php echo esc_url($setting['social-link']); ?> ">
			<i class="fa fa-<?php echo esc_attr($setting['social_icon']); ?>"></i>
			</a>
		</li>
	<?php endforeach; ?>
	</ul>		 
</div><!-- End: social-nav -->
<?php endif; ?>


/*  Section:: 2	//  Styling  Fields
/* ========================================= */
/**
 * Add the Body-typography control
 */
Kirki::add_field( 'refib_theme', [
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_html__( 'Body Typography Select', 'curver' ),
	'description' => esc_attr__( 'Select the typography options for your Body.', 'curver' ),
	'help'        => esc_attr__( 'Please choose a font for your site. This font-family will be applied to body elements on your page.', 'curver'), 
	'section'     => 'styling',
	'default'     => [
		'font-family'    => 'Roboto',
		'variant'        => '400',
		'font-size'      => '15px',
		'line-height'    => '1.7', 
		'color'          => '#5a5a5a',
	], 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => 'body, body > div',
		],
	],
] );
 
/**
 * Add the Body-typography control
 */
//Single Blog Heading Typography
Kirki::add_field( 'refib_theme', [
	'type'        => 'typography',
	'settings'    => 'blog_heading_typography',
	'label'       => esc_html__( 'Single Blog Heading Typography', 'curver' ),
	'description' => esc_attr__( 'Select the typography options for Single Blog headers.', 'curver' ),
	'help'        => esc_attr__( 'Please choose a font for your site. This font-family will be applied to heading elements on your page.', 'curver'), 
	'section'     => 'styling',
	'default'     => [
		'font-family'    => 'PT Sans',
		'font-size'        => '20px',   
		'variant'        => '700',   
		'color'          => '#222',
	], 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.entry-header h2 a',
		],
	],
] );

//Widget Heading Typography
Kirki::add_field( 'refib_theme', [
	'type'        => 'typography',
	'settings'    => 'widget_typography',
	'label'       => esc_html__( 'Widget Heading Typography', 'curver' ),
	'description' => esc_attr__( 'Select the typography options for your Widget.', 'curver' ),
	'help'        => esc_attr__( 'Please choose a font for your site. This font-family will be applied to heading elements on your page.', 'curver'), 
	'section'     => 'styling',
	'default'     => [
		'font-family'    => 'PT Sans',
		'font-size'        => '20px',   
		'variant'        => '700',   
		'color'          => '#222',
	], 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.widget h2',
		],
	],
] );

//Breadcrum Heading Typography
Kirki::add_field( 'refib_theme', [
	'type'        => 'typography',
	'settings'    => 'breadcrum_typography',
	'label'       => esc_html__( 'Breadcrum Heading Typography', 'curver' ),
	'description' => esc_attr__( 'Select the typography options for your Widget.', 'curver' ),
	'help'        => esc_attr__( 'Please choose a font for your Breadcrum. This font-family will be applied to heading elements on your Breadcrum.', 'curver'), 
	'section'     => 'styling',
	'default'     => [
		'font-family'    => 'PT Sans',
		'font-size'        => '33px',   
		'variant'        => '700',   
		'color'          => '#fff',
	], 
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.adam_breadcrum_area h1',
		],
	],
 
] );
