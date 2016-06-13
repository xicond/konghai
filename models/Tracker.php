<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tracker".
 *
 * @property string $id
 * @property string $shipment_id
 * @property string $shipment_code
 * @property string $status
 * @property string $track_date
 * @property string $track_time
 * @property integer $input_by
 * @property string $input_time
 * @property integer $update_by
 * @property string $update_time
 * @property string $description
 * @property string $history
 *
 * @property ShipmentCode $shipment
 * @property Shipment $shipment0
 */
class Tracker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracker';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['input_time', 'update_time' ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
            'trackdate' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['track_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['track_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    $date = explode('-',$parent->track_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return $parent->track_date;

//                    die(strtotime($parent->track_date));
                    return date('Y-m-d',strtotime($parent->track_date));
                },
            ],
            'trackdate_show' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['track_date'],
                    ActiveRecord::EVENT_AFTER_REFRESH => ['track_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    $date = explode('-',$parent->track_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return date('d F Y',strtotime($parent->track_date));

//                    die(strtotime($parent->track_date));
                    return $parent->track_date;
                },
            ],
            'tracktime' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['track_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['track_time'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    $date = explode(':',$parent->track_time);
                    if(count($date)==3 && strlen($date[0])<=2 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return $parent->track_time;

//                    die(strtotime($parent->track_date));
                    return date('H:i:s',strtotime($parent->track_time));
                },
            ],
            'tracktime_show' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['track_time'],
                    ActiveRecord::EVENT_AFTER_REFRESH => ['track_time'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    $date = explode(':',$parent->track_time);
                    if(count($date)==3 && strlen($date[0])<=2 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return date('h:i A',strtotime('2000-01-01 '.$parent->track_time));

//                    die(strtotime($parent->track_date));
                    return $parent->track_time;
                },
            ],
            'uid' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['input_by', 'update_by' ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_by'],
                ],
                'value' => Yii::$app->user->id,
            ],
            'history' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['history'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    if(count($parent->getDirtyAttributes())){
                        $history = json_decode($parent->history);
                        if(!isset($history[0])){
                            $history = [];
                        }
                        $current_state = $parent->getOldAttributes();
                        unset($current_state['history']);
                        $history[] = $current_state;
                        return json_encode($history);
                    }

                    return $parent->history;

                },
            ],
        ];
    }

    public function defaultScope()
    {
        return array('order' => "CONCAT(track_date,' ',track_time)");
    }

    public function scopes()
    {
        return array('active' => array('order' => "CONCAT(track_date,' ',track_time)"));
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipment_id', 'shipment_code', 'status', 'track_date', ], 'required'], //'input_by', 'input_time', 'update_time'
            [['shipment_id', 'input_by', 'update_by'], 'integer'],
            [['track_date', 'track_time', 'input_time', 'update_time'], 'safe'],
            [['history'], 'string'],
            [['shipment_code'], 'string', 'max' => 35],
            [['status'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
            [['shipment_id', 'shipment_code'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentCode::className(), 'targetAttribute' => ['shipment_id' => 'shipment_id', 'shipment_code' => 'code']],
            [['shipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::className(), 'targetAttribute' => ['shipment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('db', 'ID'),
            'shipment_id' => Yii::t('db', 'Shipment ID'),
            'shipment_code' => Yii::t('db', 'Shipment Code'),
            'status' => Yii::t('db', 'Status'),
            'track_date' => Yii::t('db', 'Track Date'),
            'track_time' => Yii::t('db', 'Track Time'),
            'input_by' => Yii::t('db', 'Input By'),
            'input_time' => Yii::t('db', 'Input Time'),
            'update_by' => Yii::t('db', 'Update By'),
            'update_time' => Yii::t('db', 'Update Time'),
            'description' => Yii::t('db', 'Description'),
            'history' => Yii::t('db', 'History'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipment()
    {
        return $this->hasOne(ShipmentCode::className(), ['shipment_id' => 'shipment_id', 'code' => 'shipment_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipment0()
    {
        return $this->hasOne(Shipment::className(), ['id' => 'shipment_id']);
    }

    /**
     * @inheritdoc
     * @return TrackerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrackerQuery(get_called_class());
    }
}
