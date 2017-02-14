<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "fichas_inscricoes".
 *
 * @property integer $id
 * @property string $nomeInscricao
 * @property string $arquivoInscricao
 * @property string $data
 * @property integer $vestibular_id
 *
 * @property VestibularVest $vestibular
 */
class FichasInscricoes extends \yii\db\ActiveRecord
{
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fichas_inscricoes';
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
            [['nomeInscricao', 'data', 'vestibular_id'], 'required'],
            [['data'], 'safe'],
            [['vestibular_id'], 'integer'],
            [['nomeInscricao', 'arquivoInscricao'], 'string', 'max' => 255],
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
            'nomeInscricao' => 'Nome Inscricao',
            'arquivoInscricao' => 'Arquivo Inscricao',
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
