<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "gabarito".
 *
 * @property integer $id
 * @property string $nomeGabarito
 * @property string $arquivoGabarito
 * @property string $data
 * @property integer $vestibular_id
 *
 * @property VestibularVest $vestibular
 */
class Gabarito extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gabarito';
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
            [['nomeGabarito', 'data', 'vestibular_id'], 'required'],
            [['data'], 'safe'],
            [['vestibular_id'], 'integer'],
            [['nomeGabarito', 'arquivoGabarito'], 'string', 'max' => 145],
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
            'nomeGabarito' => 'Nome Gabarito',
            'arquivoGabarito' => 'Arquivo Gabarito',
            'file' => 'Arquivo',
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
