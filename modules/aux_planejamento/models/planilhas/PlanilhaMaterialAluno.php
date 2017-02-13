<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "planilhamaterialaluno_planimatalun".
 *
 * @property integer $id
 * @property string $planilhadecurso_cod
 * @property string $planimatalun_descricao
 * @property string $planimatalun_unidade
 * @property string $planimatalun_tipo
 * @property double $planimatalun_valor
 * @property integer $planimatalun_quantidade
 *
 * @property PlanilhadecursoPlacu $planilhadecursoCod
 */
class PlanilhaMaterialAluno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhamaterialaluno_planimatalun';
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
            [['planilhadecurso_cod', 'planodeacao_cod', 'planimatalun_quantidade'], 'integer'],
            [['planimatalun_valor'], 'number'],
            [['planimatalun_descricao'], 'string', 'max' => 100],
            [['planimatalun_unidade'], 'string', 'max' => 20],
            [['planimatalun_tipo'], 'string', 'max' => 45],
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
            'planilhadecurso_cod' => 'Cód Planilha',
            'planodeacao_cod' => 'Cod. Plano',
            'planimatalun_descricao' => 'Descrição',
            'planimatalun_unidade' => 'Unidade',
            'planimatalun_tipo' => 'Fonte de Recursos',
            'planimatalun_valor' => 'Valor',
            'planimatalun_quantidade' => 'Quantidade',
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
