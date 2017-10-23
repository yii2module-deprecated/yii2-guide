<?php

namespace yii2module\guide\domain\repositories\file;

use Yii;
use yii\web\NotFoundHttpException;
use yii2lab\domain\BaseEntity;
use yii2lab\domain\data\Query;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\helpers\yii\FileHelper;

class ArticleRepository extends BaseRepository {

	public $dir;
	public $main = 'README';

	public function createInProject(BaseEntity $entity, $project_id) {
		$project = Yii::$app->guide->project->oneById($project_id);
		$fileName = $project->dir . '/' . $entity->id . '.md';
		$fileName = ROOT_DIR . '/' . $fileName;
		FileHelper::save($fileName, $entity->md);
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
			'md' => $content,
		]);
	}

	public function setProject($project_id) {
		$project = Yii::$app->guide->project->oneById($project_id);
		$this->dir = $project->dir;
	}

	public function oneMain() {
		return $this->oneById($this->main);
	}

	public function oneById($id, Query $query = null) {
		/** @var Query $query */
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

	public function oneByIdWithChapter($id) {
		$entity = $this->oneById($id);
		$entity->chapter = $this->domain->repositories->chapter->oneByArticleId($id);
		return $entity;
	}

}
