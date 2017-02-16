<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\contratacao\models\Comunicacaointerna;
use app\modules\contratacao\models\Destinocomunicacao;
use app\modules\contratacao\models\DestinocomunicacaoEnc;
use app\modules\contratacao\models\Despachos;
use app\modules\contratacao\models\Cargos_car;
use app\modules\contratacao\models\Colaborador;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;


//RESGATANDO AS INFORMAÇÕES DO CURRICULO
$cv_resumocv = $model->cv_resumocv;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
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
    <th height="92" id="titulo" bgcolor="#ddd"><div align="center"> RESUMO DO CURRÍCULO</div></th>
  </tr>
  <tr>
    <td height="759" id="linhas"><p><?php echo $cv_resumocv; ?></p></td>
  </tr>
</table>
</body>
</html>