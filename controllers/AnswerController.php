<?php

namespace app\controllers;

use yii\rest\ActiveController;

class AnswerController extends ActiveController
{
    public $modelClass = 'app\models\Answer';
    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin'                           => ['http://localhost:8100'],
                'Access-Control-Request-Method'    => ['GET','PUT','POST'],
                'Access-Control-Request-Headers'   => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 600
            ]
        ];
            return $behaviors;
        }



}

