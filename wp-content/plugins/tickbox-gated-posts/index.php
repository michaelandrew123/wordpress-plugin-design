<?php 
/**
* Plugin Name: TickBox Gated Posts
* Description: This TickBox Gated Posts is design for a testing purposes.
* Author: Christian Senior
*/ 
?>

 
 
<?php
function tickedbox_admin_menu_option(){ 
     
    // $optionCat = new WP_Query('cat=1');
    global $wpdb; 
    if(array_key_exists('submit-tickbox-posts',$_POST)){  
        $tickbox_success=$wpdb->update( 
            'wp_posts', 
            array( 
                'comment_status' => 'closed'  // string 
            ), 
            array( 'ID' => $_POST['tickbox-id'] ), 
            array( 
                '%s'   // value1 
            ), 
            array( '%d' ) 
        );
        if($tickbox_success){
            echo '<div class="alert alert-success"> Success </div>';
        }else{ 
            echo '<div class="alert alert-danger"> Failed </div>';
        }
    } 
    $wp_posts_items = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' and comment_status = 'open' and post_type ='post'");
    foreach ( $wp_posts_items as $wp_posts_item ) {     
        ?>
            <div> 
                </div>
                <h2><?php echo $wp_posts_item->post_title ?></h2> 
                <?php echo $wp_posts_item->post_excerpt;   ?>
                <form method='post' action='' >
                    <input type='hidden' name='tickbox-id' value='<?php echo $wp_posts_item->ID; ?>'>
                    <input type='submit' name='submit-tickbox-posts' value='TICKED THE BOX'>
                </form>    
            </div> 
        <?php 
    }    
} 
function tickedbox_dashboard_setup() {
    wp_add_dashboard_widget( 'tickedbox_admin_menu_option', __( 'Google Page Rank' ),'tickedbox_admin_menu_option');
}
add_action('wp_dashboard_setup', 'tickedbox_dashboard_setup');
 
function tickedbox_content_link($content){
       global $wpdb;   
    //    echo  $content . ' ' . get_the_ID();
      $wp_posts_excerpts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='post' and post_status = 'publish'" );
        /*
        if(array_key_exists('unlock-btn', $_POST)){

            if(!empty($_POST['email-box'])){ 
                $unlock_box_result = $wpdb->update( 
                    'wp_posts', 
                    array( 
                        'comment_status' => 'open'
                    ), 
                    array( 'ID' => $_POST['unlock-posts-id'] ), 
                    array( 
                        '%s'    
                    ), 
                    array( '%d' ) 
                );
    
                if($unlock_box_result){
                                   
                    $myfile = fopen("test.txt", "a") or die("Unable to open file!");
                    $txt =  $_POST['email-box'] . ',';
                    fwrite($myfile, $txt); 
                    fclose($myfile);
    
                }
            }
           
        } */


        foreach ( $wp_posts_excerpts as $wp_posts_excerpt ) {      
 
            if(get_the_ID() == $wp_posts_excerpt->ID){

                if($wp_posts_excerpt->comment_status == 'closed'){ 
                    ?>
                        <div>
                        <input type='hidden' id='ajax-url' value='<?php echo plugins_url('js/ajax.php', __FILE__);?>'>
                            <!-- <form method='post' action=''> -->
                                <input type='hidden' name='unlock-posts-id' id='unlock-posts-id' value='<?php echo $wp_posts_excerpt->ID; ?>'>
                                <input type="email" name="email-box" id="myInput" required >
                                <!-- <input type='submit' name="unlock-btn" value='Unlock Post'>  -->
                                 <button type='submit' id='unlock-btn' name="unlock-btn" value='Unlock Post'> Unlock Post </button>   
                            <!-- </form> -->
                        </div> 
                    <?php

                }else{
 
                echo $wp_posts_excerpt->post_content;
                } 
            } 
        } 
}

add_filter( "the_content", "tickedbox_content_link" );

function tickedbox_title_link($title){ 
    return $title;
}

add_filter('the_title', 'tickedbox_title_link');

add_action( 'wp_enqueue_scripts', 'so_enqueue_scripts' );

function so_enqueue_scripts(){  
  wp_enqueue_script( 'ajax-script', plugins_url( 'js/index.js', __FILE__ ), array('jquery') ); 
} 

?> 
  