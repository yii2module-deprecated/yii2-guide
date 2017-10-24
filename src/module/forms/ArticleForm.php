<?php

namespace yii2module\guide\module\forms;

use yii2lab\domain\base\Model;

class ArticleForm extends Model
{
	
	public $id;
	public $content;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' 		=> t('guide/article', 'id'),
			'content' 		=> t('guide/article', 'content'),
		];
	}
	
}
