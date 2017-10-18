<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii2module\guide\module\Module;

$this->title = $entity->title;

?>

<h1>
	<?= $entity->title ?>
</h1>

<ul>
	<?php foreach($collection as $item) { ?>
		<li>
			<?= Html::a($item->title, [Module::URL_ARTICLE_VIEW, 'id' => $item->id]) ?>
		</li>
	<?php } ?>
</ul>
