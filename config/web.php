<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language'=>'pt-BR',
    'timeZone' => 'America/Manaus',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'xkXa8fAcclZtTKwX2esdhDkUhT4Dbl7g',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'db'                   => require(__DIR__ . '/db.php'),
        'db_base'              => require(__DIR__ . '/db_base.php'),
        'db_apl'               => require(__DIR__ . '/db_apl.php'),
        'db_rep'               => require(__DIR__ . '/db_rep.php'),
        'db_manut_transporte'  => require(__DIR__ . '/db_manut_transporte.php'),
        'senachttp'            => require(__DIR__ . '/senachttp.php'),
        'db_psg'               => require(__DIR__ . '/db_psg.php'),
        'db_vestibular'        => require(__DIR__ . '/db_vestibular.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],

    'modules' => [
            'comunicacaointerna' => [
                'class' => 'app\modules\comunicacaointerna\Comunicacaointerna',
            ],

            'aux_planejamento' => [
            'class' => 'app\modules\aux_planejamento\Aux_planejamento',
            ],

            'manut_transporte' => [
            'class' => 'app\modules\manut_transporte\Manut_transporte',
            ],

            'siteadmin' => [
            'class' => 'app\modules\siteadmin\Siteadmin',
            ],

                'gridview' =>  [
                'class' => '\kartik\grid\Module'
                               ],
                'dynagrid'=> [
                        'class'=>'\kartik\dynagrid\Module',
                        // other module settings
                    ],
                'markdown' => [
                'class' => 'kartik\markdown\Module',
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
