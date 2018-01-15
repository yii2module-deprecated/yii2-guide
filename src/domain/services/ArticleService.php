<?php

namespace yii2module\guide\domain\services;

use Yii;
use yii\data\ArrayDataProvider;
use yii2lab\domain\services\ActiveBaseService;

class ArticleService extends ActiveBaseService {
	
	public function search($body) {
		$collection = $this->repository->search($body);
		$dataProvider = new ArrayDataProvider([
			'allModels' => $collection,
			'pagination' => false,
		]);
		return $dataProvider;
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
