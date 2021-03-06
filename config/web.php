<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'konghai',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['xicond', 'admin'],
            'enableUnconfirmedLogin' => true,
            'enableRegistration' => false,
            'enableConfirmation' => false,
            'enablePasswordRecovery' => false
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BP-VF28PiHRNPWqIeZih9Pmn6MihcpFW',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' =>
        [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y H:i a',
            'timeFormat' => 'php:H:i A',
            /*'defaultTimeZone' OR */'timeZone' => 'Asia/Jakarta', //global date formats for display for your locale.
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'verb' => 'POST',
                    'pattern' => '<action:(track|contact_us)>',
                    'route' => 'site/<action>',
                    'suffix' => '.php',
                    'mode' => 1

                ],
//                'POST contact_us.php' => 'site/contact_us',
                [
                    'verb' => 'POST',
                    'pattern' => '<action:(track|contact_us)>',
                    'route' => 'POST site/<action>',
                    'suffix' => '.php',
                    'mode' => 2
                ],
                [
                    'verb' => 'GET',
                    'pattern' => '<action:(index|track|about|contact_us)>',
                    'route' => 'site/<action>',
                    'suffix' => '.html',
                ],
            ],
        ],

        'assetManager' => [
            'appendTimestamp' => true,
            'hashCallback' => function ($path) {
                return hash('md4', $path);
            }
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource'
                ],
            ],
        ],

        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LfoQSITAAAAAHrdGO9XotXacUETxAlX9FSf-Vck',
            'secret' => '6LfoQSITAAAAADnXU-1pGmeSJTt1f-9v9tFHIoUK',
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        //'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.*'] // adjust this to your needs
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.*'] // adjust this to your needs
    ];
}

return $config;
