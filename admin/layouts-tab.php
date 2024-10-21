<?php
// layout images and select option to selec the layout
function learndash_grid_layouts_layouts_tab() {
    $path = plugins_url('learndash_grid_layouts/admin/');
    $layouts = array(
        'layout1' => array('title' => 'Layout 1', 'image' => $path . 'layout1.png'),
        'layout2' => array('title' => 'Layout 2', 'image' => $path . 'layout2.png'),
        'layout3' => array('title' => 'Layout 3', 'image' => $path . 'layout3.png'),
        'layout4' => array('title' => 'Layout 4', 'image' => $path . 'layout4.png'),
    );

    $selected_layout = get_option('selected_layout', 'layout1');

    if (isset($_POST['save_layout'])) {
        if (isset($_POST['learndash_grid_layout'])) {
            update_option('selected_layout', sanitize_text_field($_POST['learndash_grid_layout']));
            $selected_layout = sanitize_text_field($_POST['learndash_grid_layout']);
        }
    }

    ?>

    <div class="learndash-grid-layouts-layouts">
        <h3>Select a Grid Layout</h3>
        <p>Select one of the layouts below to apply the settings:</p>
		<label>Use this shortcode to display the learndash course in different layout <b>[learndash_grid_layouts]</b></label>
		<br>
        <form method="post">
            <div class="learndash-layout-grid">
                <?php foreach ($layouts as $layout_key => $layout): ?>
                    <div class="layout">
                        <label>
                            <input type="radio" name="learndash_grid_layout" value="<?php echo esc_attr($layout_key); ?>" <?php checked($selected_layout, $layout_key); ?> />
                            <img src="<?php echo esc_url($layout['image']); ?>" alt="<?php echo esc_attr($layout['title']); ?>" />
                            <h4><?php echo esc_html($layout['title']); ?></h4>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <p>
                <button name="save_layout" class="save_layout button-primary" type="submit">Save Layout</button>
            </p>
        </form>
    </div>

    <style>
        .save_layout {
            float: right;
        }
     .learndash-layout-grid {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(3, 1fr); /* Create 3 equal-width columns */
}

.learndash-layout-grid > label {
    display: block;
}
		.learndash-layout-grid > label:nth-child(4) {
    grid-column: span 3; /* Span all 3 columns */
}
        .layout {
            flex: 1;
        }
        .layout label {
            display: block;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }
        .layout input[type="radio"] {
            display: none;
        }
        .layout img {
            width: 97%;
            height: 450;
            margin-bottom: 10px;
            border: 3px solid transparent;
            transition: border-color 0.3s ease;
        }
        .layout h4 {
            margin: 0;
            padding: 5px 0;
        }
        .layout input[type="radio"]:checked + img,
        .layout input[type="radio"]:checked + h4 {
            border-color: #007cba;
        }
        .layout input[type="radio"]:checked + img {
            box-shadow: 0 0 0 3px rgba(0,123,186,.25);
        }
        .layout input[type="radio"]:checked + h4,
        .layout input[type="radio"]:checked + img + h4 {
            color: #007cba;
        }
        .layout input[type="radio"]:checked + img + h4 {
            border-bottom: 3px solid #007cba;
        }
        .layout label:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,.2);
        }
    </style>

    <?php
}

learndash_grid_layouts_layouts_tab();
