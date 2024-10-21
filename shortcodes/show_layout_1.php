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
	
	 $category = get_course_categories($course->ID);
            $course_link = $course->guid;
            $thumbnail_url = get_the_post_thumbnail_url($course->ID, 'full');
            $title = get_the_title($course->ID);    
            $author_id = $course->post_author;
            $author_name = get_the_author_meta('display_name', $author_id);
            $sfwd_lessons_count = get_post_meta($course->ID, 'sfwd_lessons_count', true);
            $course_price = 0;
            $serialized_data = get_post_meta($course->ID, '_sfwd-courses', true);
            $unserialized_data = maybe_unserialize($serialized_data);
            if (is_array($unserialized_data)) {
                $course_price = isset($unserialized_data['sfwd-courses_course_price']) ? $unserialized_data['sfwd-courses_course_price'] : "0";
            }
	
	
		 $sfwd_lessons_count = 0;
            $post_meta = get_post_meta($course->ID);
            if (isset($post_meta['ld_course_steps'][0])) {
                $serialized_data = $post_meta['ld_course_steps'][0];
                $unserialized_data = unserialize($serialized_data);
                if (isset($unserialized_data['steps']['h']['sfwd-lessons'])) {
                    $sfwd_lessons = $unserialized_data['steps']['h']['sfwd-lessons'];
                    $sfwd_lessons_count = count($sfwd_lessons);
                }
            }
            $student_count = learndash_course_grid_count_students($course->ID);
            if (empty($course_price)) {
                $course_price = "0";
            }
            ?>
            <div class="product_course">
                <div class="image_div">
                    <a href="<?php echo esc_url($course_link); ?>">
                        <img class="course_image" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>">
                    </a>
					<?php
					if (!empty($category)) {
					echo '<span class="text_on_image">' . $category . '</span>';
					}
					?>
                    
                </div>
                <div class="after_image_content">
                    <span class="course_lesson"><i class="fas fa-book lesson_icon"></i> <?php echo intval($sfwd_lessons_count) . ' Lessons'; ?>  </span>
                    <div class="layout_fr_title">
                        <a href="<?php echo esc_url($course_link); ?>">
                            <label class="course_label">
                                <?php echo esc_html($title); ?>
                            </label>
                        </a>
                    </div>
                    <p class="course_author">by <?php echo esc_html($author_name); ?></p>
                    <div class="price_start">
                        <div class="course_price">
                            <span>Price</span><br>
                            <?php echo esc_html($course_price); ?>
                        </div>
                        <div class="course_start">
                            <a href="<?php echo esc_url($course_link); ?>">
                                <button class="start_button">
                                    <i class="fas fa-play"></i>
                                    Start
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
