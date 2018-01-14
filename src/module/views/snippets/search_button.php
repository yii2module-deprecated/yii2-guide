<?php

use yii\helpers\Url;
use yii2lab\helpers\yii\Html;

?>

<?=  Html::a(Html::fa('search', ['class' => 'text-primary']), Url::to(['/guide/search']), [
        'class' => 'pull-right',
	'title' => Yii::t('action', 'search'),
]) ?>
