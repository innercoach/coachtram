<?php
/**
 * Admin UI — Shared CSS, JS, tab system, and field rendering helpers.
 */

/* ============================================================
   ADMIN STYLES & SCRIPTS
   ============================================================ */
add_action('admin_enqueue_scripts', function ($hook) {
    // Only on post edit screens and our options page
    if (!in_array($hook, ['post.php', 'post-new.php', 'settings_page_edt-settings'])) return;

    wp_enqueue_media(); // Media library

    // Admin CSS
    wp_add_inline_style('wp-admin', edt_admin_css());

    // Admin JS
    wp_add_inline_script('jquery', edt_admin_js());
});


/* ============================================================
   ADMIN CSS
   ============================================================ */
function edt_admin_css() {
    return '
    /* Tab navigation */
    .edt-tabs { display: flex; flex-wrap: wrap; gap: 0; border-bottom: 2px solid #c3c4c7; margin-bottom: 20px; }
    .edt-tab { padding: 10px 18px; cursor: pointer; font-weight: 500; font-size: 13px; border: 1px solid transparent; border-bottom: none; border-radius: 4px 4px 0 0; margin-bottom: -2px; background: transparent; color: #50575e; transition: all 0.2s; }
    .edt-tab:hover { color: #135e96; background: #f6f7f7; }
    .edt-tab.active { background: #fff; color: #1d2327; border-color: #c3c4c7; border-bottom-color: #fff; font-weight: 600; }
    .edt-tab-panel { display: none; }
    .edt-tab-panel.active { display: block; }

    /* Field rows */
    .edt-field-row { margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f1; }
    .edt-field-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    .edt-field-row > label { display: block; font-weight: 600; margin-bottom: 6px; color: #1d2327; }
    .edt-field-row input[type="text"],
    .edt-field-row input[type="url"],
    .edt-field-row input[type="number"],
    .edt-field-row input[type="date"],
    .edt-field-row input[type="datetime-local"],
    .edt-field-row textarea { width: 100%; max-width: 600px; }
    .edt-field-row textarea { min-height: 80px; }
    .edt-field-desc { display: block; font-size: 12px; color: #646970; margin-top: 4px; font-style: italic; }

    /* Image picker */
    .edt-image-preview { max-width: 300px; margin-bottom: 8px; border: 1px solid #ddd; border-radius: 4px; padding: 4px; background: #fafafa; }
    .edt-image-preview img { display: block; max-width: 100%; height: auto; border-radius: 3px; }
    .edt-image-preview:empty { display: none; }
    .edt-upload-btn, .edt-remove-btn { margin-right: 8px !important; }

    /* Repeater */
    .edt-repeater-item { background: #f9f9f9; border: 1px solid #e2e4e7; border-radius: 4px; padding: 15px; margin-bottom: 10px; position: relative; }
    .edt-repeater-item .edt-field-row { border-bottom-color: #e8e8e8; }
    .edt-remove-repeater { position: absolute; top: 8px; right: 8px; color: #b32d2e; cursor: pointer; font-size: 11px; background: none; border: 1px solid #b32d2e; border-radius: 3px; padding: 2px 8px; }
    .edt-remove-repeater:hover { background: #b32d2e; color: #fff; }
    .edt-add-repeater { margin-top: 5px; }

    /* Section header in admin */
    .edt-section-title { font-size: 15px; font-weight: 600; color: #1d2327; margin: 0 0 15px 0; padding: 0 0 10px 0; border-bottom: 1px solid #e2e4e7; }

    /* Group box */
    .edt-group { background: #f6f7f7; border: 1px solid #e2e4e7; border-radius: 6px; padding: 15px; margin-bottom: 15px; }
    .edt-group-title { font-size: 13px; font-weight: 600; margin: 0 0 12px 0; color: #50575e; }
    ';
}


/* ============================================================
   ADMIN JS
   ============================================================ */
function edt_admin_js() {
    return "
    jQuery(function($) {
        // Tab switching
        $(document).on('click', '.edt-tab', function(e) {
            e.preventDefault();
            var panel = $(this).data('panel');
            var box = $(this).closest('.inside, .edt-metabox-wrap');
            box.find('.edt-tab').removeClass('active');
            $(this).addClass('active');
            box.find('.edt-tab-panel').removeClass('active');
            box.find('#' + panel).addClass('active');
        });

        // Image upload
        $(document).on('click', '.edt-upload-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var inputId = btn.data('input-id');
            var frame = wp.media({
                title: 'Chọn ảnh',
                button: { text: 'Chọn ảnh này' },
                multiple: false,
                library: { type: 'image' }
            });
            frame.on('select', function() {
                var att = frame.state().get('selection').first().toJSON();
                $('#' + inputId).val(att.id);
                var url = att.sizes && att.sizes.medium ? att.sizes.medium.url : att.url;
                $('#' + inputId + '_preview').html('<img src=\"' + url + '\">');
            });
            frame.open();
        });

        // Image remove
        $(document).on('click', '.edt-remove-btn', function(e) {
            e.preventDefault();
            var inputId = $(this).data('input-id');
            $('#' + inputId).val('');
            $('#' + inputId + '_preview').html('');
        });

        // Repeater add
        $(document).on('click', '.edt-add-repeater', function(e) {
            e.preventDefault();
            var container = $(this).prev('.edt-repeater-container');
            var template = container.find('.edt-repeater-template').html();
            var index = container.find('.edt-repeater-item').length;
            template = template.replace(/__INDEX__/g, index);
            container.append('<div class=\"edt-repeater-item\">' + template + '</div>');
        });

        // Repeater remove
        $(document).on('click', '.edt-remove-repeater', function(e) {
            e.preventDefault();
            $(this).closest('.edt-repeater-item').remove();
        });
    });
    ";
}


/* ============================================================
   FIELD RENDERING HELPERS
   ============================================================ */

/**
 * Text input field.
 */
function edt_text_field($name, $label, $value, $desc = '', $placeholder = '') {
    echo '<div class="edt-field-row">';
    echo '<label for="' . esc_attr($name) . '">' . esc_html($label) . '</label>';
    echo '<input type="text" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" placeholder="' . esc_attr($placeholder) . '">';
    if ($desc) echo '<span class="edt-field-desc">' . esc_html($desc) . '</span>';
    echo '</div>';
}

/**
 * URL input field.
 */
function edt_url_field($name, $label, $value, $desc = '') {
    echo '<div class="edt-field-row">';
    echo '<label for="' . esc_attr($name) . '">' . esc_html($label) . '</label>';
    echo '<input type="url" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" value="' . esc_url($value) . '">';
    if ($desc) echo '<span class="edt-field-desc">' . esc_html($desc) . '</span>';
    echo '</div>';
}

/**
 * Textarea field.
 */
function edt_textarea_field($name, $label, $value, $desc = '') {
    echo '<div class="edt-field-row">';
    echo '<label for="' . esc_attr($name) . '">' . esc_html($label) . '</label>';
    echo '<textarea id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" rows="3">' . esc_textarea($value) . '</textarea>';
    if ($desc) echo '<span class="edt-field-desc">' . esc_html($desc) . '</span>';
    echo '</div>';
}

/**
 * Rich text editor (wp_editor).
 */
function edt_editor_field($name, $label, $value, $desc = '', $rows = 6) {
    echo '<div class="edt-field-row">';
    echo '<label>' . esc_html($label) . '</label>';
    wp_editor($value, $name, [
        'textarea_name' => $name,
        'textarea_rows' => $rows,
        'media_buttons' => false,
        'teeny'         => true,
        'quicktags'     => true,
    ]);
    if ($desc) echo '<span class="edt-field-desc">' . esc_html($desc) . '</span>';
    echo '</div>';
}

/**
 * Image picker field.
 */
function edt_image_field($name, $label, $value, $desc = '') {
    $img_url = '';
    if ($value) {
        $src = wp_get_attachment_image_src(absint($value), 'medium');
        if ($src) $img_url = $src[0];
    }
    echo '<div class="edt-field-row">';
    echo '<label>' . esc_html($label) . '</label>';
    echo '<input type="hidden" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '">';
    echo '<div class="edt-image-preview" id="' . esc_attr($name) . '_preview">';
    if ($img_url) echo '<img src="' . esc_url($img_url) . '">';
    echo '</div>';
    echo '<button type="button" class="button edt-upload-btn" data-input-id="' . esc_attr($name) . '">Chọn từ thư viện</button>';
    echo '<button type="button" class="button edt-remove-btn" data-input-id="' . esc_attr($name) . '">Xóa ảnh</button>';
    if ($desc) echo '<span class="edt-field-desc">' . esc_html($desc) . '</span>';
    echo '</div>';
}

/**
 * Number input field.
 */
function edt_number_field($name, $label, $value, $desc = '') {
    echo '<div class="edt-field-row">';
    echo '<label for="' . esc_attr($name) . '">' . esc_html($label) . '</label>';
    echo '<input type="text" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" style="max-width:200px;">';
    if ($desc) echo '<span class="edt-field-desc">' . esc_html($desc) . '</span>';
    echo '</div>';
}

/**
 * Datetime-local input field.
 */
function edt_datetime_field($name, $label, $value, $desc = '') {
    echo '<div class="edt-field-row">';
    echo '<label for="' . esc_attr($name) . '">' . esc_html($label) . '</label>';
    echo '<input type="datetime-local" id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '" style="max-width:300px;">';
    if ($desc) echo '<span class="edt-field-desc">' . esc_html($desc) . '</span>';
    echo '</div>';
}

/**
 * Render tab navigation.
 */
function edt_render_tabs($tabs) {
    echo '<div class="edt-tabs">';
    $first = true;
    foreach ($tabs as $id => $label) {
        $class = $first ? 'edt-tab active' : 'edt-tab';
        echo '<div class="' . $class . '" data-panel="' . esc_attr($id) . '">' . esc_html($label) . '</div>';
        $first = false;
    }
    echo '</div>';
}

/**
 * Open a tab panel.
 */
function edt_open_tab($id, $first = false) {
    $class = $first ? 'edt-tab-panel active' : 'edt-tab-panel';
    echo '<div id="' . esc_attr($id) . '" class="' . $class . '">';
}

/**
 * Close a tab panel.
 */
function edt_close_tab() {
    echo '</div>';
}
