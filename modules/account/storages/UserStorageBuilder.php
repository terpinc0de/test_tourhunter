<?php

namespace app\modules\account\storages;

use Yii;

class UserStorageBuilder
{
    public function build()
    {
        return Yii::createObject('app\modules\account\storages\interfaces\IUserStorage');
    }
}