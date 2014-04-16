<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Detention Utilization Study',
	'defaultController'=>'detention',
	'theme'=>'jdai',
    //'localeDataPath' => 'protected/i18n/',
	
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'softek',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', $_SERVER['REMOTE_ADDR'])
		),

	),

	// application components
	'components'=>array(


        'user'=>array(
            'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl'=>array('detention/index')
		),
		// uncomment the following to enable URLs in path-format

        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('account_user'),
        ),

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
            'showScriptName' => false,
		),

		'db'=>array(
            'connectionString' => 'sqlsrv:Server=jdai.demo.aisnovations.com; Database=jdai',
			'username' => 'jdai',
			'password' => 'MCkJEjWLL7biZvXR9jCL',
			'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging' => true,
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
                /*
                array(
                    'class'=>'CProfileLogRoute',
                    'levels'=>'profile',
					'enabled'=>true,
				),
				// uncomment the following to show log messages on web pages

				array(
					'class' => 'CWebLogRoute',
                    'categories' => 'application',
                    'levels'=>'error, warning, trace, profile, info',
				),
                */
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'d.drynov@aisnovations.com',
	),
);