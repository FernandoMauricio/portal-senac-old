<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\siteadmin\models\Abertura;
use app\modules\siteadmin\models\Errata;
use app\modules\siteadmin\models\Classificados;
use app\modules\siteadmin\models\Comunicado;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

?>


<?php

//RESGATANDO AS INFORMAÇÕES DA ABERTURA DE VAGAS
$id = $model->id;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listagem de Anexos</title>
<style type="text/css">
#titulo {
	font-size: 16px;
	color: #F60;

}
</style>
</head>

<body>
<table width="100%" border="1" bordercolor="#ddd">
  <tr>
    <th height="97" id="titulo" bgcolor="#ddd" scope="col"><div align="center">ANEXOS</div></th>
  </tr>
  <tr>
    <td id="titulo"><p><br>LISTAS DE CLASSIFICADOS</p>
      <p>
        
    <?php

  $query_classificados = "SELECT * FROM aprovados WHERE edital_id = '".$id."' ";
  $classificado = Classificados::findBySql($query_classificados)->all(); 
  foreach ($classificado as $classificados) {
     
     $Classificados = $classificados["arquivoLista"];

     $arquivoLista = substr($Classificados, strrpos($Classificados, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/siteadmin/psg/classificados/'.$arquivoLista.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoLista; ?>
          <?php echo "</div></a>";

            }
    ?>

      </p></td>
  </tr>
  <tr>
    <td id="titulo" height="97"><p>LISTAS DE ERRATAS</p>
    <p>
      
    <?php

  $query_erratas = "SELECT * FROM errata WHERE edital_id = '".$id."' ";
  $errata = Errata::findBySql($query_erratas)->all(); 
  foreach ($errata as $erratas) {
     
     $Errata = $erratas["arquivoErrata"];

     $arquivoErrata = substr($Errata, strrpos($Errata, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/siteadmin/psg/erratas/'.$arquivoErrata.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoErrata; ?>
          <?php echo "</div></a>";

            }
    ?>

    </p></td>
  </tr>
  <tr>
    <td id="titulo" height="97"><p>LISTAS DE COMUNICADOS</p>
    <p>
      
    <?php

  $query_comunicado = "SELECT * FROM comunicado WHERE edital_id = '".$id."' ";
  $comunicado = Comunicado::findBySql($query_comunicado)->all(); 
  foreach ($comunicado as $comunicados) {
     
     $Comunicado = $comunicados["arquivoComunicado"];

     $arquivoComunicado = substr($Comunicado, strrpos($Comunicado, '/') + 1);

   ?>
          <?php echo "<div class='row'>";?>
          <?php echo '<a href="../web/uploads/siteadmin/psg/comunicados/'.$arquivoComunicado.'" target="_blank">';?>
          <?php echo "<button type='button' class='btn btn-link'></button>"?><?php echo $arquivoComunicado; ?>
          <?php echo "</div></a>";

            }
    ?>

    </p></td>
  </tr>
</table>
</body>
</html>
