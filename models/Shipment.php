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
 * @property integer $input_by
 * @property integer $update_by
 * @property string $history
 * @property string $input_time
 * @property string $update_time
 * @property string $description
 * @property string $address_from
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
            [['from', 'to', 'address_from'], 'required'], //, 'input_by', 'input_time', 'update_time'
            [['input_by', 'update_by'], 'integer'],
            [['history'], 'string'],
            [['input_time', 'update_time'], 'safe'],
            [['from', 'to'], 'string', 'max' => 50],
            [['address_to', 'address_from', 'description'], 'string', 'max' => 255],
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
