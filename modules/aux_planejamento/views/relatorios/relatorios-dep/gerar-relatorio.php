<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = 'Relatórios DEP';
$this->params['breadcrumbs'][] = 'Relatórios';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Relatório Segmento - Plano - Materiais:

<?= Html::a('Gerar Excel', ['segmento-plano-material'], ['class' => 'btn btn-primary']) ?>
	
</h3>

<h3>Planos de Ação:

<?php echo Html::a('Gerar Excel', ['planos'], ['class' => 'btn btn-primary']) ?>
	
</h3>