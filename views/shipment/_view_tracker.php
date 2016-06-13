<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TrackerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Pjax::begin(); ?>

<?= GridView::widget([
        'dataProvider' => $model,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shipment_id',
            'shipment_code',
            'track_date',
            'track_time',
            'status',
            // 'input_by',
            // 'input_time',
            // 'update_by',
            // 'update_time',
            // 'description',
            // 'history:ntext',

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
                    $url = Yii::$app->urlManager->createUrl(['tracker/'.$action,'id'=>$model->id]); // your own url generation logic
                    return $url;
                    //}
                }
            ],
        ],
    ]);

Pjax::end();

