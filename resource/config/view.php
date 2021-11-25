<?php

return [
    env('LAYOUT_PREFIX,
    __layout.'),

    env('LAYOUT_EXTENSION,
    .php'),

    env('DEFAULT_LAYOUT,
    main'),

    env('VIEW_EXTENSION,
    .slade.php'),

    env('VIEW_PLACEHOLDER,
    {{view}}'),

    env('VIEW_DIR,
    ' . APP_BASE_PATH . '/resource/web/views/'),

    env('LAYOUT_DIR,
    ' . APP_BASE_PATH . '/resource/web/layouts/')
];