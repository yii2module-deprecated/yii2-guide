<?php

namespace yii2module\guide\domain\services;

use yii2lab\domain\services\ActiveBaseService;

class ChapterService extends ActiveBaseService {

	public function oneByArticleId($id) {
		return $this->repository->oneByArticleId($id);
	}

	public function allByParentId($id) {
		return $this->repository->allByParentId($id);
	}
}
