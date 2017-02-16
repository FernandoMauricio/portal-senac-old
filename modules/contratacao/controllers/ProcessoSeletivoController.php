<?php

namespace app\modules\contratacao\controllers;

use Yii;
use app\modules\contratacao\models\ProcessoSeletivo;
use app\modules\contratacao\models\ProcessoSeletivoSearch;
use app\modules\contratacao\models\Edital;
use app\modules\contratacao\models\Anexos;
use app\modules\contratacao\models\Adendos;
use app\modules\contratacao\models\Resultados;
use app\modules\contratacao\models\Cargos;
use app\modules\contratacao\models\CargosProcesso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProcessoSeletivoController implements the CRUD actions for ProcessoSeletivo model.
 */
class ProcessoSeletivoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProcessoSeletivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $searchModel = new ProcessoSeletivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProcessoSeletivo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProcessoSeletivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else

        $model = new ProcessoSeletivo();

        $cargos = Cargos::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong>O Processo Seletivo do edital <strong>'.$model->numeroEdital. '</strong> foi cadastrado no site!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cargos' => $cargos,
            ]);
        }
    }

    /**
     * Updates an existing ProcessoSeletivo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        if (!isset($session['sess_codusuario']) && !isset($session['sess_codcolaborador']) && !isset($session['sess_codunidade']) && !isset($session['sess_nomeusuario']) && !isset($session['sess_coddepartamento']) && !isset($session['sess_codcargo']) && !isset($session['sess_cargo']) && !isset($session['sess_setor']) && !isset($session['sess_unidade']) && !isset($session['sess_responsavelsetor'])) 
        {
           return $this->redirect('http://portalsenac.am.senac.br');
        }

    //VERIFICA SE O COLABORADOR FAZ PARTE DO SETOR GRH E DO DEPARTAMENTO DE PROCESSO SELETIVO
    if($session['sess_codunidade'] != 7 || $session['sess_coddepartamento'] != 82){

        $this->layout = 'main-acesso-negado';
        return $this->render('/site/acesso_negado');

    }else
    
        $model = $this->findModel($id);

        //CARGOS
        $cargos = Cargos::find()->where(['status' => 1])->all();
        //Retrieve the stored checkboxes
        $model->permissions = \yii\helpers\ArrayHelper::getColumn(
            $model->getCargosProcesso()->asArray()->all(),
            'cargo_id'
        );

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong>O Processo Seletivo do edital <strong>' .$model->numeroEdital. '</strong> foi atualizado no site!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cargos' => $cargos,
            ]);
        }
    }


    public function actionEdital($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=edital/index', [
             'model' => $model,
         ]);
    }

    public function actionAnexos($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=anexos/index', [
             'model' => $model,
         ]);
    }

    public function actionAdendos($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=adendos/index', [
             'model' => $model,
         ]);
    }

    public function actionResultados($id) 
    {


        $model = ProcessoSeletivo::findOne($id);
        $session = Yii::$app->session;
        $session->set('sess_processo', $model->id);

        return $this->redirect(Yii::$app->request->BaseUrl . '/index.php?r=resultados/index', [
             'model' => $model,
         ]);
    }





    /**
     * Deletes an existing ProcessoSeletivo model.
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
     * Finds the ProcessoSeletivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProcessoSeletivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProcessoSeletivo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
