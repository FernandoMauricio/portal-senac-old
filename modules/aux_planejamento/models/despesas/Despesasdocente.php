<?php

namespace app\modules\aux_planejamento\models\despesas;

use Yii;

/**
 * This is the model class for table "despesas_docente".
 *
 * @property integer $doce_id
 * @property string $doce_descricao
 * @property double $doce_valor
 * @property double $doce_dsr
 * @property double $doce_planejamento
 * @property double $doce_produtividade
 * @property double $doce_valorhoraaula
 * @property integer $doce_status
 */
class Despesasdocente extends \yii\db\ActiveRecord
{
    public $calculos;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'despesas_docente';
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
            [['doce_descricao', 'doce_encargos', 'doce_valor', 'doce_status', 'calculos'], 'required'],
            [['doce_valor', 'doce_dsr', 'doce_planejamento', 'doce_produtividade', 'doce_valorhoraaula'], 'number'],
            [['doce_status'], 'integer'],
            [['calculos'], 'safe'],
            [['doce_descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doce_id' => 'Cód.',
            'doce_descricao' => 'Nível Docente',
            'doce_encargos' => 'Encargos',
            'doce_valor' => 'Valor',
            'doce_dsr' => 'DSR',
            'doce_planejamento' => 'Planejamento',
            'doce_produtividade' => 'Produtividade 45%',
            'doce_valorhoraaula' => 'Valor Hora/Aula',
            'doce_status' => 'Situação',

            'calculos' => 'Realizar cálculos de Planejamento e Produtividade',
        ];
    }
}
