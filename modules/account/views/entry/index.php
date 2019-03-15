<?php

use app\modules\account\AccountModule as M;
use yii\widgets\ActiveForm;

?>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column">
                <div id="login-box" class="col-md-12">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'class' => 'form',
                    ]) ?>
                        <h3 class="text-center text-info"><?= M::t('Sign in') ?></h3>

                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-md"><?= M::t('Go!') ?></button>
                        </div>

                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>