<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use app\modules\aux_planejamento\models\planos\NivelUnidadesCurriculares;
use app\modules\aux_planejamento\models\planos\Unidadescurriculares;
use app\modules\aux_planejamento\models\planos\PlanoMaterial;
use app\modules\aux_planejamento\models\planos\PlanoConsumo;
use app\modules\aux_planejamento\models\planos\PlanoAluno;
use app\modules\aux_planejamento\models\planos\PlanoEstruturafisica;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\Planilhadecurso */

$this->title = $model->placu_codplanilha;
$this->params['breadcrumbs'][] = ['label' => 'Listagem Planilhas de Curso - Pendentes', 'url' => ['/planilhas/planilhadecurso-pendentes/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilhadecurso-pendentes-view">

<?php
    //Pega as mensagens
    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
    }
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            echo Html::a('Listagem de Planilhas', ['/planilhas/planilhadecurso-pendentes/index'], ['class' => 'btn btn-warning']);
        ?>
    </p>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> DETALHES DA PLANILHA DE CUSTO</h3>
    </div>
      <div class="panel-body">

          <div id="rootwizard" class="tabbable tabs-left">
           <ul>
                <li><a href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Informações</a></li>
                <li><a href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-folder-open"></span> Organização Curricular</a></li>
                <li><a href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-book"></span> Material Didático</a></li>
                <li><a href="#tab4" data-toggle="tab"><span class="glyphicon glyphicon-tags"></span> Material de Consumo</a></li>
                <li><a href="#tab5" data-toggle="tab"><span class="glyphicon glyphicon-education"></span> Material do Aluno</a></li>
                <li><a href="#tab6" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Equipamentos / Utensílios</a></li>
           </ul>

            <div class="tab-content" style="margin-right: -15px; margin-left: -15px;"><br>

                <div class="tab-pane" id="tab1">
                    <?= $this->render('/planilhas/planilhadecurso/view-planilha', [
                        'model' => $model,
                        'modelsPlaniDespDocente' => $modelsPlaniDespDocente,
                    ]) ?>
                </div>

                <div class="tab-pane" id="tab2">
                    <?= $this->render('/planilhas/planilhadecurso/view-orgcurricular', [
                        'modelsPlaniUC' => $modelsPlaniUC,
                    ]) ?>
                </div>

                <div class="tab-pane" id="tab3">
                    <?= $this->render('/planilhas/planilhadecurso/view-materiaisdidaticos', [
                        'modelsPlaniMaterial' => $modelsPlaniMaterial,
                    ]) ?>
                </div>
            
                <div class="tab-pane" id="tab4">
                    <?= $this->render('/planilhas/planilhadecurso/view-materiaisconsumo', [
                        'modelsPlaniConsumo' => $modelsPlaniConsumo,
                    ]) ?>
                </div>

                <div class="tab-pane" id="tab5">
                    <?= $this->render('/planilhas/planilhadecurso/view-materiaisaluno', [
                        'modelsPlaniMateriaisAluno' => $modelsPlaniMateriaisAluno,
                    ]) ?>
                </div>

                <div class="tab-pane" id="tab6">
                    <?= $this->render('/planilhas/planilhadecurso/view-equipamentos', [
                        'modelsPlaniEquipamento' => $modelsPlaniEquipamento,
                    ]) ?>
                </div>

            </div>

          </div>
      </div>
  </div>
</div>

            <!--          JS etapas dos formularios            -->
<?php
$script = <<< JS
$(document).ready(function() {
    $('#rootwizard').bootstrapWizard({'tabClass': 'nav nav-tabs'});
});

JS;
$this->registerJs($script);
?>

<?php  $this->registerJsFile(Yii::$app->request->baseUrl.'/js/jquery.bootstrap.wizard.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>