<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

?>
<div class="planilhadecurso-view">

        <table class="table table-condensed table-hover">
         <caption> Listagem de Materiais Didáticos</caption>
          <thead>
            <tr>
              <th>UC</th>
              <th>Cód. MXM</th>
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
                  
               ?>
               <?php foreach ($modelsPlaniMaterial as $i => $modelPlaniMaterial): ?>
            <tr>
                <td><?= $modelPlaniMaterial->planima_nivelUC ?></td>
                <td><?= $modelPlaniMaterial->planima_codmxm ?></td>
                <td><?= $modelPlaniMaterial->planima_titulo ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniMaterial->planima_valor, 2, ',', '.') ?></td>
                <td><?= $modelPlaniMaterial->planima_tipomaterial ?></td>
                <td><?= $modelPlaniMaterial->planima_editora ?></td>
                <td><?= $modelPlaniMaterial->planima_tipoplano ?></td>
                <td><?= $modelPlaniMaterial->planima_observacao ?></td>
                <td><a target="_blank" href="http://localhost/aux_planejamento/web/uploads/aux_planejamento/repositorio/<?php echo $modelPlaniMaterial->planima_arquivo ?>"> <?php echo $modelPlaniMaterial->planima_arquivo ?></a></td>
            </tr>
            <?php
              $valorTotal += $modelPlaniMaterial->planima_valor;
            ?>
               <?php endforeach; ?>
           </tbody>
           <tfoot>
                 <tr class="warning kv-edit-hidden" style="border-top: #dedede">
                   <th>TOTAL </th>
                   <th></th>
                    <th colspan="12" style="color:red"><?php echo 'R$ ' . number_format($valorTotal, 2, ',', '.') ?></th>
                 </tr>
           </tfoot>
        </table>

</div>
