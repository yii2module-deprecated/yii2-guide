<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $entity->title;

?>

<h1>
	<?= $entity->title ?>
</h1>

<ul>
	<?php foreach($collection as $item) { ?>
		<li>
			<?= Html::a($item->title, ['/guide/default/view', 'id' => $item->id]) ?>
		</li>
	<?php } ?>
</ul>
