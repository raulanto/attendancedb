<?php

namespace app\controllers;

use yii\rest\ActiveController;

class PersonController extends ActiveController
{
    public $modelClass = 'app\models\Person';
}