<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Inspect\Controller\Inspect' => 'Inspect\Controller\InspectController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'inspect' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/inspect',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Inspect\Controller',
                        'controller'    => 'Inspect',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    'router' => array(
    		'routes' => array(
    				'inspect' => array(
    						'type'    => 'segment',
    						'options' => array(
    								'route'    => '/inspect[/:action][/:id]',
    								'constraints' => array(
    										'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
    										'id'     => '[0-9]+',
    								),
    								'defaults' => array(
    										'controller' => 'Inspect\Controller\Inspect',
    										'action'     => 'index',
    								),
    						),
    				),
    		),
    ),
        
    
    'view_manager' => array(
        'template_path_stack' => array(
            'Inspect' => __DIR__ . '/../view',
        ),
    ),
);
