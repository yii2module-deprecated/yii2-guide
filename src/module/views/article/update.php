<?php
/**
 * @var $this yii\web\View
 * @var $model yii\base\Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="row">
	<div class="col-lg-12">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'md')->textarea(['rows' => 18]); ?>

		<div class="form-group">
			<?= Html::submitButton(t('action', 'SAVE'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>