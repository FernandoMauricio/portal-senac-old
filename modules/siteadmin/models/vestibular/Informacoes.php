<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "informacoes".
 *
 * @property integer $id
 * @property string $nomeInfo
 * @property string $arquivoInfo
 * @property string $data
 * @property integer $vestibular_id
 *
 * @property VestibularVest $vestibular
 */
class Informacoes extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'informacoes';
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
            [['nomeInfo', 'data', 'vestibular_id'], 'required'],
            [['data'], 'safe'],
            [['vestibular_id'], 'integer'],
            [['nomeInfo', 'arquivoInfo'], 'string', 'max' => 255],
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
            'nomeInfo' => 'Nome Info',
            'arquivoInfo' => 'Arquivo Info',
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
