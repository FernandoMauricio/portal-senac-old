<?php

namespace app\modules\contratacao\models;

use Yii;

/**
 * This is the model class for table "contratacao".
 *
 * @property string $id
 * @property string $data_solicitacao
 * @property string $hora_solicitacao
 * @property integer $cod_colaborador
 * @property integer $cod_unidade_solic
 * @property integer $quant_pessoa
 * @property string $motivo
 * @property integer $substituicao
 * @property integer $periodo
 * @property integer $tempo_periodo
 * @property integer $aumento_quadro
 * @property string $nome_substituicao
 * @property integer $deficiencia
 * @property string $obs_deficiencia
 * @property integer $fundamental_comp
 * @property integer $fundamental_inc
 * @property integer $medio_comp
 * @property integer $medio_inc
 * @property integer $tecnico_comp
 * @property integer $tecnico_inc
 * @property string $tecnico_area
 * @property integer $superior_comp
 * @property integer $superior_inc
 * @property string $superior_area
 * @property integer $pos_comp
 * @property integer $pos_inc
 * @property string $pos_area
 * @property string $dominio_atividade
 * @property integer $windows
 * @property integer $word
 * @property integer $excel
 * @property integer $internet
 * @property integer $experiencia
 * @property string $experiencia_tempo
 * @property string $experiencia_atividade
 * @property integer $jornada_horas
 * @property string $jornada_obs
 * @property string $principais_atividades
 * @property integer $recrutamento_id
 * @property integer $selec_curriculo
 * @property integer $selec_dinamica
 * @property integer $selec_prova
 * @property integer $selec_entrevista
 * @property string $selec_teste
 * @property integer $situacao_id
 *
 * @property Recrutamento $recrutamento
 * @property SituacaoContratacao $situacao
 */
class Contratacao extends \yii\db\ActiveRecord
{
    public $nomesituacao;
    public $permissions;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contratacao';
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
            [['data_solicitacao', 'hora_solicitacao', 'nomesituacao'], 'safe'],
            ['tecnico_area', 'required', 'when' => function($model) { return $model->tecnico_comp == 1; }, 'enableClientValidation' => true],
            ['superior_area', 'required', 'when' => function($model) { return $model->superior_comp == 1; }, 'enableClientValidation' => true],
            ['pos_area', 'required', 'when' => function($model) { return $model->pos_comp == 1; }, 'enableClientValidation' => true],
            [['cod_colaborador', 'cod_unidade_solic', 'quant_pessoa', 'substituicao', 'periodo', 'tempo_periodo', 'aumento_quadro', 'deficiencia', 'fundamental_comp', 'fundamental_inc', 'medio_comp', 'medio_inc', 'tecnico_comp', 'tecnico_inc', 'superior_comp', 'superior_inc', 'pos_comp', 'pos_inc', 'windows', 'word', 'excel', 'internet', 'experiencia', 'jornada_horas', 'recrutamento_id', 'selec_curriculo', 'selec_dinamica', 'selec_prova', 'selec_entrevista', 'situacao_id'], 'integer'],
            [['motivo', 'obs_deficiencia', 'obs_aumento','dominio_atividade', 'jornada_obs', 'principais_atividades'], 'string'],
            [['recrutamento_id', 'situacao_id', 'permissions'], 'required'],
            [['colaborador', 'unidade', 'nome_substituicao'], 'string', 'max' => 100],
            [['data_ingresso'], 'string', 'max' => 15],
            [['tecnico_area', 'cargo','superior_area', 'pos_area', 'experiencia_tempo', 'experiencia_atividade', 'selec_teste'], 'string', 'max' => 45]
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'data_solicitacao' => 'Data Solicitacao',
            'hora_solicitacao' => 'Hora Solicitacao',
            'cod_colaborador' => 'Cod. Colaborador',
            'colaborador' => 'Solicitante',
            'cargo' => 'Cargo',
            'cod_unidade_solic' => 'cód unidade solicitante',
            'unidade' => 'Unidade',
            'quant_pessoa' => 'Quantidade de pessoas a ser contratada:',
            'motivo' => 'Motivo da contratação:',
            'substituicao' => 'Substituição:',
            'nome_substituicao' => 'Servidor a ser substituido',
            'periodo' => 'Período Indeterminado:',
            'tempo_periodo' => 'Período em meses',
            'aumento_quadro' => 'Necessidade de aumento do quadro de pessoal:',
            'obs_aumento' => 'Justificativa em caso do aumento do quadro de pessoal:',
            'data_ingresso' => 'Data prevista do ingresso do futuro contratado(a):',
            'deficiencia' => 'Poderá ser recrutado e selecionado candidato portador de algum tipo de deficiência:',
            'obs_deficiencia' => 'Observação',
            'fundamental_comp' => 'Completo',
            'fundamental_inc' => 'Incompleto',
            'medio_comp' => 'Completo',
            'medio_inc' => 'Incompleto',
            'tecnico_comp' => 'Completo',
            'tecnico_inc' => 'Incompleto',
            'tecnico_area' => 'Área',
            'superior_comp' => 'Completo',
            'superior_inc' => 'Incompleto',
            'superior_area' => 'Área',
            'pos_comp' => 'Completo',
            'pos_inc' => 'Incompleto',
            'pos_area' => 'Área',
            'dominio_atividade' => 'Domínio de alguma atividade ou conhecimento específico:',
            'windows' => 'Windows',
            'word' => 'Word',
            'excel' => 'Excel',
            'internet' => 'Internet',
            'experiencia' => 'Grau de experiência comprovada:',
            'experiencia_tempo' => 'Tempo de experiência',
            'experiencia_atividade' => 'Atividade',
            'jornada_horas' => 'Disponibilidade para jornada de 8 horas de segunda-feira a sexta-feira:',
            'jornada_obs' => 'Observação',
            'principais_atividades' => 'Principais atividades a serem desenvolvidas pelo servidor a ser contratado:',
            'recrutamento_id' => 'Métodos de recrutamento indicados:',
            'selec_curriculo' => 'Análise de Currículo',
            'selec_dinamica' => 'Dinâmica de Grupo',
            'selec_prova' => 'Provas gerais ou técnicas',
            'selec_entrevista' => 'Entrevista',
            'selec_teste' => 'Testes Psicológicos',
            'nomesituacao' => 'Situação',
            'situacao_id' => 'Situação',
            'permissions' => 'Criação de contas para:',
        ];
    }


    public function getSistemasContratacao() //Relation between Cargos & Processo table
    {
        return $this->hasMany(SistemasContratacao::className(), ['contratacao_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes){
        \Yii::$app->db->createCommand()->delete('sistemas_contratacao', 'contratacao_id = '.(int) $this->id)->execute(); //Delete existing value
        foreach ($this->permissions as $id) { //Write new values
            $tc = new SistemasContratacao();
            $tc->contratacao_id = $this->id;
            $tc->sistema_id = $id;
            $tc->save();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecrutamento()
    {
        return $this->hasOne(Recrutamento::className(), ['idrecrutamento' => 'recrutamento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(SituacaoContratacao::className(), ['cod_situacao' => 'situacao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratacaoJustificativas()
    {
        return $this->hasMany(ContratacaoJustificativas::className(), ['id_contratacao' => 'id']);
    }
}
