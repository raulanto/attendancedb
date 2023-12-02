<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;

use app\models\ExtraGroup;


class ExtraGroupController extends ActiveController
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
            'except' => ['index', 'view', 'extragroups', 'buscar']
        ];
    
        return $behaviors;
    }
    public $modelClass = 'app\models\ExtraGroup';
    
    public $enableCsrfValidation = false;

    public function actionExtragroups($id)
    {
        // Busca todas las extragroups que pertenecen al grupo
        $extragroups = ExtraGroup::find()->where(['extgro_fkgroup' => $id])->all();
        
        // Verifica si se encontraron registros
        if (!empty($extragroups)) {
            $result = [];
            foreach ($extragroups as $datos => $extragroup) {
                $result[] = [
                    'extgro_id' => $extragroup->extgro_id,
                    'extgro_fkgroup' => $extragroup->extgro_fkgroup,
                    'extgro_fkextracurricular' => $extragroup->extgro_fkextracurricular,
                    // Agrega otros campos si es necesario
                ];
            }
            return $result;
        } else {
            // Manejar la situación en la que no se encontraron registros
            return ['message' => 'No se encontraron registros para el grupo proporcionado'];
        }
    }

    public function actionBuscar($text='') {
        $consulta = ExtraGroup::find()->joinWith(['extgroFkextracurricular'])->where(['like', new \yii\db\Expression("CONCAT(extgro_id, ' ', ext_name)"), $text]);
    
        $extras = new \yii\data\ActiveDataProvider([
            'query' => $consulta,
            'pagination' => [
                'pageSize' => 20 // Número de resultados por página
            ],
        ]);
    
        return $extras->getModels();
    }

    public function actionTotal($text='') {
        $total = ExtraGroup::find();
        if($text != '') {
            $total = $total->where(['like', new \yii\db\Expression("CONCAT(extgro_id, ' ', extgro_fkextracurricular, ' ', extgro_fkgroup)"), $text]);
        }
        $total = $total->count();
        return $total;
    }
}