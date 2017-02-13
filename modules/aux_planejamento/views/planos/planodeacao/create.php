<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planos\Planodeacao */

$this->title = 'Novo Plano de Ação';
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Planos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planodeacao-create">

	<?php
	    echo $this->render('_form', [
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
	    ])
	?>

</div>