<?php

/* @var $this yii\web\View
 * @var $collection array */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('action', 'search');

?>

<div class="row">
    <div class="col-lg-12">
    
		<?php $form = ActiveForm::begin(); ?>
	
	    <?= $form->field($model, 'text')->textInput(['maxlength' => 64]) ?>

        <div class="form-group">
			<?= Html::submitButton(t('action', 'search'), ['class' => 'btn btn-primary']) ?>
        </div>
		
		<?php ActiveForm::end(); ?>

        <ul>
            <?php foreach($collection as $projectId => $projectFiles) { ?>
                    <?php foreach($projectFiles as $articleEntity) { ?>
                        <li>
                            <?= Html::a($articleEntity->project->title, Url::to(['/guide/article', 'project_id' => $projectId]), ['target' => '_blank']) ?>
                            /
                            <?= Html::a($articleEntity->title, Url::to(['/guide/article/view', 'id' => $articleEntity->id, 'project_id' => $projectId]), ['target' => '_blank']) ?>
                        </li>
                    <?php } ?>
            <?php } ?>
        </ul>
        
    </div>
</div>

<br/>
