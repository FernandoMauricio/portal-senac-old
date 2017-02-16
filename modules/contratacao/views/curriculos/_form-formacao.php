      <?php

use kartik\builder\Form;


      ?>

        <?= $form->field($curriculosFormacao, 'fundamental_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?>

        <?= $form->field($curriculosFormacao, 'medio_comp')->radioList([1 =>'Completo', 0 =>'Incompleto'], ['inline'=>true]) ?>


                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'tecnico'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'tecnico_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe o seu curso técnico...'],'columnOptions'=>['colspan'=>2]],
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'superior_comp'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'superior_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe a sua graduação...'],'columnOptions'=>['colspan'=>2]],
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'pos'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'pos_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de Pós-graduação...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'mestrado'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'mestrado_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de mestrado...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'doutorado'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Completo', 0=>'Incompleto'], 'options'=>['inline'=>true]],
                                    'doutorado_area'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso de Pós-graduação...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

                        <?php
                            echo Form::widget([
                                'model'=>$curriculosFormacao,
                                'form'=>$form,
                                'columns'=>4,
                                'attributes'=>[       
                                    'estuda_atualmente'=>['type'=>Form::INPUT_RADIO_LIST,'items'=>[1=>'Sim', 0=>'Não'], 'options'=>['inline'=>true]],
                                    'estuda_curso'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Informe seu curso...'],'columnOptions'=>['colspan'=>2]],
                                    
                                            ],
                            ]);
                        ?>

        <?= $form->field($curriculosFormacao, 'estuda_turno_mat')->checkbox() ?>
        
        <?= $form->field($curriculosFormacao, 'estuda_turno_vesp')->checkbox() ?>
        
        <?= $form->field($curriculosFormacao, 'estuda_turno_not')->checkbox() ?>