<?php

namespace app\modules\aux_planejamento\models\planilhas;

use Yii;

/**
 * This is the model class for table "planilhadespesadoce_planides".
 *
 * @property integer $id
 * @property string $planilhadecurso_cod
 * @property string $planides_descricao
 * @property double $planides_valor
 * @property double $planides_dsr
 * @property double $planides_planejamento
 * @property double $planides_produtividade
 * @property double $planides_valorhoraaula
 *
 * @property PlanilhadecursoPlacu $planilhadecursoCod
 */
class PlanilhaDespesaDocente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planilhadespesadoce_planides';
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
            [['planilhadecurso_cod', 'planides_cargahoraria'], 'required'],
            [['planilhadecurso_cod', 'planides_cargahoraria'], 'integer'],
            [['planides_valor', 'planides_valorhidden', 'planides_encargos', 'planides_dsr', 'planides_planejamento', 'planides_produtividade', 'planides_valorhoraaula'], 'number'],
            [['planides_descricao'], 'string', 'max' => 45],
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
            'planilhadecurso_cod' => 'Cód. Planilha',
            'planides_descricao' => '',
            'planides_valor' => '',
            'planides_valorhidden' =>'',
            'planides_encargos' => '',
            'planides_dsr' => '',
            'planides_planejamento' => '',
            'planides_produtividade' => '',
            'planides_valorhoraaula' => '',
            'planides_cargahoraria' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanilhadecurso()
    {
        return $this->hasOne(Planilhadecurso::className(), ['placu_codplanilha' => 'planilhadecurso_cod']);
    }
}
