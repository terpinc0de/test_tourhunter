<?php

$config = require(__DIR__ . '/../../../../config/test.php');

$application = new \yii\web\Application($config);

$container = Yii::$container;

$container->setSingleton('app\modules\account\storages\interfaces\IUserStorage', 'app\modules\account\tests\_support\storages\UserStorage');
$container->setSingleton('app\modules\account\services\interfaces\IAuthService', 'app\modules\account\tests\_support\services\AuthService');