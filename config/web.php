<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'দেওয়ানী ও সার্ভে ট্রাইব্যুনাল মামলার মনিটরিং সিষ্টেম',
    'language' => 'bn',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],		
    'modules' => [
	        'notifications' => [
	            'class' => 'machour\yii2\notifications\NotificationsModule',            
	            'notificationClass' => 'app\models\Notification',            
	            'userId' => function() {                
			return \Yii::$app->user->identity->userof;
	            }
	        ],      
	    ],
	'components' => [
        'request' => [            
            'cookieValidationKey' => 'VXpxMl3Qrytzv87UgNcRc4PZAuNA-lun',
        ],
	'formatter' => [
            'dateFormat' => 'dd/MM/yyyy',
			'defaultTimeZone' => 'UTC',
			//'timeZone' => 'Asia/Dhaka',
        ],       
        'cache' => [
            'class' => 'yii\caching\FileCache',			
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<alias:\w+>' => 'site/<alias>',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => false,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'savePath' => '@app/runtime/session'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',            
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
        'db' => require(__DIR__ . '/db.php'),		
    ],		
    'params' => $params,
	
];

return $config;