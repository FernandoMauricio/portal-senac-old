<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\planilhas\Precificacao */

$this->title = $model->planp_id;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Precificação de Custo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="precificacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?php
                  echo Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['imprimir','id' => $model->planp_id], [
                      'class'=>'btn btn-warning', 
                      'target'=>'_blank', 
                      'data-toggle'=>'tooltip', 
                      'title'=>' Clique aqui para gerar um arquivo PDF'
                  ]);
            ?>

            <?= Html::button('<i class="glyphicon glyphicon-info-sign"></i> Dúvidas?', ['value'=> Url::to('index.php?r=aux_planejamento/planilhas/precificacao/duvidas'), 'class' => 'btn btn-info', 'id'=>'modalButton']) ?>

        </p>

    <?php
        Modal::begin([
            'header' => '<h4>Cálculos Realizados</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
            ]);

        echo "<div id='modalContent'></div>";

        Modal::end();

   ?>

<?php

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> DETALHES DA PRECIFICAÇÃO DE CUSTO</h3>
    </div>
      <div class="panel-body">

          <div id="rootwizard" class="tabbable tabs-left">
           <ul>
                  <li><a href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Preço Ofertado</a></li>
                  <li><a href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Preço de Venda por Unidade</a></li>
           </ul>

            

            <div class="tab-content"><br>

                <div class="tab-pane" id="tab1">
                    <?= $this->render('view-precificacao', [
                        'model' => $model,
                    ]) ?>
                </div>

                <div class="tab-pane" id="tab2">
                    <?= $this->render('view-unidades', [
                        'model' => $model,
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