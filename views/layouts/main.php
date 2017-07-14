<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\widgets;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
   <link rel="canonical" href="https://inter48.tech<?php echo $_SERVER['REQUEST_URI']; ?>" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'activateParents' => true,
        'items' => array_filter([

            ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],


            ['label' => Yii::t('app', 'NAV_BLOG'), 'url' => ['/blog/view/index']],


            ['label' => Yii::t('app', 'NAW_CONTACT'), 'url' => ['/main/contact/index']],

            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] :
                false,

            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
                false,

            Yii::$app->user->can('admin') ?
                ['label' => Yii::t('app', 'NAV_ADMIN'), 'items' => [
                    ['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
                    ['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
                    ['label' => Yii::t('app', 'NAV_BLOG'), 'url' => ['/blog/post/index']],
                ]] :
                false,

            !Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_PROFILE'), 'items' => [
                    ['label' => Yii::$app->user->id/*Yii::t('app', 'NAV_PROFILE')*/, 'url' => ['/user/profile/index']],
                    ['label' => Yii::t('app', 'NAV_LOGOUT'),
                        'url' => ['/user/default/logout'],
                        'linkOptions' => ['data-method' => 'post']]
                ]] :
                false,
           //['label' => Yii::$app->user->id],
        ]),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= @app\components\widgets\Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

     <!--   <p class="pull-right"><?= Yii::powered() ?></p>   -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
