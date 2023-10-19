<?php

namespace app\controllers;

use yii\rest\ActiveController;

class MajorController extends ActiveController
{
    public $modelClass = 'app\models\Major';
    //public $enableCsrfValidation = false;
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        //unset($behaviors['authenticator']);
        
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin'                           => ['http://localhost:8100'],
                'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'DELETE'],
                'Access-Control-Request-Headers'   => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 600
            ]
        ];

        
   /*$behaviors['authenticator'] = [
        'class' => CompositeAuth::className(),
        'authMethods' => [
            HttpBearerAuth::className(),
        ],
        'except' => ['index', 'view']
    ];*/
        return $behaviors;
    }
}