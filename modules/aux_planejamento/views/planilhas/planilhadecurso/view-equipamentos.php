<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

?>
<div class="planilhadecurso-view">

        <table class="table table-condensed table-hover">
         <caption> Listagem de Unidades Curriculares</caption>
          <thead>
            <tr>
              <th>Descrição</th>
              <th>Quantidade</th>
              <th>Tipo</th>
            </tr>
         </thead>
           <tbody>
               <?php

                  $valorTotal = 0;
                  
               ?>
               <?php foreach ($modelsPlaniEquipamento as $i => $modelPlaniEquipamento): ?>
            <tr>
                <td><?= $modelPlaniEquipamento->planieq_descricao ?></td>
                <td><?= $modelPlaniEquipamento->planieq_quantidade ?></td>
                <td><?= $modelPlaniEquipamento->planieq_tipo ?></td>
            </tr>
            <?php
              $valorTotal += $modelPlaniEquipamento->planieq_quantidade;
            ?>
               <?php endforeach; ?>
           </tbody>
           <tfoot>
                 <tr class="warning kv-edit-hidden" style="border-top: #dedede">
                   <th>TOTAL</th>
                   <th colspan="2" style="color:red"><?php echo $valorTotal; ?></th>
                 </tr>
           </tfoot>
        </table>

</div>
