<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use app\modules\blog\models;
?>


<div>
    <h2>
        <a href="<?=Url::to(['show', 'id'=> $model->id])?>"><?=$model->title?></a>
    </h2>
</div>

<div>
    <?= HtmlPurifier::process($model->content) ?>
</div>
