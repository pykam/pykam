<?php

return [
    'email' => $faker->email,
    'firstname' => $faker->firstName,
    'lastname' => $faker->lastName,
    'password' => Yii::$app->getSecurity()->generatePasswordHash('test'),
    'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
    'access_token' => Yii::$app->getSecurity()->generateRandomString(),
];