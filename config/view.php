<?php

return [
    env('VIEWS_DIR,' .
        ROOTDIR . '/resources/views/'),

    env('LAYOUTS_DIR,' .
        ROOTDIR . '/resources/views/layouts/'),

    env('LAYOUT_PREFIX,
        __layout.'),

    env('LAYOUT_EXTENSION,
        .php'),

    env('VIEW_EXTENSION,
        .brick.php'),

    cons('VIEW_PLACEHOLDER,
        {{content}}'),
];