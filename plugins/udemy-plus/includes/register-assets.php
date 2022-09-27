<?php

function up_register_assets() {
    wp_register_style(
        'up_admin',
        plugins_url('/build/admin/index.css', UP_PLUGIN_FILE)
    );

    $adminAssets = include (UP_PLUGIN_DIR . 'build/admin/index.asset.php');

    wp_register_script(
        'up_admin',
        plugins_url('/build/admin/index.js', UP_PLUGIN_FILE),
        $adminAssets['dependencies'],
        $adminAssets['version'],
        true
    );
}