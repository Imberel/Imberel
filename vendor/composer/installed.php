<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'project',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => 'imberel/imberel',
        'dev' => true,
    ),
    'versions' => array(
        'imberel/core' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'type' => 'package',
            'install_path' => __DIR__ . '/../imberel/core',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'reference' => '9f185367205e4cf247019447d97f0d5906a71829',
            'dev_requirement' => false,
        ),
        'imberel/imberel' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'project',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
    ),
);
