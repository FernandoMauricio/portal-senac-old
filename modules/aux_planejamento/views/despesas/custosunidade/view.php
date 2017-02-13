<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use app\modules\aux_planejamento\models\despesas\Custosindireto;
use app\modules\aux_planejamento\models\despesas\Salas;


/* @var $this yii\web\View */
/* @var $model app\modules\aux_planejamento\models\despesas\Custosunidade */

$this->title = $model->cust_codcusto;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Custos da Unidade', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}

?>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->cust_codcusto], ['class' => 'btn btn-primary']) ?>

    </p>

<div class="custosunidade-view">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> DETALHES DE CUSTOS DA UNIDADE</h3>
      </div>
        <div class="panel-body">
            <div class="row">
        <?php

        $attributes = [

        //-------------- SESSÃO 1 INFORMAÇÕES DA SOLICITAÇÃO
                    [
                        'group'=>true,
                        'label'=>'SEÇÃO 1: Informações da Unidade',
                        'rowOptions'=>['class'=>'info']
                    ],


                    [
                        'columns' => [
                            [
                                'attribute'=>'cust_codcusto', 
                                'displayOnly'=>true,
                                'valueColOptions'=>['style'=>'width:0%'],
                                'labelColOptions'=>['style'=>'width:5%'],
                            ],

                            [
                                'attribute'=>'cust_ano', 
                                'displayOnly'=>true,
                                'valueColOptions'=>['style'=>'width:0%'],
                                'labelColOptions'=>['style'=>'width:0%'],
                            ],

                            [
                                'attribute'=>'cust_codunidade', 
                                'displayOnly'=>true,
                                'value'=> $model->unidade->uni_nomeabreviado,
                                'valueColOptions'=>['style'=>'width:0%'],
                                'labelColOptions'=>['style'=>'width:10%'],
                            ],

                            [
                                'attribute'=>'cust_indireto', 
                                'label'=>'Custo Indireto (R$)',
                                'displayOnly'=>true,
                                'valueColOptions'=>['style'=>'width:0%'],
                                'labelColOptions'=>['style'=>'width:15%'],
                            ],

                            [
                                'attribute'=>'cust_status', 
                                'format'=>'raw',
                                'type'=>DetailView::INPUT_SWITCH,
                                'value'=>$model->cust_status ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>',
                                'valueColOptions'=>['style'=>'width:10%'],
                                'labelColOptions'=>['style'=>'width:00%'],
                            ],
                        ],
                    ],

                ];

        echo DetailView::widget([
            'model'=>$model,
            'condensed'=>true,
            'hover'=>true,
            'mode'=>DetailView::MODE_VIEW,
            'attributes'=> $attributes,
        ]);

        ?>
                              <!-- SEÇÃO 2 - INFORMAÇÕES DE CUSTOS -->
    <table class="table table-condensed table-hover">
      <thead>
      <tr class="info"><th colspan="12">SEÇÃO 2: Informações de Custos</th></tr>
      <tr>
        <th colspan="3" style="text-align: center;">Descrição dos Espaços Físicos</th>
        <th colspan="1" style="text-align: center;">Média Mensal</th>
        <th colspan="1" style="text-align: center;">Custo Indireto</th>
      </tr>
        <tr>
          <th>Código DN</th>
          <th>Salas</th>
          <th>Cap. Máx. de Alunos</th>
          <th>Metragem</th>
          <th>Valores em %</th>
          <th>Valores em $</th>
        </tr>
      </thead>
      <tbody>
          <?php

            //Busca no banco o quantitativo da porcentagem
            $sql = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."'";
            $qnt_porcentagem = Custosindireto::findBySql($sql)->count(); 

               //Valores Totais (Cap. Máxima de Aluno, Metragem, Porcentagem, Custo Indireto)
               $valorTotal = 0;
               $valorTotalMetragem = 0;
               $valorTotalPorcentagem = 0;
               $valorTotalCustoIndireto = 0;

                //busca pelas despesas
                $query_custoIndireto = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."' ORDER BY id ASC";
                $modelsCustosIndireto = Custosindireto::findBySql($query_custoIndireto)->all(); 
                foreach ($modelsCustosIndireto as $modelCustosIndireto) {

                  $salas_id               = $modelCustosIndireto["salas_id"];
                  $custin_ambienteDN      = $modelCustosIndireto["custin_ambienteDN"];
                  $custin_capmaximo       = $modelCustosIndireto["custin_capmaximo"];
                  $custin_metragem        = $modelCustosIndireto["custin_metragem"];
                  $custin_porcentagem     = $modelCustosIndireto["custin_porcentagem"];
                  $custin_custoindireto   = $modelCustosIndireto["custin_custoindireto"];

                  //somatório de todos os valores dos itens
                  $valorTotal              += $modelCustosIndireto["custin_capmaximo"];
                  $valorTotalMetragem      += $modelCustosIndireto["custin_metragem"];
                  $valorTotalPorcentagem   += $custin_porcentagem;   //---------cap. máx. de alunos * 100 / Valor Total de Cap Alunos
                  $valorTotalCustoIndireto += $custin_porcentagem * $model->cust_indireto; //porcetagem x custo indireto

                //busca pelas salas de cada despesa
                $query_salas = "SELECT sal_descricao FROM `salas_sal`, `custosindireto_custin` WHERE `sal_codsala`= '".$salas_id."' ";
                $modelsSalas = Salas::findBySql($query_salas)->all(); 

                foreach ($modelsSalas as $modelSalas) {

                  $sal_descricao  = $modelSalas["sal_descricao"];
              }
          ?>
          <tr>
          <td><?php echo $custin_ambienteDN ?></td>
          <td><?php echo $sal_descricao ?></td>
          <td><?php echo $custin_capmaximo ?></td>
          <td><?php echo $custin_metragem ?></td>
          <td><?php echo number_format(($custin_porcentagem * 100), 2) . "%" ?></td>
          <td><?php echo 'R$ ' . number_format($custin_custoindireto, 2, ',', '.') ?></td>
        </tr>
          <?php
            }
          ?>
      </tbody>
       <tfoot>
              <tr class="warning kv-edit-hidden" style="border-top: #dedede">
                <th>TOTAL </th>
                  <th></th>
                 <th><?php echo $valorTotal ?></th>
                 <th><?php echo $valorTotalMetragem ?></th>
                 <th><?php echo ($valorTotalPorcentagem * 100) . "%" ?></th>
                 <th><?php echo 'R$ ' . number_format($valorTotalCustoIndireto, 2, ',', '.') ?></th>

              </tr>
           </tfoot>
    </table>


                        <!-- CAIXA DE MÉDIA FIX POR SALA % -->

            <div class="col-md-2"></div>

            <div class="col-md-4">
                 <table class="table" colspan="2"  border="1" style="max-width: 80%;">
                    <thead>
                      <tr>
                        <th class="info" colspan="2" style="border-top: #dedede;text-align: center;">(%) Média Fixa por Sala</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="2" style="text-align: center;">

                      <?php  echo number_format($model->cust_MediaPorcentagem, 2, ',', '.') . "%"   ?>
                      </td>
                      </tr>
                    </tbody>
                  </table>

            </div>

                        <!-- CAIXA DE CUSTO MÉDIO POR SALA R$ -->

            <div class="col-md-4">
                 <table class="table" colspan="2"  border="1" style="max-width: 80%;">
                    <thead>
                      <tr>
                        <th class="info" colspan="2" style="border-top: #dedede;text-align: center;">Custo Médio por Sala R$</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="2" style="text-align: center;">

                      <?php  echo "R$ " . number_format($model->cust_MediaCustoIndireto, 2, ',', '.')  ?>
                      </td>
                      </tr>
                    </tbody>
                  </table>

            </div>

            <div class="col-md-2"></div>

            </div>
        </div>
    </div>

</div>
