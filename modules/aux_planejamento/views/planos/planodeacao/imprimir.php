<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use app\modules\aux_planejamento\models\planos\NivelUnidadesCurriculares;
use app\modules\aux_planejamento\models\planos\Unidadescurriculares;
use app\modules\aux_planejamento\models\planos\PlanoMaterial;
use app\modules\aux_planejamento\models\planos\PlanoConsumo;
use app\modules\aux_planejamento\models\planos\PlanoAluno;
use app\modules\aux_planejamento\models\planos\PlanoEstruturafisica;

?>

<?php

//RESGATANDO AS INFORMAÇÕES
$id = $model->plan_codplano;

?>
<div class="planodeacao-view">
<div class="panel panel-primary">
    <div class="panel-body">
          <div class="row">
  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 1: Informações do Plano</th></tr>
    </thead>
    <tr>
        <td colspan="4"><strong>Título: </strong><?php echo $model->plan_descricao; ?></td>
        <td colspan="3" ><strong>CH: </strong><?php echo $model->plan_cargahoraria; ?></td> 
        <td colspan="3"><strong>Situação: </strong> <?php echo $model->plan_status ? '<span class="label label-success">Liberado</span>' : '<span class="label label-danger">Em elaboração</span>' ?></td>
        <td colspan="2"><strong>Novo Modelo Pedagógico: </strong> <?php echo $model->plan_modelonacional ? '<span class="label label-success">Sim</span>' : '<span class="label label-danger">Não</span>' ?></td>
    </tr> 
