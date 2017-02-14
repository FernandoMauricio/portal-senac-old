<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "editais".
 *
 * @property integer $id
 * @property string $nomeEdital
 * @property string $arquivoEdital
 * @property string $data
 * @property integer $vestibular_id
 *
 * @property VestibularVest $vestibular
 */
class Editais extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'editais';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_vestibular');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'pdf', 'maxSize' => 1024 * 1024, 'tooBig' => 'O arquivo é grande demais. Seu tamanho não pode exceder 1MB.'],
            [['nomeEdital', 'data', 'vestibular_id'], 'required'],
            [['data'], 'safe'],
            [['vestibular_id'], 'integer'],
            [['nomeEdital', 'arquivoEdital'], 'string', 'max' => 145],
            [['vestibular_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vestibular::className(), 'targetAttribute' => ['vestibular_id' => 'idVest']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomeEdital' => 'Nome Edital',
            'arquivoEdital' => 'Arquivo Edital',
            'file' => 'Arquivo Edital',
            'data' => 'Data',
            'vestibular_id' => 'Vestibular ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVestibular()
    {
        return $this->hasOne(VestibularVest::className(), ['idVest' => 'vestibular_id']);
    }
}
