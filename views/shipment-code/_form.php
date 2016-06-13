<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipment-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \app\models\ShipmentType::find()->all(), 'type', 'type'),['maxlength' => true]) ?>

    <?php //= $form->field($model, 'shipment_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
