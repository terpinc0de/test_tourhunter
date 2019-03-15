<?php

use yii\widgets\DetailView;
use app\modules\account\AccountModule as M;

?>
<h2><?= M::t('Balance') ?></h2>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'balance',
            'value' => function($model) {
                return $model->getFormattedBalance();
            }
        ],
        [
            'attribute' => 'maxTransferSum',
            'value' => function($model) {
                return $model->getFormattedMaxTransferSum();
            }
        ],
    ],
]) ?>