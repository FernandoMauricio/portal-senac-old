<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "curriculos_empregos".
 *
 * @property integer $id
 * @property string $empresa
 * @property string $cidade
 * @property string $cargo
 * @property string $atividades
 * @property string $inicio
 * @property string $termino
 * @property integer $curriculos_id
 *
 * @property Curriculos $curriculos
 */
class CurriculosEmpregos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curriculos_empregos';
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
            [['atividades'], 'string'],
            //[['inicio', 'termino'], 'safe'],
            [['curriculos_id'], 'integer'],
            [['inicio', 'termino'], 'string', 'max' => 14],
            [['empresa', 'cidade', 'cargo'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa' => 'Empresa',
            'cidade' => 'Cidade',
            'cargo' => 'Cargo',
            'atividades' => 'Atividades',
            'inicio' => 'Inicio',
            'termino' => 'Termino',
            'curriculos_id' => 'Curriculos ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurriculos()
    {
        return $this->hasOne(Curriculos::className(), ['id' => 'curriculos_id']);
    }
}
