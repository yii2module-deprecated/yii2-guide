<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2module\guide\module\helpers\ViewHelper;

?>

<div class="row">
	<div class="col-lg-12">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'content', ['template' => "{hint}\n{input}\n{error}"])->textarea(['rows' => 19, 'style' => 'font-family: Monaco, Menlo, Consolas, "Courier New", monospace']); ?>

		<div class="form-group">
			<?= Html::submitButton(t('action', 'SAVE'), ['class' => 'btn btn-primary']) ?>
			<?= Html::submitButton(t('action', 'PREVIEW'), ['name'=> 'isPreview', 'value'=> '1', 'class' => 'btn btn-default']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>

	<div class="col-lg-12">
		<?= ViewHelper::markdownToHtml($model->content) ?>
	</div>
</div>