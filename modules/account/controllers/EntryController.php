<?php

namespace app\modules\account\controllers;

use Yii;
use yii\web\Controller;
use app\modules\account\forms\EntryForm;
use app\modules\account\services\SignInService;

class EntryController extends Controller
{
    private $signInService;

    public function __construct($id, $module, SignInService $signInService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->signInService = $signInService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    return $action->controller->redirect('/');
                },
            ],
        ];
    }

    public function actionIndex()
    {
        $form = new EntryForm();
        $post = Yii::$app->request->post();

        if($form->load($post) && $form->validate() && $this->signInService->signIn($form)) {
            return $this->redirect(['/']);
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }
}