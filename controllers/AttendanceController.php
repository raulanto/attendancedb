<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use app\models\Attendance;

class AttendanceController extends ActiveController
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
            'except' => ['index', 'view','asistencias']
        ];
    
        return $behaviors;
    }
    public $modelClass = 'app\models\Attendance';
    public $enableCsrfValidation = false;

    //funcion personalizada 
    public function actionAsistencias($id)
    {
        // Buscar asistencias con el ID específico
        $asistencias = Attendance::find()->where(['att_fklist' => $id])->all();
    
        // Verificar si se encontraron asistencias
        if (!empty($asistencias)) {
            $result = [];
            foreach ($asistencias as $asistencia) {
                // Agregar los campos deseados al resultado
                $result[] = [
                    'att_id' => $asistencia->att_id,
                    'att_date' => $asistencia->att_date,
                    'att_time' => $asistencia->att_time,
                    'att_commit' => $asistencia->att_commit,
                    'att_fkcode' => $asistencia->attFkcode->code,
                    // Agregar otros campos si es necesario
                ];
            }
            return $result;
        } else {
            // Manejar la situación en la que no se encontraron asistencias
            return ['message' => 'No se encontraron asistencias para el ID proporcionado'];
        }
    }

    
    
 
}