<?php

namespace yii2module\guide\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;

class ChapterService extends ActiveBaseService {

	public function oneByArticleId($id) {
		return $this->repository->oneByArticleId($id);
	}

	public function oneByIdWithArticles($id) {
		$entity = $this->repository->oneById($id);
		$entity->articles = $this->repository->allByParentId($id);
		return $entity;
	}

	public function allByParentId($id) {
		return $this->repository->allByParentId($id);
	}
}
