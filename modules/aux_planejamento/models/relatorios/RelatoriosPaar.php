<?php

namespace app\modules\aux_planejamento\models\relatorios;

use Yii;
use yii\base\Model;

class RelatoriosPaar extends Model
{
    public $relat_codano;
    public $relat_codtipla;
    public $relat_codsituacao;
    public $relat_tiporelatorio;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relat_codano', 'relat_codtipla', 'relat_codsituacao', 'relat_tiporelatorio'], 'required'],
            [['relat_codano', 'relat_codtipla', 'relat_codsituacao', 'relat_tiporelatorio'], 'integer'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'relat_codano' => 'Ano Planilha',
            'relat_codsituacao' => 'Situação Planilha',
            'relat_codtipla' => 'Tipo Planilha',
            'relat_tiporelatorio' => 'Tipo de Relatório',
        ];
    }
}
