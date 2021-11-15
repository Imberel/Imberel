<?php

return [

    cons('SESSION_TABLE,
    sessions'),

    env('HTTP_USER_AGENT,'
        . $_SERVER['HTTP_USER_AGENT']),

    env('SESSID_NAME,
    IMBERELSESSID'),

    cons('USER_SESSION_ID,'
        . $_COOKIE[getenv('SESSID_NAME')]),
];