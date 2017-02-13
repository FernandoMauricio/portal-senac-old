<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "planilhaequip_planieq".
 *
 * @property integer $id
 * @property string $planilhadecurso_cod
 * @property integer $planodeacao_cod
 * @property string $planieq_descricao
 * @property integer $planieq_quantidade
 * @property string $planieq_tipo
 *
 * @property PlanilhadecursoPlacu $planilhadecursoCod
 */
class PlanilhaEquipamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhaequip_planieq';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_apl');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['planilhadecurso_cod', 'planodeacao_cod', 'planieq_quantidade'], 'integer'],
            [['planieq_descricao'], 'string', 'max' => 100],
            [['planieq_tipo'], 'string', 'max' => 45],
            [['planilhadecurso_cod'], 'exist', 'skipOnError' => true, 'targetClass' => Planilhadecurso::className(), 'targetAttribute' => ['planilhadecurso_cod' => 'placu_codplanilha']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'planilhadecurso_cod' => 'Cod. Planilha',
            'planodeacao_cod' => 'Cód. Plano',
            'planieq_descricao' => 'Descrição',
            'planieq_quantidade' => 'Qnt',
            'planieq_tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanilhadecursoCod()
    {
        return $this->hasOne(PlanilhadecursoPlacu::className(), ['placu_codplanilha' => 'planilhadecurso_cod']);
    }
}
