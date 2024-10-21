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

.layout_fr_title {
    font-weight: bold;
    font-size: 18px;
    height: 50px; 
    line-height: 22px;
    overflow: hidden; 
    display: block !important;
    -webkit-line-clamp: 2; 
    -webkit-box-orient: vertical;
    white-space: normal; 
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
    object-fit: cover;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
}

.text_on_image {
    position: absolute;
    bottom: 20px; 
    left: 10px;
    border-radius: 20px;
    background: #423d38ba;
    color: white;
    padding: 2% 5%;
    font-size: 13px;
}

.price_start {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.start_button {
    color: #1D7371;
    border: 1px solid #1D7371;
    border-radius: 25px;
    padding: 15px 15px;
    font-size: 15px;
    background: unset;
}

.course_author {
    color: #1D7371;
}

.after_image_content {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    margin: 5%;
}

.lesson_icon {
    color: #1D7371;
}

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
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: <?php echo esc_attr($colors['layout1']); ?> !important;
    border-radius: 10px;
    padding-bottom: 3%;
    height: 100%;
    overflow: hidden;
}
	.grid-4 .layout_fr_title{
		height:62px;
		  -webkit-box-orient:unset;
	}
/* Responsive Grid */
@media (max-width: 1024px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }
}


