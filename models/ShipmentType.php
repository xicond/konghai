<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shipment_type".
 *
 * @property string $type
 * @property string $description
 *
 * @property ShipmentCode[] $shipmentCodes
 */
class ShipmentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => Yii::t('db', 'Type'),
            'description' => Yii::t('db', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentCodes()
    {
        return $this->hasMany(ShipmentCode::className(), ['type' => 'type']);
    }

    /**
     * @inheritdoc
     * @return ShipmentTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShipmentTypeQuery(get_called_class());
    }
}
