<?php

namespace app\modules\account\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\account\services\MoneyTransferService;
use app\modules\account\AccountModule as M;

class MoneyTransferController extends Controller
{
    private $moneyTransferService;

    public function __construct(
        $id, $module,
        MoneyTransferService $moneyTransferService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->moneyTransferService = $moneyTransferService;
    }

    public function behaviors()
    {
        return [
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
        $form = $this->moneyTransferService->createForm();
        $post = Yii::$app->request->post();

        if($form->load($post) && $form->validate() && $this->moneyTransferService->transfer($form)) {
            Yii::$app->session->setFlash('success', M::t('Money transfer to user "{username}" ({sum} units) was successfully completed.', [
                'username' => $form->recipient,
                'sum' => $form->transferSum,
            ]));
            return $this->redirect(['/']);
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }
}