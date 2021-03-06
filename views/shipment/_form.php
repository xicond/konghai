<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Shipment */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord)
        $this->registerJs('
var cache = {};


$("#'.Html::getInputId($model, 'marking_code').'").change(function(){
    if($(this).val() && $("#'.Html::getInputId($model, 'receipt_date').'").val()){

        var receipt = new Date($("#'.Html::getInputId($model, 'receipt_date').'"). datepicker("getDate"));
        if(/\bsea\b/i.test($(this).val()) && !$("#'.Html::getInputId($model, 'estimate_arrive_date').'").data("manual")){
            receipt.setMonth(receipt.getMonth() + 1);
            $("#'.Html::getInputId($model, 'estimate_arrive_date').'").val( $.datepicker.formatDate("dd MM yy", receipt));
        }else if(/\bair\b/i.test($(this).val()) && !$("#'.Html::getInputId($model, 'estimate_arrive_date').'").data("manual")){
            receipt.setDate(receipt.getDate() + 7);
            $("#'.Html::getInputId($model, 'estimate_arrive_date').'").val( $.datepicker.formatDate("dd MM yy", receipt));
        }

    }
});

if($("#'.Html::getInputId($model, 'estimate_arrive_date').'").val()) {
    $("#'.Html::getInputId($model, 'estimate_arrive_date').'").data("manual", true);
}

$("#'.Html::getInputId($model, 'estimate_arrive_date').'").keypress(function(){
    if($(this).val())
    $(this).data("manual",true);
    else
    $(this).data("manual",false);
});

', \yii\web\View::POS_READY, 'estimate_arrive');

?>

<div class="shipment-form">

    <?php $form = ActiveForm::begin([
        'id' => 'shipment-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
    ]); ?>

    <?= $form->field($model, 'receipt_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
//        'attributeTo' => 'receipt_date',
//        'form' => $form, // best for correct client validation
//        'language' => 'en',
//        'inline' => true,
        'addon' => false,
        'template' => '{input}',
//        'size' => 'lg',
        'clientOptions' => [
            'autoclose' => true,
            'dateFormat' => 'dd MM yy',
            'changeYear' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'marking_code')->widget(\yii\jui\AutoComplete::classname(), [
        'options' => [ 'class' => 'form-control' ],
        'clientOptions' => [
            'source'=>new \yii\web\JsExpression("

            function(request, response) {
                var term = request.term;
                if ( term in cache ) {
                  response( cache[ term ] );
                  return;
                }
                $.getJSON('".\yii\helpers\Url::to('index')."', {
                    'ShipmentSearch[marking_code]': request.term
                }, function( data, status, xhr ) {
                    var result = {};
                    for(k in data)
                    {
                        result[k] = {};
                        result[k].value = data[k].marking_code;
                        result[k].label = data[k].marking_code;
                    }
                    cache[ term ] = result;
                    response( result );

                });
            }"),
            'select'=>new \yii\web\JsExpression('
                function( event, ui ) {
                    $("#'.Html::getInputId($model, 'marking_code').'").trigger("change");

            }'),
        ],
    ]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colly')->textInput(['type'=>'number', 'min'=>'1', 'step'=>'1', 'maxlength' => true]) ?>

    <?= $form->field($model, 'means')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['type'=>'number', 'min'=>'0.01', 'step'=>'0.01', 'maxlength' => true]) ?>

    <?= $form->field($model, 'loading_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
//        'attributeTo' => 'loading_date',
//        'form' => $form, // best for correct client validation
//        'language' => 'en',
        'addon' => false,
        'template' => '{input}',
//        'size' => 'lg',
        'clientOptions' => [
            'autoclose' => true,
            'dateFormat' => 'dd MM yy',
            'changeYear' => true,
        ]]); ?>


    <?= $form->field($model, 'estimate_arrive_date')->widget(\dosamigos\datepicker\DatePicker::className(), [
//        'attributeTo' => 'loading_date',
//        'form' => $form, // best for correct client validation
//        'language' => 'en',
        'addon' => false,
        'template' => '{input}',
//        'size' => 'lg',
        'clientOptions' => [
            'autoclose' => true,
            'dateFormat' => 'dd MM yy',
            'changeYear' => true,
            'onSelect' =>new \yii\web\JsExpression('
                function (dateText, inst ) {
                    $("#'.Html::getInputId($model, 'estimate_arrive_date').'").data("manual",true);
            }'),
        ]]); ?>


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
