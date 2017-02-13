<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

?>
<style type="text/css">
	
	.calc {
		color: red;
	}
</style>

<div class="precificacao-duvidas">

<p><b> Custo de Mão de Obra Direta </b> = Total Horas Docente <b class="calc"> x </b> Valor hora/aula <b class="calc"> + </b> Valor hora/aula Planejamento</p>

<p><b> 1/12 de 13º </b> =  Custo de Mão de Obra Direta <b class="calc"> / </b> 12 </p>

<p><b> 1/12 de Férias </b> =  Custo de Mão de Obra Direta <b class="calc"> / </b> 12 </p>

<p><b> 1/12 de 1/3 de férias </b> =  Custo de Mão de Obra Direta <b class="calc"> / </b> 12 <b class="calc"> / </b> 3 </p>

<p><b> Total de Salários </b> =  Custo de Mão de Obra Direta <b class="calc"> + </b> 1/12 de 13º <b class="calc"> + </b> 1/12 de Férias <b class="calc"> + </b> 1/12 de 1/3 de férias </p>

<p><b> Total de Encargos</b> =  ( Total de Salários<b class="calc"> x </b> 32,70% ) <b class="calc"> / </b> 100 </p>

<p><b> Total de Salários + Encargos</b> =  Total de Salários<b class="calc"> + </b> Total de Encargos </p>

<p><b> Total de Custo Direto</b> =  Total de Salários e Encargos<b class="calc"> + </b> Diarias <b class="calc"> + </b> Passagens <b class="calc"> + </b> Serv. Terceiros (PF) <b class="calc"> + </b> Serv. Terceiros (PJ) <b class="calc"> + </b> (Material Didático <b class="calc">* </b>Quantidade de Alunos) <b class="calc"> + </b> Material de Consumo  <b class="calc"> + </b> Material do Aluno</p>

<p><b> Valor Hora/Aula de Custo Direto</b> =  Total de Custo Direto <b class="calc"> / </b> Carga Horária <b class="calc"> / </b> Quantidade de Alunos </p>

<p><b> Total Incidências(%)</b> = Custos Indiretos(%) <b class="calc"> + </b> IPCA/Mês(%) <b class="calc"> + </b> Rerserva Técnica(%) <b class="calc"> + </b> Despesa Sede ADM <?php echo date('Y'); ?>(%)</p>

<p><b> Total Custo Indireto</b> =  ( Total de Custo Direto<b class="calc"> x </b> Total Incidências(%) ) <b class="calc"> / </b> 100</p>

<p><b> Despesa Total</b> = Total de Custo Direto <b class="calc"> + </b>  Total Custo Indireto</p>

<p><b> Mark-Up Divisor</b> = ( 100 <b class="calc"> - </b> Total Incidências(%) ) <b class="calc"> / </b> 100 </p>

<p><b> Mark-Up Multiplicador</b> = ( 100 <b class="calc"> / </b> Mark-Up Divisor ) <b class="calc"> * </b> 100 </p>

<p><b> Preço de Venda Total da Turma</b> =  ( Total de Custo Direto<b class="calc"> / </b> Mark-Up Divisor)<b class="calc"> x </b> 100 </p>

<p><b> Preço de Venda Total por Aluno</b> =  Preço de Venda Total da Turma<b class="calc"> / </b>  Quantidade de Alunos</p>

<p><b> Retorno com Preço de Venda</b> =  Preço de Venda Total por Aluno <b class="calc"> - </b> Despesa Total </p>

<p><b> Valor Hora/Aula por Aluno </b> =  Preço de Venda Total da Turma<b class="calc"> / </b> Carga Horária<b class="calc"> / </b> Quantidade de Alunos </p>

<p><b> % de Retorno </b> = ( Retorno com Preço de Venda <b class="calc"> / </b> Preço de Venda Total da Turma ) * 100 </p>

<p><b> Retorno com Preço Sugerido</b> = ( Preço Sugerido<b class="calc"> x </b> Quantidade de Alunos ) <b class="calc"> / </b> Despesa Total</p>

<p><b> Numero Minimo de Alunos por Turma</b> =  Despesa Total <b class="calc"> / </b> Preço Sugerido </p>

</div>