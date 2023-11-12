<?php
namespace app\controllers;
 
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use app\models\Listg;

class ListgController extends ActiveController
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
            'except' => ['index', 'view', 'listas']
        ];
    
        return $behaviors;
    }
    public $modelClass = 'app\models\Listg';

    public $enableCsrfValidation = false;

    public function actionListas($id)
{
    // Busca todas las listas que pertenecen al grupo
    $listas = Listg::find()->where(['list_fkgroup' => $id])->all();

    // Verifica si se encontraron listas
    if (!empty($listas)) {
        $result = [];
        foreach ($listas as $datos=> $lista) {
            $result[] = [
                'list_id' => $lista->list_id,
                'list_fkgroup' => $lista->list_fkgroup,
                'list_fkperson' => $lista->listFkperson->completo,
                // Agrega otros campos si es necesario
            ];
        }
        return $result;
    } else {
        // Manejar la situación en la que no se encontraron listas
        return ['message' => 'No se encontraron listas para el grupo proporcionado'];
    }
}



}