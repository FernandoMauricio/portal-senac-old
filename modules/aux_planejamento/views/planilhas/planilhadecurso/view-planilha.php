<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
?>
<div class="planilhadecurso-view">

    <?php
        $attributes = [
                            [
                                'group'=>true,
                                'label'=>'SEÇÃO 1: Informações da Planilha',
                                'rowOptions'=>['class'=>'info']
                            ],

                            [
                                'columns' => [
                                    [
                                        'attribute'=>'placu_codnivel', 
                                        'value'=> $model->nivel->niv_descricao,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_codeixo', 
                                        'value'=> $model->eixo->eix_descricao,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_codsegmento', 
                                        'value'=> $model->segmento->seg_descricao,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_codtipoa', 
                                        'value'=> $model->tipo->tip_descricao,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                ],
                            ],

                            [
                                'columns' => [
                                    [
                                        'label'=>'Plano de Ação',
                                        'format'=>'raw', 
                                        'value'=>$model->plano->plan_descricao,
                                        'displayOnly'=>true,
                                        'labelColOptions'=>['style'=>'width:0%'],
                                        'valueColOptions'=>['style'=>'width:0%']
                                    ],

                                    [
                                        'attribute'=>'placu_cargahorariaplano', 
                                        'format'=>'raw', 
                                        'value'=>$model->placu_cargahorariaplano,
                                        'valueColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],

                                    [
                                        'attribute'=>'placu_codsituacao', 
                                        'format'=>'raw', 
                                        'value'=>'<span class="label label-success"> '.$model->situacaoPlani->sipla_descricao .'</span>',
                                        'valueColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],

                                ],
                            ],

                            [
                                'label'=>'Informações Comerciais',
                                'format' => 'ntext',
                                'value'=> $model->plano->plan_sobre,
                                'type'=>DetailView::INPUT_TEXTAREA, 
                                'options'=>['rows'=>4]
                            ],

                            [
                                'label'=>'Pré-Requisito',
                                'format' => 'ntext',
                                'value'=> $model->plano->plan_prerequisito,
                                'type'=>DetailView::INPUT_TEXTAREA, 
                                'options'=>['rows'=>4]
                            ],

                            [
                                'label'=>'Perfil Profissional de Conclusão',
                                'format' => 'ntext',
                                'value'=> $model->plano->plan_perfConclusao,
                                'type'=>DetailView::INPUT_TEXTAREA, 
                                'options'=>['rows'=>4]
                            ],

                            [
                                'label'=>'Perfil do Docente',
                                'format' => 'ntext',
                                'value'=> $model->plano->plan_perfTecnico,
                                'type'=>DetailView::INPUT_TEXTAREA, 
                                'options'=>['rows'=>4]
                            ],

                            [
                                'group'=>true,
                                'label'=>'SEÇÃO 2: Sobre a Turma',
                                'rowOptions'=>['class'=>'info']
                            ],

                            [
                                'columns' => [
                                    [
                                        'attribute'=>'placu_codano', 
                                        'value'=> $model->planilhaAno->an_ano,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_codtipla', 
                                        'value'=> $model->tipoplanilha->tipla_descricao,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_codprogramacao', 
                                        'value'=> $model->tipoprogramacao->tipro_descricao,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_quantidadeturmas', 
                                        'value'=> $model->placu_quantidadeturmas,
                                        'labelColOptions'=>['style'=>'width:0%'], 
                                        'displayOnly'=>true
                                    ],
                                ],
                            ],

                            [
                                'columns' => [
                                    [
                                        'attribute'=>'placu_cargahorariarealizada', 
                                        'labelColOptions'=>['style'=>'width:4.7%'],
                                        'valueColOptions'=>['style'=>'width:5%'],
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_quantidadealunos', 
                                        'labelColOptions'=>['style'=>'width:5%'],
                                        'valueColOptions'=>['style'=>'width:5%'],
                                        'displayOnly'=>true
                                    ],
                                ],
                            ],

                            [
                                'columns' => [
                                    [
                                        'attribute'=>'placu_cargahorariaarealizar', 
                                        'labelColOptions'=>['style'=>'width:5%'],
                                        'valueColOptions'=>['style'=>'width:5%'],
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_quantidadealunosisentos', 
                                        'labelColOptions'=>['style'=>'width:5%'],
                                        'valueColOptions'=>['style'=>'width:5%'],
                                        'displayOnly'=>true
                                    ],
                                ],
                            ],

                            [
                                'columns' => [
                                    [
                                        'attribute'=>'placu_cargahorariavivencia', 
                                        'labelColOptions'=>['style'=>'width:3.55%'],
                                        'valueColOptions'=>['style'=>'width:5%'],
                                        'displayOnly'=>true
                                    ],
                                    [
                                        'attribute'=>'placu_quantidadealunospsg', 
                                        'labelColOptions'=>['style'=>'width:5%'],
                                        'valueColOptions'=>['style'=>'width:5%'],
                                        'displayOnly'=>true
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
        <div class="row">
            <p class="bg-info" style="padding: 7px; margin-right: 15px; margin-left: 15px;"><strong> SEÇÃO 3: Cálculos de Custos Diretos</strong></p>
        </div>
        <table class="table table-condensed table-hover">
         <caption> Despesas com Docente</caption>
          <thead>
            <tr>
              <th>Descrição</th>
              <th>Encargos</th>
              <th>Valor</th>
              <th>DSR</th>
              <th>Planejamento</th>
              <th>Produtividade</th>
              <th>Valor Hora/Aula</th>
              <th>Carga Horária</th>
            </tr>
         </thead>

           <tbody>
               <?php foreach ($modelsPlaniDespDocente as $i => $modelPlaniDespDocente): ?>
            <tr>
                <td><?= $modelPlaniDespDocente->planides_descricao ?></td>
                <td><?= $modelPlaniDespDocente->planides_encargos . '%' ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniDespDocente->planides_valor, 2, ',', '.'); ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniDespDocente->planides_dsr, 2, ',', '.'); ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniDespDocente->planides_planejamento, 2, ',', '.'); ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniDespDocente->planides_produtividade, 2, ',', '.'); ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniDespDocente->planides_valorhoraaula, 2, ',', '.'); ?></td>
                <td><?= $modelPlaniDespDocente->planides_cargahoraria ?></td>
            </tr>
               <?php endforeach; ?>
           </tbody>
        </table>
    <div class="panel panel-default">
            <div class="panel-heading"> Resumo de Custos Diretos</div><br>
        <div class="container">
              <div class="row">
                      <div class="col-md-2"><strong>Mão de Obra Direta:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_totalcustodocente, 2, ',', '.'); ?></div>

                      <div class="col-md-2"><strong>1/12 de 13º:</strong><br> <?php echo 'R$ ' . number_format($model->placu_decimo, 2, ',', '.'); ?></div>

                      <div class="col-md-2"><strong>1/12 de Férias:</strong><br> <?php  echo 'R$ ' . number_format($model->placu_ferias, 2, ',', '.'); ?></div>

                      <div class="col-md-2"><strong>1/12 de 1/3 de férias:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_tercoferias, 2, ',', '.'); ?></div>

                      <div class="col-md-2"><strong>SubTotal de Venc.:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_totalsalario, 2, ',', '.'); ?></div>

                      <div class="col-md-2"><strong>SubTotal Encargos:</strong><br><?php echo 'R$ ' . number_format( $model->placu_totalencargos, 2, ',', '.'); ?></div>
              </div>

            <br>

              <div class="row">
                      <div class="col-md-2"><strong>Outras Desp. Variáveis:</strong><br> <?php echo 'R$ ' . number_format($model->placu_outdespvariaveis, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>SubTotal de Vencimentos(Prestador):</strong><br> <?php echo 'R$ ' . number_format($model->placu_totalsalarioPrestador, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>SubTotal Encargos(Prestador):</strong><br> <?php echo 'R$ ' . number_format( $model->placu_totalencargosPrestador, 2, ',', '.'); ?></div>

                      <div class="col-md-4"><strong>Total Venc. + Encargos (Horista+Prestador):</strong><br> <?php echo 'R$ ' . number_format( $model->placu_totalsalarioencargo, 2, ',', '.'); ?></div>
              </div>

              <br>

              <div class="row">
                      <div class="col-md-3"><strong>Diárias:</strong><br> <?php echo 'R$ ' . number_format($model->placu_diarias, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>Passagens:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_passagens, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>Equipamentos:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_equipamentos, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>Serv. Terceiros (PF):</strong><br> <?php echo 'R$ ' . number_format( $model->placu_pessoafisica, 2, ',', '.'); ?></div>
              </div>

             <br>

              <div class="row">
                      <div class="col-md-3"><strong>Serv. Terceiros (PJ):</strong><br> <?php echo 'R$ ' . number_format( $model->placu_pessoajuridica, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>Mat. Didático (Apostila/plano A):</strong><br> <?php echo 'R$ ' .  number_format($model->placu_PJApostila, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>Mat. Didático (Livros/plano A):</strong><br> <?php echo 'R$ ' .  number_format($model->placu_custosmateriais, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>Material Consumo:</strong><br> <?php echo 'R$ ' .  number_format($model->placu_custosconsumo, 2, ',', '.'); ?></div>
              </div>

             <br>

              <div class="row">
                      <div class="col-md-3"><strong>Material do Aluno:</strong><br> <?php echo 'R$ ' .  number_format($model->placu_custosaluno, 2, ',', '.'); ?></div>
                      
                      <div class="col-md-3" style="color: #F7941D;"><strong>Total de Custo Direto:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_totalcustodireto, 2, ',', '.'); ?></div>

                      <div class="col-md-3"><strong>Valor Hora/Aula de Custo Direto:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_totalhoraaulacustodireto, 2, ',', '.'); ?></div>
              </div><br>
        </div>
    </div>

        <div class="row">
            <p class="bg-info" style="padding: 7px; margin-right: 15px; margin-left: 15px;"><strong> SEÇÃO 4: Cálculos de Custos Indiretos</strong></p>
        </div>

    <div class="panel panel-default">
            <div class="panel-heading"> Resumo de Custos Indiretos</div><br>
        <div class="container">
              <div class="row">
                  <div class="col-md-3"><strong>Custos Indiretos(%):</strong><br> <?php echo number_format($model->placu_custosindiretos, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>IPCA/Mês(%):</strong><br> <?php echo number_format($model->placu_ipca, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>Rerserva Técnica(%):</strong><br> <?php echo number_format($model->placu_reservatecnica, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>Despesa Sede ADM 2016(%):</strong><br> <?php echo number_format($model->placu_despesadm, 2, ',', '.') . '%'; ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Total Incidências(%):</strong><br> <?php echo number_format($model->placu_totalincidencias, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3" style="color: #F7941D;"><strong>Total Custo Indireto:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_totalcustoindireto, 2, ',', '.'); ?></div>

                  <div class="col-md-4" style="color: red;"><strong>Despesa Total:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_despesatotal, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Mark-Up Divisor 100-X/100:</strong><br> <?php echo number_format($model->placu_markdivisor, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>Mark-Up Multiplicador 100/Markup:</strong><br> <?php echo number_format($model->placu_markmultiplicador, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-4"><strong>Preço de Venda Total da Turma:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_vendaturma, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Preço de Venda Total por Aluno:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_vendaaluno, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Retorno com Preço de Venda:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_retorno, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Valor Hora/Aula por Aluno:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_horaaulaaluno, 2, ',', '.'); ?> </div>

                  <div class="col-md-3"><strong>% de Retorno:</strong><br>  <?php echo number_format($model->placu_porcentretorno, 2, ',', '.') . '%'; ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3" style="color: green;"><strong>Preço Sugerido:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_precosugerido, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Retorno com preço sugerido:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_retornoprecosugerido, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Numero minimo de alunos por turma:</strong><br> <?php echo $model->placu_minimoaluno; ?></div>

          </div>

        <br>
          
          <div class="row">
                  <div class="col-md-3"><strong>Quantidade de Parcelas:</strong><br> <?php echo $model->placu_parcelas; ?></div>

                  <div class="col-md-3"><strong>Valor das Parcelas:</strong><br> <?php echo 'R$ ' . number_format( $model->placu_valorparcelas, 2, ',', '.'); ?></div>
          </div><br>
      </div>
  </div>

        <div class="row">
            <p class="bg-info" style="padding: 7px; margin-right: 15px; margin-left: 15px;"><strong> SEÇÃO 5: Auditoria</strong></p>
        </div>
        <div class="container">
          <div class="row">
                  <div class="col-md-5"><strong>Última modificação:</strong> <?php echo $model->colaborador->usuario->usu_nomeusuario ?></div>

                  <div class="col-md-5"><strong>Data da modificação:</strong> <?php echo  date('d/m/Y', strtotime($model->placu_data)) ?></div>
          </div>
        </div>
</div>
