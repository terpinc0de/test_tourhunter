<?php

namespace app\modules\account;

use Yii;
use yii\base\Module;
use yii\base\BootstrapInterface;

class AccountModule extends Module implements BootstrapInterface
{
    private static $isEventsRun;

    public function bootstrap($app)
    {
        if (self::$isEventsRun === null) {
            $container = Yii::$container;
            $container->setSingleton('app\modules\account\storages\interfaces\IUserStorage', 'app\modules\account\storages\UserStorage');
            $container->setSingleton('app\modules\account\services\interfaces\IAuthService', 'app\modules\account\services\YiiAuthService');
            $this->registerTranslations();
            self::$isEventsRun = true;
        }
    }

    public static function t($message, $params = [], $language = null)
    {
        if(isset(Yii::$app->i18n->translations['account/*']))
        return Yii::t('account/app', $message, $params, $language);
        
        return $message;
    }

    private function registerTranslations()
    {
        Yii::$app->i18n->translations[$this->id . '/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/modules/' . $this->id . '/messages',
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                $this->id . '/app' => 'app.php',
            ],
        ];
    }
}