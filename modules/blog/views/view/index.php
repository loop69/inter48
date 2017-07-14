<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use app\modules\blog\models;
//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'События');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <div class="body-content">
        <div class="row">
            <div class="col-lg-8">
                 <?php echo ListView::widget([
                    'dataProvider' => $listDataProvider,
                    'itemView' => '_list', ]);
                 ?>
                </div>
            <div class=" col-lg-1" >

            </div>
                <div class="col-lg-3 right-sidebar">
                    <?php if(Yii::$app->user->can('createPost')):?>
                    <div>
                        <p> <a href="<?=Url::to(['/blog/view/create'])?>"><?=Yii::t('app', 'NAV_CREATE')?></a></p>
                    </div>
                    <?php endif;?>
                    <?php echo ListView::widget([
                        'dataProvider' => $post_title,
                        'layout' => "{summary}\n{items}\n",
                        'summary' => '<a href="/blog/view" class="nav-header">ВСЕ СОБЫТИЯ</a>',
                        'itemView' => '_listcategory', ]);
                    ?>

            </div>
        </div>
    </div>
</div>