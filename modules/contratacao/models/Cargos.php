<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "cargos".
 *
 * @property integer $idcargo
 * @property string $descricao
 *
 * @property CargosProcesso[] $cargosProcessos
 */
class Cargos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargos';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_processos');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['status'], 'integer'],
            [['descricao'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcargo' => 'Código',
            'descricao' => 'Descrição',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargosProcessos()
    {
        return $this->hasMany(CargosProcesso::className(), ['cargo_id' => 'idcargo']);
    }
}
