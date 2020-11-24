<?php
/**
 * Plugin Name: Chris Example Plugin
 * Description: This is just a testing plugin
 * Author Name: Chris
 * Version: 0.1
 * 
 * **/ 

if(!defined('ABSPATH')){

    exit();
 }
function chist_chris_example(){ 
    $infromation = 'This is very basic chris plugin';
    return $infromation;
}

add_shortcode('example', 'chist_chris_example');

function chis_admin_menu_option(){
    add_menu_page(' Header & Footer Script', 'Site Scripts', 'manage_options', 'chris-admin-menu', 'chis_scripts_page', '', 200);
}

add_action('admin_menu', 'chis_admin_menu_option');

function chis_scripts_page(){
    if(array_key_exists('submit_scripts_update',$_POST)){
        update_option('chris_header_scripts', $_POST['header_scripts']);
        update_option('chris_footer_scripts', $_POST['footer_scripts']);
        ?>
            <div id='setting-error-settings-updated' class='updated_settings_error notice is-dismissible'>
                <strong>
                    Setting have been saved.
                </strong>
            </div>
        <?php
    }
    $header_scripts = get_option('chris_header_scripts', 'none');
    $footer_scripts = get_option('chris_footer_scripts', 'none'); 
    ?>
        <div clas='wrap'>
       
            <h2>Update Scripts</h2>
            <form method='post' action=''>    
                <label>header scripts</label>
                <textarea name='header_scripts' class='large-text'><?php print $header_scripts; ?></textarea>
                <label>footer scripts</label>
                <textarea name='footer_scripts' class='large-text'><?php print $footer_scripts; ?></textarea>
                <input name='submit_scripts_update' type='submit' style='button button-primary'value='UPDATE SCRIPTS' />
            </form>
        </div>
    <?php
    
}


function chris_display_header_scripts(){
    $header_scripts = get_option('chris_header_scripts', 'none');
    print $header_scripts; 
} 
add_action('wp_head', 'chris_display_header_scripts');

function chris_display_footer_scripts(){
    $footer_scripts = get_option('chris_footer_scripts', 'none'); 
    print $footer_scripts; 
} 
add_action('wp_footer', 'chris_display_footer_scripts');


function chris_form(){
    /* Content variable */
    $content = '';
    $content .= '<form method="post" action="http://localhost/chris/wordpress/thank-you/">';
        $content .= '<input type="text" name="full_name" placeholder="Your Full Name" />';
        $content .= '<br />';
        $content .= '<input type="text" name="email_address" placeholder="Email Address" />';
        $content .= '<br />';
        $content .= '<input type="text" name="phone_number" placeholder="Phone Number" />';
        $content .= '<br />'; 
        $content .= '<textarea name="comments" placeholder="Give us your comments"></textarea>';
        $content .= '<br />'; 
        $content .= '<input type="submit" name="chris_form_submit" value="SUBMIT YOUR INFORMATION" >'; 
    $content .= '</form>';

    return $content;
}

add_shortcode('chris_contact_form', 'chris_form');

function set_html_content_type(){

    return 'text/html';
}

function chris_form_capture(){
    if(array_key_exists('chris_form_submit', $_POST)){
 
        $to = 'michaelandrewsuarez0@gmail.com';
        $subject = 'Chis Example Form Submission';
        $body = '';

        $body .= 'Name: ' . $_POST['full_name'] . '<br />';
        $body .= 'Email: '. $_POST['email_address'] . '<br />';
        $body .= 'Phone Number: '. $_POST['phone_number'] . '<br />';
        $body .= 'Comments: '. $_POST['comments'] . '<br />'; 

        add_filter('wp_mail_content_type', 'set_html_content_type');
        wp_mail($to, $subject, $body);
        remove_filter('wp_mail_content_type', 'set_html_content_type');


        /* Insert example to a comment table */

        global $post, $current_user, $wpdb; //for this example only :)
        /* $time = current_time('mysql');

        $commentdata = array(
            'comment_post_ID'      => $post->ID,             // To which post the comment will show up. 
            'comment_content'      => $body, // Fixed value - can be dynamic.
            //'user_id'              => $current_user->ID,     // Passing current user ID or any predefined as per the demand.
            'comment_author_IP'    => $_SERVER['REMOTE_ADDR'], 
            'comment_date'         => $time,
            'comment_approved'     => 1,

        );
        
        // Insert new comment and get the comment ID.
        //$comment_id = wp_new_comment( $commentdata );
        //Insert new comment
        wp_insert_comment($commentdata);
        */

        /**add the submission to the database using database wp_form_submission */
        $insertData = $wpdb->get_results(" INSERT INTO ".$wpdb->prefix."form_submission (data) VALUES('".$body."')");

    }




    
}
 
add_action('wp_head', 'chris_form_capture');






?>