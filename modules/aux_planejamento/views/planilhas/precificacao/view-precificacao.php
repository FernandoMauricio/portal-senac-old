
<div class="precificacao1-view">

          <div class="row">
              <p class="bg-info" style="padding: 10px"><strong> SEÇÃO 1: Informações do Curso</strong></p>

                  <div class="col-md-1"><strong>Código:</strong><br> <?php echo $model->planp_id; ?></div>

                  <div class="col-md-1"><strong>Ano:</strong><br> <?php echo $model->planp_ano; ?></div>

                  <div class="col-md-5"><strong>Unidade:</strong> <?php echo $model->unidade->uni_nomeabreviado; ?></div>

                  <div class="col-md-5"><strong>Plano de Ação:</strong> <?php echo $model->planodeacao->plan_descricao; ?></div>

          </div>

          <br>

          <div class="row">
                  <div class="col-md-3"><strong>Carga Horária:</strong> <?php echo $model->planp_cargahoraria; ?></div>

                  <div class="col-md-3"><strong>Qnt Alunos:</strong> <?php echo $model->planp_qntaluno; ?></div>
          </div>

        <br>

          <div class="row">
              <p class="bg-info" style="padding: 10px"><strong> SEÇÃO 2: Cálculos de Custos Diretos</strong></p>

                  <div class="col-md-3"><strong>Nível Docente:</strong><br> <?php echo $model->despesasdocente->doce_descricao; ?></div>

                  <div class="col-md-3"><strong>Total Horas Docente:</strong><br> <?php echo $model->planp_totalhorasdocente; ?></div>

                  <div class="col-md-4"><strong>Hora/Aula Serv. Pedagógico (s/produtividade):</strong><br> <?php echo $model->planp_servpedagogico; ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Valor Hora/Aula:</strong><br> <?php echo 'R$ ' . number_format($model->planp_valorhoraaula, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Valor Hora/Aula Planejamento:</strong><br> <?php  echo 'R$ ' . number_format($model->planp_horaaulaplanejamento, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Custo de Mão de Obra Direta:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalcustodocente, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>1/12 de 13º:</strong><br> <?php echo 'R$ ' . number_format($model->planp_decimo, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>1/12 de Férias:</strong><br> <?php  echo 'R$ ' . number_format($model->planp_ferias, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>1/12 de 1/3 de férias:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_tercoferias, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Total de Salários:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalsalario, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>(%) Encargos s/13º, férias e salários:</strong><br> <?php echo number_format($model->planp_encargos, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>Total de Encargos:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalencargos, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Total de Salários + Encargos:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalsalarioencargo, 2, ',', '.'); ?></div>
          </div>

          <br>

          <div class="row">
                  <div class="col-md-3"><strong>Diárias:</strong><br> <?php echo 'R$ ' . number_format($model->planp_diarias, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Passagens:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_passagens, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Serv. Terceiros (PF):</strong><br> <?php echo 'R$ ' . number_format( $model->planp_pessoafisica, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Serv. Terceiros (PJ):</strong><br> <?php echo 'R$ ' . number_format( $model->planp_pessoajuridica, 2, ',', '.'); ?></div>
          </div>

         <br>

          <div class="row">
                  <div class="col-md-3"><strong>Mat. Didático (Apostila/plano A):</strong><br> <?php echo 'R$ ' .  number_format($model->planp_PJApostila, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Mat. Didático (Livros/plano A):</strong><br> <?php echo 'R$ ' .  number_format($model->planp_custosmateriais, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Material Consumo:</strong><br> <?php echo 'R$ ' .  number_format($model->planp_custosconsumo, 2, ',', '.'); ?></div>

                  <div class="col-md-3" style="color: #F7941D;"><strong>Total de Custo Direto:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalcustodireto, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Valor Hora/Aula de Custo Direto:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalhoraaulacustodireto, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
              <p class="bg-info" style="padding: 10px"><strong> SEÇÃO 3: Cálculos de Custos Indiretos</strong></p>

                  <div class="col-md-3"><strong>Custos Indiretos(%):</strong><br> <?php echo number_format($model->planp_custosindiretos, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>IPCA/Mês(%):</strong><br> <?php echo number_format($model->planp_ipca, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>Rerserva Técnica(%):</strong><br> <?php echo number_format($model->planp_reservatecnica, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>Despesa Sede ADM 2016(%):</strong><br> <?php echo number_format($model->planp_despesadm, 2, ',', '.') . '%'; ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Total Incidências(%):</strong><br> <?php echo number_format($model->planp_totalincidencias, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3" style="color: #F7941D;"><strong>Total Custo Indireto:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_totalcustoindireto, 2, ',', '.'); ?></div>

                  <div class="col-md-4" style="color: red;"><strong>Despesa Total:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_despesatotal, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Mark-Up Divisor 100-X/100:</strong><br> <?php echo number_format($model->planp_markdivisor, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-3"><strong>Mark-Up Multiplicador 100/Markup:</strong><br> <?php echo number_format($model->planp_markmultiplicador, 2, ',', '.') . '%'; ?></div>

                  <div class="col-md-4"><strong>Preço de Venda Total da Turma:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_vendaturma, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3"><strong>Preço de Venda Total por Aluno:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_vendaaluno, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Retorno com Preço de Venda:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_retorno, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Valor Hora/Aula por Aluno:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_horaaulaaluno, 2, ',', '.'); ?> </div>

                  <div class="col-md-3"><strong>% de Retorno:</strong><br>  <?php echo number_format($model->planp_porcentretorno, 2, ',', '.') . '%'; ?></div>
          </div>

        <br>

          <div class="row">
                  <div class="col-md-3" style="color: green;"><strong>Preço Sugerido:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_precosugerido, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Retorno com preço sugerido:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_retornoprecosugerido, 2, ',', '.'); ?></div>

                  <div class="col-md-3"><strong>Numero minimo de alunos por turma:</strong><br> <?php echo $model->planp_minimoaluno; ?></div>
          </div>

          <br>
          
          <div class="row">
                  <div class="col-md-3"><strong>Quantidade de Parcelas:</strong><br> <?php echo $model->planp_parcelas; ?></div>

                  <div class="col-md-3"><strong>Valor das Parcelas:</strong><br> <?php echo 'R$ ' . number_format( $model->planp_valorparcelas, 2, ',', '.'); ?></div>
          </div>

        <br>

          <div class="row">
              <p class="bg-info" style="padding: 10px"><strong> SEÇÃO 4: Auditoria</strong></p>
                  <div class="col-md-5"><strong>Cadastrado por:</strong> <?php echo $model->colaborador->usuario->usu_nomeusuario ?></div>

                  <div class="col-md-5"><strong>Data de Cadastro:</strong> <?php echo  date('d/m/Y', strtotime($model->planp_data)) ?></div>
          </div>
  </div>
