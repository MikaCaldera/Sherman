<?php 
/*
*
*		SHERMAN
*
*/

// Remove the Header Image Feature


function sherman_remove_theme_features() {
   remove_theme_support( 'custom-header' );
	remove_theme_support( 'custom-background' );
	remove_theme_support( 'post-formats' );
}
add_action( 'init', 'sherman_remove_theme_features' );

function sherman_customize_register( $wp_customize ) {
	//$wp_customize->remove_section('colors');
	$wp_customize->remove_section('background_image');
	//$wp_customize->remove_section('nav');
}
add_action( 'customize_register', 'sherman_customize_register' );


// Add Options for Sherman-specific Color options. 

function sherman_titlebar_register( $wp_customize ){
    
	$wp_customize->add_setting( 'themeColor', //Give it a SERIALIZED name (so all theme settings can live under one db record)
		array(
			'default' => 'sherman-blue', //Default setting/value to save
			'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
			'transport' => 'refresh'
			)
		);
	$wp_customize->add_control('themeColor', array(
        'type' => 'radio',
        'label' => '',
        'section' => 'colors',
        'choices' => array(
			'sherman-blue' => 'Dark Blue + Red',
			'sherman-red' => 'Red + Dark Blue',
			'sherman-black' => 'Dark Grey + Red',
			'sherman-grey' => 'Light Grey + Red',
			'sherman-orange' => 'Orange + Ice Blue',
			'sherman-redorange' => 'Soft Red + Green',
			'sherman-pink' => 'Soft Pink + Green',
			'sherman-hotpink' => 'Hot Pink + Teal',
			'sherman-brightyellow' => 'Mellow Yellow + Blue',
			'sherman-yellow' => 'Gold + Purple',
			'sherman-skyblue' => 'Sky Blue + Green',
			'sherman-teal' => 'Teal + Purple',
			'sherman-green' => 'Green + Red',
			'sherman-huntergreen' => 'Dark Green + Green',
			'sherman-lavender' => 'Lavender + Purple',
			'sherman-purple' => 'Purple + Gold'
        	)
    	)
	);
}
add_action( 'customize_register', 'sherman_titlebar_register' , 34);

function sherman_scripts() {
	wp_enqueue_script( 'sherman-js', get_stylesheet_directory_uri() . '/javascripts/min/sherman.min.js', array( 'jquery' ));	
	$stylesheet = get_theme_mod('themeColor');
	if( $stylesheet ){
		wp_enqueue_style( $stylesheet, get_stylesheet_directory_uri() . '/css/'.$stylesheet.'.css', array('cs-style') );
	} else {
		wp_enqueue_style( 'sherman-blue', get_stylesheet_directory_uri() . '/css/sherman-blue.css', array('cs-style') );
	}
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$maxMegaMenuActive = is_plugin_active('megamenu/megamenu.php');
	if ($maxMegaMenuActive){
		wp_dequeue_style( 'cs-megamenu' );
		wp_enqueue_style( 'sherman-megamenu', get_stylesheet_directory_uri(). '/css/sherman-maxmegamenu.css', array( 'cs-style' ));
	};

}

add_action( 'wp_enqueue_scripts', 'sherman_scripts', 50);
?>