<?php

namespace app\modules\account\forms;

use yii\base\Model;
use app\modules\account\AccountModule as M;

class EntryForm extends Model
{
    public $username;

    public $rememberMe;

    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username'], 'string', 'min' => 3, 'max' => 32],
            [['rememberMe'], 'in', 'range' => [0, 1]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => M::t('Your login'),
            'rememberMe' => M::t('Remember me'),
        ];
    }
}