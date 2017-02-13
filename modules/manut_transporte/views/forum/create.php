<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manut_transporte\models\Forum */

$this->title = 'Atualizar Solicitação de Transporte';

?>
<div class="forum-create">

    <h1><?= Html::encode('Chat Suporte - Atendimento') ?></h1>

    <?= $this->render('/forum/_form', [
        'forum' => $forum,
    ]) ?>

</div>
