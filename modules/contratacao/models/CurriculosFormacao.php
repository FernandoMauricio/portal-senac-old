<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "curriculos_formacao".
 *
 * @property integer $id
 * @property integer $fundamental_comp
 * @property integer $medio_comp
 * @property integer $superior_comp
 * @property string $superior_area
 * @property integer $pos
 * @property string $pos_area
 * @property integer $mestrado
 * @property string $mestrado_area
 * @property integer $doutorado
 * @property string $doutorado_area
 * @property integer $estuda_atualmente
 * @property string $estuda_curso
 * @property integer $estuda_turno
 * @property integer $curriculos_id
 *
 * @property Curriculos $curriculos
 */
class CurriculosFormacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curriculos_formacao';
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
            [['fundamental_comp', 'medio_comp', 'superior_comp', 'tecnico', 'pos', 'mestrado', 'doutorado', 'estuda_atualmente', 'estuda_turno_mat', 'estuda_turno_vesp', 'estuda_turno_not', 'curriculos_id'], 'integer'],
            [['curriculos_id'], 'required'],
            [['tecnico_area','superior_area', 'pos_area', 'mestrado_area', 'doutorado_area'], 'string', 'max' => 45],
            [['estuda_curso'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fundamental_comp' => 'Ensino Fundamental',
            'medio_comp' => 'Ensino Médio',
            'tecnico' => 'Ensino Técnico',
            'tecnico_area' => 'Curso Técnico',
            'superior_comp' => 'Ensino Superior',
            'superior_area' => 'Curso Graduação',
            'pos' => 'Pós Graduação',
            'pos_area' => 'Curso Pós Graduação',
            'mestrado' => 'Mestrado',
            'mestrado_area' => 'Curso Mestrado',
            'doutorado' => 'Doutorado',
            'doutorado_area' => 'Curso Doutorado',
            'estuda_atualmente' => 'Estuda Atualmente',
            'estuda_turno_mat' => 'Matutino',
            'estuda_turno_vesp' => 'Vespertino',
            'estuda_turno_not' => 'Noturno',
            'estuda_curso' => 'Estuda Curso',
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
