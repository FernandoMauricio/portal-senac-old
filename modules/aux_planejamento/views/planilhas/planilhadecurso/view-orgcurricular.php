<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use app\modules\aux_planejamento\models\planos\Unidadescurriculares;

?>
<div class="planilhadecurso-view">

        <table class="table table-condensed table-hover">
         <caption> Listagem de Unidades Curriculares</caption>
          <thead>
            <tr>
              <th>UC</th>
              <th>Descrição</th>
              <th>Carga Horária</th>
            </tr>
         </thead>
         <?php

         $valorTotal = 0;

         ?>
           <tbody>
               <?php foreach ($modelsPlaniUC as $i => $modelPlaniUC): ?>
            <tr>
                <td><?= $modelPlaniUC->planiuc_nivelUC ?></td>
                <td><?= $modelPlaniUC->planiuc_descricao ?></td>
                <td><?= $modelPlaniUC->planiuc_cargahoraria ?></td>
                <?php 
                //----Total de horas das Unidades Curriculares
                $valorTotal += $modelPlaniUC->planiuc_cargahoraria 

                ?>
            </tr>
               <?php endforeach; ?>
           </tbody>
      <tfoot>
            <tr class="warning kv-edit-hidden" style="border-top: #dedede">
              <th>TOTAL </th>
              <th></th>
               <th colspan="12" style="color:red"><?php echo  $valorTotal . " horas" ?></th>
            </tr>
      </tfoot>
        </table>

</div>
