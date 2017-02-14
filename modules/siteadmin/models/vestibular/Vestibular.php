<?php

namespace app\modules\siteadmin\models\vestibular;

use Yii;

/**
 * This is the model class for table "vestibular_vest".
 *
 * @property integer $idVest
 * @property string $descVest
 * @property string $dataAbertura
 * @property string $dataEncerramento
 * @property string $curso
 * @property integer $vagas
 * @property string $turno
 * @property integer $status_id
 *
 * @property Aprovados $aprovados
 * @property Editais[] $editais
 * @property Gabarito[] $gabaritos
 * @property Matriz[] $matrizs
 * @property Status $status
 */
class Vestibular extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vestibular_vest';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_vestibular');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descVest', 'dataAbertura', 'dataEncerramento', 'curso', 'vagas', 'turno', 'status_id'], 'required'],
            [['dataAbertura', 'dataEncerramento'], 'safe'],
            [['vagas', 'status_id', 'situacao_id'], 'integer'],
            [['descVest'], 'string', 'max' => 100],
            [['curso'], 'string', 'max' => 255],
            [['turno'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idVest' => 'Id',
            'descVest' => 'Descrição',
            'dataAbertura' => 'Data Abertura',
            'dataEncerramento' => 'Data Encerramento',
            'curso' => 'Curso',
            'vagas' => 'Vagas',
            'turno' => 'Turno',
            'situacao_id' => 'Situação',
            'status_id' => 'Publicação no site',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprovados()
    {
        return $this->hasOne(Aprovados::className(), ['id' => 'idVest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditais()
    {
        return $this->hasMany(Editais::className(), ['vestibular_id' => 'idVest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGabaritos()
    {
        return $this->hasMany(Gabarito::className(), ['vestibular_id' => 'idVest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatrizs()
    {
        return $this->hasMany(Matriz::className(), ['vestibular_id' => 'idVest']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    public function getSituacao()
    {
        return $this->hasOne(Situacao::className(), ['id' => 'situacao_id']);
    }


}
