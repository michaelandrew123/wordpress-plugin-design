<?php
//Add scripts

function ws_add_scripts(){
    //Add Main CSS
        wp_enqueue_style('ws-main-style', plugins_url(). '/example-widget/css/style.css');
    //Add Mainn JS 
        wp_enqueue_script('ws-main-script', plugins_url(). '/example-widget/js/main.js'); 
    //Add google scripts

        wp_register_script('google','https://apis.google.com/js/platform.js');
        wp_enqueue_script('google');
}

add_action('wp_enqueue_scripts', 'ws_add_scripts');