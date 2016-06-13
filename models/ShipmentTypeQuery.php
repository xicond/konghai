<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ShipmentType]].
 *
 * @see ShipmentType
 */
class ShipmentTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ShipmentType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ShipmentType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
