<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use app\models\library;

class LibraryController extends ActiveController
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
            'except' => ['index', 'view' , 'librarys']
        ];
    
        return $behaviors;
    }
    public $modelClass = 'app\models\Library';

    public $enableCsrfValidation = false;

    public function actionLibrarys($id)
{
    // Busca todas las entradas de la tabla "library" donde "lib_fkgroup" coincide con el valor proporcionado
    $libraryEntries = Library::find()->where(['lib_fkgroup' => $id])->all();

    // Verifica si se encontraron entradas
    if (!empty($libraryEntries)) {
        $result = [];
        foreach ($libraryEntries as $entry) {
            $result[] = [
                'lib_id' => $entry->lib_id,
                'lib_type' => $entry->lib_type,
                'lib_title' => $entry->lib_title,
                'lib_description' => $entry->lib_description,
                'lib_file' => $entry->lib_file,
            ];
        }
        return $result;
    } else {
        return ['message' => 'No se encontraron entradas en la tabla "library" para el grupo proporcionado'];
    }
}

}