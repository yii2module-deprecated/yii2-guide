<?php

namespace yii2module\guide\domain\entities;

use yii2lab\domain\BaseEntity;

class ChapterEntity extends BaseEntity {

	protected $id;
	protected $title;
	protected $parent_id;
	protected $parent;
	protected $articles;

	public function fieldType() {
		return [
			'parent' => [
				'type' => static::className(),
			],
			'articles' => [
				'type' => ArticleEntity::className(),
				'isCollection' => true,
			],
		];
	}
}