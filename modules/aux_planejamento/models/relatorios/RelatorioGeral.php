<?php

namespace app\modules\aux_planejamento\models\relatorios;

use Yii;
use yii\base\Model;

class RelatorioGeral extends Model
{
    public $relat_unidade;
    public $relat_codano;
    public $relat_codtipla;
    public $relat_codsituacao;
    public $relat_tiporelatorio;
    public $relat_modelorelatorio;
    public $relat_tipoprogramacao;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relat_codano', 'relat_codtipla', 'relat_codsituacao', 'relat_tiporelatorio', 'relat_modelorelatorio', 'relat_tipoprogramacao'], 'required'],
            [['relat_unidade', 'relat_codano', 'relat_codtipla', 'relat_codsituacao', 'relat_tiporelatorio', 'relat_modelorelatorio', 'relat_tipoprogramacao'], 'integer'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'relat_unidade' => 'Unidade',
            'relat_codano' => 'Ano Planilha',
            'relat_codsituacao' => 'Situação Planilha',
            'relat_codtipla' => 'Tipo Planilha',
            'relat_tiporelatorio' => 'Tipo de Relatório',
            'relat_modelorelatorio' => 'Modelo de Relatório',
            'relat_tipoprogramacao' => 'Tipo de Programação',
        ];
    }


}
