<?php

namespace yii2module\guide\domain\entities;

use Michelf\MarkdownExtra;
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

	public function getHtml() {
		$markdown = new MarkdownExtra();
		$html = $markdown->transform($this->md);
		return $html;
	}

	public function getTitle() {
		return ArticleHelper::extractTileFromMarkdown($this->md);
	}
}