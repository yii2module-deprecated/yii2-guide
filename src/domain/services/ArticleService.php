<?php

namespace yii2module\guide\domain\services;

use yii2lab\domain\services\ActiveBaseService;

class ArticleService extends ActiveBaseService {

	public function oneMain() {
		return $this->repository->oneMain();
	}

}
