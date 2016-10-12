<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Shipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipment-form">

    <?php $form = ActiveForm::begin([
        'id' => 'shipment-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'receipt_date')->widget(\kartik\date\DatePicker::classname(), [
        'options' => ['placeholder' => 'Select Receipt date ...'],
        'value' => date('d-M-Y', strtotime('+2 days')),
        'pluginOptions' => [
            'format' => 'dd MM yyyy',
            'todayHighlight' => true,
            'autoclose'=>true,
            'convertFormat'=>true
        ]
    ]); ?>

    <?= $form->field($model, 'marking_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colly')->textInput(['type'=>'number', 'min'=>'1', 'step'=>'1', 'maxlength' => true]) ?>

    <?= $form->field($model, 'means')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['type'=>'number', 'min'=>'0.01', 'step'=>'0.01', 'maxlength' => true]) ?>

    <?= $form->field($model, 'loading_date')->widget(\kartik\date\DatePicker::classname(), [
        'options' => ['placeholder' => 'Select loading date ...'],
        'value' => date('d-M-Y', strtotime('+2 days')),
        'pluginOptions' => [
            'format' => 'dd MM yyyy',
            'todayHighlight' => true,
            'autoclose'=>true,
            'convertFormat'=>true
        ]
    ]); ?>


    <?= $form->field($model, 'estimate_arrive_date')->widget(\kartik\date\DatePicker::classname(), [
        'options' => ['placeholder' => 'Select date ...'],
        'value' => date('d-M-Y', strtotime('+2 days')),
        'pluginOptions' => [
            'format' => 'dd MM yyyy',
            'todayHighlight' => true,
            'autoclose'=>true,
            'convertFormat'=>true
        ]
    ]); ?>


    <?php if(false):$model->isNewRecord?>

        <?php echo $this->render('_form_code', [
            'model' => $model_code,
        ]);

        ?>

    <?php endif?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();
//    $script = <<<'JS'
//        $('#shipment-form').yiiActiveForm('add',{"id":"shipmentcode-code","name":"code","container":".field-shipmentcode-code","input":"#shipmentcode-code","enableAjaxValidation":true});
//        $('#shipment-form').yiiActiveForm('add',{"id":"shipmentcode-type","name":"type","container":".field-shipmentcode-type","input":"#shipmentcode-type","enableAjaxValidation":true});
//JS;
//
//    $this->registerJs( $script , \yii\web\View::POS_READY, 'my-options');

    ?>

</div>
