<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-group field-shipmentcode-code">
    <?= Html::activeLabel($model, 'code', ['class' => "control-label"]) ?>
    <?= Html::activeTextInput($model, 'code',['maxlength' => true, 'class' => "form-control"]) ?>
    <div class="help-block"></div>
</div>

<div class="form-group field-shipmentcode-type">
    <?= Html::activeLabel($model, 'type', ['class' => "control-label"]) ?>
    <?= Html::activeTextInput($model, 'type',['maxlength' => true, 'class' => "form-control"]) ?>
    <div class="help-block"></div>
</div>
