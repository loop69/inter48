<?php

namespace app\modules\user\models\form;

use app\modules\user\models\User;
use app\modules\user\Module;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => User::className(), 'message' => Module::t('module', 'ERROR_USERNAME_EXISTS')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Module::t('module', 'ERROR_EMAIL_EXISTS')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Module::t('module', 'USER_USERNAME'),
            'email' => Module::t('module', 'USER_EMAIL'),
            'password' => Module::t('module', 'USER_PASSWORD'),
            'verifyCode' => Module::t('module', 'USER_VERIFY_CODE'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();

            if ($user->save()) {

                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('author');
                $auth->assign($authorRole, $user->getId());

                Yii::$app->mailer->compose(['text' => '@app/modules/user/mails/emailConfirm'], ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->send();
            }


            return $user;
        }

        return null;
    }
}