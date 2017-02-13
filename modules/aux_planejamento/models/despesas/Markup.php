<?php

namespace app\modules\aux_planejamento\models\despesas;

use Yii;

use app\modules\aux_planejamento\models\base\Unidade;

/**
 * This is the model class for table "markup_mark".
 *
 * @property integer $mark_id
 * @property integer $mark_codunidade
 * @property double $mark_ipca
 * @property double $mark_reservatecnica
 * @property double $mark_despesasede
 * @property double $mark_totalincidencias
 * @property double $mark_divisor
 */
class Markup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'markup_mark';
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
            [['mark_codunidade', 'mark_ano', 'mark_custoindireto', 'mark_ipca', 'mark_reservatecnica', 'mark_despesasede'], 'required'],
            [['mark_codunidade', 'mark_ano'], 'integer'],
            [['mark_ipca', 'mark_reservatecnica', 'mark_custoindireto', 'mark_despesasede', 'mark_totalincidencias', 'mark_divisor'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mark_id' => 'Mark ID',
            'mark_ano' => 'Ano',
            'mark_codunidade' => 'Unidade',
            'mark_custoindireto' => 'C. Indiretos(%)',
            'mark_ipca' => 'IPCA/Mês(%)',
            'mark_reservatecnica' => 'R.Técnica(%)',
            'mark_despesasede' => 'Sede ADM ' .  date('Y') . '(%)',
            'mark_totalincidencias' => 'T. Incidências(%)',
            'mark_divisor' => 'Markup Divisor 100-X/100(%)',
        ];
    }

    public function getUnidade()
    {
        return $this->hasOne(Unidade::className(), ['uni_codunidade' => 'mark_codunidade']);
    }
}
