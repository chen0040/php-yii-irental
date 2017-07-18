<?php

// uncomment the following to define a path alias
Yii::setPathOfAlias('widgets','protected/widgets');

$cz_themes=array('fly', 'business3', 'orange', 'wpcraft', 'lines');

$cz_dbhost='127.0.0.1';
$cz_dbname='mysql';
$cz_dbusername='root';
$cz_dbpassword='chen0469';
$cz_theme=$cz_themes[4];


$cz_connectionString='mysql:host='.$cz_dbhost.';dbname='.$cz_dbname;
		
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Irental Web Application',
	
	//'homeUrl'=>'/ViMICE/index.php?r=event',
	//'layout'=>'czmain',
	'theme'=>$cz_theme,
	
	

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'chen0469',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',
		// rbac configured to run with module Yii-User
		'rbac'=>array(
			// Table where Users are stored. RBAC Manager use it as read-only
			'tableUser'=>'cztbl_user', 
			// The PRIMARY column of the User Table
			'columnUserid'=>'id',
			// only for display name and could be same as id
			'columnUsername'=>'username',
			// only for display email for better identify Users
			'columnEmail'=>'email' // email (only for display)
			),
	),
	
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'authManager'=>array( 
			'class'=>'CDbAuthManager', 
			'connectionID'=>'db',
			'defaultRoles'=>array('registered'), // default Role for logged in users
			'showErrors'=>true, // show eval()-errors in buisnessRules
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => $cz_connectionString,
			'emulatePrepare' => true,
			'username' => $cz_dbusername,
			'password' => $cz_dbpassword,
			'charset' => 'utf8',
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
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		
		'CURL' =>array(
			'class' => 'application.extensions.curl.Curl',
			 //you can setup timeout,http_login,proxy,proxylogin,cookie, and setOPTIONS
		),
	),
	
	

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);