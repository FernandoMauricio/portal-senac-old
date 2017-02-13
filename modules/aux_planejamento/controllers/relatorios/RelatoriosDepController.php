<?php

namespace app\modules\aux_planejamento\controllers\relatorios;

use Yii;
use app\modules\aux_planejamento\models\base\Unidade;
use app\modules\aux_planejamento\models\cadastros\Ano;
use app\modules\aux_planejamento\models\relatorios\RelatoriosDep;
use app\modules\aux_planejamento\models\planos\Planodeacao;
use app\modules\aux_planejamento\models\planilhas\Planilhadecurso;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;



class RelatoriosDepController extends Controller
{

    public function behaviors()
    {

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionGerarRelatorio()
    {
    
        return $this->render('/relatorios/relatorios-dep/gerar-relatorio');

    }

    public function actionSegmentoPlanoMaterial()
    {

        $objPHPExcel = new \PHPExcel();

        $sheet=0;
                  
            $objPHPExcel->setActiveSheetIndex($sheet);

                $connection = Yii::$app->db_apl;
                $command = $connection->createCommand('
                    SELECT 
                        `segmento_seg`.`seg_descricao`, 
                        `planodeacao_plan`.`plan_codsegmento`, 
                        `planodeacao_plan`.`plan_codplano`, 
                        `planodeacao_plan`.`plan_descricao`, 
                        `planomaterial_plama`.`plama_codplano`, 
                        `planomaterial_plama`.`plama_tipoplano`,
                        `planomaterial_plama`.`plama_codmxm`, 
                        `planomaterial_plama`.`plama_titulo`, 
                        `planomaterial_plama`.`plama_tipomaterial`, 
                        `planomaterial_plama`.`plama_editora`, 
                        `planomaterial_plama`.`plama_valor`
                    FROM 
                        `planodeacao_plan`
                        INNER JOIN `segmento_seg` ON `planodeacao_plan`.`plan_codsegmento` = `segmento_seg`.`seg_codsegmento` 
                        INNER JOIN `planomaterial_plama` ON `planodeacao_plan`.`plan_codplano` = `planomaterial_plama`.`plama_codplano`
                    WHERE 
                        `planodeacao_plan`.`plan_status` = 1 
                       AND seg_codsegmento = plan_codsegmento

                    ');

                $foos = $command->queryAll();

            //TAMANHO DAS COLUNAS  
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

            //TÍTULO DAS COLUNAS
            $objPHPExcel->getActiveSheet()->setTitle('Segmento-Plano-Material')                     
             ->setCellValue('A1', 'SEGMENTO')
             ->setCellValue('B1', 'CÓD. PLANO')
             ->setCellValue('C1', 'PLANO')
             ->setCellValue('D1', 'TIPO DE MATERIAL')
             ->setCellValue('E1', 'CÓD. MXM')
             ->setCellValue('F1', 'NOME DO MATERIAL')
             ->setCellValue('G1', 'EDITORA')
             ->setCellValue('H1', 'VALOR');
                 
         $row=2; //GERAÇÃO DOS DADOS A PARTIR DA LINHA 2
                                
                foreach ($foos as $foo) {  

                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['seg_descricao']); 
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['plan_codplano']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['plan_descricao']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['plama_tipoplano']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['plama_codmxm']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['plama_titulo']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$foo['plama_editora']);
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$foo['plama_valor']);

                    $row++ ;
               }


        header('Content-Type: application/vnd.ms-excel');
        $filename = "Relatoio_DEP_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');      

    }

    public function actionPlanos()
    {

        $objPHPExcel = new \PHPExcel();

        $sheet=0;
                  
            $objPHPExcel->setActiveSheetIndex($sheet);

                $connection = Yii::$app->db_apl;
                $command = $connection->createCommand('
                    SELECT 
                        `segmento_seg`.`seg_descricao`, 
                        `planodeacao_plan`.`plan_codsegmento`, 
                        `planodeacao_plan`.`plan_codplano`, 
                        `planodeacao_plan`.`plan_descricao`, 
                        `planodeacao_plan`.`plan_cargahoraria`, 
                        `planodeacao_plan`.`plan_sobre`, 
                        `planodeacao_plan`.`plan_prerequisito`, 
                        `planodeacao_plan`.`plan_perfConclusao`, 
                        `planodeacao_plan`.`plan_perfTecnico`, 
                        `planodeacao_plan`.`plan_status`, 
                        `planodeacao_plan`.`plan_modelonacional`, 
                        `planodeacao_plan`.`plan_custoMaterialLivro`, 
                        `planodeacao_plan`.`plan_custoMaterialApostila`, 
                        `planodeacao_plan`.`plan_custoTotalConsumo`, 
                        `planodeacao_plan`.`plan_custoTotalAluno` 
                    FROM 
                        `planodeacao_plan` 
                        INNER JOIN `segmento_seg` ON `planodeacao_plan`.`plan_codsegmento` = `segmento_seg`.`seg_codsegmento` 
                    WHERE 
                        `planodeacao_plan`.`plan_status` = 1 
                        AND seg_codsegmento = plan_codsegmento

                    ');

                $foos = $command->queryAll();

            //TAMANHO DAS COLUNAS  
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

            //TÍTULO DAS COLUNAS
            $objPHPExcel->getActiveSheet()->setTitle('Planos de Ação')                     
             ->setCellValue('A1', 'SEGMENTO')
             ->setCellValue('B1', 'CÓD. PLANO')
             ->setCellValue('C1', 'PLANO')
             ->setCellValue('D1', 'CARGA HORÁRIA')
             ->setCellValue('E1', 'INFORMAÇÕES COMERCIAIS')
             ->setCellValue('F1', 'PRÉ-REQUISITO')
             ->setCellValue('G1', 'PERFIL PROFISSIONAL DE CONCLUSÃO')
             ->setCellValue('H1', 'PERFIL DOCENTE')
             ->setCellValue('I1', 'CUSTO MATERIAL (LIVRO)')
             ->setCellValue('J1', 'CUSTO MATERIAL (APOSTILA)')
             ->setCellValue('K1', 'CUSTO MATERIAL CONSUMO')
             ->setCellValue('L1', 'CUSTO MATERIAL ALUNO')
             ->setCellValue('M1', 'MODELO NACIONAL')
             ->setCellValue('N1', 'SITUAÇÃO');
                 
         $row=2; //GERAÇÃO DOS DADOS A PARTIR DA LINHA 2
                                
                foreach ($foos as $foo) {  

                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$foo['seg_descricao']); 
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$foo['plan_codplano']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$foo['plan_descricao']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$foo['plan_cargahoraria']);
                    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$foo['plan_sobre']);
                    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$foo['plan_prerequisito']);
                    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$foo['plan_perfConclusao']);
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$foo['plan_perfTecnico']);
                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$foo['plan_custoMaterialLivro']);
                    $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$foo['plan_custoMaterialApostila']);
                    $objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$foo['plan_custoTotalConsumo']);
                    $objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$foo['plan_custoTotalAluno']);
                    $objPHPExcel->getActiveSheet()->setCellValue('M'.$row,$foo['plan_modelonacional'] ? 'Sim' : 'Não');
                    $objPHPExcel->getActiveSheet()->setCellValue('N'.$row,$foo['plan_status'] ? 'Ativo' : 'Inativo');

                    $row++ ;
               }


        header('Content-Type: application/vnd.ms-excel');
        $filename = "Relatoio_DEP_".date("d-m-Y-His").".xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');      

    }
    
}