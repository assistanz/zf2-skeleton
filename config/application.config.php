<?php
return array(
    'modules' => array(
        'AssetManager',
        'DoctrineModule',
        'DoctrineORMModule',
        'ZendDeveloperTools',
        'DluTwBootstrap',
        'ZfcBase',
        'ZfcUser',
        'Application',
        'Album',
        'Security'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
