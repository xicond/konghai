<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $subject;
    public $body;
    public $phone;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['firstname', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', \PetraBarus\Yii2\ReCaptcha\ReCaptchaValidator::className()],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if (!$this->subject) {
            $this->subject = 'Message From '.$this->firstname.' '.$this->lastname;
        }
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setReplyTo([$this->email => $this->firstname.' '.$this->lastname])
                ->setFrom(['no-reply@konghaicargo.com' => $this->firstname.' '.$this->lastname])
                ->setCharset('iso-8859-1')
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
