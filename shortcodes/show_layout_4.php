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
            $course_link = $course->guid;
            $thumbnail_url = get_the_post_thumbnail_url($course->ID, 'full');
            $thumbnail_html = get_the_post_thumbnail($course->ID, 'full');
            $title = get_the_title($course->ID);    
            $author_id = $course->post_author;
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_image = get_avatar_url($author_id);
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
        
            $sfwd_lessons_count = 0;
            if (isset($post_meta['ld_course_steps'][0])) {
                $serialized_data = $post_meta['ld_course_steps'][0];
                $unserialized_data = unserialize($serialized_data);
                if (isset($unserialized_data['steps']['h']['sfwd-lessons'])) {
                    $sfwd_lessons = $unserialized_data['steps']['h']['sfwd-lessons'];
                    $sfwd_lessons_count = count($sfwd_lessons);
                }
            }
            ?>
            <div class="product_course">
                <div class="students_and_ratings">
                    <div>
                        <i class="fas fa-users"></i>
                        <span class="course_students"><?php echo $student_count . ' students'; ?> </span>
                    </div>
                </div>
                <div class="image_div">
                    <a href="<?php echo $course_link; ?>">
                        <img class="course_image" src="<?php echo esc_attr($thumbnail_url); ?>">
                    </a>
                </div>
                <div class="after_image_content">
                    <div class="layout_fr_title">
                        <a href="<?php echo $course_link; ?>">
                            <label class="course_label"><?php echo $title; ?></label>
                        </a>
                    </div>
                    <hr>
                    <div class="avatar_and_lessons">
                        <div class="avatar_and_author">
                            <img class="author_image" src="<?php echo $author_image; ?>">
                            <span class="course_author"><?php echo $author_name; ?></span>
                        </div>
                        <div>
                            <span class="course_lesson"><?php echo $sfwd_lessons_count . ' Lessons'; ?></span>
                        </div>
                    </div>
                    <div class="course_start">
                        <a href="<?php echo $course_link; ?>">
                            <button class="start_button">Join Now</button>
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
    padding: 3%;
    border: 2px dashed #ccc;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    position: relative;
}

.students_and_ratings {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    color: #555;
}

.students_and_ratings i {
    color: #ED4884;
}

.after_image_content {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding-top: 30px; 
}

.layout_fr_title {
    font-weight: bold;
    font-size: 18px;
    height: 50px; 
    line-height: 22px;
    overflow: hidden; 
    display: -webkit-box;
    -webkit-line-clamp: 2; 
    -webkit-box-orient: vertical;
    white-space: normal; 
}

.avatar_and_lessons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10%;
    font-size: 14px;
    color: #555;
}

.author_image {
    width: 15%;
    border-radius: 50%;
    margin-right: 10px;
    object-fit: cover;
}

.course_author {
    color: #1D7371;
    font-size: 14px;
}

.course_start {
    width: 100%;
    text-align: center;
    margin-top: auto;
    margin-bottom: 20px; 
}

.start_button {
    background: #ED4884;
    color: white;
    width: 100%;
    font-size: 16px;
    border-radius: 20px;
    border: none;
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.start_button:hover {
    background-color: #d43f73;
}

hr {
    border: 0;
    border-top: 1px solid #ccc;
    margin: 20px 0; 
}

.grid-1 {
    grid-template-columns: 1fr;
}

.grid-1 .course_image {
    height: auto;
}

.grid-1 .product_course, .grid-1 .course_label {
    font-size: 40px;
}

.grid-1 .start_button {
    font-size: 25px;
}

.grid-2 {
    grid-template-columns: 1fr 1fr;
}

.grid-3 {
    grid-template-columns: 1fr 1fr 1fr;
}

.course_image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.students_and_ratings span {
    color: #1D7371;
    font-weight: bold;
}

.star-ratings {
    color: #FFC107;
}

.course_label {
    color: #111827;
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: 25px;
}

/* Media Queries for Responsive Design */
@media (max-width: 1200px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }




    .product_course {
        padding: 2%;
    }

    .course_label {
        font-size: 18px;
    }

    .start_button {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
 

    .product_course {
        padding: 1%;
    }

    .course_label {
        font-size: 16px;
    }

    .start_button {
        font-size: 12px;
    }
}
</style>
