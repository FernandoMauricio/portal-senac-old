<?php

namespace app\modules\aux_planejamento\controllers\planilhas;

use Yii;
use app\modules\aux_planejamento\models\MultipleModel as Model;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Tipoprogramacao;
use app\modules\aux_planejamento\models\despesas\Markup;
use app\modules\aux_planejamento\models\despesas\Despesasdocente;
use app\modules\aux_planejamento\models\planos\Planodeacao;
use app\modules\aux_planejamento\models\planos\Unidadescurriculares;
use app\modules\aux_planejamento\models\planos\PlanoMaterial;
use app\modules\aux_planejamento\models\planos\PlanoConsumo;
use app\modules\aux_planejamento\models\planos\PlanoAluno;
use app\modules\aux_planejamento\models\planos\PlanoEstruturafisica;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoAdmin;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoAdminSearch;
use app\modules\aux_planejamento\models\planilhas\PlanilhaDespesaDocente;
use app\modules\aux_planejamento\models\planilhas\PlanilhaDespesaDocenteSearch;
use app\modules\aux_planejamento\models\planilhas\PlanilhaUnidadesCurriculares;
use app\modules\aux_planejamento\models\planilhas\PlanilhaMaterial;
use app\modules\aux_planejamento\models\planilhas\PlanilhaConsumo;
use app\modules\aux_planejamento\models\planilhas\PlanilhaMaterialAluno;
use app\modules\aux_planejamento\models\planilhas\PlanilhaEquipamento;
use app\modules\aux_planejamento\models\planilhas\Planilhadecurso;
use app\modules\aux_planejamento\models\planilhas\PlanilhadecursoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * PlanilhadecursoAdminController implements the CRUD actions for PlanilhadecursoAdmin model.
 */
class PlanilhadecursoAdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {

        $this->AccessAllow(); //Irá ser verificado se o usuário está logado no sistema

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PlanilhadecursoAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-planilhadecurso';
        $searchModel = new PlanilhadecursoAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionObservacoesAdminGerentes($id)
    {
        $model = Planilhadecurso::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_planilhadecurso', $model->placu_codplanilha);

        return $this->redirect(['/planilhas/planilha-justificativas/observacoes-admin-gerentes'], [
             'model' => $model,
         ]);
    }

    //Envia todo o Planejamento para o GPO da unidade selecionada pelo Administrador
    public function actionEnviarPlanejamentoAdmin()
    {
        $model = new PlanilhadecursoAdmin();
        $unidades = Unidade::find()->where(['uni_codsituacao' => 1])->orderBy('uni_nomeabreviado')->all();
        $tipoProgramacao = Tipoprogramacao::find()->all();

        if ($model->load(Yii::$app->request->post())) {

        //Realiza a Contagem das Planilhas da unidade que estão definidas como PRODUÇÃO, PROGRAMAÇÃO ANUAL e AGUARDANDO ENVIO
        $countPlanilhas = 0;
        $countPlanilhas = Planilhadecurso::find()->where(['placu_codtipla' => 1, 'placu_codsituacao' => 5, 'placu_codprogramacao' => 1, 'placu_codunidade' => $model->placu_codunidade])->count();  
        if($countPlanilhas != 0){
        //Envia as Planilhas para o GPO da unidade que estão definidas como PRODUÇÃO, PROGRAMAÇÃO ANUAL e AGUARDANDO ENVIO
        Yii::$app->db_apl->createCommand('UPDATE `planilhadecurso_placu` SET `placu_codsituacao` = 3 WHERE `placu_codtipla` = 1 AND `placu_codprogramacao` = 1 AND `placu_codsituacao`= 5 AND `placu_codunidade` = "'.$model->placu_codunidade.'" ')->execute();

        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Total de '.$countPlanilhas.' planilhas de "'.$model->unidade->uni_nomeabreviado.'" enviadas para análise do GPO!</strong>');
        }else{
        Yii::$app->session->setFlash('warning', '<strong>AVISO! </strong> Não existem planilhas com a situação: <strong>Aguardando Envio Planejamento</strong> de <strong>'.$model->unidade->uni_nomeabreviado.'</strong> para serem enviadas à GPO!</strong>');
        }

        return $this->redirect(['index']);

            }else{
                return $this->renderAjax('enviar-planejamento-admin', [
                'model' => $model,
                'unidades'=> $unidades,
                'tipoProgramacao' => $tipoProgramacao,
            ]);
        }
    }

