<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\Planodeacao */

$this->title = 'Atualizar Plano de Ação: ' . $model->plan_codplano;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Planos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->plan_codplano, 'url' => ['view', 'id' => $model->plan_codplano]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="planodeacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
	            'model' 			  		 => $model,
	            'estruturafisica' 	  		 => $estruturafisica,
	            'repositorio' 		  		 => $repositorio,
	            'materialconsumo' 	  		 => $materialconsumo,
	            'materialaluno' 	  		 => $materialaluno,
	            'modelsUnidadesCurriculares' => $modelsUnidadesCurriculares,
	            'modelsPlanoMaterial' 		 => $modelsPlanoMaterial,
	            'modelsPlanoEstrutura'		 => $modelsPlanoEstrutura,
	            'modelsPlanoConsumo'  		 => $modelsPlanoConsumo,
	            'modelsPlanoAluno' 	  		 => $modelsPlanoAluno,
	            'categoria'                  => $categoria,
    ]) ?>

</div>
