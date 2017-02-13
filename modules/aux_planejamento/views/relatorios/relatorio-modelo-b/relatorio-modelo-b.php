<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\modeloa\ModeloA;
use app\modules\aux_planejamento\models\modeloa\DetalhesModeloA;
use app\modules\aux_planejamento\models\modeloa\OrcamentoPrograma;
?>
	
	<?php
		   $contador = 0;
		   $query_modeloA = "SELECT moda_codano, moda_codmodelo, moda_centrocusto, moda_centrocustoreduzido, moda_nomeunidade, moda_descriminacaoprojeto, an_ano, moda_nomecentrocusto FROM modeloa_moda, ano_an where moda_codunidade= '".$combo_unidade['placu_codunidade']."' AND moda_codano = '".$combo_ano['an_codano']."' AND moda_codano = an_codano";

		   	    $modelosa = ModeloA::findBySql($query_modeloA)->all(); 

            	foreach ($modelosa as $modeloa) {
            		$ano_modelo            = $modeloa['anoModeloA']['an_codano'];
            		$centro_custo          = $modeloa['moda_centrocusto'];
            		$nome_unidade          = $modeloa['moda_nomeunidade'];
            		$nome_centrocusto      = $modeloa['moda_nomecentrocusto'];
            		$descriminacao_projeto = $modeloa['moda_descriminacaoprojeto'];

				if($contador == 0)
				{
				    $contador ++;
					
	?>
					<title>Modelo B da Unidade</title>
					
					 <table width="100%" border="0">
                     <tr> 
                     <td width="19%"><img height="100px" src="<?php echo Url::base().'/uploads/logo.png'?>"></td>
                     <td width="81%">&nbsp;</td>
                     </tr>
                     </table>
		   
		             <br>
					
				     <table width="100%" border="1" cellspacing="0" bordercolor="#000000">
                     <tr> 
                     <td colspan="2" valign="middle"> <div align="center"></div>
                     <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>OR&Ccedil;AMENTO 
                     PROGRAMA</strong></font></div></td>
                     <td width="14%" valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>MODELO 
                     B</strong></font></div></td>
                     </tr>
                     <tr> 
                     <td width="18%" valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">C&Oacute;DIGO<br>
                     02 </font></div></td>
                     <td valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">NOME 
                     DA ADMINISTRA&Ccedil;&Atilde;O<br>
                     AR AMAZONAS</font></div></td>
                     <td rowspan="2" valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">EXERC&Iacute;CIO<br>
                     <?php echo $combo_ano['an_ano']; ?></font></div></td>
                     </tr>
                     <tr> 
                     <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">C&Oacute;DIGO<br>
                     <?php echo $centro_custo[12].$centro_custo[13]; ?> </font></div></td>
                     <td valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">NOME 
                     DA UNIDADE OR&Ccedil;AMENT&Aacute;RIA<br>
                     <?php echo $nome_unidade; ?></font></div>
                     <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
                     </font></div></td>
                     </tr>
                     </table>
                     <br>
					
					<?php
					
				}
				
		   }
	?>
          <br>
		
		  <table width="100%" border="1" cellspacing="0" bordercolor="#000000">
          <tr> 
          <td colspan="2" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ELEMENTO, 
          SUBELEMENTO E ITEM DE DESPESA</strong></font></div></td>
          <td width="7%" rowspan="2"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">IDENT</font></div></td>
          <td colspan="3" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>CUSTO 
          PREVISTO</strong></font></div></td>
          </tr>
          <tr valign="middle"> 
          <td width="11%"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">C&Oacute;DIGO</font></div></td>
          <td width="42%"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">T&Iacute;TULO</font></div></td>
          <td width="13%"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Programado</font></div></td>
          <td width="14%"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Refor&ccedil;o(+) 
          <br>
          Redu&ccedil;&atilde;o(-)</font></div></td>
          <td width="13%"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Dota&ccedil;&atilde;o 
          Final</font></div></td>
          </tr>
		  
		  <?php
		  
		   $totalgeral_programado = 0;
		   $totalgeral_reforco = 0;
		   $totalgeral_dotacao = 0;
		   
		   $total_programado_corrente = 0;
		   $total_reforco_corrente = 0;
		   $total_dotacao_corrente = 0;
		   
		   
		   $query_orcamentos = "SELECT orcpro_identificacao, orcpro_codigo, orcpro_titulo FROM orcamentoprograma_orcpro where orcpro_codtipo = 1 ORDER BY orcpro_codorcpro";

		   	    $orcamentos = OrcamentoPrograma::findBySql($query_orcamentos)->all(); 

            	foreach ($orcamentos as $orcamento) {

            		$codigo_orcamento = $orcamento['orcpro_codigo'];
            		$identificacao    = $orcamento['orcpro_identificacao'];
            		$titulo           = $orcamento['orcpro_titulo'];
		   
		       $acumula_programado = 0;
			   $acumula_reforco = 0;
			   
			   $query_detalhesmodelo = "SELECT deta_codtitulo, deta_titulo, deta_identificacao, deta_programado, deta_reforcoreducao FROM detalhesmodeloa_deta, modeloa_moda where deta_codtipo = 1 AND deta_identificacao = '".$identificacao."' AND deta_codmodelo = moda_codmodelo AND moda_codunidade = '".$combo_unidade['placu_codunidade']."' AND moda_codano = '".$combo_ano['an_codano']."' ORDER BY deta_identificacao";

		   	    $detalhesmodelo = DetalhesModeloA::findBySql($query_detalhesmodelo)->all(); 

            	foreach ($detalhesmodelo as $detalhemodelo) {

            		$programado = $detalhemodelo['deta_programado'];
            		$reforco    = $detalhemodelo['deta_reforcoreducao'];

			         $acumula_programado = $acumula_programado + $programado;
					 $acumula_reforco = $acumula_reforco + $reforco;
					 
					 $total_programado_corrente = $total_programado_corrente + $programado;
		             $total_reforco_corrente = $total_reforco_corrente + $reforco;
		             $total_dotacao_corrente = $total_dotacao_corrente + ( $programado + $reforco);
			   
			         $totalgeral_programado = $totalgeral_programado + $programado;
		             $totalgeral_reforco = $totalgeral_reforco + $reforco;
		             $totalgeral_dotacao = $totalgeral_dotacao + ( $programado + $reforco);
			   
		        }
		        ?>
				
				<tr> 
               <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $codigo_orcamento;?></font></div></td>
               <td valign="middle"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $titulo;?></font></td>
               <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $identificacao;?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($acumula_programado,2,".",".");?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($acumula_reforco,2,".",".");?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($acumula_programado + $acumula_reforco,2,".",".");?></font></div></td>
               </tr>
				
			<?php
				}
			?>   
					 
		  <tr> 
          <td colspan="3" valign="middle" bgcolor="#CCCCCC">
          <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">TOTAL 
          DE DESPESA DE CORRENTES</font></div></td>
          <td valign="middle" bgcolor="#CCCCCC">
          <div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($total_programado_corrente,2,".",".");?></font></strong></div>
          <div align="right"></div></td>
          <td valign="middle" bgcolor="#CCCCCC">
          <div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($total_reforco_corrente,2,".",".");?></font></strong></div>
          <div align="right"></div></td>
          <td valign="middle" bgcolor="#CCCCCC">
          <div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($total_dotacao_corrente,2,".",".");?></font></strong></div>
          <div align="right"></div></td>
          </tr>
  
  	  
		   <?php
		   $total_programado_capital = 0;
		   $total_reforco_capital = 0;
		   $total_dotacao_capital = 0;

		   
		   $query_orcamentos = "SELECT orcpro_identificacao, orcpro_codigo, orcpro_titulo FROM orcamentoprograma_orcpro where orcpro_codtipo = 2 ORDER BY orcpro_codorcpro";
		   	    $orcamentos = OrcamentoPrograma::findBySql($query_orcamentos)->all(); 

            	foreach ($orcamentos as $orcamento) {

            		$codigo_orcamento = $orcamento['orcpro_codigo'];
            		$identificacao    = $orcamento['orcpro_identificacao'];
            		$titulo           = $orcamento['orcpro_titulo'];

		       
			   $acumula_programado = 0;
			   $acumula_reforco = 0;
			   $query_detalhesmodelo = "SELECT deta_codtitulo, deta_titulo, deta_identificacao, deta_programado, deta_reforcoreducao FROM detalhesmodeloa_deta, modeloa_moda where deta_codtipo = 2 AND deta_identificacao = '".$identificacao."' AND deta_codmodelo = moda_codmodelo AND moda_codunidade = '".$combo_unidade['placu_codunidade']."' AND moda_codano = '".$combo_ano['an_codano']."' ORDER BY deta_identificacao";
		   	    $detalhesmodelo = DetalhesModeloA::findBySql($query_detalhesmodelo)->all(); 

            	foreach ($detalhesmodelo as $detalhemodelo) {

            		$programado = $detalhemodelo['deta_programado'];
            		$reforco    = $detalhemodelo['deta_reforcoreducao'];
			          
					  $acumula_programado = $acumula_programado + $programado;
					  $acumula_reforco = $acumula_reforco + $reforco;
					  
			          $total_programado_capital = $total_programado_capital + $programado;
		              $total_reforco_capital = $total_reforco_capital + $reforco;
		              $total_dotacao_capital = $total_dotacao_capital + ( $programado + $reforco );
			   
			          $totalgeral_programado = $totalgeral_programado + $programado;
		              $totalgeral_reforco = $totalgeral_reforco + $reforco;
		              $totalgeral_dotacao = $totalgeral_dotacao + ( $programado + $reforco);
			   		   
		         }
		        
				 ?>
			     <tr> 
                 <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $codigo_orcamento;?></font></div></td>
                 <td valign="middle"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $titulo;?></font></td>
                 <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $identificacao;?></font></div></td>
                 <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($acumula_programado,2,".",".");?></font></div></td>
                 <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($acumula_reforco,2,".",".");?></font></div></td>
                 <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($acumula_programado + $acumula_reforco,2,".",".");?></font></div></td>
                 </tr>
			<?php
		    	}
		    ?>	   
		  
		   <tr> 
           
           <td colspan="3" valign="middle" bgcolor="#CCCCCC">
           <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">TOTAL 
           DE DESPESA DE CAPITAL</font></div></td>
           <td valign="middle" bgcolor="#CCCCCC">
           <div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($total_programado_capital,2,".",".");?></font></strong></div>
           <div align="right"></div></td>
           <td valign="middle" bgcolor="#CCCCCC">
           <div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($total_reforco_capital,2,".",".");?></font></strong></div>
           <div align="right"></div></td>
           <td valign="middle" bgcolor="#CCCCCC">
           <div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($total_dotacao_capital,2,".",".");?></font></strong></div>
           <div align="right"></div></td>
           </tr>
  
  
          <tr> 
          <td colspan="3" valign="middle"><div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">TOTAIS</font></div></td>
          <td valign="middle"><div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($totalgeral_programado,2,".",".");?></font></strong></div></td>
          <td valign="middle"><div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($totalgeral_reforco,2,".",".");?></font></strong></div></td>
          <td valign="middle"><div align="right"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($totalgeral_dotacao,2,".",".");?></font></strong></div></td>
          </tr>
		  
          </table>
		  <br>
		  <br>
		  <br>
		  <table width="100%" border="0">
  <tr> 
    <td width="65%">&nbsp;</td>
    <td width="35%" valign="middle">
<div align="center">_______________________________<br>
        <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Rubrica e cargo ou 
        fun&ccedil;&atilde;o do Respons&aacute;vel</font></div></td>
  </tr>
</table><br>
<br>
 <div align="right"><br>
        <em><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Gerado 
        em: <?php echo date("d/m/Y"); ?> &agrave;s <?php echo date("H:i:s");?></font></em> </div>