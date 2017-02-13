<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "precificacao_unidades".
 *
 * @property integer $uprec_id
 * @property integer $uprec_codunidade
 * @property integer $uprec_cargahoraria
 * @property integer $uprec_qntaluno
 * @property double $uprec_totalcustodireto
 * @property double $uprec_vendaturma
 * @property double $uprec_vendaaluno
 * @property double $uprec_horaaula
 * @property integer $precificacao_id
 *
 * @property PrecificacaoPlanp $precificacao
 */
class PrecificacaoUnidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'precificacao_unidades';
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
            [['uprec_codunidade', 'uprec_cargahoraria', 'uprec_qntaluno', 'precificacao_id'], 'integer'],
            [['uprec_totalcustodireto', 'uprec_vendaturma', 'uprec_vendaaluno', 'uprec_horaaula'], 'number'],
            [['precificacao_id'], 'required'],
            [['precificacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Precificacao::className(), 'targetAttribute' => ['precificacao_id' => 'planp_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uprec_id' => 'Código',
            'uprec_codunidade' => 'Unidade',
            'uprec_cargahoraria' => 'Carga Horária',
            'uprec_qntaluno' => 'Qnt Alunos',
            'uprec_totalcustodireto' => 'Total Custo Direto',
            'uprec_vendaturma' => 'V. Total da Turma',
            'uprec_vendaaluno' => 'V. Por Aluno',
            'uprec_horaaula' => 'V. Hora/Aula',
            'precificacao_id' => 'Precificacao ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecificacao()
    {
        return $this->hasOne(Precificacao::className(), ['planp_id' => 'precificacao_id']);
    }
}
