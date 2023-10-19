<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'es-Es',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'unagatitaquelegustaelmambo',
            //en que formato regresar el 
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
            'enableSession'   => false,
            'loginUrl'        => null
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            //yo no debo mostrar los script de mi proyecto 
            'showScriptName' => false,
            //reglas de mi url para controlador 
            'rules' => [
                //primera regla para el primer controlador 
                ['class' => 'yii\rest\UrlRule', 'controller' => 'answer'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'attendance'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'code'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'degree'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'extracurricular'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'extra-person'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'grade'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'person'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'question'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'tag'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'teacher'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'classroom'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'group'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'listg'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'library'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'subject'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'major'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'subject-major'],                
            ],
        ]
    ],
    'params' => $params,
];

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
}

return $config;
