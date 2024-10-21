<?php
$settings = get_option('learndash_grid_layouts_settings');
    if (!is_array($settings)) {
        $settings = array();
    }
$colors = isset($settings['colors']) && is_array($settings['colors']) ? $settings['colors'] : array();
    $fonts = isset($settings['fonts']) && is_array($settings['fonts']) ? $settings['fonts'] : array();
    $columns = isset($settings['columns']) ? $settings['columns'] : array();
    // Set defaults for missing keys
  $defaults = array(
    'columns' => array('layout_columns' => '1'),
    'colors' => array(
        'layout1' => '#ffffff',
        'layout_button_color' => '#ffffff',
        'layout_button_text_color' => '#ffffff',
        'layout_btn_hover_bg_color' => '#ffffff',
        'layout_title_color' => '#ffffff',
        'layout_btn_brdr_color' => '#ffffff',
        'layout_btn_hover_txt_color' => '#ffffff',
        'price_color' => '#000000',
        'container_color' => '#ffffff',
        'lesson_font_color'=>'#000000',
        'student_font_color'=>'#000000',
        'author_font_color'=>'#000000',
    ),
    'fonts' => array(
        'heading_font' => 'Arial, sans-serif',
        'button_font' => 'Arial, sans-serif',
        'category_font' => 'Arial, sans-serif',
        'lesson_font' => 'Arial, sans-serif',
        'student_font' => 'Arial, sans-serif',
        'author_font' => 'Arial, sans-serif',
        'heading_font_size' => '16px',
        'button_font_size' => '14px',
        'price_font_size' => '14px',
        'category_font_size' => '14px',
        'lesson_font_size' => '14px',
        'student_font_size' => '14px',
        'author_font_size' => '14px',
        'heading_font_weight' => '400',
        'button_font_weight' => '400',
        'price_font_weight' => '400',
        'category_font_weight' => '400',
        'lesson_font_weight' => '400',
        'student_font_weight' => '400',
        'author_font_weight' => '400',
        'text_align' => 'left'
    )
);

$settings = wp_parse_args(get_option('learndash_grid_layouts_settings', array()), $defaults);
$columns = $settings['columns']['layout_columns'];
$colors = $settings['colors'];
$fonts = $settings['fonts'];
?>
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
    width: 12%;
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
	
    .image_div {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 56.25%;
    }

    .course_image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
    }

/* .grid-1 .product_course, .grid-1 .course_label {
    font-size: 40px;
} */

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

/* .students_and_ratings span {
    color: #1D7371;
    font-weight: bold;
} */

.star-ratings {
    color: #FFC107;
}

/* .course_label {
    color: #111827;
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: 25px;
} */

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