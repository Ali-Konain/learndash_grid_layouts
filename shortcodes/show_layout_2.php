<?php
$settings = get_option('learndash_grid_layouts_settings');
$columns = isset($settings['columns']['layout_columns']) ? $settings['columns']['layout_columns'] : 3;
$color = isset($settings['colors']['layout1']) ? $settings['colors']['layout1'] : '#ffffff';
$selected_layout = get_option('selected_layout');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<?php
$courses = get_posts(array(
    'post_type' => 'sfwd-courses',
    'posts_per_page' => -1,
));
?>
<div class="main_container">
    <div class="grid grid-<?php echo intval($columns); ?>">
        <?php foreach ($courses as $course) {
             $categories = get_the_terms($course->ID, 'ld_course_category');

	 $category = get_course_categories($course->ID);
            // Collect data for each course (not used in this example)
            $course_link = $course->guid;
            $thumbnail_url = get_the_post_thumbnail_url($course->ID, 'full');
            $thumbnail_html = get_the_post_thumbnail($course->ID, 'full');
            $title = get_the_title($course->ID);    
            $author_id = $course->post_author;
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_image = get_avatar_url($author_id);
            $lessons = get_post_meta($course->ID, 'course_lessons', true);
            $user_query_args = array('course_id' => $course->ID);
            $student_count = learndash_course_grid_count_students($course->ID);
            $rating = get_post_meta($course->ID, 'course_rating', true);
            $post_meta = get_post_meta($course->ID);
            $seconds = isset($post_meta['_learndash_course_grid_duration'][0]) ? intval($post_meta['_learndash_course_grid_duration'][0]) : 0;
            $hours = floor($seconds / 3600);

            $course_price = 0;
            $serialized_data = $post_meta['_sfwd-courses'][0];
            $unserialized_data = unserialize($serialized_data);
            if (is_array($unserialized_data)) {
                $course_price = isset($unserialized_data['sfwd-courses_course_price']) ? $unserialized_data['sfwd-courses_course_price'] : null;
            }
            if (empty($course_price)) {
                $course_price = "0";
            }

            $sfwd_lessons_count = 0;
            if (isset($post_meta['ld_course_steps'][0])) {
                $serialized_data = $post_meta['ld_course_steps'][0];
                $unserialized_data = unserialize($serialized_data);
                if (isset($unserialized_data['steps'])) {
                    if (isset($unserialized_data['steps']['h'])) {
                        if (isset($unserialized_data['steps']['h']['sfwd-lessons'])) {
                            $sfwd_lessons = $unserialized_data['steps']['h']['sfwd-lessons'];
                            $sfwd_lessons_count = count($sfwd_lessons);
                        }
                    }
                }
            }
            ?>
            <div class="product_course">
                <div class="image_div">
                    <a href="<?php echo $course_link; ?>">
                        <img class="course_image" src="<?php echo esc_attr($thumbnail_url); ?>">
                    </a>
					<?php
					if (!empty($category)) {
					echo '<span class="text_on_image">' . $category . '</span>';
					}
					?>
                    
                </div>
                <div class="after_image_content">
                    <div class="avatar_and_author">
                        <img class="auther_image" src="<?php echo esc_attr($author_image); ?>">
                        <span class="course_author">
                            by <?php echo esc_html($author_name); ?>
                        </span>
                    </div>
                    <div class="layout_fr_title">
                        <a href="<?php echo $course_link; ?>">
                            <label class="course_label">
                                <?php echo esc_html($title); ?>
                            </label>
                        </a>
                    </div>
                   
                    <hr class="hr_width">
                    <div class="price_start">
                        <div class="couse_time">
                            <i class="fas fa-clock clock_icon"></i> <?php echo esc_html($hours); ?> hours
                        </div>
                        <div class="course_price">
                            <?php echo esc_html($course_price); ?>
                        </div>
                    </div>
                    <div class="course_start">
                        <a href="<?php echo $course_link; ?>">
                            <button class="start_button">
                                See Preview
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