    /**
     * Displays a single PlanilhadecursoAdmin model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelsPlaniDespDocente    = $model->planiDespDocente;
        $modelsPlaniUC             = $model->planiUC;
        $modelsPlaniMaterial       = $model->planiMateriais;
        $modelsPlaniConsumo        = $model->planiConsumo;
        $modelsPlaniMateriaisAluno = $model->planiMateriaisAluno;
        $modelsPlaniEquipamento    = $model->planiEquipamento;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelsPlaniDespDocente'    => $modelsPlaniDespDocente,
            'modelsPlaniUC'             => $modelsPlaniUC,
            'modelsPlaniMaterial'       => $modelsPlaniMaterial,
            'modelsPlaniConsumo'        => $modelsPlaniConsumo,
            'modelsPlaniMateriaisAluno' => $modelsPlaniMateriaisAluno,
            'modelsPlaniEquipamento'    => $modelsPlaniEquipamento,
        ]);
    }

    /**
     * Creates a new PlanilhadecursoAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PlanilhadecursoAdmin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->placu_codplanilha]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PlanilhadecursoAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update'; //Validações obrigatórias na atualização
        $modelsPlaniUC             = $model->planiUC;
        $modelsPlaniMaterial       = $model->planiMateriais;
        $modelsPlaniConsumo        = $model->planiConsumo;
        $modelsPlaniMateriaisAluno = $model->planiMateriaisAluno;
        $modelsPlaniEquipamento    = $model->planiEquipamento;
        $modelsPlaniDespDocente    = $model->planiDespDocente;


        //Caso o exercicio da Planilha seja diferente com o ano da Planilha, será avisado ao usuário para excluir alguns itens
        if($model->planilhaAno->an_ano <= date('Y')){
             Yii::$app->session->setFlash('danger', '<strong>AVISO! </strong> Planilha '.$id.' do ano de <strong>'.$model->planilhaAno->an_ano.'</strong>. Por favor, <strong>exclua</strong> os itens de Organização Curricular, Material Didático, Consumo e Aluno que não irá utilizar!</strong>');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        //--------Despesas com Docentes--------------
        $oldIDsDespesaDocente = ArrayHelper::map($modelsPlaniDespDocente, 'id', 'id');
        $modelsPlaniDespDocente = Model::createMultiple(PlanilhaDespesaDocente::classname(), $modelsPlaniDespDocente);
        Model::loadMultiple($modelsPlaniDespDocente, Yii::$app->request->post());
        $deletedIDsDespesaDocente = array_diff($oldIDsDespesaDocente, array_filter(ArrayHelper::map($modelsPlaniDespDocente, 'id', 'id')));

        //--------Unidades Curriculares--------------
        $oldIDsUnidadesCurriculares = ArrayHelper::map($modelsPlaniUC, 'id', 'id');
        $modelsPlaniUC = Model::createMultiple(PlanilhaUnidadesCurriculares::classname(), $modelsPlaniUC);
        Model::loadMultiple($modelsPlaniUC, Yii::$app->request->post());
        $deletedIDsUnidadesCurriculares = array_diff($oldIDsUnidadesCurriculares, array_filter(ArrayHelper::map($modelsPlaniUC, 'id', 'id')));

        //--------Materiais Didáticos--------------
        $oldIDsMateriais = ArrayHelper::map($modelsPlaniMaterial, 'id', 'id');
        $modelsPlaniMaterial = Model::createMultiple(PlanilhaMaterial::classname(), $modelsPlaniMaterial);
        Model::loadMultiple($modelsPlaniMaterial, Yii::$app->request->post());
        $deletedIDsMateriais = array_diff($oldIDsMateriais, array_filter(ArrayHelper::map($modelsPlaniMaterial, 'id', 'id')));

        //--------Materiais de Consumo--------------
        $oldIDsConsumo = ArrayHelper::map($modelsPlaniConsumo, 'id', 'id');
        $modelsPlaniConsumo = Model::createMultiple(PlanilhaConsumo::classname(), $modelsPlaniConsumo);
        Model::loadMultiple($modelsPlaniConsumo, Yii::$app->request->post());
        $deletedIDsConsumo = array_diff($oldIDsConsumo, array_filter(ArrayHelper::map($modelsPlaniConsumo, 'id', 'id')));

        //--------Materiais do Aluno--------------
        $oldIDsMaterialAluno = ArrayHelper::map($modelsPlaniMateriaisAluno, 'id', 'id');
        $modelsPlaniMateriaisAluno = Model::createMultiple(PlanilhaMaterialAluno::classname(), $modelsPlaniMateriaisAluno);
        Model::loadMultiple($modelsPlaniMateriaisAluno, Yii::$app->request->post());
        $deletedIDsMaterialAluno = array_diff($oldIDsMaterialAluno, array_filter(ArrayHelper::map($modelsPlaniMateriaisAluno, 'id', 'id')));

        //--------Equipamentos / Utensílios--------------
        $oldIDsEquipamento = ArrayHelper::map($modelsPlaniEquipamento, 'id', 'id');
        $modelsPlaniEquipamento = Model::createMultiple(PlanilhaEquipamento::classname(), $modelsPlaniEquipamento);
        Model::loadMultiple($modelsPlaniEquipamento, Yii::$app->request->post());
        $deletedIDsEquipamento = array_diff($oldIDsEquipamento, array_filter(ArrayHelper::map($modelsPlaniEquipamento, 'id', 'id')));

        // validate all models
        $valid = $model->validate();
        $valid = (Model::validateMultiple($modelsPlaniDespDocente) || Model::validateMultiple($modelsPlaniUC) || Model::validateMultiple($modelsPlaniMaterial) || Model::validateMultiple($modelsPlaniConsumo) || Model::validateMultiple($modelsPlaniEquipamento) ) && $valid;

                        if ($valid) {
                            $transaction = \Yii::$app->db_apl->beginTransaction();
                            try {
                                if ($flag = $model->save(false)) {

                                    if (! empty($deletedIDsDespesaDocente)) {
                                        PlanilhaDespesaDocente::deleteAll(['id' => $deletedIDsDespesaDocente]);
                                    }
                                    foreach ($modelsPlaniDespDocente as $modelPlaniDespDocente) {
                                        $modelPlaniDespDocente->planilhadecurso_cod = $model->placu_codplanilha;
                                        if (! ($flag = $modelPlaniDespDocente->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }

                                    if (! empty($deletedIDsUnidadesCurriculares)) {
                                        PlanilhaUnidadesCurriculares::deleteAll(['id' => $deletedIDsUnidadesCurriculares]);
                                    }
                                    foreach ($modelsPlaniUC as $modelPlaniUC) {
                                        $modelPlaniUC->planilhadecurso_cod = $model->placu_codplanilha;
                                        if (! ($flag = $modelPlaniUC->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }

                                    if (! empty($deletedIDsMateriais)) {
                                        PlanilhaMaterial::deleteAll(['id' => $deletedIDsMateriais]);
                                    }
                                    foreach ($modelsPlaniMaterial as $modelPlaniMaterial) {
                                        $modelPlaniMaterial->planilhadecurso_cod = $model->placu_codplanilha;
                                        if (! ($flag = $modelPlaniMaterial->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }

                                    if (! empty($deletedIDsConsumo)) {
                                        PlanilhaConsumo::deleteAll(['id' => $deletedIDsConsumo]);
                                    }
                                    foreach ($modelsPlaniConsumo as $modelPlaniConsumo) {
                                        $modelPlaniConsumo->planilhadecurso_cod = $model->placu_codplanilha;
                                        if (! ($flag = $modelPlaniConsumo->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }

                                    if (! empty($deletedIDsMaterialAluno)) {
                                        PlanilhaMaterialAluno::deleteAll(['id' => $deletedIDsMaterialAluno]);
                                    }
                                    foreach ($modelsPlaniMateriaisAluno as $modelPlaniMateriaisAluno) {
                                        $modelPlaniMateriaisAluno->planilhadecurso_cod = $model->placu_codplanilha;
                                        if (! ($flag = $modelPlaniMateriaisAluno->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }

                                    if (! empty($deletedIDsEquipamento)) {
                                        PlanilhaEquipamento::deleteAll(['id' => $deletedIDsEquipamento]);
                                    }
                                    foreach ($modelsPlaniEquipamento as $modelPlaniEquipamento) {
                                        $modelPlaniEquipamento->planilhadecurso_cod = $model->placu_codplanilha;
                                        if (! ($flag = $modelPlaniEquipamento->save(false))) {
                                            $transaction->rollBack();
                                            break;
                                        }
                                    }
                                }

                                if ($flag) {
                                    $transaction->commit();

                                if($model->save()){

                                    //realiza a soma dos custos de material didático(LIVROS) SOMENTE DO PLANO A
                                    $query = (new \yii\db\Query())->from('db_apl2.planilhamaterial_planima')->where(['planilhadecurso_cod' => $model->placu_codplanilha, 'planima_tipoplano' => 'Plano A', 'planima_tipomaterial' => 'LIVRO']);
                                    $totalValorMaterialLivro = $query->sum('planima_valor');

                                    //realiza a soma dos custos de material didático(APOSTILAS) SOMENTE DO PLANO A
                                    $query = (new \yii\db\Query())->from('db_apl2.planilhamaterial_planima')->where(['planilhadecurso_cod' => $model->placu_codplanilha, 'planima_tipoplano' => 'Plano A', 'planima_tipomaterial' => 'APOSTILAS']);
                                    $totalValorMaterialApostila = $query->sum('planima_valor');

                                    //realiza a soma dos custos de materiais de consumo (somatória de Quantidade * Valor de todas as linhas)
                                    $query = (new \yii\db\Query())->from('db_apl2.planilhaconsumo_planico')->where(['planilhadecurso_cod' => $model->placu_codplanilha]);
                                    $totalValorConsumo = $query->sum('planico_valor*planico_quantidade');

                                    //realiza a soma dos custos de material do aluno
                                    $query = (new \yii\db\Query())->from('db_apl2.planilhamaterialaluno_planimatalun')->where(['planilhadecurso_cod' => $model->placu_codplanilha]);
                                    $totalValorAluno = $query->sum('planimatalun_valor*planimatalun_quantidade');

                                    //Somatória Quantidade de Alunos Pagantes, Isentos e PSG 
                                    $valorTotalQntAlunos = $model->placu_quantidadealunos + $model->placu_quantidadealunosisentos + $model->placu_quantidadealunospsg;
                                    
                                    $model->placu_custosmateriais  = $totalValorMaterialLivro * $valorTotalQntAlunos; //save custo material didático - LIVROS
                                    $model->placu_PJApostila       = $totalValorMaterialApostila * $valorTotalQntAlunos; //save custo material didático - APOSTILAS
                                    $model->placu_custosconsumo    = $totalValorConsumo; //save custo material consumo
                                    $model->placu_custosaluno      = $totalValorAluno; //save custo material consumo

                                    $model->placu_hiddenmaterialdidatico = $totalValorMaterialLivro; //save hidden custo para multiplicação javascript
                                    $model->placu_hiddenpjapostila       = $totalValorMaterialApostila; //save hidden custo para multiplicação javascript
                                    $model->placu_data                   = date('Y-m-d');
                                    $model->placu_codsituacao            = 1; //Situação Padrão: Em elaboração

                                    //Totalização das Despesas Diretas (Total de Custo Direto)
                                    $model->placu_totalcustodireto = $model->placu_totalsalarioencargo + $model->placu_diarias + $model->placu_passagens + $model->placu_pessoafisica + $model->placu_pessoajuridica + $model->placu_PJApostila + $model->placu_custosmateriais + $model->placu_custosconsumo + $model->placu_custosaluno;

                                    //Despesas Indiretas
                                    $model->placu_totalincidencias     = $model->placu_custosindiretos + $model->placu_ipca + $model->placu_reservatecnica + $model->placu_despesadm;
                                    $model->placu_totalcustoindireto   = ($model->placu_totalcustodireto * $model->placu_totalincidencias) / 100;
                                    $model->placu_despesatotal         = $model->placu_totalcustoindireto + $model->placu_totalcustodireto;
                                    $model->placu_markdivisor          = (100 - $model->placu_totalincidencias);
                                    $model->placu_markmultiplicador    = ((100 / $model->placu_markdivisor) - 1) * 100; // Valores em %
                                    $model->placu_vendaturma           = ($model->placu_totalcustodireto / $model->placu_markdivisor) * 100; // Valores em %
                                    $model->placu_vendaaluno           = ($model->placu_vendaturma / $valorTotalQntAlunos);
                                    $model->placu_horaaulaaluno        = $model->placu_vendaturma / $model->placu_cargahorariaplano / $valorTotalQntAlunos; //Venda da Turma / CH TOTAL / QNT Alunos
                                    $model->placu_retorno              = $model->placu_vendaturma - $model->placu_despesatotal; // Preço de venda da turma - Despesa Total;
                                    $model->placu_porcentretorno       = ($model->placu_retorno / $model->placu_vendaturma) * 100; // % de Retorno / Preço de venda da Turma -- Valores em %
                                    $model->placu_retornoprecosugerido = ($model->placu_precosugerido * $valorTotalQntAlunos) - $model->placu_despesatotal; // Preço Sugerido x Qnt de Alunos - Despesa  Total;
                                    $model->placu_minimoaluno = ceil($model->placu_despesatotal / $model->placu_precosugerido); // Despesa Total / Preço Sugerido;
                                    $model->placu_valorparcelas =  $model->placu_precosugerido / $model->placu_parcelas;
                                    $model->save();
                                }
                
                                    Yii::$app->session->setFlash('info', '<strong>SUCESSO! </strong> Planilha '.$id.' Atualizada!</strong>');
                                    return $this->redirect(['update', 'id' => $model->placu_codplanilha]);
                                }
                            } catch (Exception $e) {
                                $transaction->rollBack();
                            }
                        }

            Yii::$app->session->setFlash('info', '<strong>SUCESSO! </strong> Planilha '.$id.' Atualizada!</strong>');

            return $this->redirect(['update', 'id' => $model->placu_codplanilha]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsPlaniDespDocente'    => (empty($modelsPlaniDespDocente)) ? [new PlanilhaDespesaDocente] : $modelsPlaniDespDocente,
                'modelsPlaniUC'             => (empty($modelsPlaniUC)) ? [new PlanilhaUnidadesCurriculares] : $modelsPlaniUC,
                'modelsPlaniMaterial'       => (empty($modelsPlaniMaterial)) ? [new PlanilhaMaterial] : $modelsPlaniMaterial,
                'modelsPlaniConsumo'        => (empty($modelsPlaniConsumo)) ? [new PlanilhaConsumo] : $modelsPlaniConsumo,
                'modelsPlaniMateriaisAluno' => (empty($modelsPlaniMateriaisAluno)) ? [new PlanilhaMaterialAluno] : $modelsPlaniMateriaisAluno,
                'modelsPlaniEquipamento'    => (empty($modelsPlaniEquipamento)) ? [new PlanilhaEquipamento] : $modelsPlaniEquipamento,
            ]);
        }
    }

    public function actionFinalizar($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update'; //Validações obrigatórias na atualização
        $modelsPlaniUC             = $model->planiUC;
        $modelsPlaniMaterial       = $model->planiMateriais;
        $modelsPlaniConsumo        = $model->planiConsumo;
        $modelsPlaniMateriaisAluno = $model->planiMateriaisAluno;
        $modelsPlaniEquipamento    = $model->planiEquipamento;
        $modelsPlaniDespDocente    = $model->planiDespDocente;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->placu_codsituacao  = 5; //Atualiza a Planilha para Aguardando Envio Planejamento
            $model->save();
            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Planilha '.$id.' Atualizada e Aguardando o Envio do Planejamento!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelsPlaniDespDocente'    => (empty($modelsPlaniDespDocente)) ? [new PlanilhaDespesaDocente] : $modelsPlaniDespDocente,
                'modelsPlaniUC'             => (empty($modelsPlaniUC)) ? [new PlanilhaUnidadesCurriculares] : $modelsPlaniUC,
                'modelsPlaniMaterial'       => (empty($modelsPlaniMaterial)) ? [new PlanilhaMaterial] : $modelsPlaniMaterial,
                'modelsPlaniConsumo'        => (empty($modelsPlaniConsumo)) ? [new PlanilhaConsumo] : $modelsPlaniConsumo,
                'modelsPlaniMateriaisAluno' => (empty($modelsPlaniMateriaisAluno)) ? [new PlanilhaMaterialAluno] : $modelsPlaniMateriaisAluno,
                'modelsPlaniEquipamento'    => (empty($modelsPlaniEquipamento)) ? [new PlanilhaEquipamento] : $modelsPlaniEquipamento,
            ]);
        }
    }

    /**
     * Deletes an existing PlanilhadecursoAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PlanilhadecursoAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PlanilhadecursoAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PlanilhadecursoAdmin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }
    }

    public function AccessAllow()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }
    }
}