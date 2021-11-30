<?php

return [

    env('APP_LOGS_STORAGE,
    ' . APP_BASE_PATH . '/runtime/logs/'),

    env('MIGRATIONS_FOLDER,
    ' . APP_BASE_PATH . '/runtime/migrations/')
];