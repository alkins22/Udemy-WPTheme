<?php

function up_admin_menus() {
    add_menu_page(
        __('Udemy Plus', 'udemy-plus'),
        __('Udemy Plus', 'udemy-plus'),
        'edit_theme_options',
        'up_plugin_options',
        'up_plugin_options_page',
        plugins_url('letter-u.svg', UP_PLUGIN_FILE )
    );
}