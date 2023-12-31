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
                ['class' => 'yii\rest\UrlRule', 'controller' => 'answer', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'attendance', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'code', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'degree', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'extracurricular', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'extra-group', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'grade', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'person', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'question', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'tag', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'teacher', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'classroom', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'group', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'listg', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'library', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'subject', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'major', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'subject-major', 'pluralize' => false],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'extra-group/buscar/<text:.*>', 'route' => 'extra-group/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'extra-group/total/<text:.*>', 'route' => 'extra-group/total'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'grade/buscar/<text:.*>', 'route' => 'grade/buscar'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'grade/total/<text:.*>', 'route' => 'grade/total'],
                //Regla para la funcion que trae la lista de un cierto grupo
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'listg',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>'
                    ],
                    'extraPatterns' => [
                        'GET listas/{id}' => 'listas'
                    ],
                ],
                //Regla que trae el detalle de asistencia de un cierto fklist
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'attendance',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>'
                    ],
                    'extraPatterns' => [
                        'GET asistencias/{id}' => 'asistencias'
                    ],
                ],
                //Regla para traer todos los codigos de un grupo especifico
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'code',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>'
                    ],
                    'extraPatterns' => [
                        'GET codigos/{id}' => 'codigos'
                    ],
                ],
                //Regla para traer todos los archivos de un grupo especifico
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'library',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>'
                    ],
                    'extraPatterns' => [
                        'GET librarys/{id}' => 'librarys'
                    ],
                ],

                //Regla para extra-group
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'extra-group',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total' => 'id',
                    ],
                ],
                //Regla para grade
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'grade',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total' => 'id',
                    ],
                ],
            ],
        ],
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