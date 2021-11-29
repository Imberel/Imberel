<?php

return [
    env('SESSION_TABLE,
    sessions'),

    env('SESSION_DRIVER,
    database'),

    env('SESSID_NAME,
    IMBERELSESSID'),

    env('COOKIE_LIFETIME,
    2592000'),

    env('SESSION_LIFETIME,
    3600'),

    env('SESSION_STORAGE,
    ' . APP_BASE_PATH . '/runtime/sessions/'),
];