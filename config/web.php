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
                ['class' => 'yii\rest\UrlRule', 'controller' => 'extra-person', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'grade', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'person', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'question', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'tag', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'teacher', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'classroom', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'group', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'listg'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'library', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'subject', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'major', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'subject-major', 'pluralize' => false],


                //reglas para buscar total listg
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'listg/buscar/<text:[\w\-]+>/<id:\d+>',
                    'route' => 'listg/buscar',
                    'defaults' => ['id' => null],
                ],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'listg/total/<text:[\w\-]+>/<id:\d+>', 'route' => 'listg/total'],


                //buscar total major
                [
                    'class' => 'yii\web\UrlRule', 
                    'pattern' => 'major/buscar/<text:.*>', 
                    'route' => 'major/buscar'
                ],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'major/total/<text:.*>', 'route' => 'major/total'],
                
                //buscar total subject
                [
                    'class' => 'yii\web\UrlRule', 
                    'pattern' => 'subject/buscar/<text:.*>', 
                    'route' => 'subject/buscar'
                ],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'subject/total/<text:.*>', 'route' => 'subject/total'],                            



                //buscar total grade
                [
                    'class' => 'yii\web\UrlRule', 
                    'pattern' => 'grade/buscar', 
                    'route' => 'grade/buscar'
                ],                
                ['class' => 'yii\web\UrlRule', 'pattern' => 'grade/total/<text:.*>', 'route' => 'grade/total'],



                //buscar total group
                [
                    'class' => 'yii\web\UrlRule', 
                    'pattern' => 'group/buscar/<text:.*>', 
                    'route' => 'group/buscar'
                ],    
                ['class' => 'yii\web\UrlRule', 'pattern' => 'group/total/<text:.*>', 'route' => 'group/total'],

                //buscar total classroom
                [
                    'class' => 'yii\web\UrlRule', 
                    'pattern' => 'classroom/buscar/<text:.*>', 
                    'route' => 'classroom/buscar'
                ],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'classroom/total/<text:.*>', 'route' => 'classroom/total'],

                //buscar total library
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'library/buscar/<text:[\w\-]+>/<id:\d+>',
                    'route' => 'library/buscar',
                    'defaults' => ['id' => null],
                ],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'library/total/<text:[\w\-]+>/<id:\d+>', 'route' => 'library/total'],


                //buscar total question
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'question/buscar/<text:[\w\-]+>/<id:\d+>',
                    'route' => 'question/buscar',
                    'defaults' => ['id' => null],
                ],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'question/total/<text:[\w\-]+>/<id:\d+>', 'route' => 'question/total'],


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



                 //Regla para traer todos los extra-group de un grupo especifico               
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'extragroup',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>'
                    ],
                    'extraPatterns' => [
                        'GET extragroups/{id}' => 'extragroups'
                    ],
                ],   

                 //Regla para traer todos los grade de un grupo especifico               
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'grade',
                    'tokens' => [
                        '{id}' => '<id:\\d[\\d,]*>',
                    ],
                    'extraPatterns' => [
                        'GET grades/{id}' => 'grades',
                    ],
                ],   
                
                //Regla para buscar en listg
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'listg',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}' => 'total',
                        'GET gruposp/{text}' => 'gruposp'
                    ],
                ],                

                //Regla para buscar en major
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'major',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total' => 'id',
                    ],
                ],
                
                //Regrla para buscar en subjects
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'subject',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total' => 'id',
                    ],
                ],



                //Regla para buscar en group
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'group',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}'      => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total' => 'id',
                    ],
                ],

                //Regla para buscar en classroom
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'classroom',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}'      => '<text:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total' => 'id',
                    ],
                ],
                
                //Regla para buscar en library
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'library',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}' => 'total',
                    ],
                ],



                //Regla para buscar en grade
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'grade',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}' => 'total',
                    ],
                ], 
                
                 //Reglas de extragroup
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'extra-group/extragroups/<id:\d+>',
                    'route' => 'extra-group/extragroups',
                    'defaults' => ['text' => null],
                ],
                [
                    'class' => 'yii\web\UrlRule',
                    'pattern' => 'extra-group/buscar/<text:\w+>',
                    'route' => 'extra-group/buscar',
                ], 
                
                
                //Regla para buscar en question
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'question',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}' => 'total',
                    ],
                ],
                //Regla para teacher
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'teacher',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST registrar' => 'registrar',
                    ],
                ],
                //Regla para teacher
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'person',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST registrar' => 'registrar',
                    ],
                ],
                //Regla para traer todos los grupo de una persona especifico
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'group',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET grupos/{id}' => 'grupos'
                    ],
                ],

                //Regla para buscar en question
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'question',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET buscar/{text}' => 'buscar',
                        'GET total/{text}' => 'total',
                    ],
                ],
                //Regla para teacher
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'teacher',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST registrar' => 'registrar',
                    ],
                ],
                //Regla para teacher
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'person',
                    'tokens' => [
                        '{id}' => '<id:\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST registrar' => 'registrar',
                    ],
                ],
                //Regla para traer todos los grupo de una persona especifico
                [
                    'class'      => 'yii\rest\UrlRule',
                    'controller' => 'group',
                    'tokens' => [
                        '{id}'        => '<id:\\d[\\d,]*>',
                        '{text}' => '<text:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET grupos/{id}' => 'grupos'
                    ],
                ],                
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
