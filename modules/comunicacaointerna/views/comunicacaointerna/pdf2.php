<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\comunicacaointerna\models\Comunicacaointerna;
use app\modules\comunicacaointerna\models\Destinocomunicacao;
use app\modules\comunicacaointerna\models\DestinocomunicacaoEnc;
use app\modules\comunicacaointerna\models\Despachos;
use app\modules\comunicacaointerna\models\Cargos_car;
use app\modules\comunicacaointerna\models\Colaborador;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

//RESGATANDO AS INFORMAÇÕES DA CI
$dest_coddestino = $model->dest_coddestino;
$unidade_solicitante =  $model->comunicacaointerna->unidades->uni_nomeabreviado;
$dest_nomeunidadedest =  $model->dest_nomeunidadedest;
$dest_codcomunicacao = $model->dest_codcomunicacao;
$com_codcomunicacao = $model->comunicacaointerna->com_codcomunicacao;
$com_codsituacao = $model->comunicacaointerna->situacao->sitco_situacao1;
$datasolicitacao = $model->comunicacaointerna->com_datasolicitacao;
$com_titulo = $model->comunicacaointerna->com_titulo;
$com_texto = $model->comunicacaointerna->com_texto;
$com_codcolaboradorautorizacao = $model->comunicacaointerna->colaboradorAutorizacao->usuario->usu_nomeusuario;
$com_codcargoautorizacao = $model->comunicacaointerna->cargo->car_cargo;
$com_dataautorizacao = $model->comunicacaointerna->com_dataautorizacao;
$com_codtipo = $model->comunicacaointerna->com_codtipo;
$cod_situacao = $model->comunicacaointerna->com_codsituacao;
$com_usuarioEncerramento = $model->comunicacaointerna->com_usuarioEncerramento;
$com_dataEncerramento = $model->comunicacaointerna->com_dataEncerramento;

$session = Yii::$app->session;

//PEGANDO OS DESTINATÁIOS NESSE DESPACHO
     $destinatarios = "";
     $contador = 0;
     $sql = "SELECT dest_nomeunidadedest FROM destinocomunicacao_dest WHERE dest_codcomunicacao ='".$dest_codcomunicacao. "' AND dest_codtipo = 2";

      $model = Destinocomunicacao::findBySql($sql)->all(); 

      foreach ($model as $models) {
         if($contador == 0){
              $destinatarios = $models['dest_nomeunidadedest']; 
       }else
            $destinatarios = $destinatarios."<br>".$models['dest_nomeunidadedest'];
          
       $contador ++; 
     }  

     $contador = 0;
     $destinatariosCopia = "";
     $sqlCopia = "SELECT dest_nomeunidadedestCopia FROM destinocomunicacao_dest WHERE dest_codcomunicacao ='".$dest_codcomunicacao. "' AND dest_codtipo = 4 AND dest_coddespacho = 0";

       $modelCopia = Destinocomunicacao::findBySql($sqlCopia)->all(); 

      foreach ($modelCopia as $modelsCopia) {
         if($contador == 0){
              $destinatariosCopia = $modelsCopia['dest_nomeunidadedestCopia'];  
       }else
            $destinatariosCopia = $destinatariosCopia."<br>".$modelsCopia['dest_nomeunidadedestCopia'];
          
       $contador ++; 
     }  

?>

<?php

  if($com_codtipo == 2 && $session["sess_responsavelsetor"] != 1)
  {
       
     
     $com_titulo = "CONFIDENCIAL";
     $com_texto = "<div align='center'>********************************************************************************<br>".
              "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br></div>";

  }
  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
th{ text-align: center;} .assinatura{font-size: 10px;} p{ margin: 0px 10px 10px;} .anexos {font-size: 12px;font-weight: bold;}
</style>
</head>

<body>

 <?php

 //MENSAGEM INFORMANDO O USUÁRIO E A DATA QUE FINALIZOU A CI
  if($cod_situacao == 5 AND $com_usuarioEncerramento != NULL ){

    echo "<div class='alert alert-danger' align='center' role='alert'><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Comunicação Interna <strong>Encerrada</strong> por: <strong> ". $com_usuarioEncerramento ."</strong> na data ". date('d/m/Y à\s H:i', strtotime($com_dataEncerramento)) ."</div>";

  }

    ?>


<table width="100%" border="1">
  <tr>
    <td width="16%" rowspan="2"><img src="../views/comunicacaointerna/pdf/logo.jpg" width="180" height="75" /></td> <!-- width="115" height="70" -->
    <td width="58%" height="43"><div align="center"><strong> FORMULÁRIO DE DESPACHO</strong></div></td>
    <td width="24%"><div align="center"><strong>CÓDIGO: <?php echo $com_codcomunicacao ?></strong></div></td>
  </tr>
  <tr>
    <td height="39">[<em><strong>ASSUNTO</strong></em>] <?php echo $com_titulo ?></td>
    <td><div align="center">SITUAÇÃO: <?php echo $com_codsituacao ?></div></td>
  </tr>
