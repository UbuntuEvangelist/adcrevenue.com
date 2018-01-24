<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
     'name' => 'এডিসি রেভিনিউ',
    'language' => 'bn',
	'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerMap'=>[
        'file-manager-elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['theCreator'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl'=>'@web',
                    'basePath'=>'@webroot',
                    'path'   => '/',
                    'access' => ['read' => 'theCreator', 'write' => 'theCreator']
                ]
            ]
        ]
    ],
	'modules' => [
        'notifications' => [
            'class' => 'machour\yii2\notifications\NotificationsModule',            
            'notificationClass' => 'app\models\Notification',            
            'userId' => function() {
                //return \Yii::$app->user->id;
				return \Yii::$app->user->identity->userof;
            }
        ],      
    ],
	'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'VXpxMl3Qrytzv87UgNcRc4PZAuNA-lun',
        ],
		/*
		'formatter' => [
            'dateFormat' => 'dd/MM/yyyy',
			//'defaultTimeZone' => 'UTC',
			//'timeZone' => 'Asia/Dhaka',
        ],   
        */
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		/*'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@app/runtime/session'
        ],*/
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
		'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                    'sourceLanguage' => 'en'
                ],
            ],
        ],
		'assetManager' => [
			'class' => 'yii\web\AssetManager',
			'forceCopy' => false,          
		],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
		'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			//'enableStrictParsing' => true,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
				//'notifications' => 'monitoringchok/view',				
            ],						    		
        ],
    ],
    'params' => $params,
];

/*
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
} */

return $config;
