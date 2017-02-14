<?php

namespace app\modules\siteadmin\models;

use Yii;

/**
 * This is the model class for table "errata".
 *
 * @property integer $id
 * @property string $nomeErrata
 * @property string $arquivoErrata
 * @property string $data
 * @property integer $edital_id
 *
 * @property Abertura $edital
 */
class Errata extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'errata';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_psg');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'pdf', 'maxSize' => 1024 * 1024, 'tooBig' => 'O arquivo é grande demais. Seu tamanho não pode exceder 1MB.'],
            [['nomeErrata', 'edital_id'], 'required'],
            [['data'], 'safe'],
            [['edital_id'], 'integer'],
            [['nomeErrata', 'arquivoErrata'], 'string', 'max' => 145]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomeErrata' => 'Descrição',
            'file' => 'Arquivo',
            'arquivoErrata' => 'Arquivo Errata',
            'data' => 'Data',
            'edital_id' => 'Edital ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEdital()
    {
        return $this->hasOne(Abertura::className(), ['id' => 'edital_id']);
    }
}
