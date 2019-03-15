<?php

namespace app\modules\account\controllers;

use Yii;
use yii\web\Controller;
use app\modules\account\services\interfaces\IAuthService;
use app\modules\account\exceptions\AccountException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class LogoutController extends Controller
{
    private $authService;

    public function __construct($id, $module, IAuthService $authService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if($this->authService->logout()) {
            return $this->redirect('/');
        }

        throw new AccountException('Could not logout from system.');
    }
}