<?php

namespace console\controllers;
use yii\console\Controller;
use common\models\User;
use common\models\Token;

class TokenController extends Controller
{
    public function actionGetToken($login, $password){
        $out = [];
        $user = User::findOne(['username' => $login]);
        if (empty($user)){
            $out['status'] = 'error';
            $out['error'] = 'user not found';
        } elseif(!\Yii::$app->getSecurity()->validatePassword($password, $user->password_hash)) {
            $out['status'] = 'error';
            $out['error'] = 'error password';
        } else {
            $out['status'] = 'success';
            $out['token'] = Token::getToken($user->id);
        }
        echo json_encode($out);
        \Yii::$app->end();
    }
}