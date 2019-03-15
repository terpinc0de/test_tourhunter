<?php

namespace app\modules\account\mappers;

use app\modules\account\models\User;
use app\modules\account\forms\EntryForm;

class UserMapper
{
    public function getUserModelFromEntryForm(EntryForm $form)
    {
        $model = new User();
        $model->username = $form->username;
        return $model;
    }
}