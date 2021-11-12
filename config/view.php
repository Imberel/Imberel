<?php

return [
    env('VIEWS_DIR,' .
        ROOTDIR . '/app/resources/views/'),

    env('LAYOUTS_DIR,' .
        ROOTDIR . '/app/resources/views/layouts/'),

    env('LAYOUT_EXTENSION,
        __layout.php'),

    env('VIEW_EXTENSION,
        .brick.php'),

    cons('VIEW_PLACEHOLDER,
        {{content}}'),
];