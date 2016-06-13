<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shipment_code".
 *
 * @property string $id
 * @property string $code
 * @property string $type
 * @property string $shipment_id
 * @property integer $input_by
 * @property integer $delete_by
 * @property string $input_time
 * @property string $delete_time
 *
 * @property Shipment $shipment
 * @property ShipmentType $type0
 * @property Tracker[] $trackers
 */
class ShipmentCode extends \yii\db\ActiveRecord
{

    protected $updateAttr;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_code';
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['input_time' ],
                ],
                'value' => date('Y-m-d H:i:s')/*function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     *--/
                    if(!$parent->input_time){
                        return date('Y-m-d H:i:s');
                    }

                    return $parent->input_time;
                }*/
            ],
            'uid' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['input_by' ],
                ],
                'value' => Yii::$app->user->id,
            ],
            'onupdate_deleteby' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['delete_by' ],
                ],
                'value' => //Yii::$app->user->id,
                    function (\yii\base\Event $event) {
                        $parent = $event->sender;
                        /**
                         * @var $parent self
                         */

                        $this->updateAttr = $dirtyAttributes = $this->getDirtyAttributes(['code', 'type', 'shipment_id']);
                        if(count($dirtyAttributes)){
                            return Yii::$app->user->id;
                        }
                        return $parent->delete_by;
                    }
            ],
            'onupdate_id' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['id' ],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                     * @var $parent self
                     */
                    $dirtyAttributes = $parent->getDirtyAttributes(['id']);
                    if(!empty($dirtyAttributes['id'])){
                        return $parent->getOldAttribute('id');
                    }

                    return $parent->id;
                }
            ],
            'onupdate_deletetime' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['delete_time' ],
                ],
                'value' => //date('Y-m-d H:i:s')
                    function (\yii\base\Event $event) {
                        $parent = $event->sender;
                        /**
                         * @var $parent self
                         */

                        $dirtyAttributes = $this->getDirtyAttributes(['code', 'type', 'shipment_id']);
                        if(count($dirtyAttributes)){
                            return date('Y-m-d H:i:s');
                        }
                        return $parent->delete_time;
                    }
            ],
            'onupdate_insert' => [
                'class' => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_UPDATE => ['delete_by'],
                ],
                'value' => function (\yii\base\Event $event) {
                    $parent = $event->sender;
                    /**
                    * @var $parent self
                    */
//                    $dirtyAttributes = $this->getDirtyAttributes(['code', 'type', 'shipment_id']);
                    if($parent->delete_time && count($this->updateAttr)){
                        $model = new static;
                        $model->setAttributes($parent->getAttributes());

                        $model->delete_by = 0;
                        $model->delete_time = NULL;
                        $model->insert();

                        $code = ShipmentCode::findOne(['id'=>$parent->id])->code;
                        Tracker::updateAll(['shipment_code'=>$parent->code],['shipment_code'=>$code]);

                    }

                    return $parent->delete_by;
                }
            ],

        ];
    }

    public static function updateAll($attributes, $condition = '', $params = [])
    {
        $command = static::getDb()->createCommand();

        unset($attributes['id'],$attributes['code'],$attributes['type'],$attributes['shipment_id'],$attributes['input_by'],$attributes['input_time']);
        $command->update(static::tableName(), $attributes, $condition, []);
        return $command->execute();
    }

    public function defaultScope()
    {
        return array('condition' => 'delete_time IS NULL');
    }

    public function scopes()
    {
        return array('active' => array('condition' => 'delete_time IS NULL'));
    }

    public function delete()
    {
        $this->delete_time = date('Y-m-d H:i:s');
        $this->delete_by = Yii::$app->user->id;
        $this->update();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'type'], 'required'], //, 'shipment_id', 'input_by', 'delete_by', 'input_time'
            [['code', ], 'validateCode'], //'type'
            [['type', ], 'validateType'], //'type'
            [['shipment_id', 'input_by', 'delete_by'], 'integer'],
            [['input_time', 'delete_time'], 'safe'],
            [['code'], 'string', 'max' => 35],
            [['type'], 'string', 'max' => 30],
            [['shipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::className(), 'targetAttribute' => ['shipment_id' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentType::className(), 'targetAttribute' => ['type' => 'type']],
        ];
    }

    public function validateCode($attribute, $params)
    {
        if(!$this->isNewRecord && !isset($this->getDirtyAttributes([$attribute])[$attribute]));
        elseif (!$this->hasErrors()) {
            $shipmentcode = ShipmentCode::findOne(array('code'=>$this->$attribute, 'delete_time'=>null));

            if (!empty($shipmentcode)) {
                $this->addError($attribute, Yii::t('app', 'Shipment Code already exist'));
            }
        }
    }

    public function validateType($attribute, $params)
    {
        if(!$this->isNewRecord && !isset($this->getDirtyAttributes([$attribute])[$attribute]));
        elseif (!$this->hasErrors()) {
            $shipmentcode = ShipmentCode::findOne(array('shipment_id'=>$this->id, 'delete_time'=>null, 'type'=>$this->$attribute));

            if (!empty($shipmentcode)) {
                $this->addError($attribute, Yii::t('app', 'Shipment Type only one for one shipping'));
            }
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('db', 'ID'),
            'code' => Yii::t('db', 'Code'),
            'type' => Yii::t('db', 'Type'),
            'shipment_id' => Yii::t('db', 'Shipment ID'),
            'input_by' => Yii::t('db', 'Input By'),
            'delete_by' => Yii::t('db', 'Delete By'),
            'input_time' => Yii::t('db', 'Input Time'),
            'delete_time' => Yii::t('db', 'Delete Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipment()
    {
        return $this->hasOne(Shipment::className(), ['id' => 'shipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(ShipmentType::className(), ['type' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrackers()
    {
        return $this->hasMany(Tracker::className(), ['shipment_id' => 'shipment_id', 'shipment_code' => 'code']);
    }

    /**
     * @inheritdoc
     * @return ShipmentCodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShipmentCodeQuery(get_called_class());
    }
}
