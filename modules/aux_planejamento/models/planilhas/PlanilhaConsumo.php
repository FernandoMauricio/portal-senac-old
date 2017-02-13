<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "planilhaconsumo_planico".
 *
 * @property integer $id
 * @property string $planilhadecurso_cod
 * @property integer $planodeacao_cod
 * @property integer $materialconsumo_cod
 * @property integer $planico_codMXM
 * @property string $planico_descricao
 * @property integer $planico_quantidade
 * @property double $planico_valor
 * @property string $planico_tipo
 *
 * @property PlanilhadecursoPlacu $planilhadecursoCod
 */
class PlanilhaConsumo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhaconsumo_planico';
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
            [['planilhadecurso_cod', 'planodeacao_cod', 'materialconsumo_cod', 'planico_codMXM', 'planico_quantidade'], 'integer'],
            [['planico_valor'], 'number'],
            [['planico_descricao'], 'string', 'max' => 100],
            [['planico_tipo'], 'string', 'max' => 45],
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
            'planodeacao_cod' => 'Cod. Plano',
            'materialconsumo_cod' => 'Cód. Material Consumo',
            'planico_codMXM' => 'Cód. MXM',
            'planico_descricao' => 'Descrição',
            'planico_quantidade' => 'Qnt',
            'planico_valor' => 'Valor',
            'planico_tipo' => 'Tipo',
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
