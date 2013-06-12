<?php
use DoctrineModule;
use DoctrineORMModule;
return array(
    'modules' => array(
        'Application',        
        'ZfcBase',
        'ZfcUser',
        'ZfTable','Inspect','Album','DoctrineModule','DoctrineORMModule','synergydatagrid'
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
