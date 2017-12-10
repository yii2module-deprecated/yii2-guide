<?php

/**
 * @var $this yii\web\View
 * @var $model yii\base\Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2mod\markdown\MarkdownEditor;
use yii2module\guide\module\widgets\Markdown;

$this->title = t('action', 'UPDATE');

?>

<div class="row">
	<div class="col-lg-12">
		<?php $form = ActiveForm::begin(); ?>
		
		<?= $form->field($model, 'content', ['template' => "{hint}\n{input}\n{error}"])->widget(MarkdownEditor::class, [
			'editorOptions' => [
				'showIcons' => ["code", "table"],
                'toolbar' => [
                    'bold', 'italic', 'strikethrough',
                    '|',
                    //'heading', 'heading-smaller', 'heading-bigger',
                    'heading-1', 'heading-2', 'heading-3',
	                '|',
	                'code', 'quote',
	                '|',
                    'unordered-list', 'ordered-list',
	                '|',
	                'clean-block', 'link', 'image', 'table', 'horizontal-rule',
	                '|',
                    'preview', 'side-by-side', 'fullscreen', 'guide',
	                
                ],
			],
   
		]); ?>
        
        <div class="form-group">
			<?= Html::submitButton(t('action', 'SAVE'), ['class' => 'btn btn-primary']) ?>
			<?= Html::submitButton(t('action', 'PREVIEW'), ['name'=> 'isPreview', 'value'=> '1', 'class' => 'btn btn-default']) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>

    <?php if(Yii::$app->request->isPost) { ?>
        <div class="col-lg-12">
		    <?= Markdown::widget(['content' => $model->content]) ?>
        </div>
	<?php } ?>
	
</div>

<br/>
