<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\account\AccountModule as M;

$this->title = M::t('Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>

<?php /*
<a href="<?= Url::to(['index']) ?>" class="btn btn-warning"><?= M::t('Сбросить фильтр') ?></a>
*/ ?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'summaryOptions' => ['class' => 'summary'],

	'columns' => [

        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'username',
            'label' => $searchModel->getAttributeLabel('username'),
            'value' => function($model) {
                return $model->username;
            }
        ],

        [
            'attribute' => 'balance',
            'label' => $searchModel->getAttributeLabel('balance'),
            'value' => function($model) {
                return $model->balance;
            }
        ],

        [
            'attribute' => 'createdAt',
            'label' => $searchModel->getAttributeLabel('createdAt'),
            'value' => function($model) {
                return date('d-m-Y H:i', $model->created_at);
            }
        ],

	],
]); ?>

