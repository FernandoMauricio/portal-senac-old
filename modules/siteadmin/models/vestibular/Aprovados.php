<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "aprovados".
 *
 * @property integer $id
 * @property string $nomeLista
 * @property string $arquivoLista
 * @property string $data
 * @property integer $vestibular_id
 *
 * @property VestibularVest $id0
 */
class Aprovados extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aprovados';
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
            [['nomeLista', 'vestibular_id'], 'required'],
            [['data'], 'safe'],
            [['vestibular_id'], 'integer'],
            [['nomeLista', 'arquivoLista'], 'string', 'max' => 145],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Vestibular::className(), 'targetAttribute' => ['id' => 'idVest']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomeLista' => 'Nome Lista',
            'arquivoLista' => 'Arquivo Lista',
            'file' => 'Arquivo',
            'data' => 'Data',
            'vestibular_id' => 'Vestibular ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(VestibularVest::className(), ['idVest' => 'id']);
    }
}
