<?php

namespace app\modules\aux_planejamento\controllers\solicitacoes;

use Yii;

use app\modules\aux_planejamento\models\MultipleModel as Model;
use app\modules\aux_planejamento\models\planos\Planodeacao;
use app\modules\aux_planejamento\models\base\Emailusuario;
use app\modules\aux_planejamento\models\cadastros\Centrocusto;
use app\modules\aux_planejamento\models\repositorio\Repositorio;
use app\modules\aux_planejamento\models\solicitacoes\Acabamento;
use app\modules\aux_planejamento\models\solicitacoes\MaterialCopiasItens;
use app\modules\aux_planejamento\models\solicitacoes\MaterialCopias;
use app\modules\aux_planejamento\models\solicitacoes\MaterialCopiasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * MaterialCopiasController implements the CRUD actions for MaterialCopias model.
 */
class MaterialCopiasController extends Controller
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
     * Lists all MaterialCopias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialCopiasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaterialCopias model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //Localiza os dados de quantidade de originais de materiais didático cadastrados no repositorio
    public function actionGetRepositorio($repId){

        $getRepositorio = Repositorio::find()->where(['rep_titulo' => $repId])->one();

        echo Json::encode($getRepositorio);
    }

    //Localiza os dados de tipos de material cadastrados no repositorio
    public function actionCentrocusto(){

            $out = [];
            if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                    $cat_id = $parents[0];
                    $subcat_id = $parents[1];
                    $out = MaterialCopias::getCentroCustoSubCat($cat_id, $subcat_id);
                    echo Json::encode(['output'=>$out, 'selected'=>'']);
                    return;
                    }
                 }
            echo Json::encode(['output'=>'', 'selected'=>'']);
    }


    //Localiza os cursos onde foram selecionados o segmento e tipo de ação
    public function actionCursos() {
            $out = [];
            if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                    $cat_id = $parents[0];
                    $subcat_id = $parents[1];
                    $out = MaterialCopias::getPlanodeacaoSubCat($cat_id, $subcat_id);
                    echo Json::encode(['output'=>$out, 'selected'=>'']);
                    return;
                    }
                 }
            echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Creates a new MaterialCopias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;

        //conexão com os bancos
        $connection = Yii::$app->db;
        $connection = Yii::$app->db_apl;

        $model = new MaterialCopias();
        $modelsItens  = [new MaterialCopiasItens];

        $acabamento = Acabamento::find()->all();

        $repositorio = Repositorio::find()->where(['rep_status' => 1])->orderBy('rep_titulo')->all();

        $model->matc_data        = date('Y-m-d');
        $model->matc_solicitante = $session['sess_codcolaborador'];
        $model->matc_unidade     = $session['sess_codunidade'];
        $model->situacao_id      = 1;
  
        if ($model->load(Yii::$app->request->post())) {

            $model->matc_totalGeral = $model->matc_totalValorMono + $model->matc_totalValorColor;

            //Inserir vários itens na solicitação
            $modelsItens = Model::createMultiple(MaterialCopiasItens::classname());
            Model::loadMultiple($modelsItens, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsItens) && $valid;

             if ($valid ) {
                $transaction = \Yii::$app->db_apl->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsItens as $modelItens) {
                            $modelItens->materialcopias_id = $model->matc_id;
                            if (! ($flag = $modelItens->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag && $session['sess_responsavelsetor'] == 0) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Cópia cadastrada!</strong>');

         //ENVIANDO EMAIL PARA O GERENTE DO SETOR INFORMANDO SOBRE A SOLICITAÇÃO PENDENTE DE AUTORIZAÇÃO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->matc_unidade."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
              
              $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
              foreach ($email_solicitacao as $email)
                  {
                    $email_usuario  = $email["emus_email"];

                                    Yii::$app->mailer->compose()
                                    ->setFrom(['dep.suporte@am.senac.br' => 'DEP - INFORMA'])
                                    ->setTo($email_usuario)
                                    ->setSubject('Solicitação de Cópia - ' . $model->matc_id)
                                    ->setTextBody('Existe uma solicitação de Cópia de código: '.$model->matc_id.' - Pendente de Autorização pelo Setor')
                                    ->setHtmlBody('<p>Prezado(a) Senhor(a),</p>

                                    <p>Existe uma Solicita&ccedil;&atilde;o de Cópia de c&oacute;digo: <strong><span style="color:#F7941D">'.$model->matc_id.' </span></strong>- <strong><span style="color:#F7941D">Pendente de Autorização pelo Setor</span></strong></p>

                                    <p><strong>Situação</strong>: '.$model->situacao->sitmat_descricao.'</p>

                                    <p><strong>Total de Despesa</strong>: R$ ' .number_format($model->matc_totalGeral, 2, ',', '.').'</p>

                                    <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicita&ccedil;&atilde;o de Cópia.</p>

                                    <p>Atenciosamente,</p>

                                    <p>Divisão de Educação Profissional -&nbsp;DEP</p>
                                    ')
                                    ->send();
                                } 
                        return $this->redirect(['view', 'id' => $model->matc_id]);
                    }

                    if ($flag && $session['sess_responsavelsetor'] == 1) {
                //SE FOR GERENTE ENVIA DIRETAMENTE PARA A DEP COM A AUTORIZAÇÃO DO SETOR
                $transaction->commit();
                Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Cópia cadastrada!</strong>');

                $model->matc_dataGer     = date('Y-m-d H:i:s');
                $model->matc_ResponsavelGer = $session['sess_nomeusuario'];

                //-------atualiza a situação pra aprovado pela gerência do setor
                Yii::$app->db_apl->createCommand('UPDATE `materialcopias_matc` SET `situacao_id` = 7 , `matc_autorizadoGer` = 1, `matc_ResponsavelGer` = "'.$model->matc_ResponsavelGer.'" , `matc_dataGer` = "'.$model->matc_dataGer.'" WHERE `matc_id` = '.$model->matc_id.'')
                ->execute();

                $model->matc_totalGeral = $model->matc_totalValorMono + $model->matc_totalValorColor;

                $model->situacao_id = 7;
                if($model->situacao_id == 7){

            //ENVIANDO EMAIL PARA OS RESPONSÁVEIS DO GABINETE TÉCNICO INFORMANDO SOBRE O RECEBIMENTO DE UMA NOVA SOLICITAÇÃO DE CÓPIA 
            //-- 15 - DIVISÃO DE EDUCAÇÃO PROFISSIONAL // 87 - GABINETE TÉCNICO
                  $sql_email = "SELECT DISTINCT emus_email FROM emailusuario_emus,colaborador_col,responsavelambiente_ream,responsaveldepartamento_rede WHERE ream_codunidade = '15' AND rede_coddepartamento = '87' AND rede_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
                  
                  $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
                  foreach ($email_solicitacao as $email)
                      {
                        $email_usuario  = $email["emus_email"];

                                    Yii::$app->mailer->compose()
                                    ->setFrom(['dep.suporte@am.senac.br' => 'DEP - INFORMA'])
                                    ->setTo($email_usuario)
                                    ->setSubject('Aprovada! - Solicitação de Cópia '.$model->matc_id.'')
                                    ->setTextBody('Por favor, verique a situação da solicitação de cópia de código: '.$model->matc_id.' com status de '.$model->situacao->sitmat_descricao.' ')
                                    ->setHtmlBody('<p>Prezado(a), Senhor(a)</p>

                                    <p>A solicitação de cópia de código <span style="color:rgb(247, 148, 29)"><strong>'.$model->matc_id.'</strong></span> foi atualizada:</p>

                                    <p><strong>Situação</strong>: '.$model->situacao->sitmat_descricao.'</p>

                                    <p><strong>Total de Despesa</strong>: R$ ' .number_format($model->matc_totalGeral, 2, ',', '.').'</p>

                                    <p><strong>Responsável pela Aprovação do Setor</strong>: '.$model->matc_ResponsavelGer.'</p>

                                    <p><strong>Data/Hora da Aprovação do Setor</strong>: '.date('d/m/Y H:i', strtotime($model->matc_dataGer)).'</p>

                                    <p>Por favor, não responda esse e-mail. Acesse http://portalsenac.am.senac.br</p>

                                    <p>Atenciosamente,</p>

                                    <p>Divisão de Educação Profissional - DEP</p>')
                                    ->send();
                                } 
                            }
 
                        return $this->redirect(['view', 'id' => $model->matc_id]);
                    }

                }  catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            if($model->save()){

                Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Cópia cadastrada!</strong>');
            }

            return $this->redirect(['view', 'id' => $model->matc_id]);
        } else {

            return $this->render('create', [
                'model'       => $model,
                'repositorio' => $repositorio,
                'acabamento'  => $acabamento,
                'modelsItens' => (empty($modelsItens)) ? [new MaterialCopiasItens] : $modelsItens,
            ]);
        }
    }

    public function actionObservacoes($id) 
    {
        $model = MaterialCopias::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_materialcopias', $model->matc_id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=solicitacoes/material-copias-justificativas/observacoes', [
             'model' => $model,
         ]);
    }

    /**
     * Updates an existing MaterialCopias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;

        $model = $this->findModel($id);
        $modelsItens = $model->materialCopiasItens;

        $repositorio = Repositorio::find()->where(['rep_status' => 1])->orderBy('rep_titulo')->all();

        //ACABAMENTOS
        $acabamento = Acabamento::find()->where(['acab_status' => 1])->all();
        //Retrieve the stored checkboxes
        $model->listAcabamento = \yii\helpers\ArrayHelper::getColumn(
            $model->getCopiasAcabamento()->asArray()->all(),
            'acabamento_id'
        );

        $model->matc_data        = date('Y-m-d');
        $model->matc_solicitante = $session['sess_codcolaborador'];
        $model->matc_unidade     = $session['sess_codunidade'];
        $model->situacao_id      = 1;
        $model->matc_ResponsavelAut = NULL;
        $model->matc_dataAut = NULL;
        
        $model->matc_totalGeral = $model->matc_totalValorMono + $model->matc_totalValorColor;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
         
           $model->matc_totalGeral = $model->matc_totalValorMono + $model->matc_totalValorColor;

        //--------Materiais Didáticos--------------
        $oldIDsItens = ArrayHelper::map($modelsItens, 'id', 'id');
        $modelsItens = Model::createMultiple(MaterialCopiasItens::classname(), $modelsItens);
        Model::loadMultiple($modelsItens, Yii::$app->request->post());
        $deletedIDsItens = array_diff($oldIDsItens, array_filter(ArrayHelper::map($modelsItens, 'id', 'id')));

        // validate all models
        $valid = $model->validate();
        $valid = Model::validateMultiple($modelsItens) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDsItens)) {
                            PlanoMaterial::deleteAll(['id' => $deletedIDsItens]);
                        }
                        foreach ($modelsItens as $modelItens) {
                            $modelItens->materialcopias_id = $model->matc_id;
                            if (! ($flag = $modelItens->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

                        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Cópia atualizada!</strong>');

            //-------atualiza a situação pra aprovado pela gerência do setor
            Yii::$app->db_apl->createCommand('UPDATE `materialcopias_matc` SET `situacao_id` = 1, `matc_autorizadoGer` = NULL, `matc_ResponsavelGer` = NULL, `matc_dataGer` = NULL, `matc_autorizado` = NULL, `matc_ResponsavelAut` = NULL, `matc_dataAut` = NULL WHERE `matc_id` = '.$model->matc_id.'')
            ->execute();

         //ENVIANDO EMAIL PARA O GERENTE INFORMANDO SOBRE A SOLICITAÇÃO PENDENTE DE AUTORIZAÇÃO
          $sql_email = "SELECT emus_email FROM emailusuario_emus, colaborador_col, responsavelambiente_ream WHERE ream_codunidade = '".$model->matc_unidade."' AND ream_codcolaborador = col_codcolaborador AND col_codusuario = emus_codusuario";
              
              $email_solicitacao = Emailusuario::findBySql($sql_email)->all(); 
              foreach ($email_solicitacao as $email)
                  {
                    $email_usuario  = $email["emus_email"];

                                    Yii::$app->mailer->compose()
                                    ->setFrom(['dep.suporte@am.senac.br' => 'DEP - INFORMA'])
                                    ->setTo($email_usuario)
                                    ->setSubject('Solicitação de Cópia - ' . $model->matc_id)
                                    ->setTextBody('Existe uma solicitação de Cópia de código: '.$model->matc_id.' - Pendente de Autorização pelo Setor')
                                    ->setHtmlBody('<p>Prezado(a) Senhor(a),</p>

                                    <p>Existe uma Solicita&ccedil;&atilde;o de Cópia de c&oacute;digo: <strong><span style="color:#F7941D">'.$model->matc_id.' </span></strong>- <strong><span style="color:#F7941D">Pendente de Autorização pelo Setor</span></strong></p>

                                    <p><strong>Situação</strong>: '.$model->situacao->sitmat_descricao.'</p>

                                    <p><strong>Total de Despesa</strong>: R$ ' .number_format($model->matc_totalGeral, 2, ',', '.').'</p>

                                    <p>Por favor, n&atilde;o responda esse e-mail. Acesse http://portalsenac.am.senac.br para ANALISAR a solicita&ccedil;&atilde;o de Cópia.</p>

                                    <p>Atenciosamente,</p>

                                    <p>Divisão de Educação Profissional -&nbsp;DEP</p>
                                    ')
                                    ->send();
                                } 
                        return $this->redirect(['view', 'id' => $model->matc_id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Solicitação de Cópia atualizada!</strong>');

            return $this->redirect(['view', 'id' => $model->matc_id]);
        } else {
            return $this->render('update', [
                'model'       => $model,
                'repositorio' => $repositorio,
                'acabamento'  => $acabamento,
                'modelsItens' => (empty($modelsItens)) ? [new MaterialCopiasItens] : $modelsItens,
            ]);
        }
    }

    /**
     * Deletes an existing MaterialCopias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MaterialCopias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MaterialCopias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaterialCopias::findOne($id)) !== null) {
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
