<?php
/**
this is the global config. each module will have its own config merged into this one when loaded
 */
return array(
	//array of module namespaces used in the application.
	'modules' => array(
		'Converter',
	),

	'module_listener_options' => array(
		'module_paths' => array(
			'./module',
			'./vendor',
		),
		'config_glob_paths' => array(
			'config/autoload/{{,*.}global,{,*.}local}.php',
		),
	)
);
