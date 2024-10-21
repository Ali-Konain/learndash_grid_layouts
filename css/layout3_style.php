<?php

$settings = get_option('learndash_grid_layouts_settings');

    // Ensure $settings is an array
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

// Merge with saved settings
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
	.grid-4 .layout_fr_title {
        font-weight: bold;
        font-size: 18px;
        height: 85px;
        line-height: 22px;
        overflow: hidden;
       display: block !important;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
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