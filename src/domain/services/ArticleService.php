<?php

namespace yii2module\guide\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;

class ArticleService extends ActiveBaseService {

	public function oneMain() {
		return $this->repository->oneMain();
	}

	public function oneByIdWithChapter($id) {
		$entity = $this->repository->oneById($id);
		$entity->chapter = Yii::$app->guide->chapter->oneByArticleId($id);
		return $entity;
	}

}
