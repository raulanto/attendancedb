<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use app\models\ExtraGroup;

class ExtraGroupController extends ActiveController
{
    public $modelClass = 'app\models\ExtraGroup';

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

    public function actionExtragroups($id)
    {
        $text = \Yii::$app->request->get('text');

        $query = ExtraGroup::find()
            ->with(['extgroFkextracurricular'])
            ->joinWith(['extgroFkextracurricular'])
            ->where(['extgro_fkgroup' => $id]);

        if ($text !== null) {
            $query->andWhere(['like', 'extracurricular.ext_name', $text]);
        }

        $extragroups = $query->all();

        if (!empty($extragroups)) {
            $result = [];
            foreach ($extragroups as $extragroup) {
                $result[] = [
                    'extgro_id' => $extragroup->extgro_id,
                    'extgro_fkgroup' => $extragroup->extgro_fkgroup,
                    'extgro_fkextracurricular' => $extragroup->extgro_fkextracurricular,
                    'extracurricular' => [
                        'ext_id' => $extragroup->extgroFkextracurricular->ext_id,
                        'ext_name' => $extragroup->extgroFkextracurricular->ext_name,
                    ],
                ];
            }
            return $result;
        } else {
            return ['message' => 'No se encontraron registros para el grupo proporcionado'];
        }
    }

    public function actionBuscar($text='') {
        $consulta = ExtraGroup::find()->joinWith(['extgroFkextracurricular'])->where(['like', 'extracurricular.ext_name', $text]);

        $extras = new \yii\data\ActiveDataProvider([
            'query' => $consulta,
            'pagination' => [
                'pageSize' => 20 // Número de resultados por página
            ],
        ]);

        return $extras->getModels();
    }
}


