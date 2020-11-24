<?php
/**
 * Plugin Name: Michael Andrew Widgets plugin example
 * Description: Widgets plugin example
 * Author Name: Michael
 * Version: 0.1
 * 
 * **/ 

if(!defined('ABSPATH')){ 
    exit();
 }
//load scripts
 require_once(plugin_dir_path(__FILE__).'includes/widget-script.php');
 require_once(plugin_dir_path(__FILE__).'includes/widget-class.php');

 //Register Widget
 function register_example_widget(){
     register_widget('Example_Widget');
 }
 //Hook in function

 add_action('widgets_init', 'register_example_widget');