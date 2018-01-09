<?php

namespace yii2module\guide\domain;

use yii2lab\domain\enums\Driver;
use yii2lab\domain\services\ActiveBaseService;

class Domain extends \yii2lab\domain\Domain {
	
	public function config() {
		return [
			'repositories' => [
				'project' => [
					'driver' => Driver::FILE,
					'owners' => [
						'yii2lab',
						'yii2module',
						'yii2woop',
						'yii2guide',
					],
				],
				'article' => Driver::FILE,
				'chapter' => Driver::FILE,
			],
			'services' => [
				'project' => ActiveBaseService::className(),
				'article',
				'chapter',
			],
		];
	}
	
}
