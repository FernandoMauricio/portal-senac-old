<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\contratacao\models\Adendos;
use app\modules\contratacao\models\Anexos;
use app\modules\contratacao\models\Edital;
use app\modules\contratacao\models\Resultados;
use app\modules\contratacao\models\Cargos;
use app\modules\contratacao\models\CargosProcesso;
use app\modules\contratacao\models\Cidades;
use app\modules\contratacao\models\CidadesProcesso;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

?>


<?php

//RESGATANDO AS INFORMAÇÕES DA ABERTURA DE VAGAS
$id = $model->id;

?>


<body>

  <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Cargos Disponíveis</div>

  <!-- List group -->
  <ul class="list-group">
    <?php

  $query_cargos = "SELECT descricao FROM cargos, cargos_processo WHERE processo_id = '".$id."' AND cargo_id = idcargo";
  $cargo = Cargos::findBySql($query_cargos)->all(); 
  foreach ($cargo as $cargos) {

   $Cargos = $cargos["descricao"];

    echo '<li class="list-group-item">'.$Cargos.'</li>' ;
  }

    ?>
  </ul>
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Documentos para Download</div>
  <div class="panel-body">
    <p><strong>LISTA DE EDITAIS</strong></p>
      <ul class="list-group">
      <li class='list-group-item'>
    <?php

  $query_edital = "SELECT * FROM edital WHERE processo_id = '".$id."' ";
  $edital = Edital::findBySql($query_edital)->all(); 
  foreach ($edital as $editals) {
     
     $Editals = $editals["edital"];

     $arquivoEditals = substr($Editals, strrpos($Editals, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/contratacao/editais/'.$arquivoEditals.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoEditals; ?>
          <?php echo "</a></div>";

            }
    ?>
    </li>
</ul>


    <p><strong>LISTA DE ANEXOS</strong></p>
    <ul class="list-group">
    <li class='list-group-item'>
        
    <?php

  $query_anexo = "SELECT * FROM anexos WHERE processo_id = '".$id."' ";
  $anexo = Anexos::findBySql($query_anexo)->all(); 
  foreach ($anexo as $anexos) {
     
     $Anexos = $anexos["anexo"];

     $arquivoAnexos = substr($Anexos, strrpos($Anexos, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/contratacao/anexos/'.$arquivoAnexos.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoAnexos; ?>
          <?php echo "</div></a>";

            }
    ?>
    </li>
    </ul>
    

    <p><strong>LISTA DE ADENDOS</strong></p>
    <ul class="list-group">
    <li class='list-group-item'>
        
    <?php

  $query_adendo = "SELECT * FROM adendos WHERE processo_id = '".$id."' ";
  $adendo = Adendos::findBySql($query_adendo)->all(); 
  foreach ($adendo as $adendos) {
     
     $Adendos = $adendos["adendos"];

     $arquivoAdendos = substr($Adendos, strrpos($Adendos, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/contratacao/adendos/'.$arquivoAdendos.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoAdendos; ?>
          <?php echo "</div></a>";

            }
    ?>

    </li>
    </ul>
    



    <p><strong>LISTA DE RESULTADOS</strong></p>
    <ul class="list-group">
    <li class='list-group-item'>
        
    <?php

  $query_resultados = "SELECT * FROM resultados WHERE processo_id = '".$id."' ";
  $resultado = Resultados::findBySql($query_resultados)->all(); 
  foreach ($resultado as $resultados) {
     
     $Resultados = $resultados["resultado"];

     $arquivoResultados = substr($Resultados, strrpos($Resultados, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/contratacao/resultados/'.$arquivoResultados.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoResultados; ?>
          <?php echo "</div></a>";

            }
    ?>

        
    </li>
    </ul>
    </div>







  </div>
</div>