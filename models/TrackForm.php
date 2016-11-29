<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class TrackForm extends Model
{
    public $code;
    public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // code are required
            [['code'], 'required'],
//            [['code'], 'validateCode'],
            [['reCaptcha'], \PetraBarus\Yii2\ReCaptcha\ReCaptchaValidator::className()]
        ];
    }

    public function validateCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
//            $shipmentcode = ShipmentCode::findOne(array('code'=>$this->$attribute, 'delete_time'=>null));
            $shipment = Shipment::findOne(array('marking_code'=>$this->$attribute));

            if(!$shipment)
            {
                $shipment = Shipment::findOne(array('resi'=>$this->$attribute));

                if (empty($shipment)) {
                    $this->addError($attribute, Yii::t('app', 'Shipment Code might be wrong, it\'s not available on our system'));
                }
            }

//            if (empty($shipmentcode)) {
//                $this->addError($attribute, Yii::t('app', 'Shipment Code might be wrong, it\'s not available on our system'));
//            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reCaptcha' => Yii::t('app', 'Captcha Security'),
        ];
    }


}
