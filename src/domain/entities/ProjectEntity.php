<?php

namespace yii2module\guide\domain\entities;

use Yii;
use yii2lab\domain\BaseEntity;
use yii2module\guide\domain\helpers\ArticleHelper;

class ProjectEntity extends BaseEntity {

	const DEFAULT_GROUP = 'main';

	protected $id;
	protected $title;
	protected $dir;
	protected $main = 'README';
	protected $group;

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

	public function getGroup() {
		if(!empty($this->group)) {
			return $this->group;
		}
		$idParts = explode('.', $this->id);
		if(count($idParts) > 1) {
			return $idParts[0];
		}
		return self::DEFAULT_GROUP;
	}

}