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
/* @var $model app\modules\aux_planejamento\models\planos\Planodeacao */

$this->title = $model->plan_codplano . ' - ' .$model->plan_descricao;
$this->params['breadcrumbs'][] = ['label' => 'Listagem de Planos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

//RESGATANDO AS INFORMAÇÕES
//$id = $model->plan_codplano;
$session = Yii::$app->session;
?>
<div class="planodeacao-view">
<?php
//Pega as mensagens
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-'.$key.'">'.$message.'</div>';
}
?>
    <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?php
        if($session['sess_codunidade'] == 11) { //ÁREA DA DEP
    ?>
           <?= Html::a('Atualizar', ['update', 'id' => $model->plan_codplano], ['class' => 'btn btn-primary']) ?>
    <?php
        }
    ?>
            <?php
                  echo Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['imprimir','id' => $model->plan_codplano], [
                      'class'=>'btn btn-warning', 
                      'target'=>'_blank', 
                      'data-toggle'=>'tooltip', 
                      'title'=>' Clique aqui para gerar um arquivo PDF'
                  ]);

            ?>
        </p>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> DETALHES DO PLANO</h3>
  </div>
    <div class="panel-body">
          <div class="row">

    <?php
$attributes = [
                [
                    'group'=>true,
                    'label'=>'SEÇÃO 1: Informações do Plano',
                    'rowOptions'=>['class'=>'info']
                ],

                [
                    'columns' => [
                        [
                            'attribute'=>'plan_descricao', 
                            'displayOnly'=>true,
                            'labelColOptions'=>['style'=>'width:0%'],
                            'valueColOptions'=>['style'=>'width:30%']
                        ],

                        [
                            'attribute'=>'plan_cargahoraria', 
                            'format'=>'raw', 
                            'value'=>$model->plan_cargahoraria,
                            'valueColOptions'=>['style'=>'width:0%'], 
                            'displayOnly'=>true
                        ],

                        [
                            'attribute'=>'plan_status', 
                            'format'=>'raw',
                            'type'=>DetailView::INPUT_SWITCH,
                            'value'=>$model->plan_status ? '<span class="label label-success">Liberado</span>' : '<span class="label label-danger">Em elaboração</span>',
                            'valueColOptions'=>['style'=>'width:0%']
                        ],

                        [
                            'attribute'=>'plan_modelonacional', 
                            'format'=>'raw',
                            'type'=>DetailView::INPUT_SWITCH,
                            'value'=>$model->plan_modelonacional ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>',
                            'valueColOptions'=>['style'=>'width:0%']
                        ],
                    ],
                ],

                [
                    'columns' => [
                        [
                            'attribute'=>'plan_codnivel', 
                            'value'=> $model->nivel->niv_descricao,
                            'labelColOptions'=>['style'=>'width:0%'], 
                            'displayOnly'=>true
                        ],
                        [
                            'attribute'=>'plan_codeixo', 
                            'value'=> $model->eixo->eix_descricao,
                            'labelColOptions'=>['style'=>'width:0%'], 
                            'displayOnly'=>true
                        ],
                        [
                            'attribute'=>'plan_codsegmento', 
                            'value'=> $model->segmento->seg_descricao,
                            'labelColOptions'=>['style'=>'width:0%'], 
                            'displayOnly'=>true
                        ],
                        [
                            'attribute'=>'plan_codtipoa', 
                            'value'=> $model->tipo->tip_descricao,
                            'labelColOptions'=>['style'=>'width:0%'], 
                            'displayOnly'=>true
                        ],
                    ],

                ],

                [
                    'attribute'=>'plan_sobre',
                    'format' => 'ntext',
                    'value'=> $model->plan_sobre,
                    'type'=>DetailView::INPUT_TEXTAREA, 
                    'options'=>['rows'=>4]
                ],

                [
                    'attribute'=>'plan_prerequisito',
                    'format' => 'ntext',
                    'value'=> $model->plan_prerequisito,
                    'type'=>DetailView::INPUT_TEXTAREA, 
                    'options'=>['rows'=>4]
                ],

                [
                    'attribute'=>'plan_perfConclusao',
                    'format' => 'ntext',
                    'value'=> $model->plan_perfConclusao,
                    'type'=>DetailView::INPUT_TEXTAREA, 
                    'options'=>['rows'=>4]
                ],

                [
                    'attribute'=>'plan_perfTecnico',
                    'format' => 'ntext',
                    'value'=> $model->plan_perfTecnico,
                    'type'=>DetailView::INPUT_TEXTAREA, 
                    'options'=>['rows'=>4]
                ],

                [
                    'attribute'=>'plan_categoriasPlano',
                    'format' => 'ntext',
                    'value'=> implode(', ', \yii\helpers\ArrayHelper::map($model->planoCategorias, 'id', 'categoria.descricao')),
                    'type'=>DetailView::INPUT_TEXTAREA, 
                    'options'=>['rows'=>4]
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
                              <!-- SEÇÃO 2 - UNIDADES CURRICULARES -->
  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 2: Organização Curricular</th></tr>
      <tr>
        <th>UC</th>
        <th>Descrição</th>
        <th>Carga Horária</th>
      </tr>
    </thead>
    <tbody>
        <?php
             $valorTotal = 0;
             $query_planoUnidadesCurriculares = "SELECT * FROM unidadescurriculares_uncu WHERE planodeacao_cod = '".$model->plan_codplano."' ORDER BY id ASC";
             $modelsUnidadesCurriculares = Unidadescurriculares::findBySql($query_planoUnidadesCurriculares)->all(); 
             foreach ($modelsUnidadesCurriculares as $modelUnidadesCurriculares) {
                
                $nivel_uc          = $modelUnidadesCurriculares["nivel_uc"];
                $uncu_descricao    = $modelUnidadesCurriculares["uncu_descricao"];
                $uncu_cargahoraria = $modelUnidadesCurriculares["uncu_cargahoraria"];
                $valorTotal       += $modelUnidadesCurriculares["uncu_cargahoraria"]; //somatório de todos os valores dos itens

                //busca pelos níveis das unidades curriculares
                $query_nivelUC = "SELECT nivuc_descricao FROM `nivelunidcurriculares_nivuc`, `unidadescurriculares_uncu` WHERE `nivuc_id` = '".$nivel_uc."' ";
                $modelsNivelUC = NivelUnidadesCurriculares::findBySql($query_nivelUC)->all(); 

                foreach ($modelsNivelUC as $modelNivelUC) {

                 $nivuc_descricao   = $modelNivelUC["nivuc_descricao"];
              }
        ?>
        <tr>
        <td><?php echo $nivuc_descricao ?></td>
        <td><?php echo $uncu_descricao ?></td>
        <td><?php echo $uncu_cargahoraria . " horas" ?></td>
      </tr>
        <?php
          }
        ?>
    </tbody>
      <tfoot>
            <tr class="warning kv-edit-hidden" style="border-top: #dedede">
              <th>TOTAL </th>
              <th></th>
               <th colspan="12" style="color:red"><?php echo $valorTotal . " horas" ?></th>
            </tr>
      </tfoot>
  </table>

                              <!-- SEÇÃO 3 - MATERIAIS DIDÁTICOS -->
  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 3: Materiais Didáticos</th></tr>
      <tr>
        <th>UC</th>
        <th>Cód MXM</th>
        <th>Descrição</th>
        <th>Valor Unitário</th>
        <th>Tipo Material</th>
        <th>Editora</th>
        <th>Plano</th>
        <th>Observação</th>
        <th>Arquivo</th>
      </tr>
    </thead>
    <tbody>
        <?php
             $valorTotal = 0;
             $query_planoMaterial = "SELECT * FROM planomaterial_plama WHERE plama_codplano = '".$model->plan_codplano."' ORDER BY nivel_uc ASC";
             $modelsPlanoMaterial = PlanoMaterial::findBySql($query_planoMaterial)->all(); 
             foreach ($modelsPlanoMaterial as $modelPlanoMaterial) {

                //$model->plan_codplano                   = $modelPlanoMaterial["id"];
                $nivel_uc             = $modelPlanoMaterial["nivel_uc"];
                $plama_codmxm         = $modelPlanoMaterial["plama_codmxm"];
                $plama_codrepositorio = $modelPlanoMaterial["plama_codrepositorio"];
                $plama_titulo         = $modelPlanoMaterial["plama_titulo"];
                $plama_valor          = $modelPlanoMaterial["plama_valor"];
                $plama_tipomaterial   = $modelPlanoMaterial["plama_tipomaterial"];
                $plama_editora        = $modelPlanoMaterial["plama_editora"];
                $plama_tipoplano      = $modelPlanoMaterial["plama_tipoplano"];
                $plama_observacao     = $modelPlanoMaterial["plama_observacao"];
                $plama_arquivo        = $modelPlanoMaterial["plama_arquivo"];
                $valorTotal           += $modelPlanoMaterial["plama_valor"]; //somatório de todos os valores dos itens

                //busca pelos níveis das unidades curriculares
                $query_nivelUC = "SELECT nivuc_descricao FROM `nivelunidcurriculares_nivuc`, `unidadescurriculares_uncu` WHERE `nivuc_id` = '".$nivel_uc."' ";
                $modelsNivelUC = NivelUnidadesCurriculares::findBySql($query_nivelUC)->all(); 

                foreach ($modelsNivelUC as $modelNivelUC) {

                 $nivuc_descricao   = $modelNivelUC["nivuc_descricao"];
              }

        ?>
        <tr>
        <td><?php echo $nivuc_descricao ?></td>
        <td><?php echo $plama_codmxm ?></td>
        <td><?php echo $plama_titulo ?></td>
        <td><?php echo 'R$ ' . number_format($plama_valor, 2, ',', '.') ?></td>
        <td><?php echo $plama_tipomaterial ?></td>
        <td><?php echo $plama_editora ?></td>
        <td><?php echo $plama_tipoplano ?></td>
        <td><?php echo $plama_observacao ?></td>
        <td><a target="_blank" href="http://portalsenac.am.senac.br/aux_planejamento/web/uploads/aux_planejamento/repositorio/<?php echo $plama_codrepositorio .'/'. $plama_arquivo ?>"> <?php echo $plama_arquivo ?></a></td>
      </tr>
        <?php
          }
        ?>
    </tbody>
     <tfoot>
               <tr class="warning kv-edit-hidden" style="border-top: #dedede">
               <th colspan="3">TOTAL <i>(Valor Unitário)</i></th>
               <th colspan="9" style="color:red"><?php echo 'R$ ' . number_format($valorTotal, 2, ',', '.') ?></th>
            </tr>
         </tfoot>
  </table>
                              <!-- SEÇÃO 4 - MATERIAIS DE CONSUMO -->
  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 4: Materiais de Consumo</th></tr>
      <tr>
        <th>Cód MXM</th>
        <th>Descrição</th>
        <th>Valor Unitário</th>
        <th>Quantidade</th>
        <th>Unidade</th>
        <th>Valores Atualizados Em</th>
      </tr>
    </thead>
    <tbody>
        <?php
             $valorTotal = 0;
             $query_planoConsumo = "SELECT * FROM plano_materialconsumo WHERE planodeacao_cod = '".$model->plan_codplano."' ORDER BY id ASC";
             $modelsPlanoConsumo = PlanoConsumo::findBySql($query_planoConsumo)->all(); 
             foreach ($modelsPlanoConsumo as $modelPlanoConsumo) {
                $planmatcon_codMXM     = $modelPlanoConsumo["planmatcon_codMXM"];
                $planmatcon_descricao  = $modelPlanoConsumo["planmatcon_descricao"];
                $planmatcon_valor      = $modelPlanoConsumo["planmatcon_valor"];
                $planmatcon_tipo       = $modelPlanoConsumo["planmatcon_tipo"];
                $planmatcon_quantidade = $modelPlanoConsumo["planmatcon_quantidade"];
                $planmatcon_data       = $modelPlanoConsumo["planmatcon_data"];
                $valorTotal           += $modelPlanoConsumo["planmatcon_valor"]; //somatório de todos os valores dos itens
        ?>
        <tr>
        <td><?php echo $planmatcon_codMXM ?></td>
        <td><?php echo $planmatcon_descricao ?></td>
        <td><?php echo 'R$ ' . number_format($planmatcon_valor, 2, ',', '.') ?></td>
        <td><?php echo $planmatcon_quantidade ?></td>
        <td><?php echo $planmatcon_tipo ?></td>
        <td><?php echo date('d/m/Y', strtotime($planmatcon_data)) != '31/12/1969' ? date('d/m/Y', strtotime($planmatcon_data)) : '-' ?></td>

      </tr>
        <?php
          }
        ?>
    </tbody>
     <tfoot>
            <tr>
               <?php
               //somatória de Quantidade * Valor de todas as linhas
               $query = (new \yii\db\Query())->from('db_apl2.plano_materialconsumo')->where(['planodeacao_cod' => $model->plan_codplano]);
               $sum = $query->sum('planmatcon_valor*planmatcon_quantidade');
               ?>
               <tr class="warning kv-edit-hidden" style="border-top: #dedede">
               <th colspan="2">TOTAL <i>(Valor Unitário * Quantidade)</i></th>
               <th colspan="4" style="color:red"><?php echo 'R$ ' . number_format($sum, 2, ',', '.') ?></th>
            </tr>
         </tfoot>
  </table>

                              <!-- SEÇÃO 5 - MATERIAIS DO ALUNO -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 5: Materiais do Aluno</th></tr>
      <tr>
        <th>Descrição</th>
        <th>Valor Unitário</th>
        <th>Quantidade</th>
        <th>Unidade</th>
        <th>Fonte de Recursos</th>
      </tr>
    </thead>
    <tbody>
        <?php
             $valorTotal = 0;
             $query_planoAluno = "SELECT * FROM plano_materialaluno WHERE planodeacao_cod = '".$model->plan_codplano."' ORDER BY planmatalu_tipo ASC";
             $modelsPlanoAluno = PlanoAluno::findBySql($query_planoAluno)->all(); 
             foreach ($modelsPlanoAluno as $modelPlanoAluno) {
                
                $planmatalu_descricao  = $modelPlanoAluno["planmatalu_descricao"];
                $planmatalu_valor      = $modelPlanoAluno["planmatalu_valor"];
                $planmatalu_unidade    = $modelPlanoAluno["planmatalu_unidade"];
                $planmatalu_quantidade = $modelPlanoAluno["planmatalu_quantidade"];
                $planmatalu_tipo       = $modelPlanoAluno["planmatalu_tipo"];
                $valorTotal           += $modelPlanoAluno["planmatalu_valor"]; //somatório de todos os valores dos itens
        ?>
        <tr>
        <td><?php echo $planmatalu_descricao ?></td>
        <td><?php echo 'R$ ' . number_format($planmatalu_valor, 2, ',', '.') ?></td>
        <td><?php echo $planmatalu_quantidade ?></td>
        <td><?php echo $planmatalu_unidade ?></td>
        <td><?php echo $planmatalu_tipo ?></td>

      </tr>
        <?php    }   ?>
    </tbody>
     <tfoot>
            <tr class="warning kv-edit-hidden" style="border-top: #dedede">
               <th>TOTAL <i>(Valor Unitário * Quantidade)</i></th>

               <?php
               //somatória de Quantidade * Valor de todas as linhas
               $query = (new \yii\db\Query())->from('db_apl2.plano_materialaluno')->where(['planodeacao_cod' => $model->plan_codplano]);
               $sum = $query->sum('planmatalu_valor*planmatalu_quantidade');
               ?>
               <th colspan="12" style="color:red"><?php echo 'R$ ' . number_format($sum, 2, ',', '.') ?></th>
            </tr>
         </tfoot>
  </table>

                              <!-- SEÇÃO 6 - Equipamentos / Utensílios DO PLANO -->

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 6: Equipamentos / Utensílios do Plano</th></tr>
      <tr>
        <th>Descrição</th>
        <th>Quantidade</th>
        <th>Tipo</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php
             $query_PlanoEstrutura = "SELECT * FROM plano_estruturafisica WHERE planodeacao_cod = '".$model->plan_codplano."' ORDER BY planestr_tipo ASC";
             $modelsPlanoEstrutura = PlanoEstruturafisica::findBySql($query_PlanoEstrutura)->all(); 
             foreach ($modelsPlanoEstrutura as $modelPlanoEstrutura) {
                
                $planestr_descricao  = $modelPlanoEstrutura["planestr_descricao"];
                $planestr_quantidade = $modelPlanoEstrutura["planestr_quantidade"];
                $planestr_tipo       = $modelPlanoEstrutura["planestr_tipo"];
        ?>
        <td><?php echo $planestr_descricao ?></td>
        <td><?php echo $planestr_quantidade ?></td>
        <td><?php echo $planestr_tipo ?></td>

      </tr>
        <?php    }   ?>
    </tbody>
  </table>

  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 7: Auditoria</th></tr>
        <th>Atualizado por: <?php echo $model->colaborador->usuario->usu_nomeusuario ?></th>
        <th>Última Modifcação: <?php echo  date('d/m/Y', strtotime($model->plan_data)) ?></th>
    </thead>
  </table>

           </div>
      </div>
  </div>
</div>