<?php

namespace yii2module\guide\domain\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;

class ChapterService extends ActiveBaseService {

	public function oneByIdWithArticles($id) {
		return $this->repository->oneByIdWithArticles($id);
	}

}
