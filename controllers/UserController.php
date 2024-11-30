<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;

use app\models\User;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentificator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::class,
                    'auth' => function ($username, $password) {
                
                        if ($user = User::find()->where(['email' => $username])->one() and !empty($password) and $user->validatePassword($password)) {
                            return $user;
                        }
                        return null;
                    }
                ],
                
                HttpBearerAuth::class,
            ],
            
        ];
        $behaviors['authentificator']['except'] = ['create'];

        return $behaviors;
    }

}
