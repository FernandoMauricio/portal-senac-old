<?php

namespace app\modules\aux_planejamento\models\relatorios;

use Yii;
use yii\base\Model;

class RelatoriosDep extends Model
{
    public $relat_unidade;
    public $relat_codano;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['relat_unidade', 'relat_codano'], 'required'],
            [['relat_unidade', 'relat_codano'], 'integer'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'relat_unidade' => 'Unidade',
            'relat_codano' => 'Ano',
        ];
    }
}