</table>
<br />
<table width="100%" border="1">
  <tr>
    <th height="28" scope="col">DATA/HORA</th>
    <th width="41%" scope="col">DE</th>
    <th scope="col">PARA</th>
  </tr>
  <tr>
    <td width="19%" height="44" scope="col"><div align="center"><?php echo date('d/m/Y H:i:s', strtotime($datasolicitacao)); ?></div></td>
    <td width="41%" scope="col"><div align="center"><?php echo $unidade_solicitante ?></div></td>
    <td width="40%" scope="col"><div align="center"><?php echo $destinatarios ?><br><br>
     <?php if($contador != 0)
         {
       ?>
      <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Cópia Para:</strong><br>
      <?php echo $destinatariosCopia; ?></em> 
      <?php } ?>
      </font></div></td>
  <tr>
    <!-- <th height="122" scope="row">DISCRIMINAÇÃO</th> -->
    <td colspan="3"><p>&nbsp;</p><?php echo $com_texto ?>
    <p>&nbsp;</p>
    <p class="anexos">ANEXOS - - - - - - - - - - - - - - -  - - -<br />
      <?php
//GET ANEXOS
    if($files=\yii\helpers\FileHelper::findFiles('uploads/' . $com_codcomunicacao,['recursive'=>FALSE])){
    if (isset($files[0])) {
        foreach ($files as $index => $file) {
            $nameFicheiro = substr($file, strrpos($file, '/') + 1);
  if($com_codtipo == 2 && $session["sess_responsavelsetor"] != 1)
  {
    echo '***************** Arquivos Confidenciais';
  }else{
            echo Html::a($nameFicheiro, Url::base().'/uploads/'. $com_codcomunicacao. '/' . $nameFicheiro, ['target'=>'_blank']) . "<br/>" ;
          }
      } 
    }
  }

?>
    </p>
        <div class="assinatura" align="right">Assinado Eletronicamente Por:&nbsp;&nbsp;&nbsp;<br />
      <?php echo $com_codcolaboradorautorizacao ?>&nbsp;&nbsp;&nbsp;<br />
      <?php echo $com_codcargoautorizacao ?>&nbsp;&nbsp;&nbsp;<br />
      <?php echo date('d/m/Y H:i:s', strtotime($com_dataautorizacao)); ?>&nbsp;&nbsp;&nbsp;<br />
  </div></td>
  </tr>
