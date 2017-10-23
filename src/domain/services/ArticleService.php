<?php

namespace yii2module\guide\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;

class ArticleService extends ActiveBaseService {

	public function updateInProject($data, $project_id) {
		$entity = $this->domain->factory->entity->create($this->id, $data);
		return $this->repository->updateInProject($entity, $project_id);
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

}
