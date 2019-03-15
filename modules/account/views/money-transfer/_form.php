<?php

use app\modules\account\AccountModule as M;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>
<h2><?= M::t('Make transfer') ?></h2>

<?php if(!$model->getMaxTransferSum()): ?>
    <h3><?= M::t('Insufficient balance on the account to perform this operation.') ?></h3>
    <?php return; ?>
<?php endif; ?>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'recipient')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transferSum')->widget(MaskedInput::className(), [
        'options' => [
            'type' => 'tel',
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'alias' => 'decimal',
            'rightAlign' => false,
            'digits' => 2,
        ],
    ]) ?>

    <div class="form-group">
        <button type="submit" class="btn btn-success"><?= M::t('Send') ?></button>
    </div>

<?php ActiveForm::end() ?>