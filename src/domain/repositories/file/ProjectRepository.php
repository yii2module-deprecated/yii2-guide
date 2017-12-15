<?php

namespace yii2module\guide\domain\repositories\file;

use yii2lab\domain\repositories\ActiveDiscRepository;
use yii2module\guide\domain\helpers\ProjectHelper;

class ProjectRepository extends ActiveDiscRepository {

	public $owners = [];
	public $table = 'project';
	public $path = '@yii2module/guide/data';

	protected function getCollection() {
		$array = parent::getCollection();
		$newArray = [];
		foreach($array as $item) {
			$item = ProjectHelper::normalizeItem($item);
			if(!isset($item['readonly'])) {
				$item['readonly'] = !empty($this->owners) && !empty($item['owner']) && !in_array($item['owner'], $this->owners);
			}
			if(!empty($item['title']) || empty($item['hide_on_null'])) {
				$newArray[] = $item;
			}
		}
		return $newArray;
	}
	
}
