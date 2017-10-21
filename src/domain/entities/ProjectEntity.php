<?php

namespace yii2module\guide\domain\entities;

use yii2lab\domain\BaseEntity;

class ProjectEntity extends BaseEntity {

	protected $id;
	protected $title;
	protected $dir;
	protected $main;

	public function getId() {
		if(!empty($this->id)) {
			return $this->id;
		}
		return hash('crc32b', $this->title);
	}

}