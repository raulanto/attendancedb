<?php
//CONTROLADOR DE TABLA PERSON
namespace app\controllers;

use yii\rest\ActiveController;

class PersonController extends ActiveController
{
    public $modelClass = 'app\models\Person';
}