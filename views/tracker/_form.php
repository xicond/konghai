<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tracker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tracker-form">

    <?php $form = ActiveForm::begin(['action' => ['POST site/track'],]); ?>

    <?php // = $form->field($model, 'shipment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipment_code')->dropDownList(
        \yii\helpers\ArrayHelper::map(
            \app\models\ShipmentCode::find()->where('shipment_id='.$model->shipment_id)->andWhere(['delete_time' => null])->all(), 'code', 'code')) ?>

    <?= $form->field($model, 'track_date')->widget(\kartik\date\DatePicker::classname(), [
        'options' => ['placeholder' => 'Select issue date ...'],
        'value' => date('d-M-Y', strtotime('+2 days')),
        'pluginOptions' => [
            'format' => 'dd MM yyyy',
            'todayHighlight' => true,
            'autoclose'=>true,
            'convertFormat'=>true
        ]
    ]); ?>



    <?= $form->field($model, 'track_time')->widget(\kartik\time\TimePicker::classname(), [
        'pluginOptions' => [
            'showSeconds' => false,
            'defaultTime' => 'current'
        ]
    ]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
