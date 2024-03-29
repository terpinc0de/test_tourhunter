<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\modules\account\AccountModule;

if(Yii::$app->user->isGuest) {
    $navItems = [
        ['label' => AccountModule::t('Sign in'), 'url' => ['/account/entry/']],
    ];
} else {
    $navItems = [
        ['label' => AccountModule::t('Money transfer'), 'url' => ['/account/money-transfer/']],
    ];

    $navItems[] = '<li>'
    . Html::beginForm(['/account/logout'], 'post')
    . Html::submitButton(AccountModule::t('Logout ({username})', [
        'username' => Yii::$app->user->identity->getUsername(),
    ]),
        ['class' => 'btn btn-link logout']
    )
    . Html::endForm()
    . '</li>';
}

$navItems = array_merge([
    ['label' => AccountModule::t('Users'), 'url' => ['/']],
], $navItems);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
