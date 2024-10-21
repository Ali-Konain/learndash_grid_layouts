<?php
// add menu for courses layout
function learndash_grid_layouts_menu() {
    add_menu_page(
        'LearnDash Grid Layouts',
        'LearnDash Layouts',
        'manage_options',
        'learndash-grid-layouts',
        'learndash_grid_layouts_page',
        'dashicons-layout',
        30
    );
}
add_action('admin_menu', 'learndash_grid_layouts_menu');

function learndash_grid_layouts_page() {
    ?>
    <div class="wrap">
        <h1>LearnDash Grid Layouts</h1>
        <div class="learndash-grid-layouts-admin">
            <div class="tab-buttons">
                <button class="tab-button active" data-tab="layouts">Layouts</button>
                <button class="tab-button" data-tab="settings">Settings</button>
            </div>
            <div class="tab-content">
                <div id="layouts" class="tab-pane active">
					
                    <?php include('layouts-tab.php'); ?>
                </div>
                <div id="settings" class="tab-pane">
                    <?php include('settings-tab.php'); ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .learndash-grid-layouts-admin {
            display: flex;
        }
        .tab-buttons {
            width: 200px;
            display: flex;
            flex-direction: column;
            margin-right: 20px;
        }
        .tab-button {
            background-color: #f1f1f1;
            border: none;
            padding: 10px;
            cursor: pointer;
            text-align: left;
            width: 100%;
            margin-bottom: 5px;
            font-size: 16px;
            border-left: 5px solid transparent;
        }
        .tab-button.active {
            background-color: #750FF4;
/*             border-left-color: #007cba; */
			color:white;
			border-radius:5px;
        }
        .tab-content {
            flex-grow: 1;
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
        }
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.tab-button');
            const panes = document.querySelectorAll('.tab-pane');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    panes.forEach(pane => pane.classList.remove('active'));

                    button.classList.add('active');
                    document.getElementById(button.getAttribute('data-tab')).classList.add('active');
                });
            });
        });
    </script>
    <?php
}
