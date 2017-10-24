<?php

namespace yii2module\guide\domain\entities;

use yii\helpers\Inflector;
use yii2lab\domain\BaseEntity;
use yii2module\guide\domain\helpers\ArticleHelper;

class ArticleEntity extends BaseEntity {
	
	protected $id;
	protected $content;
	protected $chapter;
	protected $project;

	public function rules()
	{
		return [
			['id', 'required'],
			['id', 'match', 'pattern' => '/^[a-z-]+$/i']
		];
	}

	public function fieldType() {
		return [
			'chapter' => [
				'type' => ChapterEntity::className(),
			],
			'project' => [
				'type' => ProjectEntity::className(),
			],
		];
	}

	public function getTitle() {
		if(!empty($this->content)) {
			return ArticleHelper::extractTileFromMarkdown($this->content);
		}
		if(!empty($this->id)) {
			$title = Inflector::id2camel($this->id);
			$title = Inflector::camel2words($title);
			$title = ucfirst($title);
			return $title;
		}
	}

	public function getContent() {
		if(!empty($this->content)) {
			return $this->content;
		}
		$title = $this->getTitle();
		if(!empty($title)) {
			return $title . PHP_EOL . '===' . PHP_EOL;
		}
	}
}