</table>
<hr />
<table width="100%" border="1">
  <tr>
    <th height="51" colspan="3" scope="col">DESPACHOS E ENCAMINHAMENTOS</th>
  </tr>
  <?php
  $sql6 = "SELECT * FROM despachocomunicacao_deco WHERE deco_codcomunicacao = '".$dest_codcomunicacao."' AND deco_codsituacao = 2 order by deco_coddespacho desc";
  $modelDespacho = Despachos::findBySql($sql6)->all(); 
  foreach ($modelDespacho as $models) {
     

     $unidade_despachante = "";
     $nome_despachante = "";
     $deco_coddespacho = $models["deco_coddespacho"];
     $deco_codcolaborador = $models["deco_codcolaborador"];
     $deco_codunidade = $models["deco_codunidade"];
     $deco_codcargo = $models["deco_codcargo"];
     $deco_data = $models["deco_data"];
     $deco_despacho = $models["deco_despacho"];
     $unidade_despachante = $models["deco_nomeunidade"];
     $nome_despachante = $models["deco_nomeusuario"];
     $deco_cargo = $models["deco_cargo"];


     //PEGANDO OS DESTINATÁIOS ENCAMINHANDOS NESSE DESPACHO
     $nome_unidade_encaminhar = "";
     $contador = 0;
     $sql = "SELECT dest_nomeunidadedest FROM destinocomunicacao_dest WHERE dest_codcomunicacao = '".$dest_codcomunicacao."' AND dest_codtipo = 3 AND dest_coddespacho = '".$deco_coddespacho."'";

      $unidade = Destinocomunicacao::findBySql($sql)->all(); 

      foreach ($unidade as $unidades) {
         if($contador == 0)
              $nome_unidade_encaminhar = $unidades['dest_nomeunidadedest']; 
       else
            $nome_unidade_encaminhar = $nome_unidade_encaminhar."<br>".$unidades['dest_nomeunidadedest'];
          
       $contador ++; 
     }  

     $nome_unidade_encaminharCopia = "";
     $contador = 0;
     $sql2 = "SELECT dest_nomeunidadedestCopia FROM destinocomunicacao_dest WHERE dest_codcomunicacao = '".$dest_codcomunicacao."' AND dest_codtipo = 4 AND dest_coddespacho = '".$deco_coddespacho."'";

      $unidade2 = Destinocomunicacao::findBySql($sql2)->all(); 

      foreach ($unidade2 as $unidades2) {
         if($contador == 0)
              $nome_unidade_encaminharCopia = $unidades2['dest_nomeunidadedestCopia']; 
       else
            $nome_unidade_encaminharCopia = $nome_unidade_encaminharCopia."<br>".$unidades2['dest_nomeunidadedestCopia'];
          
       $contador ++; 
     }  

  if($com_codtipo == 2 && $session["sess_responsavelsetor"] != 1)
  {
       

     $deco_despacho = "<div align='center'>********************************************************************************<br>".
              "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br>".
          "********************************************************************************<br></div>";
            
  }  
     ?>
  <tr>
    <th width="19%" scope="row">DATA/HORA</th>
    <th width="41%">DE</th>
    <th width="40%">PARA</th>
  </tr>
  <tr>
    <td scope="row"><div align="center"><?php echo date('d/m/Y H:i:s', strtotime($deco_data)); ?></div></td>
    <td><div align="center"><?php echo $unidade_despachante ?></div></td>
    <td><div align="center"><?php echo $nome_unidade_encaminhar ?><br><br>
     <?php if($contador != 0)
         {
       ?>
      <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><em><strong>Cópia Para:</strong><br>
      <?php echo $nome_unidade_encaminharCopia ?></em> 
      <?php } ?>
      </font></div></td>


  <tr>

    <td colspan="3"><p>&nbsp;</p><p><?php echo $deco_despacho ?></p>
    <p>&nbsp;</p>
    <p class="anexos"><i class="glyphicon glyphicon-remove"></i> UNIDADES PENDENTES - CIÊNCIAS DO DESPACHO:</p>

    <?php

      $query_pendentesCiencia = "SELECT dest_nomeunidadedestCopia FROM destinocomunicacao_dest WHERE dest_codcomunicacao = '".$dest_codcomunicacao."' AND dest_codtipo = 4 AND dest_codsituacao = 2 AND dest_coddespacho = '".$deco_coddespacho."'";
      $pendenteCiencia = Destinocomunicacao::findBySql($query_pendentesCiencia)->all(); 
      foreach ($pendenteCiencia as $pendentesCiencia) {

       $PendentesCiencia = $pendentesCiencia["dest_nomeunidadedestCopia"];
    ?>

     <p><?php echo $PendentesCiencia ?></p>
     <?php } ?>
     <p>&nbsp;</p>
    

    <p class="anexos"><i class="glyphicon glyphicon-file"></i> ANEXOS DESPACHO- - - - - - - - - - - - - - -<br />
      <?php
           $sql_destino = "SELECT DISTINCT dest_coddespacho FROM destinocomunicacao_dest WHERE dest_codcomunicacao = '".$com_codcomunicacao."' AND dest_codtipo = 3";

      $destino = Destinocomunicacao::findBySql($sql_destino)->all(); 

      foreach ($destino as $destinos) {

        $dest_coddespacho = $destinos["dest_coddespacho"];

//GET ANEXOS
      if($deco_coddespacho == $dest_coddespacho){
    $files=\yii\helpers\FileHelper::findFiles('uploads/'. $com_codcomunicacao . '/' . $deco_coddespacho);
    if (isset($files[0])) {
        foreach ($files as $index => $file) {
            $nameFicheiro = substr($file, strrpos($file, '/') + 1);
            
  if($com_codtipo == 2 && $session["sess_responsavelsetor"] != 1)
  {
    echo '***************** Arquivos Confidenciais';
  }else{
            echo Html::a($nameFicheiro, Url::base().'/uploads/'. $com_codcomunicacao. "/" . $deco_coddespacho . "/" . $nameFicheiro, ["target"=>"_blank"]) . "<br/>";
          }
        }
       }
       }
     }
    ?>
    </p>
        <div class="assinatura" align="right">Assinado Eletronicamente Por:&nbsp;&nbsp;&nbsp;<br />
      <?php echo $nome_despachante ?>&nbsp;&nbsp;&nbsp;<br />
      <?php echo $deco_cargo ?>&nbsp;&nbsp;&nbsp;<br />
      <?php echo date('d/m/Y H:i:s', strtotime($deco_data)); ?>&nbsp;&nbsp;&nbsp;<br />
  </div></td>
  </tr>
  <?php } ?>
</table>

<br>

  <p style="color:#00337d"><strong>* Só imprima este despacho eletrônico em caso de necessidade. Salve em Formato PDF e armaze-o na Pasta do Setor disponível na Rede.  <p></strong>

  <p style="color:#00337d"><strong>** "A responsabilidade social e a preservação ambiental significa um compromisso com a vida."  <p></strong>
  
</body>
</html>
