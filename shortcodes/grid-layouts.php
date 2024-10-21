<?php
// shortcode for layout and included layout files
add_shortcode('learndash_grid_layouts', 'learndash_grid_layout_shortcode');

function learndash_grid_layout_shortcode() {


    ob_start();
    $settings = get_option('learndash_grid_layouts_settings');
	$selected_layout = get_option('selected_layout');
    if ( 'layout1' == $selected_layout) {
        include 'show_layout_1.php';		
		include plugin_dir_path(__FILE__) . '../css/layout1_style.php';
    } else if ( 'layout2' == $selected_layout) {
        include 'show_layout_2.php';
		include plugin_dir_path(__FILE__) . '../css/layout2_style.php';
    } else if ( 'layout3' == $selected_layout) {
        include 'show_layout_3.php';
		include plugin_dir_path(__FILE__) . '../css/layout3_style.php';
    }else  {
        include 'show_layout_4.php';
		include plugin_dir_path(__FILE__) . '../css/layout4_style.php';
    }





    return ob_get_clean();
}
function get_course_categories($course_id) {
    // Get the base URL of the WordPress site
    $base_url = home_url(); 
    
    // Construct the API URL dynamically
    $url = $base_url . '/wp-json/ldlms/v2/courses/' . $course_id;
    
    // Perform the API request
    $response = wp_remote_get($url, array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode('username:password') // Replace with your credentials
        )
    ));

    // Handle the response
    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        // Handle error
        return $error_message;
    } else {
        $response_body = wp_remote_retrieve_body($response);
        $course_data = json_decode($response_body, true);

        // Check if categories are present
        if (isset($course_data['categories']) && !empty($course_data['categories'])) {
            // Return the name of the first category
            $first_category = $course_data['categories'][0];
            return $first_category['name']; // Return the name of the first category
        } else {
            return;
        }
    }
}


