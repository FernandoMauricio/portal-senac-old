<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "cargos_processo".
 *
 * @property integer $id
 * @property integer $cargo_id
 * @property integer $processo_id
 *
 * @property Cargos $cargo
 * @property Processo $processo
 */
class CargosProcesso extends \yii\db\ActiveRecord
{

    public $permissions;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cargos_processo';
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
            [['cargo_id', 'processo_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cargo_id' => 'Cargo ID',
            'processo_id' => 'Processo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargo()
    {
        return $this->hasOne(Cargos::className(), ['idcargo' => 'cargo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesso()
    {
        return $this->hasOne(Processo::className(), ['id' => 'processo_id']);
    }
}
