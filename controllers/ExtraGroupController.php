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
            'except' => ['index', 'view', 'extragroups', 'total']
        ];
    
        return $behaviors;
    }

    public $modelClass = 'app\models\ExtraGroup';

    public $enableCsrfValidation = false;

    public function actionExtragroups($id)
    {
        $text = \Yii::$app->request->get('text');
        $page = \Yii::$app->request->get('page', 1);

        $query = ExtraGroup::find()
            ->with(['extgroFkextracurricular'])
            ->joinWith(['extgroFkextracurricular'])
            ->where(['extgro_fkgroup' => $id]);

        if ($text !== null) {
            $query->andWhere(['like', 'extracurricular.ext_name', $text]);
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'page' => $page - 1,
                'pageSize' => 20,
            ],
        ]);

        $extragroups = $dataProvider->getModels();

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

    public function actionTotal($id = null, $text = '')
    {
        $query = ExtraGroup::find()->joinWith(['extgroFkextracurricular'])->andFilterWhere(['extgro_fkgroup' => $id]);
    
        if ($text !== '') {
            $query->andWhere(['like', 'extracurricular.ext_name', $text]);
        }
    
        $total = $query->count();
    
        return $total;
    }
    
    
    

}