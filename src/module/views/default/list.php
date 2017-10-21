<?php

/* @var $this yii\web\View
 * @var $collection array */
use yii\widgets\Menu;
use yii2module\guide\domain\helpers\ArticleHelper;
use yii2module\guide\module\Module;

//$this->title = $entity->title;
?>

<?= Menu::widget([
	'items' => ArticleHelper::collectionToItems($collection, Module::URL_ARTICLE_INDEX, ['project_id', 'id'])
]) ?>
