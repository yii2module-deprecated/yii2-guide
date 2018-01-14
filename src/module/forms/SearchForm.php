<?php

namespace yii2module\guide\module\forms;

use Yii;
use yii2lab\domain\base\Model;

class SearchForm extends Model
{
	
	public $text;

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'text' 		=> Yii::t('guide/search', 'text'),
		];
	}
	
}
