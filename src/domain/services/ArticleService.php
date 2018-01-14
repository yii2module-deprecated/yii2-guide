<?php

namespace yii2module\guide\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\helpers\yii\FileHelper;
use yii2mod\helpers\ArrayHelper;

class ArticleService extends ActiveBaseService {
	
	public function search($body) {
		$projectCollection = Yii::$app->guide->project->all();
		$projectCollection = ArrayHelper::index($projectCollection, 'id');
		$finded = $this->getAllFiles($projectCollection);
		$matches = $this->findText($finded, $body['text']);
		return $matches;
	}
	
	protected function findTextInContent($content, $text) {
		$content = mb_strtolower($content);
		$text = mb_strtolower($text);
		$isExists = mb_strpos($content, $text) !== false;
		return $isExists;
	}
	
	protected function findText($finded, $text) {
		$matches = [];
		foreach($finded as $projectId => $projectFiles) {
			$projectEntity = $projectFiles['project'];
			$files = $projectFiles['files'];
			Yii::$app->guide->article->setProject($projectId);
			foreach($files as $projectFile) {
				$dir = FileHelper::getAlias('@' . $projectEntity->dir);
				$fullName = $dir . DS . $projectFile . '.md';
				$content = FileHelper::load($fullName);
				$isExists = $this->findTextInContent($content, $text);
				$articleEntity = Yii::$app->guide->article->oneById($projectFile);
				$articleEntity->project = $projectEntity;
				if($isExists) {
					$matches[$projectId][] = $articleEntity;
				}
			}
		}
		return $matches;
	}
	
	protected function getAllFiles($projectCollection) {
		$finded = [];
		foreach($projectCollection as $projectEntity) {
			$dir = FileHelper::getAlias('@' . $projectEntity->dir);
			if(FileHelper::has($dir)) {
				$files = $this->findMdFiles($dir);
				foreach($files as &$ff) {
					$ff = mb_substr($ff, mb_strlen($dir) + 1, -3);
				}
				$finded[$projectEntity->id] = [
					'project' => $projectEntity,
					'files' => $files,
				];
			}
		}
		return $finded;
	}
	
	protected function findMdFiles($dir) {
		$options['only'][] = '*.md';
		return FileHelper::findFiles($dir, $options);
	}
	
	public function update($data) {
		Yii::$app->account->rbac->can('guide.modify', $this->repository->project);
		$entity = $this->domain->factory->entity->create($this->id, $data);
		return $this->repository->update($entity);
	}

	public function oneMainByDir($dir, $id = 'README') {
		return $this->repository->oneMainByDir($dir, $id);
	}

	public function oneMain() {
		return $this->repository->oneMain();
	}

	public function oneByIdWithChapter($id) {
		return $this->repository->oneByIdWithChapter($id);
	}

	public function setProject($project_id) {
		return $this->repository->setProject($project_id);
	}

	public function getProject() {
		return $this->repository->project;
	}

}
