<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

?>
<div class="planilhadecurso-view">

        <table class="table table-condensed table-hover">
         <caption> Listagem de Unidades Curriculares</caption>
          <thead>
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
                  
               ?>
               <?php foreach ($modelsPlaniConsumo as $i => $modelPlaniConsumo): ?>
            <tr>
                <td><?= $modelPlaniConsumo->planico_codMXM ?></td>
                <td><?= $modelPlaniConsumo->planico_descricao ?></td>
                <td><?= $modelPlaniConsumo->planico_quantidade ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniConsumo->planico_valor, 2, ',', '.') ?></td>
                <td><?= $modelPlaniConsumo->planico_tipo ?></td>
            </tr>
            <?php
              $valorTotal += $modelPlaniConsumo->planico_valor * $modelPlaniConsumo->planico_quantidade;
            ?>
               <?php endforeach; ?>
           </tbody>
           <tfoot>
                 <tr class="warning kv-edit-hidden" style="border-top: #dedede">
                   <th colspan="3" >TOTAL <i>(Valor Unitário * Quantidade)</i></th>
                   <th colspan="2" style="color:red"><?php echo 'R$ ' . number_format($valorTotal, 2, ',', '.') ?></th>
                 </tr>
           </tfoot>
        </table>

</div>
