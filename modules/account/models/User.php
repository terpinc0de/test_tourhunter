<?php

namespace app\modules\account\models;
 
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property float $balance
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }
}
