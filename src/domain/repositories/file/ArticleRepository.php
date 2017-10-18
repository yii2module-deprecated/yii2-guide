<?php

namespace yii2module\guide\domain\repositories\file;

use Yii;
use yii\web\NotFoundHttpException;
use yii2lab\domain\data\Query;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\helpers\yii\FileHelper;

class ArticleRepository extends BaseRepository {

	public $dir;
	public $main;

	public function oneMain() {
		return $this->oneById(null);
	}

	public function oneById($id, Query $query = null) {
		/** @var Query $query */
		$id = $id ? $id : $this->main;
		$content = FileHelper::load(Yii::getAlias("@{$this->dir}/{$id}.md"));
		//$query = $this->forgeQuery($query);
		if(empty($content)) {
			throw new NotFoundHttpException();
		}
		return $this->forgeEntity([
			'id' => $id,
			'md' => $content,
		]);
	}

}
