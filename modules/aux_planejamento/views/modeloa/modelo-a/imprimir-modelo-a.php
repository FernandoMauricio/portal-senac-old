<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
		   <table width="100%" border="0">
	           <tr> 
		           <td width="19%"><img src="<?php echo Url::base().'/uploads/logo.png' ?>" height="100px"></td>
		           <td width="81%">&nbsp;</td>
	           </tr>
           </table>
		   
		   <br>
           <table width="100%" border="1" cellspacing="0" bordercolor="#000000">
           <tr> 
           <td colspan="3" valign="middle"> <div align="center"></div>
           <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>OR&Ccedil;AMENTO 
           PROGRAMA</strong></font></div></td>
           <td width="14%" valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>MODELO 
           A</strong></font></div></td>
           </tr>
           <tr> 
           <td width="18%" valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">C&Oacute;DIGO<br>
           02 </font></div></td>
           <td colspan="2" valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">NOME 
           DA ADMINISTRA&Ccedil;&Atilde;O<br>
           AR AMAZONAS</font></div></td>
           <td rowspan="2" valign="middle">
           <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">EXERC&Iacute;CIO<br>
           <?php echo $model->anoModeloA->an_ano; ?></font></div></td>
           </tr>
           <tr> 
           <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">C&Oacute;DIGO<br>
           <?php echo $model->moda_centrocusto[12].$model->moda_centrocusto[13]; ?> </font></div></td>
           <td width="57%" valign="middle"> <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">NOME 
            DA UNIDADE OR&Ccedil;AMENT&Aacute;RIA<br>
            <?php echo $model->moda_nomeunidade; ?></font></div></td>
            <td width="11%" valign="middle"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">N&ordm; 
            DE ORDEM<br>
            <?php echo $model->moda_centrocusto[14].$model->moda_centrocusto[15].$model->moda_centrocusto[16]; ?> </font></div></td>
            </tr>
           </table>
		   <br>
		   
		   <?php
		   $programa = "";
		   if($model->moda_centrocusto[0].$model->moda_centrocusto[1] == 01)
		       $programa = "ADMINISTRAÇÃO GERAL";
		   elseif($model->moda_centrocusto[0].$model->moda_centrocusto[1] == 02)
		       $programa = "ADMINISTRAÇÃO FINANCEIRA";
		   elseif($model->moda_centrocusto[0].$model->moda_centrocusto[1] == 03)
		       $programa = "FORMAÇÃO DE RECURSOS HUMANOS";
		   elseif($model->moda_centrocusto[0].$model->moda_centrocusto[1] == 04)
		       $programa = "COMUNICAÇÃO SOCIAL";
		   elseif($model->moda_centrocusto[0].$model->moda_centrocusto[1] == 05)
		       $programa = "ATENÇÃO BÁSICA";
		   elseif($model->moda_centrocusto[0].$model->moda_centrocusto[1] == 06)
		       $programa = "PROTEÇÃO E BENEFÍCIOS AO TRABALHADOR";
		   elseif($model->moda_centrocusto[0].$model->moda_centrocusto[1] == 07)
		       $programa = "EMPREGABILIDADE";
		   
		   $subprograma = "";
		   if($model->moda_centrocusto[2].$model->moda_centrocusto[3] == 01)
		       $subprograma = "APOIO ADMINISTRATIVO";
		   elseif($model->moda_centrocusto[2].$model->moda_centrocusto[3] == 02)
		       $subprograma = "GESTÃO DAS POLÍTICAS DE EXECUÇÃO FINANCEIRA, CONTABILIDADE E CONTROLE INTERNO";
		   elseif($model->moda_centrocusto[2].$model->moda_centrocusto[3] == 03)
		       $subprograma = "DESENVOLVIMENTO DE GERENTES E SERVIDORES";
		   elseif($model->moda_centrocusto[2].$model->moda_centrocusto[3] == 04)
		       $subprograma = "SERVIÇOS DE COMUNICAÇÃO DE MASSA";
		   elseif($model->moda_centrocusto[2].$model->moda_centrocusto[3] == 05)
		       $subprograma = "ASSISTÊNCIA AO TRABALHADOR";
		   elseif($model->moda_centrocusto[2].$model->moda_centrocusto[3] == 06)
		       $subprograma = "QUALIFICAÇÃO PROFISSIONAL DO TRABALHADOR";
		   
		   
		   $atividade = "";
		   if($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2001)
		      $atividade = "GESTÃO ADMINISTRATIVA";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2002)
		      $atividade = "MANUTENÇÃO DOS SERVIÇOS ADMINISTRATIVOS";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2003)
		      $atividade = "MANUTENÇÃO DOS SERVIÇOS DE TRANSPORTES";	
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2004)
		      $atividade = "SERVIÇOS DE ADMINISTRAÇÃO E CONTROLE FINANCEIRO";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2005)
		      $atividade = "CAPACITAÇÃO DE RECURSOS HUMANOS";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2006)
		      $atividade = "MANUTENÇÃO DOS SERVIÇOS GRÁFICOS";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2007)
		      $atividade = "AÇÕES DE INFORMÁTICA";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2008)
		      $atividade = "MANUTENÇÃO DOS SERVIÇOS DE DOCUMENTAÇÃO E COMUNICAÇÃO";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2009)
		      $atividade = "ASSISTÊNCIA FINANCEIRA A ENTIDADES";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2010)
		      $atividade = "MANUTENÇÃO E CONSERVAÇÃO DE BENS IMÓVEIS";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2011)
		      $atividade = "DIVULGAÇÃO DE AÇÕES INSTITUCIONAIS";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2012)
		      $atividade = "APOIO À FORMAÇÃO PROFISSIONAL";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2013)
		      $atividade = "MODERNIZAÇÃO E MELHORIA DA REDE FÍSICA";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2015)
		      $atividade = "QUALIFICAÇÃO PROFISSIONAL NA ÁREA DE COMÉRCIO E SERVIÇOS";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2016)
		      $atividade = "ASSISTÊNCIA MÉDICA E ODONTOLÓGICA AOS SERVIDORES";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2017)
		      $atividade = "ASSISTÊNCIA-TRANSPORTE AOS SERVIDORES";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2018)
		      $atividade = "ASSISTÊNCIA A EDUCANDOS";
		   elseif($model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7] == 2019)
		      $atividade = "COORDENAÇÃO DE PLANEJAMENTO E ORÇAMENTAÇÃO";
		   
		   ?>
		 
		   
		   <table width="100%" border="1" cellspacing="0" bordercolor="#000000">
           <tr valign="middle"> 
           <td width="29%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">T&Iacute;TULO</font></strong></div></td>
           <td width="10%"> <div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">C&Oacute;DIGO</font></strong></div></td>
           <td width="61%"><div align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">NOME</font></strong></div></td>
           </tr>
           <tr> 
           <td valign="middle"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">PROGRAMA</font></strong></td>
           <td valign="middle"> <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $model->moda_centrocusto[0].$model->moda_centrocusto[1]; ?></font></div></td>
           
           <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $programa; ?></font></td>
           </tr>
           <tr> 
           <td valign="middle"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">SUBPROGRAMA</font></strong></td>
           <td><div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $model->moda_centrocusto[2].$model->moda_centrocusto[3]; ?></font></div></td>
           
           <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $subprograma; ?></font></td>
           </tr>
           <tr> 
           <td valign="middle"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">PROJETO/ATIVIDADE</font></strong></td>
           <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $model->moda_centrocusto[4].$model->moda_centrocusto[5].$model->moda_centrocusto[6].$model->moda_centrocusto[7]; ?></font></td>
           
           <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $atividade; ?></font></td>
           </tr>
           <tr valign="middle"> 
           <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ESPECIFICA&Ccedil;&Atilde;O 
           DO PROJ./ATIVIDADE: </strong></font></td>
           <td colspan="2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $model->moda_nomecentrocusto; ?></font></td>
           </tr>
           </table>
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
  					?> 

          		<?php foreach ($modelsDespesasCorrentes as $i => $modelDespesasCorrentes): ?> <!-- DETALHES DO MODELO A (Despesas Correntes) -->

  	          		<?php
						$total_programado_corrente = $total_programado_corrente + $modelDespesasCorrentes->deta_programado;
		    			$total_reforco_corrente = $total_reforco_corrente + $modelDespesasCorrentes->deta_reforcoreducao;
		    			$total_dotacao_corrente = $total_dotacao_corrente + ( $modelDespesasCorrentes->deta_programado + $modelDespesasCorrentes->deta_reforcoreducao);
						
						$totalgeral_programado = $totalgeral_programado + $modelDespesasCorrentes->deta_programado;
		    			$totalgeral_reforco = $totalgeral_reforco + $modelDespesasCorrentes->deta_reforcoreducao;
		    			$totalgeral_dotacao = $totalgeral_dotacao + ( $modelDespesasCorrentes->deta_programado + $modelDespesasCorrentes->deta_reforcoreducao);
  	          		?>

			   <tr> 
               <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $modelDespesasCorrentes->deta_codtitulo;?></font></div></td>
               <td valign="middle"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $modelDespesasCorrentes->deta_titulo;?></font></td>
               <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $modelDespesasCorrentes->deta_identificacao;?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($modelDespesasCorrentes->deta_programado,2,".",".");?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($modelDespesasCorrentes->deta_reforcoreducao,2,".",".");?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($modelDespesasCorrentes->deta_programado + $modelDespesasCorrentes->deta_reforcoreducao,2,".",".");?></font></div></td>
               </tr>
               	  						<?php endforeach; ?>
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
  					?>

  	          		<?php foreach ($modelsDespesasCapital as $i => $modelDespesasCapital): ?> <!-- DETALHES DO MODELO A (Despesas de Capital) -->

  	          		<?php
		  	            $total_programado_capital = $total_programado_capital + $modelDespesasCapital->deta_programado;
				        $total_reforco_capital    = $total_reforco_capital    + $modelDespesasCapital->deta_reforcoreducao;
				        $total_dotacao_capital    = $total_dotacao_capital    + ($modelDespesasCapital->deta_programado + $modelDespesasCapital->deta_reforcoreducao);
					    
					    $totalgeral_programado    = $totalgeral_programado    + $modelDespesasCapital->deta_programado;
				        $totalgeral_reforco       = $totalgeral_reforco       + $modelDespesasCapital->deta_reforcoreducao;
				        $totalgeral_dotacao       = $totalgeral_dotacao       + ($modelDespesasCapital->deta_programado + $modelDespesasCapital->deta_reforcoreducao);
  	          		?>

			   <tr> 
               <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $modelDespesasCapital->deta_codtitulo;?></font></div></td>
               <td valign="middle"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $modelDespesasCapital->deta_titulo;?></font></td>
               <td valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo $modelDespesasCapital->deta_identificacao;?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($modelDespesasCapital->deta_programado,2,".",".");?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($modelDespesasCapital->deta_reforcoreducao,2,".",".");?></font></div></td>
               <td valign="middle"> <div align="right"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo number_format($modelDespesasCapital->deta_programado + $modelDespesasCapital->deta_reforcoreducao,2,".",".");?></font></div></td>
               </tr>
               	  						<?php endforeach; ?>
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

          <tr style="background-color: #fcf8e3;"> 
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
</table>

<br>
<br>
 <div align="right"><br>
        <em><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Gerado 
        em: <?php echo date("d/m/Y"); ?> &agrave;s <?php echo date("H:i:s");?></font></em> </div>
		