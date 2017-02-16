<?php

namespace app\modules\aux_planejamento\controllers\cadastros;

use Yii;
use app\modules\aux_planejamento\models\cadastros\Materialaluno;
use app\modules\aux_planejamento\models\cadastros\TipoUnidade;
use app\modules\aux_planejamento\models\cadastros\MaterialalunoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialalunoController implements the CRUD actions for Materialaluno model.
 */
class MaterialalunoController extends Controller
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
     * Lists all Materialaluno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialalunoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materialaluno model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //----------------* Verificar se será viável essa função, uma vez que os itens sem saldo estarão zerados
    public function actionImportExcelMaterialAluno()
    {
        $inputFile = 'uploads/aux_planejamento/imports/materalaluno.xlsx';
        try{
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        }catch(Exception $e)
        {
            Yii::$app->session->setFlash('danger', '<strong>ERRO! </strong> Houve algum problema na importação do Material de Aluno!</strong>');

            return $this->redirect(['/cadastros/materialaluno/index']);
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $data = [];
        for( $row = 1; $row <= $highestRow; $row++ )
        {
            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

            if($row == 1)
            {
                continue;
            }
            // $model = new Materialaluno();
            // $model->matalu_cod = $rowData[0][0];
            // $model->matalu_descricao = $rowData[0][1];
            // $model->matalu_unidade = $rowData[0][2];
            // $model->matalu_valor = $rowData[0][3];
            // $model->matalu_status = $rowData[0][4];
            // $model->save();
            if(!empty($rowData[0][0])){
                $data[] = [$rowData[0][0],$rowData[0][1],$rowData[0][2],$rowData[0][3],$rowData[0][4]];
            }
        }

        //--------insere em massa os materiais de aluno exportados do MXM
        Yii::$app->db->createCommand()
            ->batchInsert('db_apl2.materialaluno_matalu', ['matalu_cod','matalu_descricao', 'matalu_unidade', 'matalu_valor', 'matalu_status'], $data)
            ->execute();
        
        //-------atualiza os planos já criados com os valores de materiais de aluno atuais
        Yii::$app->db_apl->createCommand('UPDATE `plano_materialaluno`, `materialaluno_matalu` SET `planmatalu_valor` = `matalu_valor` WHERE `materialaluno_cod` = `matalu_cod`')
            ->execute();

        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material de Aluno importado!</strong>');

        return $this->redirect(['/cadastros/materialaluno/index']);

    }

    /**
     * Creates a new Materialaluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;

        $model = new Materialaluno();

        $tipounidade = TipoUnidade::find()->orderBy('tipuni_descricao')->all();

        $model->matalu_data           = date('Y-m-d');
        $model->matalu_codcolaborador = $session['sess_codcolaborador'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material do aluno cadastrado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tipounidade' => $tipounidade,
            ]);
        }
    }

    /**
     * Updates an existing Materialaluno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        $tipounidade = TipoUnidade::find()->orderBy('tipuni_descricao')->all();

        $model->matalu_data           = date('Y-m-d');
        $model->matalu_codcolaborador = $session['sess_codcolaborador'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material do aluno atualizado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tipounidade' => $tipounidade,
            ]);
        }
    }

    /**
     * Deletes an existing Materialaluno model.
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
     * Finds the Materialaluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materialaluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Materialaluno::findOne($id)) !== null) {
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