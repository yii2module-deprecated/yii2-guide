<?php

namespace yii2module\guide\domain\repositories\file;

use Yii;
use yii\web\NotFoundHttpException;
use yii2lab\domain\BaseEntity;
use yii2lab\domain\data\Query;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\helpers\yii\FileHelper;

class ArticleRepository extends BaseRepository {

	public $project;
	public $main = 'README';

	public function update(BaseEntity $entity) {
		$entity->validate();
		$project = Yii::$app->guide->project->oneById($this->project->id);
		$fileName = $project->dir . '/' . $entity->id . '.md';
		$fileName = ROOT_DIR . '/' . $fileName;
		FileHelper::save($fileName, $entity->content);
	}

	public function oneMainByDir($dir) {
		return $this->oneByDir($dir, $this->main);
	}

	public function oneByDir($dir, $id) {
		$content = FileHelper::load(Yii::getAlias("@{$dir}/{$id}.md"));
		if(empty($content)) {
			throw new NotFoundHttpException();
		}
		return $this->forgeEntity([
			'id' => $id,
			'content' => $content,
		]);
	}

	public function setProject($project_id) {
		$project = Yii::$app->guide->project->oneById($project_id);
		$this->project = $project;
	}

	public function oneMain() {
		return $this->oneById($this->main);
	}

	public function oneById($id, Query $query = null) {
		/** @var Query $query */
		$content = FileHelper::load(Yii::getAlias("@{$this->project->dir}/{$id}.md"));
		//$query = $this->forgeQuery($query);
		if(empty($content)) {
			throw new NotFoundHttpException();
		}
		$entity = $this->forgeEntity([
			'id' => $id,
			'content' => $content,
		]);
		$entity->project = $this->project;
		return $entity;
	}

	public function oneByIdWithChapter($id) {
		$entity = $this->oneById($id);
		try {
			$entity->chapter = $this->domain->repositories->chapter->oneByArticleId($id);
		} catch(NotFoundHttpException $e) {}
		return $entity;
	}

}
