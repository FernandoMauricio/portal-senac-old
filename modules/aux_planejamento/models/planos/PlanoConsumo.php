<?php

namespace app\modules\aux_planejamento\models\planos;

use Yii;

use app\modules\aux_planejamento\models\cadastros\Materialconsumo;

/**
 * This is the model class for table "plano_materialconsumo".
 *
 * @property integer $id
 * @property string $planodeacao_cod
 * @property integer $materialconsumo_cod
 * @property integer $planmatcon_quantidade
 * @property double $planmatcon_valor
 * @property string $planmatcon_tipo
 *
 * @property MaterialconsumoMatcon $materialconsumoCod
 * @property PlanodeacaoPlan $planodeacaoCod
 */
class PlanoConsumo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plano_materialconsumo';
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
            [['materialconsumo_cod', 'planmatcon_quantidade', 'planmatcon_valor', 'planmatcon_tipo'], 'required'],
            [['planodeacao_cod', 'materialconsumo_cod', 'planmatcon_codMXM', 'planmatcon_quantidade'], 'integer'],
            [['planmatcon_valor'], 'number'],
            [['planmatcon_tipo'], 'string', 'max' => 45],
            [['planmatcon_descricao'], 'string', 'max' => 100],
            [['materialconsumo_cod'], 'exist', 'skipOnError' => true, 'targetClass' => Materialconsumo::className(), 'targetAttribute' => ['materialconsumo_cod' => 'matcon_codMXM']],
            [['planodeacao_cod'], 'exist', 'skipOnError' => true, 'targetClass' => Planodeacao::className(), 'targetAttribute' => ['planodeacao_cod' => 'plan_codplano']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'planodeacao_cod' => 'Cód. Plano',
            'planmatcon_codMXM' => 'Cód. MXM',
            'materialconsumo_cod' => 'Descrição',
            'planmatcon_descricao' => 'Descrição',
            'planmatcon_quantidade' => 'Quantidade',
            'planmatcon_valor' => 'Valor',
            'planmatcon_tipo' => 'Unidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialconsumoCod()
    {
        return $this->hasOne(MaterialconsumoMatcon::className(), ['matcon_codMXM' => 'materialconsumo_cod']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanodeacaoCod()
    {
        return $this->hasOne(PlanodeacaoPlan::className(), ['plan_codplano' => 'planodeacao_cod']);
    }
}
