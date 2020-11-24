<?php 
$location = include('../../../../wp-load.php');

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$location2 = $root . '/wp-load.php'; 
 
// echo __FILE__;

// define (ROOT_URL, get_site_url() );
// define (ROOT_DIR, get_theme_root() );
// echo 'root url '.get_site_url() . '<br>';
// echo 'root dir '.get_theme_root(). '<br>'; 
global $wpdb;
 
$result = $wpdb->get_results ( "
            SELECT * 
            FROM  $wpdb->posts
                WHERE ID =
        ".$_POST['id'] );  
 
        echo json_encode($result);

            // foreach ( $result as $page )
            // {
            // echo $page->ID.'<br/>';
            // echo $page->post_title.'<br/>';
            // }


// add_action( 'wp_ajax_my_action', 'my_action' );
// add_action( 'wp_ajax_nopriv_my_action', 'my_action' );
// add_action( 'wp_ajax_my_action', 'my_action' );
// function my_action() {
// 	global $wpdb;
//     $result = $wpdb->get_results ( "
//             SELECT * 
//             FROM  $wpdb->posts
//                 WHERE ID =
//         ".$id );  

//             foreach ( $result as $page )
//             {
//             echo $page->ID.'<br/>';
//             echo $page->post_title.'<br/>';
//             }


// 	wp_die();
// }

// function my_action() {
// 	global $wpdb; // this is how you get access to the database
 
//     $email = $_POST['unlockEmail'];
//     $id = $_POST['id'];
 

//     $result = $wpdb->get_results ( "
//         SELECT * 
//         FROM  $wpdb->posts
//             WHERE ID =
//     ".$id );  
//     foreach ( $result as $page )
//             {
//             echo $page->ID.'<br/>';
//             echo $page->post_title.'<br/>';
//             }
// 	wp_die(); // this is required to terminate immediately and return a proper response
// }

// add_action( 'wp_ajax_my_action', 'my_action' );


// echo $_POST['id'];


// if(isset($_POST['unlockBtn'])){
//     global $wpdb;

//     $email = $_POST['unlockEmail'];
//     $id = $_POST['id'];
 

//     $result = $wpdb->get_results ( "
//         SELECT * 
//         FROM  $wpdb->posts
//             WHERE ID =
//     ".$id ); 

//     foreach ( $result as $page )
//         {
//         echo $page->ID.'<br/>';
//         echo $page->post_title.'<br/>';
//         }


// }
// $response = json_encode
// print_r($_POST);   

// foreach ( $unlock_posts_items as $unlock_posts_item ) { 
//     echo $unlock_posts_item->post_title;
// }
// global $wpdb; // this is how you get access to the database

//     $unlock_posts_items = $wpdb->get_results('SELECT * FROM $wpdb->posts');
//     echo json_encode($unlock_posts_items);
//     exit();


// function my_action_callback() {
//     global $wpdb; // this is how you get access to the database

//     $unlock_posts_items = $wpdb->get_results('SELECT * FROM $wpdb->posts');
//     echo json_encode($unlock_posts_items);
//     exit();
//     // $whatever = intval( $_POST['whatever'] );

//     // $whatever += 10;

//     //     echo $whatever;

//     // die(); // this is required to return a proper result
// }

// add_action('wp_ajax_my_action', 'my_action_callback');
?>