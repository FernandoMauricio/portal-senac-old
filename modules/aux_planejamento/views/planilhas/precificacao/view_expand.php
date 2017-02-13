<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

?>

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> DETALHES DA PRECIFICAÇÃO DE CUSTO</h3>
    </div>
                <div class="panel-body">

                    <?= $this->render('view-precificacao', [
                        'model' => $model,
                    ]) ?>

                    <br>
                    
                    <?= $this->render('view-unidades', [
                        'model' => $model,
                    ]) ?>


                </div>
    </div>