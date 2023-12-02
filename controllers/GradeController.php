<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

use app\models\Grade;


class GradeController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
    
        unset($behaviors['authenticator']);
    
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin'                           => ['http://localhost:8100','http://localhost:8101'],
                'Access-Control-Request-Method'    => ['GET', 'POST', 'PUT', 'DELETE'],
                'Access-Control-Request-Headers'   => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 600
            ]
        ];
    
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBearerAuth::className(),
            ],
            'except' => ['index', 'view']
        ];
    
        return $behaviors;
    }
    public $modelClass = 'app\models\Grade';

    public $enableCsrfValidation = false;

    public function actionBuscar($text='') {
        $consulta = Grade::find()->where(['like', new \yii\db\Expression("CONCAT(gra_id, ' ', gra_type, ' ', gra_score, ' ', gra_date, ' ', gra_time)"), $text]);
    
        $grades = new \yii\data\ActiveDataProvider([
            'query' => $consulta,
            'pagination' => [
                'pageSize' => 20 // Número de resultados por página
            ],
        ]);
    
        return $grades->getModels();
    }

    public function actionTotal($text='') {
        $total = Grade::find();
        if($text != '') {
            $total = $total->where(['like', new \yii\db\Expression("CONCAT(gra_id, ' ', gra_type, ' ', gra_score, ' ', gra_date, ' ', gra_time)"), $text]);
        }
        $total = $total->count();
        return $total;
    }
}