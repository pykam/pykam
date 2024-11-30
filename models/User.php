<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{



    public static function tableName()
    {
        return 'users';
    }   

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'firstname'], 'required'],
            [['firstname', 'lastname', 'password', 'email', 'auth_key', 'access_token'], 'string'],
            [['email'], 'unique'],
        ];
    }

    public function fields()
    {

        $fields = parent::fields();
        unset($fields['auth_key'], $fields['password'], $fields['access_token']);
        return $fields;

    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->setAttribute('auth_key',\Yii::$app->getSecurity()->generateRandomString());
        $this->setAttribute('access_token', \Yii::$app->getSecurity()->generateRandomString());
        $this->setAttribute('password', \Yii::$app->getSecurity()->generatePasswordHash($this->getAttribute('password')));
        return true;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
