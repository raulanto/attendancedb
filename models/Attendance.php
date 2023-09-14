<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property int $att_id Unique identifier for table attendance
 * @property string $att_date Date attendance is taken
 * @property string $att_time Time attendance is taken
 * @property string $att_commit Additional comment
 * @property int $att_fklist Foreign key of the attendance list
 * @property int $att_fkcode Foreign key of the code for the attendance
 *
 * @property Code $attFkcode
 * @property List $attFklist
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['att_date', 'att_time', 'att_commit', 'att_fklist', 'att_fkcode'], 'required'],
            [['att_date', 'att_time'], 'safe'],
            [['att_commit'], 'string'],
            [['att_fklist', 'att_fkcode'], 'integer'],
            [['att_fkcode'], 'exist', 'skipOnError' => true, 'targetClass' => Code::class, 'targetAttribute' => ['att_fkcode' => 'cod_id']],
            [['att_fklist'], 'exist', 'skipOnError' => true, 'targetClass' => List::class, 'targetAttribute' => ['att_fklist' => 'list_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'att_id' => 'Unique identifier for table attendance',
            'att_date' => 'Date attendance is taken',
            'att_time' => 'Time attendance is taken',
            'att_commit' => 'Additional comment',
            'att_fklist' => 'Foreign key of the attendance list',
            'att_fkcode' => 'Foreign key of the code for the attendance',
        ];
    }

    /**
     * Gets query for [[AttFkcode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttFkcode()
    {
        return $this->hasOne(Code::class, ['cod_id' => 'att_fkcode']);
    }

    /**
     * Gets query for [[AttFklist]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttFklist()
    {
        return $this->hasOne(Listg::class, ['list_id' => 'att_fklist']);
    }
}
