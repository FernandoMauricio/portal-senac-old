<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

?>
<div class="planilhadecurso-view">

        <table class="table table-condensed table-hover">
         <caption> Listagem de Materiais do Aluno</caption>
          <thead>
            <tr>
              <th>Descrição</th>
              <th>Quantidade</th>
              <th>Valor Unitário</th>
              <th>Unidade</th>
              <th>Fonte de Recursos</th>
            </tr>
         </thead>
           <tbody>
               <?php

                  $valorTotal = 0;
                  
               ?>
               <?php foreach ($modelsPlaniMateriaisAluno as $i => $modelPlaniMateriaisAluno): ?>
            <tr>
                <td><?= $modelPlaniMateriaisAluno->planimatalun_descricao ?></td>
                <td><?= $modelPlaniMateriaisAluno->planimatalun_quantidade ?></td>
                <td><?= 'R$ ' . number_format($modelPlaniMateriaisAluno->planimatalun_valor, 2, ',', '.') ?></td>
                <td><?= $modelPlaniMateriaisAluno->planimatalun_unidade ?></td>
                <td><?= $modelPlaniMateriaisAluno->planimatalun_tipo ?></td>
            </tr>
            <?php
              $valorTotal += $modelPlaniMateriaisAluno->planimatalun_valor * $modelPlaniMateriaisAluno->planimatalun_quantidade;
            ?>
               <?php endforeach; ?>
           </tbody>
           <tfoot>
                 <tr class="warning kv-edit-hidden" style="border-top: #dedede">
                   <th colspan="2" >TOTAL <i>(Valor Unitário * Quantidade)</i></th>
                   <th colspan="3" style="color:red"><?php echo 'R$ ' . number_format($valorTotal, 2, ',', '.') ?></th>
                 </tr>
           </tfoot>
        </table>

</div>
