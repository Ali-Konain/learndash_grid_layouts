<?php
function learndash_grid_layouts_settings_tab() {
    if (isset($_POST['save_settings'])) {
        $columns = array(
            'layout_columns' => sanitize_text_field($_POST['layout_columns']),
        );
        $colors = array(
            'layout1' => sanitize_hex_color($_POST['layout_color']),
            'layout_button_color' => sanitize_hex_color($_POST['layout_button_color']),
            'layout_button_text_color' => sanitize_hex_color($_POST['layout_button_text_color']),
            'layout_btn_hover_bg_color' => sanitize_hex_color($_POST['layout_btn_hover_bg_color']),
            'layout_title_color' => sanitize_hex_color($_POST['layout_title_color']),
            'layout_btn_brdr_color' => sanitize_hex_color($_POST['layout_btn_brdr_color']),
            'layout_btn_hover_txt_color' => sanitize_hex_color($_POST['layout_btn_hover_txt_color']),
            'price_color' => sanitize_hex_color($_POST['price_color']),
            'container_color' => sanitize_hex_color($_POST['container_color']),
			'lesson_font_color'=> sanitize_hex_color($_POST['lesson_font_color']),
			'student_font_color'=> sanitize_hex_color($_POST['student_font_color']),
			'author_font_color'=> sanitize_hex_color($_POST['author_font_color']),
        );
        $fonts = array(
            'heading_font' => sanitize_text_field($_POST['heading_font']),
            'button_font' => sanitize_text_field($_POST['button_font']),
            'lesson_font' => sanitize_text_field($_POST['lesson_font']),
            'student_font' => sanitize_text_field($_POST['student_font']),
            'author_font' => sanitize_text_field($_POST['author_font']),
            'heading_font_size' => sanitize_text_field($_POST['heading_font_size']),
            'button_font_size' => sanitize_text_field($_POST['button_font_size']),
            'price_font_size' => sanitize_text_field($_POST['price_font_size']),
            'lesson_font_size' => sanitize_text_field($_POST['lesson_font_size']),
            'student_font_size' => sanitize_text_field($_POST['student_font_size']),
            'author_font_size' => sanitize_text_field($_POST['author_font_size']),
            'heading_font_weight' => sanitize_text_field($_POST['heading_font_weight']),
            'button_font_weight' => sanitize_text_field($_POST['button_font_weight']),
            'price_font_weight' => sanitize_text_field($_POST['price_font_weight']),
            'lesson_font_weight' => sanitize_text_field($_POST['lesson_font_weight']),
            'student_font_weight' => sanitize_text_field($_POST['student_font_weight']),
            'author_font_weight' => sanitize_text_field($_POST['author_font_weight']),
            'text_align' => sanitize_text_field($_POST['text_align']),
        );

        $settings = array('columns' => $columns, 'colors' => $colors, 'fonts' => $fonts);
        update_option('learndash_grid_layouts_settings', $settings);
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    $settings = get_option('learndash_grid_layouts_settings');

    // Ensure $settings is an array
    if (!is_array($settings)) {
        $settings = array();
    }

    // Extract or set default values
    $colors = isset($settings['colors']) && is_array($settings['colors']) ? $settings['colors'] : array();
    $columns = isset($settings['columns']) ? $settings['columns'] : array();
    $fonts = isset($settings['fonts']) && is_array($settings['fonts']) ? $settings['fonts'] : array();

    // Set default values
    $defaults = array(
        'layout_columns' => '1',
        'layout_button_color' => '#ffffff',
        'layout_button_text_color' => '#ffffff',
        'layout_btn_hover_bg_color' => '#ffffff',
        'layout_title_color' => '#ffffff',
        'layout_btn_brdr_color' => '#ffffff',
        'layout_btn_hover_txt_color' => '#ffffff',
        'price_color' => '#000000',
        'container_color' => '#ffffff',
        'heading_font' => 'Arial, sans-serif',
        'button_font' => 'Arial, sans-serif',

        'lesson_font' => 'Arial, sans-serif',
        'student_font' => 'Arial, sans-serif',
        'author_font' => 'Arial, sans-serif',
        'heading_font_size' => '16px',
        'button_font_size' => '14px',
        'price_font_size' => '14px',
        'lesson_font_size' => '14px',
        'student_font_size' => '14px',
        'author_font_size' => '14px',
        'heading_font_weight' => '400',
        'button_font_weight' => '400',
        'price_font_weight' => '400',
        'lesson_font_weight' => '400',
		'lesson_font_color'=>'#000000',
        'student_font_weight' => '400',
		'student_font_color'=>'#000000',
        'author_font_weight' => '400',
		'author_font_color'=>'#000000',
        'text_align' => 'left'
    );

    $columns = array_merge($defaults, $columns);
    $colors = array_merge($defaults, $colors);
    $fonts = array_merge($defaults, $fonts);

    $settings = array('columns' => $columns, 'colors' => $colors, 'fonts' => $fonts);
    ?>
<style>
    .td_style tr td:first-child {
        width: 50%;
        font-weight: 400px;
    }
    .td_style input[type="color"] {
        width: 50%;
        margin-bottom: 10px;
    }
    .td_style input[type="text"] {
        margin-bottom: 10px;
    }
    .accordion {
        margin: 20px 0;
    }
    .accordion h3 {
        cursor: pointer;
        position: relative;
        padding-right: 30px;
		width:30%;
    }
    .accordion div {
        padding: 10px;
        display: none;
    }
	 .accordion h3 .edit-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        cursor: pointer;
		 background:#f8f8f8;
		 padding:5px;
    }
	.ui-accordion-content{
		border: 1px solid rgb(241, 241, 241);
  	  width: 50%;
	}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        $(".accordion").accordion({
            collapsible: true,
            heightStyle: "content"
        });
    });
