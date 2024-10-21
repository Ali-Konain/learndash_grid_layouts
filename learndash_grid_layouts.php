<?php
/**
 * Plugin Name: LearnDash Grid Layouts
 * Author: Syed Ali Konain
  * Author URI: https://wa.me/923125493647
 * Version: 1.0.0
 * Description: A plugin to display LearnDash Courses in 4 different grid layouts.

 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
include_once(plugin_dir_path(__FILE__) . 'admin/admin-menu.php');
include_once(plugin_dir_path(__FILE__) . 'shortcodes/grid-layouts.php');

function ld_grid_layouts_enqueue_styles() {
   
    wp_enqueue_style(
        'ld-grid-layouts-styles',
        plugin_dir_url(__FILE__) . 'css/styles.css', 
        array(), 
        filemtime(plugin_dir_path(__FILE__) . 'css/styles.css') 
    );
 $settings = get_option('learndash_grid_layouts_settings');

    // Ensure $settings is an array
    if (!is_array($settings)) {
        $settings = array();
    }

    // Extract or set default values
    $colors = isset($settings['colors']) && is_array($settings['colors']) ? $settings['colors'] : array();
    $fonts = isset($settings['fonts']) && is_array($settings['fonts']) ? $settings['fonts'] : array();
    $columns = isset($settings['columns']) ? $settings['columns'] : array();

    // Set defaults for missing keys
  $defaults = array(
    'layout_columns' => array('layout_columns' => '1'),
    'colors' => array(
        'layout1' => '#ffffff',
        'layout_button_color' => '#ffffff',
        'layout_button_text_color' => '#000000',
        'layout_btn_hover_bg_color' => '#ffffff',
        'layout_title_color' => '#000000',
        'layout_btn_brdr_color' => '#000000',
        'layout_btn_hover_txt_color' => '#000000',
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
$columns = $settings['columns'];
$colors = $settings['colors'];
$fonts = $settings['fonts'];

    // Output dynamic CSS to set the CSS variables
    $css_vars = "
        :root {
            --layout1-columns: {$columns['layout_columns']};
            --layout1-bg-color: {$colors['layout1']};
            --heading-font: {$fonts['heading_font']};
            --heading-font-size: {$fonts['heading_font_size']};
            --heading-font-weight: {$fonts['heading_font_weight']};
            --layout-title-color: {$colors['layout_title_color']};
            --text-align: {$fonts['text_align']};
            --price-font-size: {$fonts['price_font_size']};
            --price-font-weight: {$fonts['price_font_weight']};
            --price-color: {$colors['price_color']};
            --lesson-font: {$fonts['lesson_font']};
            --lesson-font-size: {$fonts['lesson_font_size']};
            --lesson-font-weight: {$fonts['lesson_font_weight']};
            --lesson-font-color: {$colors['lesson_font_color']};
            --student-font: {$fonts['student_font']};
            --student-font-size: {$fonts['student_font_size']};
            --student-font-weight: {$fonts['student_font_weight']};
            --student-font-color: {$colors['student_font_color']};
            --author-font: {$fonts['author_font']};
            --author-font-size: {$fonts['author_font_size']};
            --author-font-weight: {$fonts['author_font_weight']};
            --author-font-color: {$colors['author_font_color']};
            --button-font: {$fonts['button_font']};
            --button-font-size: {$fonts['button_font_size']};
            --button-font-weight: {$fonts['button_font_weight']};
            --layout-button-text-color: {$colors['layout_button_text_color']};
            --layout-button-color: {$colors['layout_button_color']};
            --layout-btn-brdr-color: {$colors['layout_btn_brdr_color']};
            --layout-btn-hover-bg-color: {$colors['layout_btn_hover_bg_color']};
            --layout-btn-hover-txt-color: {$colors['layout_btn_hover_txt_color']};
            --container-color: {$colors['container_color']};
        }
    ";

    wp_add_inline_style('ld-grid-layouts-styles', $css_vars);
}
add_action('wp_enqueue_scripts', 'ld_grid_layouts_enqueue_styles');

// Activation hook
function learndash_grid_layouts_activate() {
    // Set default settings
 $defaults = array(
    'columns' => array('layout_columns' => '1'),
    'colors' => array(
        'layout1' => '#ffffff',
        'layout_button_color' => '#ffffff',
        'layout_button_text_color' => '#000000',
        'layout_btn_hover_bg_color' => '#ffffff',
        'layout_title_color' => '#000000',
        'layout_btn_brdr_color' => '#000000',
        'layout_btn_hover_txt_color' => '#000000',
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
    update_option('learndash_grid_layouts_settings', $defaults);
}
register_activation_hook(__FILE__, 'learndash_grid_layouts_activate');


