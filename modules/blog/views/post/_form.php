<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use iutbay\yii2kcfinder\KCFinderInputWidget;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'standart'
    ]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map($category, 'id', 'name')
    ) ?>

 <!--   <?/*= $form->field($model, 'category_id')->textInput() */?>-->

    <?= $form->field($model, 'status')->dropDownList([
        '0' => 'Черновик',
        '1' => 'Опубликован'
    ]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
