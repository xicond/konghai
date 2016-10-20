<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shipment".
 *
 * @property string $id
 * @property string $from
 * @property string $to
 * @property string $address_to
 * @property string $address_from
 * @property integer $input_by
 * @property integer $update_by
 * @property string $history
 * @property string $input_time
 * @property string $update_time
 * @property string $description
 * @property integer $colly
 * @property string $means
 * @property string $weight
 * @property string $loading_date
 * @property string $marking_code
 * @property string $estimate_arrive_date
 *
 * @property ShipmentCode[] $shipmentCodes
 * @property Tracker[] $trackers
 */
class Shipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment';
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
            'uid' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['input_by', 'update_by' ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_by'],
                ],
                'value' => Yii::$app->user->id,
            ],

            'receipt_date' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['receipt_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['receipt_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    $date = explode('-',$parent->receipt_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return $parent->receipt_date;

                    $result = date('Y-m-d',strtotime($parent->receipt_date));
                    if($result == '1970-01-01') return NULL;
                    return $result;
                },
            ],
            'receipt_date_show' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['receipt_date'],
                    ActiveRecord::EVENT_AFTER_REFRESH => ['receipt_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)
                    if(!$parent->receipt_date)return;

                    $date = explode('-',$parent->receipt_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return date('d F Y',strtotime($parent->receipt_date));

                    return $parent->receipt_date;
                },
            ],

            'loading_date' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['loading_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['loading_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    $date = explode('-',$parent->loading_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return $parent->loading_date;

                    $result = date('Y-m-d',strtotime($parent->loading_date));
                    if($result == '1970-01-01') return NULL;
                    return $result;
                },
            ],
            'loading_date_show' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['loading_date'],
                    ActiveRecord::EVENT_AFTER_REFRESH => ['loading_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)
                    if(!$parent->loading_date)return;

                    $date = explode('-',$parent->loading_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return date('d F Y',strtotime($parent->loading_date));

                    return $parent->loading_date;
                },
            ],
            'estimate_arrive_date' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['estimate_arrive_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['estimate_arrive_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    $date = explode('-',$parent->estimate_arrive_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return $parent->estimate_arrive_date;

                    $result = date('Y-m-d',strtotime($parent->estimate_arrive_date));
                    if($result == '1970-01-01') return NULL;
                    return $result;
                },
            ],
            'estimate_arrive_date' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['estimate_arrive_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)

                    if($parent->estimate_arrive_date == '1970-01-01' || is_null($parent->estimate_arrive_date) || $parent->estimate_arrive_date=='')
                    {
                        if(preg_match('@\bsea\b@i',$parent->marking_code)){
                            $parent->estimate_arrive_date = date('Y-m-d',strtotime("+1 month"));
                        }
                        elseif(preg_match('@\bair\b@i',$parent->marking_code)){
                            $parent->estimate_arrive_date = date('Y-m-d',strtotime("+7 day"));
                        }
                    }
                    return $parent->estimate_arrive_date;
                },
            ],
            'estimate_arrive_date_show' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['estimate_arrive_date'],
                    ActiveRecord::EVENT_AFTER_REFRESH => ['estimate_arrive_date'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    // if($parent->delete_time)
                    if(!$parent->estimate_arrive_date)return;

                    $date = explode('-',$parent->estimate_arrive_date);
                    if(count($date)==3 && strlen($date[0])==4 && strlen($date[1])<=2 && strlen($date[2])<=2 )
                        return date('d F Y',strtotime($parent->estimate_arrive_date));

                    return $parent->estimate_arrive_date;
                },
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['from', 'to', 'address_from'], 'required'], //, 'input_by', 'input_time', 'update_time'
            [['marking_code', 'receipt_date'], 'required'],
            [['input_by', 'update_by', 'colly'], 'integer'],
            [['history'], 'string'],
            [['input_time', 'update_time', 'loading_date', 'estimate_arrive_date'], 'safe'],
            [['weight'], 'number', 'max' => 99999.99, 'skipOnEmpty' => true, 'min' => 0],
            [['colly'], 'number', 'max' => 4294967295, 'integerOnly' => true, 'min' => 0, 'skipOnEmpty' => true],
            [['from', 'to'], 'string', 'max' => 50],
            [['address_to', 'address_from', 'description', 'resi', 'marking_code'], 'string', 'max' => 255],
            [['means'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('db', 'ID'),
            'from' => Yii::t('db', 'Consignee'),
            'to' => Yii::t('db', 'Receiver'),
            'address_to' => Yii::t('db', 'Destination'),
            'input_by' => Yii::t('db', 'Input By'),
            'update_by' => Yii::t('db', 'Update By'),
            'history' => Yii::t('db', 'History'),
            'input_time' => Yii::t('db', 'Input Time'),
            'update_time' => Yii::t('db', 'Update Time'),
            'description' => Yii::t('db', 'Description'),
            'address_from' => Yii::t('db', 'Origin'),
            'colly' => Yii::t('db', 'Colly'),
            'means' => Yii::t('db', 'Means'),
            'weight' => Yii::t('db', 'Weight'),
            'loading_date' => Yii::t('db', 'Loading Date'),
            'estimate_arrive_date' => Yii::t('db', 'Estimate Arrive Date'),
            'resi' => Yii::t('db', 'Resi'),
            'marking_code' => Yii::t('db', 'Marking Code'),
            'receipt_date' => Yii::t('db', 'Receipt Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentCodes($order=[])
    {
        return $this->hasMany(ShipmentCode::className(), ['shipment_id' => 'id'])->andOnCondition('delete_time IS NULL')->addOrderBy($order);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrackers($isReverse=false)
    {
        return $this->hasMany(Tracker::className(), ['shipment_id' => 'id'])->addOrderBy(["CONCAT(track_date,' ',track_time)"=>$isReverse?'DESC':"ASC"]);
    }

    public function getOrderedShipmentCodes()
    {
        $codes = $this->getTrackers(true)->with()->addGroupBy('shipment_code')->select('shipment_code')->createCommand()->queryAll();
        if(empty($codes)) return null;
//        die(var_dump($codes->createCommand()->rawSql));
        $strOrders = '(CASE code ';
        foreach($codes as $i=>$code){
//            die(var_dump($code));
            $strOrders .= 'WHEN "'.$code['shipment_code'].'" THEN '.$i.' ';
        }
        $strOrders .= 'ELSE '.($i+1).' END)';

        return $this->getShipmentCodes([$strOrders=>'ASC']);
    }

    /**
     * @inheritdoc
     * @return ShipmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShipmentQuery(get_called_class());
    }
}
