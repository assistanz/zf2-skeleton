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
        'BjyAuthorize',
        'Application',
        'Album',
        'Security',
        'AppConfig'
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
