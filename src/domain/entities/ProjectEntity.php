<?php

namespace yii2module\guide\domain\entities;

use Yii;
use yii2lab\domain\BaseEntity;
use yii2module\guide\domain\helpers\ArticleHelper;

class ProjectEntity extends BaseEntity {

	protected $id;
	protected $title;
	protected $dir;
	protected $main = 'README';

	public function getId() {
		if(!empty($this->id)) {
			return $this->id;
		}
		return hash('crc32b', $this->dir);
	}

	public function getTitle() {
		if(!empty($this->title)) {
			return $this->title;
		}
		$article = Yii::$app->guide->article->oneMainByDir($this->dir);
		return ArticleHelper::extractTileFromMarkdown($article->md);
	}

}