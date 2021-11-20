<?php

return [

    env('SESSION_DRIVER,
    database'),

    cons('SESSION_TABLE,
    sessions'),

    env('HTTP_USER_AGENT,'
        . $_SERVER['HTTP_USER_AGENT']),

    env('SESSID_NAME,
    IMBERELSESSID'),

    env('COOKIE_LIFETIME,
    2592000'),

    env('SESSION_LIFETIME,
    3600'),

    env('SESSION_TABLE,
    sessions'),
];