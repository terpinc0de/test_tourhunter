<?php

namespace app\modules\account\controllers;

use Yii;
use yii\web\Controller;
use app\modules\account\models\search\UserSearch;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}