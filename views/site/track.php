<?php
/**
 * Date: 6/10/16
 * Time: 08:37
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Track now';

/**
 * @var $shipment \app\models\Shipment
 */

?>


    <!--<section class="bg-light section-lg">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li>Elements</li>
            <li class="active">Table Styles</li>
        </ol>
    </section>-->
    <section class="section">
        <div class="container">
            <h2>Tracking Tools</h2>
            <hr>

            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <section class="section section-inset-3">

                        <?php $form = ActiveForm::begin([
                            'id' => 'shipment-form',
                            'action' => ['POST site/track'],
//                            'enableAjaxValidation' => true,
//                            'enableClientValidation' => false,
                        ]); ?>

                        <?= $form->field($model, 'code')->textInput(['placeholder'=>'for demo type: AXN123']) ?>

                        <?= $form->field($model, 'reCaptcha')->widget(\PetraBarus\Yii2\ReCaptcha\ReCaptcha::className()) ?>

                        <div class="form-group">
                            <?= Html::submitButton(\Yii::t('app','Track now'), ['class' => 'btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end()?>

                    </section>
                </div>
            </div>

<!--            <p>TRACE & TRACKING</p>-->

            <?php if($shipment):?>

            <div class="row"><h6>Shipment</h6></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-tracking-main table-responsive">
                        <table class="table table-bordered text-left table-primary">
                            <thead>
                            <tr>
                                <th>Shipment</th>
                                <th>Origin</th>
                                <th>Destination</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php if(($tracks = $shipment->trackers) && isset($tracks[0])) echo $tracks[0]->track_date.' '.$tracks[0]->track_time;else echo @$shipment->shipmentCodes[0]->code?></td>
                                <td><?=$shipment->address_from?></td>
                                <td><?=$shipment->address_to?></td>
                            </tr>
                            <?php if($shipment->colly || $shipment->means || $shipment->weight):?>
                            <tr>
                                <th>Colly</th>
                                <th>Means</th>
                                <th>Weight</th>
                            </tr>
                            <tr>
                                <td><?=$shipment->colly?></td>
                                <td><?=$shipment->means?></td>
                                <td><?=$shipment->weight?></td>
                            </tr>
                            <?php endif?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-tracking-main table-responsive">
                            <table class="table table-bordered text-left table-primary">
                                <thead>
                                <tr>
                                    <th>Loading Date</th>
                                    <th>Estimate Arrive Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?=$shipment->loading_date?></td>
                                    <td><?=$shipment->estimate_arrive_date?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <div class="row offset-2"><h6>Detail</h6></div>
            <div class="row">
                <div class="col-xs-12">
                        <div class="table-tracking-detail table-responsive">
                        <table class="table table-striped text-left table-dark">
                            <thead>
                            <tr>
                                <th>Origin</th>
                                <th>Destination</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?=$shipment->from?></td>
                                <td><?=$shipment->to?></td>
                            </tr>
                            <tr>
                                <td><?=$shipment->address_from?></td>
                                <td><?=$shipment->address_to?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row offset-2"><h6>Tracker</h6></div>

            <?php foreach($shipment->orderedShipmentCodes as $group):
                    if(!$group->getTrackers()->exists())continue;
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-tracking-tracker table-responsive">
                        <table class="table text-left table-light">
                            <thead>
                            <tr>
                                <th colspan="3"><?=$group->type?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach($group->trackers as $track):?>
                            <tr>
                                <td><?=$track->track_date.' '.$track->track_time?></td>
                                <td><?=$track->description?></td>
                                <td><?=$track->status?></td>
                            </tr>
                            <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endforeach?>

            <?php endif?>

        </div>
    </section>
