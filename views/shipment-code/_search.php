<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipment-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'shipment_id') ?>

    <?= $form->field($model, 'input_by') ?>

    <?php // echo $form->field($model, 'delete_by') ?>

    <?php // echo $form->field($model, 'input_time') ?>

    <?php // echo $form->field($model, 'delete_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('admin', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('admin', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
