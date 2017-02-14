<?php

namespace app\modules\siteadmin\models;

use Yii;

/**
 * This is the model class for table "abertura".
 *
 * @property integer $id
 * @property string $desc_abertura
 * @property string $arquivo
 * @property string $data
 * @property integer $estado_id
 * @property integer $status_id
 * @property string $unidades
 *
 * @property Status $status
 * @property Aprovados[] $aprovados
 * @property Comunicado[] $comunicados
 * @property Errata[] $erratas
 */
class Abertura extends \yii\db\ActiveRecord
{

    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'abertura';
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
            [['desc_abertura', 'estado_id', 'status_id', 'unidades'], 'required'],
            [['data'], 'safe'],
            [['estado_id', 'status_id'], 'integer'],
            [['desc_abertura'], 'string', 'max' => 85],
            [['arquivo', 'unidades'], 'string', 'max' => 145]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desc_abertura' => 'Descrição',
            'file' => 'Arquivo',
            'arquivo' => 'Arquivo',
            'data' => 'Data',
            'estado_id' => 'Situação',
            'status_id' => 'Publicação no site',
            'unidades' => 'Local',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprovados()
    {
        return $this->hasMany(Aprovados::className(), ['edital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunicados()
    {
        return $this->hasMany(Comunicado::className(), ['edital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getErratas()
    {
        return $this->hasMany(Errata::className(), ['edital_id' => 'id']);
    }


    public function getUnidades()
    {
        return $this->hasOne(Unidades::className(), ['uni_codunidade' => 'unidades']);
    }


    public function getSituacao()
    {
        return $this->hasOne(Situacao::className(), ['id' => 'estado_id']);
    }


}
