$(function() {

    //Carga Horária
    $('#planilhadecursoadmin-placu_cargahorariaplano').keyup(function() {
       updateTotal();
    });

    //Quantidade de Alunos Pagantes, Isentos e PSG 
    $('#planilhadecursoadmin-placu_quantidadealunos').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_quantidadealunosisentos').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_quantidadealunospsg').keyup(function() {
       updateTotal();
    });

    //DESPESAS COM DOCENTE
    //Linha 0 - Docente Nível Médio
    $('#planilhadespesadocente-0-planides_valor').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-0-planides_valorhidden').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-0-planides_valorhoraaula').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-0-planides_cargahoraria').keyup(function() {
       updateTotal();
    });

    //Linha 1 - Docente Nível Superior
    $('#planilhadespesadocente-1-planides_valor').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-1-planides_valorhidden').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-1-planides_valorhoraaula').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-1-planides_cargahoraria').keyup(function() {
       updateTotal();
    });

    //Linha 2 - Docente Nível Pós Graduado
    $('#planilhadespesadocente-2-planides_valor').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-2-planides_valorhidden').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-2-planides_valorhoraaula').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-2-planides_cargahoraria').keyup(function() {
       updateTotal();
    });

    //Linha 3 - Docente Nível Especialista(Fatese)
    $('#planilhadespesadocente-3-planides_valor').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-3-planides_valorhidden').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-3-planides_valorhoraaula').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-3-planides_cargahoraria').keyup(function() {
       updateTotal();
    });

    //Linha 4 - Docente Nível Mestre(Fatese)
    $('#planilhadespesadocente-4-planides_valor').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-4-planides_valorhidden').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-4-planides_valorhoraaula').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-4-planides_cargahoraria').keyup(function() {
       updateTotal();
    });

    //Linha 5 - Docente Nível Doutor(Fatese)
    $('#planilhadespesadocente-5-planides_valor').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-5-planides_valorhidden').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-5-planides_valorhoraaula').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-5-planides_cargahoraria').keyup(function() {
       updateTotal();
    });

    //Linha 6 - Prestador de Serviço
    $('#planilhadespesadocente-6-planides_encargos').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-6-planides_valor').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-6-planides_valorhoraaula').keyup(function() {
       updateTotal();
    });
    $('#planilhadespesadocente-6-planides_cargahoraria').keyup(function() {
       updateTotal();
    });

    //Despesas Diretas
    //Materiais Didáticos / Apostilas
    $('#planilhadecursoadmin-placu_custosmateriais').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_hiddenmaterialdidatico').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_pjapostila').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_hiddenpjapostila').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_diarias').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_passagens').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_equipamentos').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_pessoafisica').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_pessoajuridica').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_custosconsumo').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_custosaluno').keyup(function() {
       updateTotal();
    });

    //Despesas Indiretas
    $('#planilhadecursoadmin-placu_custosindiretos').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_ipca').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_reservatecnica').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_despesadm').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_totalincidencias').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_precosugerido').keyup(function() {
       updateTotal();
    });

    $('#planilhadecursoadmin-placu_parcelas').keyup(function() {
       updateTotal();
    });

    var updateTotal = function () {

      //Carga Horária do Plano
      var placu_cargahorariaplano       = parseFloat($('#planilhadecursoadmin-placu_cargahorariaplano').val());

      //Quantidade de Alunos Pagantes, Isentos e PSG 
      var placu_quantidadealunos        = parseFloat($('#planilhadecursoadmin-placu_quantidadealunos').val());
      var placu_quantidadealunosisentos = parseFloat($('#planilhadecursoadmin-placu_quantidadealunosisentos').val());
      var placu_quantidadealunospsg     = parseFloat($('#planilhadecursoadmin-placu_quantidadealunospsg').val());

      //Materiais Didáticos / Apostilas
      var placu_custosmateriais        = parseFloat($('#planilhadecursoadmin-placu_custosmateriais').val());
      var placu_hiddenmaterialdidatico = parseFloat($('#planilhadecursoadmin-placu_hiddenmaterialdidatico').val());
      var placu_pjapostila             = parseFloat($('#planilhadecursoadmin-placu_pjapostila').val());
      var placu_hiddenpjapostila       = parseFloat($('#planilhadecursoadmin-placu_hiddenpjapostila').val());

      //Despesas com Docentes
      //Linha 0 - Docente Nível Médio
      var planides_valor0         = parseFloat($('#planilhadespesadocente-0-planides_valor').val());
      var planides_valorhidden0   = parseFloat($('#planilhadespesadocente-0-planides_valorhidden').val());
      var planides_valorhoraaula0 = parseFloat($('#planilhadespesadocente-0-planides_valorhoraaula').val());
      var planides_cargahoraria0  = parseFloat($('#planilhadespesadocente-0-planides_cargahoraria').val());
      //Linha 1 - Docente Nível Superior
      var planides_valor1         = parseFloat($('#planilhadespesadocente-1-planides_valor').val());
      var planides_valorhidden1   = parseFloat($('#planilhadespesadocente-1-planides_valorhidden').val());
      var planides_valorhoraaula1 = parseFloat($('#planilhadespesadocente-1-planides_valorhoraaula').val());
      var planides_cargahoraria1  = parseFloat($('#planilhadespesadocente-1-planides_cargahoraria').val());
      //Linha 2 - Docente Nível Pós Graduado
      var planides_valor2         = parseFloat($('#planilhadespesadocente-2-planides_valor').val());
      var planides_valorhidden2   = parseFloat($('#planilhadespesadocente-2-planides_valorhidden').val());
      var planides_valorhoraaula2 = parseFloat($('#planilhadespesadocente-2-planides_valorhoraaula').val());
      var planides_cargahoraria2  = parseFloat($('#planilhadespesadocente-2-planides_cargahoraria').val());
      //Linha 3 - Docente Nível Especialista(Fatese)
      var planides_valor3         = parseFloat($('#planilhadespesadocente-3-planides_valor').val());
      var planides_valorhidden3   = parseFloat($('#planilhadespesadocente-3-planides_valorhidden').val());
      var planides_valorhoraaula3 = parseFloat($('#planilhadespesadocente-3-planides_valorhoraaula').val());
      var planides_cargahoraria3  = parseFloat($('#planilhadespesadocente-3-planides_cargahoraria').val());
      //Linha 4 - Docente Nível Mestre(Fatese)
      var planides_valor4         = parseFloat($('#planilhadespesadocente-4-planides_valor').val());
      var planides_valorhidden4   = parseFloat($('#planilhadespesadocente-4-planides_valorhidden').val());
      var planides_valorhoraaula4 = parseFloat($('#planilhadespesadocente-4-planides_valorhoraaula').val());
      var planides_cargahoraria4  = parseFloat($('#planilhadespesadocente-4-planides_cargahoraria').val());
      //Linha 5 - Docente Nível Doutor(Fatese)
      var planides_valor5         = parseFloat($('#planilhadespesadocente-5-planides_valor').val());
      var planides_valorhidden5   = parseFloat($('#planilhadespesadocente-5-planides_valorhidden').val());
      var planides_valorhoraaula5 = parseFloat($('#planilhadespesadocente-5-planides_valorhoraaula').val());
      var planides_cargahoraria5  = parseFloat($('#planilhadespesadocente-5-planides_cargahoraria').val());
      //Linha 6 - Prestador de Serviço
      var planides_valor6         = parseFloat($('#planilhadespesadocente-6-planides_valor').val());
      var planides_valorhoraaula6 = parseFloat($('#planilhadespesadocente-6-planides_valorhoraaula').val());
      var planides_cargahoraria6  = parseFloat($('#planilhadespesadocente-6-planides_cargahoraria').val());

      //Despesas Diretas
      var placu_diarias        = parseFloat($('#planilhadecursoadmin-placu_diarias').val());
      var placu_passagens      = parseFloat($('#planilhadecursoadmin-placu_passagens').val());
      var placu_equipamentos   = parseFloat($('#planilhadecursoadmin-placu_equipamentos').val());
      var placu_pessoafisica   = parseFloat($('#planilhadecursoadmin-placu_pessoafisica').val());
      var placu_pessoajuridica = parseFloat($('#planilhadecursoadmin-placu_pessoajuridica').val());
      var placu_custosconsumo  = parseFloat($('#planilhadecursoadmin-placu_custosconsumo').val());
      var placu_custosaluno    = parseFloat($('#planilhadecursoadmin-placu_custosaluno').val());

      //Despesas Indiretas
      var placu_custosindiretos  = parseFloat($('#planilhadecursoadmin-placu_custosindiretos').val());
      var placu_ipca             = parseFloat($('#planilhadecursoadmin-placu_ipca').val());
      var placu_reservatecnica   = parseFloat($('#planilhadecursoadmin-placu_reservatecnica').val());
      var placu_despesadm        = parseFloat($('#planilhadecursoadmin-placu_despesadm').val());
      var placu_totalincidencias = parseFloat($('#planilhadecursoadmin-placu_totalincidencias').val());
      var placu_precosugerido    = parseFloat($('#planilhadecursoadmin-placu_precosugerido').val());
      var placu_parcelas         = parseFloat($('#planilhadecursoadmin-placu_parcelas').val());

    //CÁLCULOS REALIZADOS
      //Linha 0 - Docente Nível Médio
      //Linha 6 - Prestador de Serviço
      var planides_valorhoraaula6 = planides_valor6; // Valor Hora/Aula será igual ao valor informado na planilha

      //Total Quantidade de Alunos
      var valorTotalQntAlunos = placu_quantidadealunos + placu_quantidadealunosisentos + placu_quantidadealunospsg;

      //Cálculos Prestador de Serviço
      var valorTotalMaoDeObraPrestador = planides_valor6 * planides_cargahoraria6;//Total do Valor - Prestador de Serviço
      var totalEncargosPrestador       = (valorTotalMaoDeObraPrestador * 20) / 100; // Encargos - Prestador de Serviço
      
      //Custo de Mão de Obra Direta = Valor Hora/Aula * Carga Horária
      var valorTotalMaoDeObra0 = planides_valorhoraaula0 * planides_cargahoraria0;
      var valorTotalMaoDeObra1 = planides_valorhoraaula1 * planides_cargahoraria1;
      var valorTotalMaoDeObra2 = planides_valorhoraaula2 * planides_cargahoraria2;
      var valorTotalMaoDeObra3 = planides_valorhoraaula3 * planides_cargahoraria3;
      var valorTotalMaoDeObra4 = planides_valorhoraaula4 * planides_cargahoraria4;
      var valorTotalMaoDeObra5 = planides_valorhoraaula5 * planides_cargahoraria5;
      var valorTotalMaoDeObra  = valorTotalMaoDeObra0 + valorTotalMaoDeObra1 + valorTotalMaoDeObra2 + valorTotalMaoDeObra3 + valorTotalMaoDeObra4 + valorTotalMaoDeObra5;

      //Despesas Diretas
      var valorDecimo              = valorTotalMaoDeObra / 12;
      var valorFerias              = valorTotalMaoDeObra / 12;
      var valorTercoFerias         = valorTotalMaoDeObra / 12 / 3;
      var totalSalarios            = valorTotalMaoDeObra + valorDecimo + valorFerias + valorTercoFerias;
      var totalEncargos            = (totalSalarios * 32.7) / 100;
      var totalOutrasDespVar       = (valorTotalMaoDeObra * 45) / 100;
      var totalSalariosEncargos    = totalSalarios + valorTotalMaoDeObraPrestador + totalEncargos + totalOutrasDespVar + totalEncargosPrestador; // Total de Salários + Outras Despesas Variáveis + Encargos (Horista e Prestador de Serviço)
      var totalMaterial            = placu_hiddenmaterialdidatico * valorTotalQntAlunos;
      var totalPJApostila          = placu_hiddenpjapostila * valorTotalQntAlunos;
      var valorTotalDireto         = totalSalariosEncargos + placu_diarias + placu_passagens + placu_equipamentos + placu_pessoafisica + placu_pessoajuridica + totalPJApostila + totalMaterial + placu_custosconsumo + placu_custosaluno;
      var totalhoraaulacustodireto = valorTotalDireto / placu_cargahorariaplano / valorTotalQntAlunos;

      //Despesas Indiretas
      var totalIncidencia       = placu_custosindiretos + placu_ipca + placu_reservatecnica + placu_despesadm;
      var totalCustoIndireto    = (valorTotalDireto * placu_totalincidencias) / 100;
      var despesaTotal          = totalCustoIndireto + valorTotalDireto;

      var MarkupDivisor        = (100 - totalIncidencia);
      var MarkupMultiplicador  = ((100 / MarkupDivisor) - 1) * 100; // Valores em %
      var PrecoVendaTurma      = (valorTotalDireto / MarkupDivisor) * 100; // Valores em %
      var PrecoVendaAluno      = (PrecoVendaTurma / valorTotalQntAlunos);
      var ValorhoraAulaAluno   = PrecoVendaTurma / placu_cargahorariaplano / valorTotalQntAlunos; //Preço de Venda da Turma / CH TOTAL / QNT Alunos
      var RetornoPrecoVenda    = PrecoVendaTurma - despesaTotal; // Preço de venda da turma - Despesa Total;
      var PorcentagemRetorno   = (RetornoPrecoVenda / PrecoVendaTurma) * 100; // % de Retorno / Preço de venda da Turma -- Valores em %
      var RetornoPrecoSugerido = (placu_precosugerido * valorTotalQntAlunos) - despesaTotal; // Preço Sugerido x Qnt de Alunos - Despesa Total;

      var MinimoAlunos = Math.ceil(despesaTotal / placu_precosugerido); // Despesa Total / Preço Sugerido;

      var ValorParcelas =  placu_precosugerido / placu_parcelas;

        //Ocultar NaN
        if (isNaN(MinimoAlunos) || MinimoAlunos < 0) {
            MinimoAlunos = '';
        }

      //RESULTADO DOS VALORES
      //---DESPESAS COM DOCENTES
      //Valores de Horistas forçados 
      $('#planilhadespesadocente-0-planides_valor').val(planides_valorhidden0);
      $('#planilhadespesadocente-1-planides_valor').val(planides_valorhidden1);
      $('#planilhadespesadocente-2-planides_valor').val(planides_valorhidden2);
      $('#planilhadespesadocente-3-planides_valor').val(planides_valorhidden3);
      $('#planilhadespesadocente-4-planides_valor').val(planides_valorhidden4);
      $('#planilhadespesadocente-5-planides_valor').val(planides_valorhidden5);

      //Linha 6 - Prestador de Serviço
      $('#planilhadespesadocente-6-planides_valorhoraaula').val(planides_valorhoraaula6);


      //---Despesas Diretas
      $('#planilhadecursoadmin-placu_totalcustodocente').val(valorTotalMaoDeObra); // Custo de Mão de Obra Direta = Valor Hora/Aula * Carga Horária
      $('#planilhadecursoadmin-placu_decimo').val(valorDecimo); // 1/12 de 13º
      $('#planilhadecursoadmin-placu_ferias').val(valorFerias); // 1/12 de Férias
      $('#planilhadecursoadmin-placu_tercoferias').val(valorTercoFerias); // 1/12 de 1/3 de férias
      $('#planilhadecursoadmin-placu_totalsalario').val(totalSalarios); // Total de Salários
      $('#planilhadecursoadmin-placu_totalencargos').val(totalEncargos); // Total de Encargos
      $('#planilhadecursoadmin-placu_outdespvariaveis').val(totalOutrasDespVar); // Outras Despesas Variáveis (Mão de Obra * 45%)
      $('#planilhadecursoadmin-placu_totalsalarioencargo').val(totalSalariosEncargos); // Total de Salários + Encargos
      $('#planilhadecursoadmin-placu_pjapostila').val(totalPJApostila); // Total Mat. Didático (Apost./plano A)
      $('#planilhadecursoadmin-placu_custosmateriais').val(totalMaterial); // Total Mat. Didático (Livros/plano A)
      $('#planilhadecursoadmin-placu_totalcustodireto').val(valorTotalDireto); // Total de Custo Direto
      $('#planilhadecursoadmin-placu_totalhoraaulacustodireto').val(totalhoraaulacustodireto); // V. Hora/Aula de Custo Direto

      //--Despesas Indiretas
      //----SEÇÃO 3
      $('#planilhadecursoadmin-placu_totalincidencias').val(totalIncidencia); // Valor Custos indireto + IPCA/MES + reserva técnica + despesa adm
      $('#planilhadecursoadmin-placu_totalcustoindireto').val(totalCustoIndireto); // Valor Custo Direto x Total Incidencias
      $('#planilhadecursoadmin-placu_despesatotal').val(despesaTotal); // Valor Custo Indireto + Custo Direto
      $('#planilhadecursoadmin-placu_markdivisor').val(MarkupDivisor); // Markup Divisor 100 - x / 100
      $('#planilhadecursoadmin-placu_markmultiplicador').val(MarkupMultiplicador); // Markup Multiplicador  ((100 / x ) -1) * 100
      $('#planilhadecursoadmin-placu_vendaturma').val(PrecoVendaTurma); // Valor Total Direto / MarkupDivisor
      $('#planilhadecursoadmin-placu_vendaaluno').val(PrecoVendaAluno); // Preço de Venda por Turma /  Qnt de Alunos
      $('#planilhadecursoadmin-placu_horaaulaaluno').val(ValorhoraAulaAluno); // Preço de Venda da Turma / CH TOTAL / QNT Alunos
      $('#planilhadecursoadmin-placu_retorno').val(RetornoPrecoVenda); // Preço de venda da turma - Despesa Total
      $('#planilhadecursoadmin-placu_porcentretorno').val(PorcentagemRetorno); // % de Retorno / Preço de venda da Turma
      $('#planilhadecursoadmin-placu_retornoprecosugerido').val(RetornoPrecoSugerido); // Preço Sugerido x Qnt de Alunos - Despesa Total;
      $('#planilhadecursoadmin-placu_minimoaluno').val(MinimoAlunos); // Despesa Total / Preço Sugerido;
      $('#planilhadecursoadmin-placu_valorparcelas').val(ValorParcelas); // Preço Sugerido / Quantidade de Parcelas;
      
      //Prestador de Serviço
      $('#planilhadecursoadmin-placu_totalsalarioprestador').val(valorTotalMaoDeObraPrestador); // Total de Mão de Obra - Prestador
      $('#planilhadecursoadmin-placu_totalencargosprestador').val(totalEncargosPrestador); // Total de Encargos - Prestador

    };
 });
