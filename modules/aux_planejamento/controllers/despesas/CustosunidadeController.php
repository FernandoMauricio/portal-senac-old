<?php

namespace app\modules\aux_planejamento\controllers\despesas;

use Yii;
use app\modules\aux_planejamento\models\MultipleModel as Model;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\despesas\Salas;
use app\modules\aux_planejamento\models\despesas\Custosindireto;
use app\modules\aux_planejamento\models\despesas\Custosunidade;
use app\modules\aux_planejamento\models\despesas\CustosunidadeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * CustosunidadeController implements the CRUD actions for Custosunidade model.
 */
class CustosunidadeController extends Controller
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
     * Lists all Custosunidade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustosunidadeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Custosunidade model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Custosunidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Custosunidade();

        $modelsCustosIndireto = [new Custosindireto()];

        $unidades = Unidade::find()->where(['uni_codsituacao' => 1, 'uni_coddisp' => 1])->orderBy('uni_nomeabreviado')->all();
        $salas    = Salas::find()->where(['sal_status' => 1])->orderBy('sal_descricao')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //Inserir vários custos indiretos (salas, metragem, cap máxima de alunos)
            $modelsCustosIndireto = Model::createMultiple(Custosindireto::classname());
            Model::loadMultiple($modelsCustosIndireto, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCustosIndireto) && $valid;

             if ($valid ) {
                $transaction = \Yii::$app->db_apl->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsCustosIndireto as $modelCustosIndireto) {
                            $modelCustosIndireto->custosunidade_id = $model->cust_codcusto;

                            if (! ($flag = $modelCustosIndireto->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

                        if($model->save()){

                            $valorTotalPorcentagem = 0;

                            //realiza a soma da capitação máxima de alunos
                            $query = (new \yii\db\Query())->from('db_apl2.custosindireto_custin')->where(['custosunidade_id' => $model->cust_codcusto]);
                            $totalCapmaximo = $query->sum('custin_capmaximo');
             
                            //busca pelas despesas cadastradas para cada custo da unidade
                            $query_custoIndireto = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."' ORDER BY id ASC";
                            $modelsCustosIndireto = Custosindireto::findBySql($query_custoIndireto)->all(); 
                            foreach ($modelsCustosIndireto as $modelCustosIndireto) {

                            $custin_capmaximo       = $modelCustosIndireto["custin_capmaximo"];
                            $custin_porcentagem     = $modelCustosIndireto["custin_porcentagem"];

                            $porcentagem = $custin_capmaximo / $totalCapmaximo; //---------capacidade máxima / TOTAL da capacidade máxima
                            $custin_custoindireto   = $porcentagem * $model->cust_indireto; //---------Porcentagem x custo indireto informado

                            $modelCustosIndireto->custin_porcentagem = $porcentagem; //---------save porcentagem 
                            $modelCustosIndireto->custin_custoindireto = $custin_custoindireto;//save custo indireto

                            $modelCustosIndireto->save();

                            //realiza a soma da porcentagem
                            $query = (new \yii\db\Query())->from('db_apl2.custosindireto_custin')->where(['custosunidade_id' => $model->cust_codcusto]);
                            $totalPorcentagem = $query->sum('custin_porcentagem');

                            //realiza a soma do custo indireto
                            $query = (new \yii\db\Query())->from('db_apl2.custosindireto_custin')->where(['custosunidade_id' => $model->cust_codcusto]);
                            $totalCustoIndireto = $query->sum('custin_custoindireto');

                            //Busca no banco o quantitativo de linhas da porcentagem
                            $sql = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."'";
                            $qnt_porcentagem = Custosindireto::findBySql($sql)->count();

                            //Busca no banco o quantitativo de linhas do custo indireto
                            $sql = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."'";
                            $qnt_custoidireto = Custosindireto::findBySql($sql)->count();


                            $model->cust_MediaPorcentagem = ($totalPorcentagem / $qnt_porcentagem) * 100; //save média porcentagem-->Porcentagem / Quantidade de linhas x 100

                            $model->cust_MediaCustoIndireto = ($totalCustoIndireto / $qnt_custoidireto); //save média porcentagem-->Porcentagem / Quantidade de linhas x 100

                            $model->save();
                            }

                        }

                        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Custo Indireto Cadastrado!</strong>');
                        return $this->redirect(['view', 'id' => $model->cust_codcusto]);
                    }
                }  catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Custo Indireto Cadastrado!</strong>');

            return $this->redirect(['view', 'id' => $model->cust_codcusto]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'unidades' => $unidades,
                'salas' => $salas,
                'modelsCustosIndireto'   => (empty($modelsCustosIndireto)) ? [new Custosindireto] : $modelsCustosIndireto,
            ]);
        }
    }

    /**
     * Updates an existing Custosunidade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsCustosIndireto  = $model->custosindireto;

        $unidades = Unidade::find()->where(['uni_codsituacao' => 1, 'uni_coddisp' => 1])->orderBy('uni_nomeabreviado')->all();
        $salas    = Salas::find()->where(['sal_status' => 1])->orderBy('sal_descricao')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

                    //--------Custos da Indiretos da Unidade--------------
        $oldIDsCustosIndireto = ArrayHelper::map($modelsCustosIndireto, 'id', 'id');
        $modelsCustosIndireto = Model::createMultiple(Custosindireto::classname(), $modelsCustosIndireto);
        Model::loadMultiple($modelsCustosIndireto, Yii::$app->request->post());
        $deletedIDsCustosIndireto = array_diff($oldIDsCustosIndireto, array_filter(ArrayHelper::map($modelsCustosIndireto, 'id', 'id')));

        // validate all models
        $valid = $model->validate();
        $valid = Model::validateMultiple($modelsCustosIndireto) && $valid;

        if ($valid ) {
                $transaction = \Yii::$app->db_apl->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsCustosIndireto as $modelCustosIndireto) {
                            $modelCustosIndireto->custosunidade_id = $model->cust_codcusto;

                            if (! ($flag = $modelCustosIndireto->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();

                        if($model->save()){

                            $valorTotalPorcentagem = 0;

                            //realiza a soma da capitação máxima de alunos
                            $query = (new \yii\db\Query())->from('db_apl2.custosindireto_custin')->where(['custosunidade_id' => $model->cust_codcusto]);
                            $totalCapmaximo = $query->sum('custin_capmaximo');
             
                            //busca pelas despesas cadastradas para cada custo da unidade
                            $query_custoIndireto = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."' ORDER BY id ASC";
                            $modelsCustosIndireto = Custosindireto::findBySql($query_custoIndireto)->all(); 
                            foreach ($modelsCustosIndireto as $modelCustosIndireto) {

                            $custin_capmaximo       = $modelCustosIndireto["custin_capmaximo"];
                            $custin_porcentagem     = $modelCustosIndireto["custin_porcentagem"];

                            $porcentagem = $custin_capmaximo / $totalCapmaximo; //---------capacidade máxima / TOTAL da capacidade máxima
                            $custin_custoindireto   = $porcentagem * $model->cust_indireto; //---------Porcentagem x custo indireto informado

                            $modelCustosIndireto->custin_porcentagem = $porcentagem; //---------save porcentagem 
                            $modelCustosIndireto->custin_custoindireto = $custin_custoindireto;//save custo indireto

                            $modelCustosIndireto->save();

                            //realiza a soma da porcentagem
                            $query = (new \yii\db\Query())->from('db_apl2.custosindireto_custin')->where(['custosunidade_id' => $model->cust_codcusto]);
                            $totalPorcentagem = $query->sum('custin_porcentagem');

                            //realiza a soma do custo indireto
                            $query = (new \yii\db\Query())->from('db_apl2.custosindireto_custin')->where(['custosunidade_id' => $model->cust_codcusto]);
                            $totalCustoIndireto = $query->sum('custin_custoindireto');

                            //Busca no banco o quantitativo de linhas da porcentagem
                            $sql = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."'";
                            $qnt_porcentagem = Custosindireto::findBySql($sql)->count();

                            //Busca no banco o quantitativo de linhas do custo indireto
                            $sql = "SELECT * FROM custosindireto_custin WHERE custosunidade_id = '".$model->cust_codcusto."'";
                            $qnt_custoidireto = Custosindireto::findBySql($sql)->count();


                            $model->cust_MediaPorcentagem = ($totalPorcentagem / $qnt_porcentagem) * 100; //save média porcentagem-->Porcentagem / Quantidade de linhas x 100

                            $model->cust_MediaCustoIndireto = ($totalCustoIndireto / $qnt_custoidireto); //save média porcentagem-->Porcentagem / Quantidade de linhas x 100

                            $model->save();
                            }

                        }

                        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Custo Indireto Atualizado!</strong>');
                        return $this->redirect(['view', 'id' => $model->cust_codcusto]);
                    }
                }  catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Custo Indireto Atualizado!</strong>');

            return $this->redirect(['view', 'id' => $model->cust_codcusto]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'unidades' => $unidades,
                'salas' => $salas,
                'modelsCustosIndireto'   => (empty($modelsCustosIndireto)) ? [new Custosindireto] : $modelsCustosIndireto,
            ]);
        }
    }

    /**
     * Deletes an existing Custosunidade model.
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
     * Finds the Custosunidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Custosunidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Custosunidade::findOne($id)) !== null) {
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