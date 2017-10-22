<?php

namespace yii2module\guide\domain\entities;

use yii2lab\domain\BaseEntity;
use yii2module\guide\domain\helpers\ArticleHelper;

class ArticleEntity extends BaseEntity {
	
	protected $id;
	protected $md;
	protected $chapter;

	public function fieldType() {
		return [
			'chapter' => [
				'type' => ChapterEntity::className(),
			],
		];
	}

	public function getTitle() {
		return ArticleHelper::extractTileFromMarkdown($this->md);
	}
}