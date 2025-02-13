
<?php
require_once __DIR__ . '/acf.php';


add_action('after_setup_theme', function() {
    register_nav_menu('header', __('Header Menu', 'barry-timberland-2025'));
});

add_action('wp_nav_menu_item_custom_fields', function($item_id, $item) {
    $is_cta = get_post_meta($item_id, '_menu_item_is_cta', true);
    ?>
    <p class="field-is-cta description">
        <label>
            <input type="checkbox" name="menu_item_is_cta[<?php echo $item_id; ?>]" value="1" <?php checked($is_cta, 1); ?>>
            <?php _e('Is a CTA?', 'barry-timberland-2025'); ?>
        </label>
    </p>
    <?php
}, 10, 2);

add_action('wp_update_nav_menu_item', function($menu_id, $menu_item_id) {
    $is_cta = isset($_POST['menu_item_is_cta'][$menu_item_id]) ? 1 : 0;
    update_post_meta($menu_item_id, '_menu_item_is_cta', $is_cta);
}, 10, 2);


add_filter('wp_nav_menu_objects', function ($items) {
    foreach ($items as $item) {
        // $item->is_cta = get_post_meta($item->ID, '_menu_item_is_cta', true) == 1;
    }
    return $items;
});