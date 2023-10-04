<?php
namespace app\controllers;

use yii\rest\ActiveController;

class AttendanceController extends ActiveController
{
    public $modelClass = 'app\models\Attendance';
}