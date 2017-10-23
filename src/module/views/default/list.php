<?php

/* @var $this yii\web\View
 * @var $collection array */

use yii\widgets\Menu;
use yii2module\guide\module\helpers\NavigationHelper;
use yii2module\guide\module\helpers\ViewHelper;

$this->title = t('guide/main', 'title');

$map = ViewHelper::collectionToMap($collection);
?>

<h1>
	<?= t('guide/project', 'title') ?>
</h1>

<?php foreach($map as $groupName => $groupCollection) { ?>
	<h2>
		<?= ucfirst($groupName) ?>
	</h2>
	<?= Menu::widget([
		'items' => ViewHelper::collectionToItems($groupCollection, NavigationHelper::URL_ARTICLE_INDEX, ['project_id', 'id'])
	]) ?>
<?php } ?>

<br/>
