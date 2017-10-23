<?php

namespace yii2module\guide\domain\entities;

use yii\helpers\Inflector;
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
		if(!empty($this->md)) {
			return ArticleHelper::extractTileFromMarkdown($this->md);
		}
		if(!empty($this->id)) {
			$title = Inflector::id2camel($this->id);
			$title = Inflector::camel2words($title);
			$title = ucfirst($title);
			return $title;
		}
	}

	public function getMd() {
		if(!empty($this->md)) {
			return $this->md;
		}
		$title = $this->getTitle();
		if(!empty($title)) {
			return $title . PHP_EOL . '===' . PHP_EOL;
		}
	}
}