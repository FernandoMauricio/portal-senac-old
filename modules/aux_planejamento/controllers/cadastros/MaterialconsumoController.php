<?php

namespace app\modules\aux_planejamento\controllers;

use Yii;
use app\modules\aux_planejamento\models\cadastros\Materialconsumo;
use app\modules\aux_planejamento\models\cadastros\TipoUnidade;
use app\modules\aux_planejamento\models\cadastros\MaterialconsumoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialconsumoController implements the CRUD actions for Materialconsumo model.
 */
class MaterialconsumoController extends Controller
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
     * Lists all Materialconsumo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialconsumoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materialconsumo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionImportExcelMaterialConsumo()
    {
        $inputFile = 'uploads/imports/materalconsumo.xlsx';
        try{
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        }catch(Exception $e)
        {
            Yii::$app->session->setFlash('danger', '<strong>ERRO! </strong> Houve algum problema na importação do Material de Consumo!</strong>');

            return $this->redirect(['/cadastros/materialconsumo/index']);
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
            // $model = new Materialconsumo();
            // $model->matcon_codMXM = $rowData[0][0];
            // $model->matcon_descricao = $rowData[0][1];
            // $model->matcon_tipo = $rowData[0][2];
            // $model->matcon_valor = $rowData[0][3];
            // $model->matcon_status = $rowData[0][4];
            // $model->save();
            if(!empty($rowData[0][0])){
                $data[] = [$rowData[0][0],$rowData[0][1],$rowData[0][2],$rowData[0][3],$rowData[0][4]];
            }
        }

        //apaga a tabela completa para preparar a importação
        Yii::$app->db->createCommand()->checkIntegrity(false)->execute();
        Yii::$app->db->createCommand()->truncateTable('db_apl2.materialconsumo_matcon')->execute();
        //--------insere em massa os materiais de consumo exportados do MXM
        Yii::$app->db->createCommand()
            ->batchInsert('db_apl2.materialconsumo_matcon', ['matcon_codMXM','matcon_descricao', 'matcon_tipo', 'matcon_valor', 'matcon_status'], $data)
            ->execute();
        
        //-------atualiza os planos já criados com os valores de materiais de consumo atuais
        Yii::$app->db_apl->createCommand('UPDATE `plano_materialconsumo`, `materialconsumo_matcon` SET `planmatcon_valor` = `matcon_valor` WHERE `planmatcon_codMXM` = `matcon_codMXM`')
            ->execute();

        Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material de Consumo importado!</strong>');

        return $this->redirect(['/cadastros/materialconsumo/index']);

    }


    /**
     * Creates a new Materialconsumo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $model = new Materialconsumo();

        $tipounidade = TipoUnidade::find()->orderBy('tipuni_descricao')->all();

        $model->matcon_data           = date('Y-m-d');
        $model->matcon_codcolaborador = $session['sess_codcolaborador'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material de Consumo Criado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tipounidade' => $tipounidade,
            ]);
        }
    }


    /**
     * Updates an existing Materialconsumo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        $tipounidade = TipoUnidade::find()->orderBy('tipuni_descricao')->all();

        $model->matcon_data           = date('Y-m-d');
        $model->matcon_codcolaborador = $session['sess_codcolaborador'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

        //-------atualiza os planos já criados com os valores de materiais de consumo atuais
        Yii::$app->db_apl->createCommand('UPDATE `plano_materialconsumo`, `materialconsumo_matcon` SET `planmatcon_valor` = '.$model->matcon_valor.' WHERE `materialconsumo_cod` = '.$model->matcon_id.'')
            ->execute();

            Yii::$app->session->setFlash('success', '<strong>SUCESSO! </strong> Material de Consumo Atualizado!</strong>');

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tipounidade' => $tipounidade,
            ]);
        }
    }

    /**
     * Deletes an existing Materialconsumo model.
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
     * Finds the Materialconsumo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materialconsumo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Materialconsumo::findOne($id)) !== null) {
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