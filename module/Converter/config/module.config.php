<?php
return
	array(
		'router' => array(
			'routes' => array(
				// HTTP routes are here
			)
		),
		'controllers' => array(
			'invokables' => array(
				'Converter\Controller\Index' => 'Converter\Controller\IndexController'
			),
		),
		'console' => array(
			'router' => array(
				'routes' => array(
					'convert-route' => array(
						'type' => 'simple',
						'options' => array(
							'route'    => 'foo bar',
							'defaults' => array(
								'controller' => 'Converter\Controller\Index',
								'action'     => 'convert',
							)
						)
					)
				)
			)
		),
	);