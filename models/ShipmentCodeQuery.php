<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ShipmentCode]].
 *
 * @see ShipmentCode
 */
class ShipmentCodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ShipmentCode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ShipmentCode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
