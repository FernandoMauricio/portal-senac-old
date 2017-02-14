<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "matriz".
 *
 * @property integer $id
 * @property string $nomeMatriz
 * @property string $arquivoMatriz
 * @property string $data
 * @property integer $vestibular_id
 *
 * @property VestibularVest $vestibular
 */
class Matriz extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matriz';
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
            [['nomeMatriz', 'data', 'vestibular_id'], 'required'],
            [['data'], 'safe'],
            [['vestibular_id'], 'integer'],
            [['nomeMatriz', 'arquivoMatriz'], 'string', 'max' => 145],
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
            'nomeMatriz' => 'Nome Matriz',
            'arquivoMatriz' => 'Arquivo Matriz',
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
