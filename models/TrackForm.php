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
            [['code'], 'validateCode'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LfoQSITAAAAADnXU-1pGmeSJTt1f-9v9tFHIoUK']
        ];
    }

    public function validateCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $shipmentcode = ShipmentCode::findOne(array('code'=>$this->$attribute, 'delete_time'=>null));

            if (empty($shipmentcode)) {
                $this->addError($attribute, Yii::t('app', 'Shipment Code might be wrong, it\'s not available on our system'));
            }
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
