<?php

namespace app\modules\aux_planejamento\controllers\despesas;

use Yii;
use app\modules\aux_planejamento\models\despesas\Despesasdocente;
use app\modules\aux_planejamento\models\despesas\DespesasdocenteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DespesasdocenteController implements the CRUD actions for Despesasdocente model.
 */
class DespesasdocenteController extends Controller
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
     * Lists all Despesasdocente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DespesasdocenteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Despesasdocente model.
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
     * Creates a new Despesasdocente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Despesasdocente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->calculos == 1) { // Realiza os cálculos de Planejamento e Produtividade caso seja marcado a opção
                $model->doce_dsr = $model->doce_valor / 6; // Valor do DSR = Valor / 6
                $model->doce_planejamento = $model->doce_valor + $model->doce_dsr; //Planejamento = Valor + DSR
                $model->doce_produtividade = ($model->doce_valor * 45) / 100; //Produtividade = Valor * 45%
                $model->doce_valorhoraaula = $model->doce_valor + $model->doce_dsr + $model->doce_produtividade; // Valor Hora Aula = valor + DSR + Produtividade
                $model->save();
            }else{
                $model->doce_dsr = $model->doce_valor / 6; // Valor do DSR = Valor / 6
                $model->doce_valorhoraaula = $model->doce_valor + $model->doce_dsr;
                $model->save();
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Despesa com docente cadastrada!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Despesasdocente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->doce_planejamento  = 0;
        $model->doce_produtividade = 0;
        $model->doce_valorhoraaula = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->calculos == 1) { // Realiza os cálculos de Planejamento e Produtividade caso seja marcado a opção
                $model->doce_dsr = $model->doce_valor / 6; // Valor do DSR = Valor / 6
                $model->doce_planejamento = $model->doce_valor + $model->doce_dsr; //Planejamento = Valor + DSR
                $model->doce_produtividade = ($model->doce_valor * 45) / 100; //Produtividade = Valor * 45%
                $model->doce_valorhoraaula = $model->doce_valor + $model->doce_dsr + $model->doce_produtividade; // Valor Hora Aula = valor + DSR + Produtividade
                $model->save();
            }else{
                if($model->doce_id != 7){ //Diferente de Prestador de Serviço
                $model->doce_dsr = $model->doce_valor / 6; // Valor do DSR = Valor / 6
                $model->doce_valorhoraaula = $model->doce_valor + $model->doce_dsr;
                $model->save();
                }else{//Caso seja prestador, só irá duplicar o valor informado para o valor/hora.
                $model->doce_dsr = 0;
                $model->doce_planejamento = 0;
                $model->doce_produtividade = 0;
                $model->doce_valorhoraaula = $model->doce_valor;
                $model->save();
                }
            }

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Despesa com docente atualizada!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Despesasdocente model.
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
     * Finds the Despesasdocente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Despesasdocente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Despesasdocente::findOne($id)) !== null) {
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