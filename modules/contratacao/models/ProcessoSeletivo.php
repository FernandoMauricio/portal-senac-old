<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "processo".
 *
 * @property integer $id
 * @property string $descricao
 * @property string $data
 * @property string $numeroEdital
 * @property string $objetivo
 * @property integer $status_id
 * @property integer $situacao_id
 * @property integer $modalidade_id
 * @property string $data_encer
 *
 * @property Modalidade $modalidade
 * @property Situacao $situacao
 * @property Resultados[] $resultados
 */
class ProcessoSeletivo extends \yii\db\ActiveRecord
{
    public $permissions;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'processo';
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
            [['descricao', 'permissions', 'data', 'numeroEdital', 'objetivo', 'modalidade_id', 'data_encer','status_id', 'situacao_id',], 'required'],
            [['data', 'data_encer'], 'safe'],
            [['objetivo'], 'string'],
            [['status_id', 'situacao_id', 'modalidade_id'], 'integer'],
            [['descricao'], 'string', 'max' => 100],
            [['numeroEdital'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'descricao' => 'Descrição',
            'data' => 'Data de Abertura',
            'data_encer' => 'Data de Encerramento',
            'numeroEdital' => 'Edital',
            'objetivo' => 'Objetivo',
            'status_id' => 'Publicação no site',
            'situacao_id' => 'Situação',
            'modalidade_id' => 'Modalidade',
            'permissions' => 'Cargos disponíveis para este edital:',
            
        ];
    }

    public function getCargosProcesso() //Relation between Cargos & Processo table
    {
        return $this->hasMany(CargosProcesso::className(), ['processo_id' => 'id']);
    }


    public function afterSave($insert, $changedAttributes){
        //Cargos
        \Yii::$app->db->createCommand()->delete('cargos_processo', 'processo_id = '.(int) $this->id)->execute(); //Delete existing value
        foreach ($this->permissions as $id) { //Write new values
            $tc = new CargosProcesso();
            $tc->processo_id = $this->id;
            $tc->cargo_id = $id;
            $tc->save();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdendos()
    {
        return $this->hasMany(Adendos::className(), ['processo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnexos()
    {
        return $this->hasMany(Anexos::className(), ['processo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditals()
    {
        return $this->hasMany(Edital::className(), ['processo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModalidade()
    {
        return $this->hasOne(Modalidade::className(), ['id' => 'modalidade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargos()
    {
        return $this->hasMany(Cargos::className(), ['processo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(Situacao::className(), ['id' => 'situacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status' => 'status_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResultados()
    {
        return $this->hasMany(Resultados::className(), ['processo_id' => 'id']);
    }
}