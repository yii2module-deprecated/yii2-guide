<?php

/* @var $this yii\web\View */

use yii2lab\helpers\yii\Html;
use yii2module\guide\module\helpers\NavigationHelper;
use yii2module\markdown\widgets\helpers\ArticleMenuHelper;
use yii2module\markdown\widgets\helpers\MarkdownHelper;
use yii2module\markdown\widgets\Markdown;

$this->title = $entity->title;

$html = Markdown::widget(['content' => $entity->content]);

if(!$entity->is_main && !$entity->project->readonly) {
	$menu = ArticleMenuHelper::getMenuFromMarkdown($entity->content);
	if(!empty($menu)) {
		$html = ArticleMenuHelper::addIdInHeaders($html);
	}
	$menuMd = ArticleMenuHelper::makeMenuMd($menu);
	$menuHtml = MarkdownHelper::toHtml($menuMd);
	$html = str_replace('</h1>', '</h1>' . $menuHtml . PHP_EOL, $html);
}

?>

<div class="pull-right">

<?php
echo Html::a(Html::fa('code', ['class' => 'text-primary']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_CODE, ['id' => $entity->id]), [
	'title' => Yii::t('action', 'code'),
]);
echo NBSP;
if(Yii::$app->user->can('guide.modify', $entity->project)) {
	echo Html::a(Html::fa('pencil', ['class' => 'text-primary']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_UPDATE, ['id' => $entity->id]), [
		'title' => Yii::t('action', 'update'),
	]);
	echo NBSP;
	echo Html::a(Html::fa('trash', ['class' => 'text-danger']), NavigationHelper::genUrl(NavigationHelper::URL_ARTICLE_DELETE, ['id' => $entity->id]), [
		'title' => Yii::t('action', 'delete'),
		'data' => [
			'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
			'method' => 'post',
		],
	]);
} ?>

</div>

<?= $html ?>

<br/>
