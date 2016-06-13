<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentCode */


\yii\widgets\Pjax::begin(); ?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $model,
    //'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        // 'id',
        'code',
        'type',
        // 'shipment_id',
        // 'input_by',
        // 'delete_by',
        // 'input_time',
        // 'delete_time',

        ['class' => 'yii\grid\ActionColumn',
            'template'=>'{update}{delete}',
            /*'buttons'=>[
                'create' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                        'title' => Yii::t('yii', 'Create'),
                    ]);

                }
            ],*/
            'urlCreator' => function ($action, $model, $key, $index) {
                //if ($action === 'info') {
                    $url = Yii::$app->urlManager->createUrl(['shipment-code/'.$action,'id'=>$model->id]); // your own url generation logic
                    return $url;
                //}
            }
        ],
    ],
]);

\yii\widgets\Pjax::end();