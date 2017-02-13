<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\cadastros\Centrocusto */

$this->title = $model->cen_codcentrocusto;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Centros de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="centrocusto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cen_codano',
            'cen_codcentrocusto',
            'cen_centrocusto',
            'cen_centrocustoreduzido',
            'cen_nomecentrocusto',

            [
                'attribute' => 'cen_coddepartamento',
                'value' => $model->cen_coddepartamento != null ? $model->departamento->dep_nomecompleto : '', 
            ],
            [
                'attribute' => 'cen_codunidade',
                'value' => $model->unidade->uni_nomeabreviado,
            ],
            [
                'attribute' => 'cen_codsegmento',
                'value' => $model->segmento->seg_descricao,
            ],
            [
                'attribute' => 'cen_codtipoacao',
                'value' => $model->tipoacao->tip_descricao,
            ],
            
            [
                'attribute' => 'cen_codsituacao',
                'value'=>$model->cen_codsituacao ? 'Ativo' : 'Inativo',
            ],
            
        ],
    ]) ?>

</div>
