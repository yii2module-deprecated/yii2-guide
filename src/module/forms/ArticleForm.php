<?php

namespace yii2module\guide\module\forms;

use yii2lab\domain\base\Model;

class ArticleForm extends Model
{
	
	public $id;
	public $md;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' 		=> t('guide/article', 'id'),
			'md' 		=> t('guide/article', 'md'),
		];
	}
	
}
