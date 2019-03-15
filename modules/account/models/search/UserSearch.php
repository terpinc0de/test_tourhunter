<?php

namespace app\modules\account\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\account\models\User;
use app\modules\account\AccountModule as M;

class UserSearch extends Model
{
    public $username;

    public $balance;

    public $createdAt;

    public function attributeLabels()
    {
        return [
            'username' => M::t('User name'),
            'createdAt' => M::t('Created at'),
            'balance' => M::t('Balance'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['createdAt'] = [
            'asc' => [User::tableName() . '.created_at' => SORT_ASC],
            'desc' => [User::tableName() . '.created_at' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