<tbody>
    <tr>
        <td colspan="3"><strong>Nível: </strong> <?php echo $model->nivel->niv_descricao; ?></td>
        <td colspan="3"><strong>Eixo: </strong> <?php echo $model->eixo->eix_descricao; ?></td>
        <td colspan="3"><strong>Segmento: </strong> <?php echo $model->segmento->seg_descricao; ?></td>
        <td colspan="3"><strong>Tipo de Ação: </strong> <?php echo $model->tipo->tip_descricao; ?></td>
     </tr> 

    <tr>
        <td colspan="12"><strong>Sobre: </strong><?php echo $model->plan_sobre; ?></td>
    </tr>

    <tr>
        <td colspan="12"><strong>Pré-Requisito: </strong><?php echo $model->plan_prerequisito; ?></td>
    </tr> <br>

    <tr>
        <td colspan="12"><strong>Perfil Profissional de Conclusão: </strong><?php echo $model->plan_perfConclusao; ?></td>
    </tr> <br>

    <tr>
        <td colspan="12"><strong>Perfil Docente: </strong><?php echo $model->plan_perfTecnico; ?></td>
    </tr> 

    </tbody>
 </table>
                             <!-- SEÇÃO 2 - UNIDADES CURRICULARES -->
  <table class="table table-condensed table-hover">
    <thead>
    <tr class="info"><th colspan="12">SEÇÃO 2: Organização Curricular</th></tr>
      <tr>
        <th>Descrição</th>
        <th>Carga Horária</th>
      </tr>
    </thead>
    <tbody>
        <?php
             $valorTotal = 0;
             $query_planoUnidadesCurriculares = "SELECT * FROM unidadescurriculares_uncu WHERE planodeacao_cod = '".$id."' ORDER BY id ASC";
             $modelsUnidadesCurriculares = Unidadescurriculares::findBySql($query_planoUnidadesCurriculares)->all(); 
             foreach ($modelsUnidadesCurriculares as $modelUnidadesCurriculares) {
                
                $uncu_descricao    = $modelUnidadesCurriculares["uncu_descricao"];
                $uncu_cargahoraria = $modelUnidadesCurriculares["uncu_cargahoraria"];
                $valorTotal       += $modelUnidadesCurriculares["uncu_cargahoraria"]; //somatório de todos os valores dos itens

        ?>
        <tr>
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
      </tr>
    </thead>
    <tbody>
      
        <?php
             $valorTotal = 0;
             $query_planoMaterial = "SELECT * FROM planomaterial_plama WHERE plama_codplano = '".$id."' ORDER BY plama_tipoplano ASC";
             $modelsPlanoMaterial = PlanoMaterial::findBySql($query_planoMaterial)->all(); 
             foreach ($modelsPlanoMaterial as $modelPlanoMaterial) {
              
                $nivel_uc           = $modelPlanoMaterial["nivel_uc"];
                $plama_codmxm       = $modelPlanoMaterial["plama_codmxm"];
                $plama_titulo       = $modelPlanoMaterial["plama_titulo"];
                $plama_valor        = $modelPlanoMaterial["plama_valor"];
                $plama_tipomaterial = $modelPlanoMaterial["plama_tipomaterial"];
                $plama_editora      = $modelPlanoMaterial["plama_editora"];
                $plama_tipoplano    = $modelPlanoMaterial["plama_tipoplano"];
                $plama_observacao   = $modelPlanoMaterial["plama_observacao"];
                $valorTotal        += $modelPlanoMaterial["plama_valor"]; //somatório de todos os valores dos itens

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
       </tr>
        <?php
          }
        ?>
    </tbody>
     <tfoot>
            <tr class="warning kv-edit-hidden" style="border-top: #dedede">
              <th>TOTAL <i>(Valor Unitário)</i> </th>
               <th colspan="12" style="color:red"><?php echo 'R$ ' . number_format($valorTotal, 2, ',', '.') ?></th>
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
      </tr>
    </thead>
    <tbody>
        <?php
             $valorTotal = 0;
             $query_planoConsumo = "SELECT * FROM plano_materialconsumo WHERE planodeacao_cod = '".$id."' ORDER BY id ASC";
             $modelsPlanoConsumo = PlanoConsumo::findBySql($query_planoConsumo)->all(); 
             foreach ($modelsPlanoConsumo as $modelPlanoConsumo) {
                $materialconsumo_cod   = $modelPlanoConsumo["materialconsumo_cod"];
                $planmatcon_descricao  = $modelPlanoConsumo["planmatcon_descricao"];
                $planmatcon_valor      = $modelPlanoConsumo["planmatcon_valor"];
                $planmatcon_tipo       = $modelPlanoConsumo["planmatcon_tipo"];
                $planmatcon_quantidade = $modelPlanoConsumo["planmatcon_quantidade"];
                $valorTotal           += $modelPlanoConsumo["planmatcon_valor"]; //somatório de todos os valores dos itens

        ?>
        <tr>
        <td><?php echo $materialconsumo_cod ?></td>
        <td><?php echo $planmatcon_descricao ?></td>
        <td><?php echo 'R$ ' . number_format($planmatcon_valor, 2, ',', '.') ?></td>
        <td><?php echo $planmatcon_quantidade ?></td>
        <td><?php echo $planmatcon_tipo ?></td>

      </tr>
        <?php
          }
        ?>
    </tbody>
     <tfoot>
            <tr>
               <?php
               //somatória de Quantidade * Valor de todas as linhas
               $query = (new \yii\db\Query())->from('db_apl2.plano_materialconsumo')->where(['planodeacao_cod' => $id]);
               $sum = $query->sum('planmatcon_valor*planmatcon_quantidade');
               ?>
               <tr class="warning kv-edit-hidden" style="border-top: #dedede">
               <th colspan="2">TOTAL <i>(Valor Unitário * Quantidade)</i></th>
               <th colspan="12" style="color:red"><?php echo 'R$ ' . number_format($sum, 2, ',', '.') ?></th>
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
             $query_planoAluno = "SELECT * FROM plano_materialaluno WHERE planodeacao_cod = '".$id."' ORDER BY planmatalu_tipo ASC";
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
               $query = (new \yii\db\Query())->from('db_apl2.plano_materialaluno')->where(['planodeacao_cod' => $id]);
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
        <?php
             $query_PlanoEstrutura = "SELECT * FROM plano_estruturafisica WHERE planodeacao_cod = '".$id."' ORDER BY planestr_tipo ASC";
             $modelsPlanoEstrutura = PlanoEstruturafisica::findBySql($query_PlanoEstrutura)->all(); 
             foreach ($modelsPlanoEstrutura as $modelPlanoEstrutura) {
                
                $planestr_descricao  = $modelPlanoEstrutura["planestr_descricao"];
                $planestr_quantidade = $modelPlanoEstrutura["planestr_quantidade"];
                $planestr_tipo       = $modelPlanoEstrutura["planestr_tipo"];
        ?>
        <tr>
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
    <tr>
        <th>Atualizado por: <?php echo $model->colaborador->usuario->usu_nomeusuario ?></th>
        <th>Última Modifcação: <?php echo  date('d/m/Y', strtotime($model->plan_data)) ?></th>
    </tr>
    </thead>
  </table>

           </div>
      </div>
  </div>
</div>