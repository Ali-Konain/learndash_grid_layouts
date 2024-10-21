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
            $author_image = get_avatar_url($author_id);
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
              $course_price = 0;
            $serialized_data = $post_meta['_sfwd-courses'][0];
            $unserialized_data = unserialize($serialized_data);
            if (is_array($unserialized_data)) {
                $course_price = isset($unserialized_data['sfwd-courses_course_price']) ? $unserialized_data['sfwd-courses_course_price'] : null;
            }
            if (empty($course_price)) {
                $course_price = "0";
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
                    <div class="layout_fr_title">
                        <a href="<?php echo $course_link; ?>">
                            <label class="course_label"><?php echo $title; ?></label>
                        </a>
                    </div>
                    <div class="price_start">
                        <div class="three_labes">
                            <label>
                                <i class="fas fa-user"></i>
                                <span class="course_author"><?php echo $author_name; ?></span>
                            </label>
                            <label>
                                <i class="fas fa-book-open"></i>
                                <span class="course_lesson"><?php echo $sfwd_lessons_count . ' Lessons'; ?></span>
                            </label>
                            <label>
                                <i class="fas fa-graduation-cap"></i>
                                <span class="course_student"><?php echo $student_count . ' Students'; ?></span>
                            </label>
                        </div>
                        <div class="course_price"><?php echo $course_price; ?></div>
                    </div>
                    <div class="course_start">
                        <a href="<?php echo $course_link; ?>">
                            <button class="start_button">Enroll Now</button>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<style type="text/css">
    .main_container {
        width: 100%;
        background: #f3f3f3;
        padding: 1%;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(<?php echo intval($columns); ?>, 1fr);
        gap: 20px;
    }
    .product_course {
        background: <?php echo ($color); ?>;
        border-radius: 10px;
        padding: 1%;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        position: relative;
    }
    .image_div {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        overflow: hidden;
    }
    .course_image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* This will cover the container without stretching */
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }
    .text_on_image {
        position: absolute;
        top: 10px;
        left: 4%;
        background: rgba(66, 61, 56, 0.73);
        color: white;
        font-weight: bold;
        padding: 2% 5%;
        font-size: 13px;
    }
    .after_image_content {
        padding: 5%;
    }
    .layout_fr_title {
        font-weight: bold;
        font-size: 18px;
        height: 70px;
        line-height: 22px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
    }
    .course_label {
        font-weight: bold;
        display: block;
        margin-bottom: 8%;
        margin-top: 2%;
        font-size: 20px;
        line-height: 25px;
    }
    .price_start {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 10%;
    }
    .three_labes {
        display: grid;
        justify-items: start;
        width: 80%;
        padding-left: 5%;
        gap: 10px;
    }
    .three_labes label {
        font-size: 14px;
    }
    .course_price {
        width: 20%;
        background: #E8EEE7;
        text-align: center;
        font-size: 20px;
        padding-top: 5%;
        padding-bottom: 5%;
    }
    .course_author {
        color: #1D7371;
    }
    .course_start {
        width: 100%;
    }
    .start_button {
        background: #e5e5e5;
        color: grey;
        width: 100%;
        font-size: 20px;
        border-top: 1px solid #A9BD4F;
        border-bottom: 1px solid #A9BD4F;
        cursor: pointer;
    }
    .grid-1 {
        grid-template-columns: 1fr;
    }
    .grid-2 {
        grid-template-columns: 1fr 1fr;
    }
    .grid-3 {
        grid-template-columns: 1fr 1fr 1fr;
    }
    .grid-4 {
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }
    @media (max-width: 1024px) {
        .grid {
            grid-template-columns: repeat(2, 1fr); /* Show 2 columns on tablets */
        }
    }
    @media (max-width: 768px) {
        .grid {
            grid-template-columns: 1fr; /* Show 1 column on mobile devices */
        }
        .course_label {
            font-size: 18px;
        }
        .three_labes label {
            font-size: 12px;
        }
        .course_price {
            font-size: 18px;
        }
        .start_button {
            font-size: 16px;
        }
        .text_on_image {
            font-size: 11px;
        }
    }
    @media (max-width: 480px) {
        .course_image {
            height: 120px; /* Adjust height for very small screens */
        }
        .course_label {
            font-size: 16px;
        }
        .three_labes label {
            font-size: 10px;
        }
        .course_price {
            font-size: 16px;
        }
        .start_button {
            font-size: 14px;
        }
        .text_on_image {
            font-size: 10px;
        }
    }
</style>
