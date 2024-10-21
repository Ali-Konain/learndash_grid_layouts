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
    grid-template-columns: repeat(<?php echo $columns; ?>, 1fr) !important;
    gap: 20px;
}

    .product_course {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: <?php echo esc_attr($colors['layout1']); ?>;
        border-radius: 10px;
        padding-bottom: 3%;
        text-align: center;
        height: 100%;
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

    .text_on_image {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(123, 77, 191, 0.74);
        color: white;
        font-weight: bold;
        padding: 2% 5%;
        font-size: 13px;
       
    }

    .after_image_content {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        padding: 5%;
    }

    .avatar_and_author {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .auther_image {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .course_author {
/*         color: #1D7371;
        font-weight: bold; */
		color:<?php echo $colors['author_font_color']; ?>;
		font-weight:<?php echo $fonts['author_font_weight']; ?>;
		font-size:<?php echo $fonts['author_font_size'];?>;
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
        margin-bottom: 10px;
    }

    .hr_width {
        width: 40%;
        margin: 0 auto;
		margin-bottom:1.5em;
    }

    .price_start {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-top: auto;
    }

    .couse_time, .course_price {
        font-size: 14px;
        font-weight: bold;
    }

    .course_start {
        width: 100%;
        text-align: center;
    }

    .start_button {
        background: #e5e5e5;
        color: grey;
        font-size: 13px;
        margin-top: 10px;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        width: 60%;
        max-width: 150px;
    }
	.grid-4 .layout_fr_title {
        font-weight: bold;
        font-size: 18px;
        height: 62px;
        line-height: 22px;
        overflow: hidden;
        display:block !important; 
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
        margin-bottom: 10px;
    }

    @media screen and (max-width: 768px) {
        .grid {
            grid-template-columns: 1fr;
        }
        .course_image {
/*             height: 150px; */
        }
    }

    @media screen and (max-width: 480px) {
        .grid {
            grid-template-columns: 1fr;
        }
        .course_image {
            height: 200px;
        }
        .layout_fr_title, .course_label {
            font-size: 16px;
        }
        .start_button {
            width: 100%;
        }
    }
</style>