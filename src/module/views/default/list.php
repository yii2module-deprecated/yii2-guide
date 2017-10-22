<?php

/* @var $this yii\web\View
 * @var $collection array */
use yii\widgets\Menu;
use yii2module\guide\domain\helpers\ArticleHelper;
use yii2module\guide\domain\helpers\NavigationHelper;

$this->title = t('guide/main', 'title');
?>

<h1><?= t('guide/project', 'title') ?></h1>

<?= Menu::widget([
	'items' => ArticleHelper::collectionToItems($collection, NavigationHelper::URL_ARTICLE_INDEX, ['project_id', 'id'])
]) ?>