</script>
    <div class="learndash-grid-layouts-settings" style="width:100%;">
        <h3>Grid Layout Settings</h3>
        <form method="post">
            <!-- Existing Color Settings -->
            <h4>Columns Settings</h4>
            <p>Set the number of columns for selected layout:</p>
            <table class="td_style" style="width:100%;">
                <tr>
                    <td>Number of Columns:</td>
                    <td><input type="number" name="layout_columns" value="<?php echo esc_attr($settings['columns']['layout_columns']); ?>" /></td>
                </tr>
            </table>
            <hr>
            <h4>Color Settings</h4>
            <p>Set the color for selected layout:</p>
            <table class="td_style" style="width:100%;">
                <tr>
                    <td>Color for grid box background</td>
                    <td><input type="color" name="layout_color" value="<?php echo esc_attr($settings['colors']['layout1']); ?>" class="color-picker" /></td>
                </tr> 
                
                <tr>
                    <td>Main container Color</td>
                    <td><input type="color" name="container_color" value="<?php echo esc_attr($settings['colors']['container_color']); ?>" class="color-picker" /></td>
                </tr>
            </table>
            <hr>
            <h2>Style Settings</h2>
            <div class="accordion">
                <h3>Heading style<span class="edit-icon">&#9998;</span></h3>
                <div>
                    <p>Set the style for headings:</p>
                    <table class="td_style" style="width:100%;">
                        <tr>
                            <td>Font</td>
                            <td><input type="text" name="heading_font" value="<?php echo esc_attr($settings['fonts']['heading_font']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Size</td>
                            <td><input type="text" name="heading_font_size" value="<?php echo esc_attr($settings['fonts']['heading_font_size']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Weight</td>
                            <td><input type="text" name="heading_font_weight" value="<?php echo esc_attr($settings['fonts']['heading_font_weight']); ?>" /></td>
                        </tr>
						<tr>
                    <td>Title Text Color</td>
                    <td><input type="color" name="layout_title_color" value="<?php echo esc_attr($settings['colors']['layout_title_color']); ?>" class="color-picker" /></td>
                </tr>   
						 <tr>
                    <td>Text Alignment</td>
                    <td>
                        <select name="text_align">
                            <option value="left" <?php selected($settings['fonts']['text_align'], 'left'); ?>>Left</option>
                            <option value="center" <?php selected($settings['fonts']['text_align'], 'center'); ?>>Center</option>
                            <option value="right" <?php selected($settings['fonts']['text_align'], 'right'); ?>>Right</option>
                        </select>
                    </td>
                </tr>
                    </table>
                </div>
                <h3>Button style<span class="edit-icon">&#9998;</span></h3>
                <div>
                    <p>Set the style for button:</p>
                    <table class="td_style" style="width:100%;">
                        <tr>
                            <td>Font</td>
                            <td><input type="text" name="button_font" value="<?php echo esc_attr($settings['fonts']['button_font']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Size</td>
                            <td><input type="text" name="button_font_size" value="<?php echo esc_attr($settings['fonts']['button_font_size']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Weight</td>
                            <td><input type="text" name="button_font_weight" value="<?php echo esc_attr($settings['fonts']['button_font_weight']); ?>" /></td>
                        </tr>
						<tr>
                    <td>Button Color</td>
                    <td><input type="color" name="layout_button_color" value="<?php echo esc_attr($settings['colors']['layout_button_color']); ?>" class="color-picker" /></td>
                </tr>
                <tr>
                    <td>Button Text Color</td>
                    <td><input type="color" name="layout_button_text_color" value="<?php echo esc_attr($settings['colors']['layout_button_text_color']); ?>" class="color-picker" /></td>
                </tr>
                <tr>
                    <td>Button Hover background Color</td>
                    <td><input type="color" name="layout_btn_hover_bg_color" value="<?php echo esc_attr($settings['colors']['layout_btn_hover_bg_color']); ?>" class="color-picker" /></td>
                </tr>
                <tr>
                    <td>Button Hover text Color</td>
                    <td><input type="color" name="layout_btn_hover_txt_color" value="<?php echo esc_attr($settings['colors']['layout_btn_hover_txt_color']); ?>" class="color-picker" /></td>
                </tr>
                <tr>
                    <td>Button border Color</td>
                    <td><input type="color" name="layout_btn_brdr_color" value="<?php echo esc_attr($settings['colors']['layout_btn_brdr_color']); ?>" class="color-picker" /></td>
                </tr>
                    </table>
                </div>
                <h3>Price style<span class="edit-icon">&#9998;</span></h3>
                <div>
                    <p>Set the font for prices:</p>
                    <table class="td_style" style="width:100%;">
                        <tr>
                            <td>Font Size</td>
                            <td><input type="text" name="price_font_size" value="<?php echo esc_attr($settings['fonts']['price_font_size']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Weight</td>
                            <td><input type="text" name="price_font_weight" value="<?php echo esc_attr($settings['fonts']['price_font_weight']); ?>" /></td>
                        </tr>
						 <tr>
                    <td>Price Color</td>
                    <td><input type="color" name="price_color" value="<?php echo esc_attr($settings['colors']['price_color']); ?>" class="color-picker" /></td>
                </tr>
                    </table>
                </div>
               
                <h3>Lesson Font<span class="edit-icon">&#9998;</span></h3>
                <div>
                    <p>Set the font for lessons:</p>
                    <table class="td_style" style="width:100%;">
                        <tr>
                            <td>Font</td>
                            <td><input type="text" name="lesson_font" value="<?php echo esc_attr($settings['fonts']['lesson_font']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Size</td>
                            <td><input type="text" name="lesson_font_size" value="<?php echo esc_attr($settings['fonts']['lesson_font_size']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Weight</td>
                            <td><input type="text" name="lesson_font_weight" value="<?php echo esc_attr($settings['fonts']['lesson_font_weight']); ?>" /></td>
                        </tr>
						<tr>
                            <td>Font color</td>
                            <td><input type="color" name="lesson_font_color" value="<?php echo esc_attr($settings['colors']['lesson_font_color']); ?>" /></td>
                        </tr>
                    </table>
                </div>
                <h3>Student Font<span class="edit-icon">&#9998;</span></h3>
                <div>
                    <p>Set the font for students:</p>
                    <table class="td_style" style="width:100%;">
                        <tr>
                            <td>Font</td>
                            <td><input type="text" name="student_font" value="<?php echo esc_attr($settings['fonts']['student_font']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Size</td>
                            <td><input type="text" name="student_font_size" value="<?php echo esc_attr($settings['fonts']['student_font_size']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Weight</td>
                            <td><input type="text" name="student_font_weight" value="<?php echo esc_attr($settings['fonts']['student_font_weight']); ?>" /></td>
                        </tr>
						<tr>
                            <td>Font color</td>
                            <td><input type="color" name="student_font_color" value="<?php echo esc_attr($settings['colors']['student_font_color']); ?>" /></td>
                        </tr>
                    </table>
                </div>
                <h3>Author Font<span class="edit-icon">&#9998;</span></h3>
                <div>
                    <p>Set the font for authors:</p>
                    <table class="td_style" style="width:100%;">
                        <tr>
                            <td>Font</td>
                            <td><input type="text" name="author_font" value="<?php echo esc_attr($settings['fonts']['author_font']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Size</td>
                            <td><input type="text" name="author_font_size" value="<?php echo esc_attr($settings['fonts']['author_font_size']); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Font Weight</td>
                            <td><input type="text" name="author_font_weight" value="<?php echo esc_attr($settings['fonts']['author_font_weight']); ?>" /></td>
                        </tr>
						<tr>
                            <td>Font color</td>
                            <td><input type="color" name="author_font_color" value="<?php echo esc_attr($settings['fonts']['author_font_color']); ?>" /></td>
                        </tr>
                    </table>
                </div>
            </div>
        

            <p><input type="submit" name="save_settings" value="Save Settings" class="button-primary" /></p>
        </form>
    </div>
    <?php
}
learndash_grid_layouts_settings_tab();
