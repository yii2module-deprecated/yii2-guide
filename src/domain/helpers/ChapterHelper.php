<?php

namespace yii2module\guide\domain\helpers;

use yii\apidoc\helpers\IndexFileAnalyzer;

class ChapterHelper {
	
	public static function extractAll($md) {
		$chapters = self::getChapters($md);
		foreach($chapters as &$chapter) {
			$chapter = self::normalizeEntity($chapter);
		}
		return self::mapToFlat($chapters);
	}
	
	private static function getChapters($md) {
		$indexAnalyzer = new IndexFileAnalyzer();
		$contents = $indexAnalyzer->analyze($md);
		return $contents;
	}
	
	private static function mapToFlat($chapters) {
		$result = [];
		foreach($chapters as $chapter) {
			if(!empty($chapter['items'])) {
				foreach($chapter['items'] as $item) {
					$item['parent_id'] = $chapter['id'];
					$result[] = $item;
				}
				unset($chapter['items']);
			}
			$result[] = $chapter;
		}
		return $result;
	}
	
	private static function normalizeEntity($data) {
		$data['title'] = $data['headline'];
		$data['id'] = !empty($data['file']) ? $data['file'] : hash('crc32b', $data['title']);
		$data['id'] = str_replace('.md', '', $data['id']);
		if(!empty($data['content'])) {
			foreach($data['content'] as $item) {
				$data['items'][] = self::normalizeEntity($item);
			}
			unset($data['content']);
		}
		unset($data['headline']);
		unset($data['file']);
		return $data;
	}

}
