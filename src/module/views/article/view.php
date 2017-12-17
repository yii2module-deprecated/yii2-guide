<?php

/* @var $this yii\web\View */

use yii2lab\helpers\yii\Html;
use yii2module\guide\module\helpers\NavigationHelper;
use yii2module\markdown\widgets\Markdown;

$this->title = $entity->title;
?>

<div class="pull-right">

<?php
echo Html::a(Html::fa('code', ['class' => 'text-primary']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_CODE, ['id' => $entity->id]), [
	//'class' => 'btn btn-default',
	'title' => t('action', 'code'),
]);
echo NBSP;
if(Yii::$app->user->can('guide.modify', $entity->project)) {
	echo Html::a(Html::fa('pencil', ['class' => 'text-primary']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_UPDATE, ['id' => $entity->id]), [
		//'class' => 'btn btn-default',
		'title' => t('action', 'update'),
	]);
	echo NBSP;
	echo Html::a(Html::fa('trash', ['class' => 'text-danger']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_DELETE, ['id' => $entity->id]), [
		//'class' => 'btn btn-default',
		'title' => t('action', 'delete'),
		'data' => [
			'confirm' => t('yii', 'Are you sure you want to delete this item?'),
			'method' => 'post',
		],
	]);
} ?>

</div>

<?= Markdown::widget(['content' => $entity->content]) ?>

<br/>
