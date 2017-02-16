          


                            <div class="row">
                                <div class="col-sm-12">

                                    <?= $form->field($curriculosEndereco, 'cep')->widget('yiibr\correios\CepInput', [
                                    'action' => ['addressSearch'],
                                    'fields' => [
                                        'location' => 'curriculosendereco-endereco',
                                        'district' => 'curriculosendereco-bairro',
                                        'city' => 'curriculosendereco-cidade',
                                        'state' => 'curriculosendereco-estado',
                                        'cep' => 'curriculosendereco-cep',
                                    ],
                                ]) ?>
                                </div>

                                <div class="col-sm-6">
                                <?= $form->field($curriculosEndereco, 'endereco')->textInput(['placeholder'=>'Endereço']) ?>
                                </div>

                                <div class="col-sm-2">
                                <?= $form->field($curriculosEndereco, 'numero_end')->textInput(['placeholder'=>'Número']) ?>
                                </div>

                                <div class="col-sm-4">
                                <?= $form->field($curriculosEndereco, 'bairro')->textInput(['placeholder'=>'Bairro']) ?>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                <?= $form->field($curriculosEndereco, 'complemento')->textInput(['placeholder'=>'Complemento']) ?>
                                </div>

                                <div class="col-sm-4">
                                <?= $form->field($curriculosEndereco, 'cidade')->textInput(['placeholder'=>'Cidade']) ?>
                                </div>

                                <div class="col-sm-2">
                                <?= $form->field($curriculosEndereco, 'estado')->textInput(['placeholder'=>'Estado']) ?>
                                </div>
                            </div>