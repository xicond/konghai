<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TrackerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tracker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'shipment_id') ?>

    <?= $form->field($model, 'shipment_code') ?>

    <?= $form->field($model, 'track_date') ?>

    <?= $form->field($model, 'track_time') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'input_by') ?>

    <?php // echo $form->field($model, 'input_time') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'history') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('admin', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('admin', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
