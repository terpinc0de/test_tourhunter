<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'tourhunter-tests',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'account',
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../public_html/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'user' => [
            'identityClass' => 'app\modules\account\services\UserIdentity',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
    ],
    'params' => $params,
    'modules' => [
        'account' => [
            'class' => 'app\modules\account\AccountModule',
        ],
    ],
    'container' => [
        'definitions' => [
            'app\custom\services\transaction\ITransaction' => 'app\custom\services\transaction\DummyTransaction',
        ],
    ],
];
