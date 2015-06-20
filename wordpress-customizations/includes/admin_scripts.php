<?php

/*
 * file to load our custom admin scripts
 */



add_action( 'admin_enqueue_scripts', 'fivesixone_custom_scripts' );

function fivesixone_custom_scripts() {
	//include all scripts here

	//chosen
	wp_enqueue_style( 'chosen_style', plugins_url( '../js/chosen/chosen.css', __FILE__ ) );
	wp_enqueue_script( 'chosen_script', plugins_url( '../js/chosen/chosen.jquery.js', __FILE__ ) );


	//switches
	wp_enqueue_style( 'itoggle_style', plugins_url( '../js/checkboxes/style.css', __FILE__ ) );
	wp_enqueue_script( 'itoggle_script', plugins_url( '../js/checkboxes/iphone-style-checkboxes.js', __FILE__ ) );

	//syntax highlighter
	wp_enqueue_style( 'syntaxhighlighter_style', plugins_url( '../js/syntaxhighlighter/styles/style.css', __FILE__ ) );
	wp_enqueue_script( 'syntaxhighlighter_script', plugins_url( '../js/syntaxhighlighter/scripts/jquery.syntaxhighlighter.js', __FILE__ ) );




}