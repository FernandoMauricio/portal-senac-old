<?php

namespace app\modules\aux_planejamento\models\despesas;

use Yii;

/**
 * This is the model class for table "custosindireto_custin".
 *
 * @property integer $id
 * @property integer $salas_id
 * @property integer $custin_capmaximo
 * @property double $custin_metragem
 * @property double $custin_porcentagem
 * @property integer $custin_totalcapmaximo
 * @property double $custin_totalmetragem
 * @property double $custin_custoindireto
 * @property integer $custosunidade_id
 *
 * @property SalasSal $salas
 * @property CustosunidadeCust $custosunidade
 */
class Custosindireto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'custosindireto_custin';
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
            [['salas_id', 'custin_ambienteDN', 'custin_capmaximo', 'custin_metragem'], 'required'],
            [['salas_id', 'custin_ambienteDN', 'custin_capmaximo', 'custosunidade_id'], 'integer'],
            [['custin_metragem', 'custin_porcentagem', 'custin_custoindireto'], 'number'],
            [['salas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Salas::className(), 'targetAttribute' => ['salas_id' => 'sal_codsala']],
            [['custosunidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Custosunidade::className(), 'targetAttribute' => ['custosunidade_id' => 'cust_codcusto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salas_id' => 'Descrição de Salas',
            'custin_ambienteDN' => 'Cód. DN',
            'custin_capmaximo' => 'Cap. Máx. de Alunos',
            'custin_metragem' => 'Metragem',
            'custin_porcentagem' => 'Custin Porcentagem',
            'custin_custoindireto' => 'Custin Custoindireto',
            'custosunidade_id' => 'Custosunidade ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalas()
    {
        return $this->hasOne(SalasSal::className(), ['sal_codsala' => 'salas_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustosunidade()
    {
        return $this->hasOne(CustosunidadeCust::className(), ['cust_codcusto' => 'custosunidade_id']);
    }
}
