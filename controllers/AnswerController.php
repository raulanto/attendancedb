<?php

namespace app\controllers;

use yii\rest\ActiveController;

class AnswerController extends ActiveController
{
    public $modelClass = 'app\models\Answer';
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    // restrict access to
                    'Origin' => ['127.0.0.1'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Method' => ['GET'],
                    // Allow only headers 'X-Wsse'
                    //'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    // 'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],

            ],
        ];
    }



}

