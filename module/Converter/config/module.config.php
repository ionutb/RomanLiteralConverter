<?php

return
	array(
		'router' => array(
			'routes' => array(
				'home' => array(
					'type' => 'Zend\Mvc\Router\Http\Literal',
					'options' => array(
						'route'    => '/',
						'defaults' => array(
							'controller' => 'Converter\Controller\Index',
							'action'     => 'index',
						),
					),
				),
				'convert-route' => array(
					'type'    => 'segment',
					'options' => array(
						'route'    => '/converter/:action',
						'verb' => 'POST',
						'constraints' => array(
							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						),
						'defaults' => array(
							'__NAMESPACE__' => 'Converter\Controller',
							'controller'    => 'Index',
							'action'        => 'convertToRoman',
						),
						'may_terminate' => true,
					),
				)
			)
		),
		'controllers' => array(
			'invokables' => array(
				'Converter\Controller\Index' => 'Converter\Controller\IndexController'
			),
		),
		'view_manager' => array(
			'display_not_found_reason' => APPLICATION_ENV != 'production',
			'display_exceptions'       => APPLICATION_ENV != 'production',
			'doctype'                  => 'HTML5',
			'not_found_template'       => 'error/404',
			'exception_template'       => 'error/index',
			'template_map' => array(
				'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
				'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
				'error/404'               => __DIR__ . '/../view/error/404.phtml',
				'error/index'             => __DIR__ . '/../view/error/index.phtml',
			),
			'template_path_stack' => array(
				__DIR__ . '/../view',
			),
		),
		'service_manager' => array(
			'abstract_factories' => array(
				'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
			)
		),



	);