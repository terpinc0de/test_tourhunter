<?php

use app\modules\account\AccountModule as M;

$this->title = M::t('Money transfer');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <h1><?= $this->title ?></h1>
    <hr>
    <div class="row">
        <div class="col-lg-4">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
        <div class="col-lg-6 pull-right">
            <?= $this->render('_detail', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
