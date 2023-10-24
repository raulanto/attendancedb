<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use app\models\Code;

class CodeController extends ActiveController
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
            'except' => ['index', 'view','codigos']
        ];
    
        return $behaviors;
    }
    public $modelClass = 'app\models\Code';
    
    public $enableCsrfValidation = false;
    //Codigos
    public function actionCodigos($id)
    {
        // Busca todos los códigos que pertenecen al grupo
        $codigos = Code::find()
            ->where(['cod_fkgroup' => $id])
            ->all();
    
        // Verifica si se encontraron códigos
        if (!empty($codigos)) {
            $result = [];
            foreach ($codigos as $codigo) {
                $result[] = [
                    'cod_id' => $codigo->cod_id,
                    'cod_code' => $codigo->cod_code,
                    'cod_time' => $codigo->cod_time,
                    'cod_date' => $codigo->cod_date,
                    'cod_duration' => $codigo->cod_duration,
                    // Puedes agregar otros campos si es necesario
                ];
            }
            return $result;
        } else {
            // Manejar la situación en la que no se encontraron códigos
            return ['message' => 'No se encontraron códigos para el grupo proporcionado'];
        }
    }
      
}