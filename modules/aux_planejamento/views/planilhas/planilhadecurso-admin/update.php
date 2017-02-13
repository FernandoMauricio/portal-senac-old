<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\Planilhadecurso */

$this->title = 'Atualizar Planilha de Curso: ' . $model->placu_codplanilha;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Planilhas de Curso - Administrador', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->placu_codplanilha, 'url' => ['view', 'id' => $model->placu_codplanilha]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="planilhadecurso-admin-update">

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('/planilhas/planilhadecurso/update/_form', [
        'model' => $model,
        'modelsPlaniDespDocente'    => $modelsPlaniDespDocente,
        'modelsPlaniUC'		 	    => $modelsPlaniUC,
        'modelsPlaniMaterial' 	    => $modelsPlaniMaterial,
        'modelsPlaniConsumo'  	    => $modelsPlaniConsumo,
        'modelsPlaniMateriaisAluno' => $modelsPlaniMateriaisAluno,
        'modelsPlaniEquipamento'    => $modelsPlaniEquipamento,
    ]) ?>

</div>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/planilhadecursoadmin.js', ['position'=>$this::POS_READY]); ?>