<?php

namespace common\models;

class Token
{
    public static function getToken($user_id){
        $data = [
            'id' => $user_id,
            'expare' => time() + 60 * 5
        ];
        $json_str = json_encode($data);
        $token = \Yii::$app->security->maskToken($json_str);
        return $token;
    }



}