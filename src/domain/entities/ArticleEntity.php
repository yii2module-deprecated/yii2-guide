<?php

namespace yii2module\guide\domain\entities;

use Michelf\MarkdownExtra;
use yii2lab\domain\BaseEntity;

class ArticleEntity extends BaseEntity {
	
	protected $id;
	protected $md;

	public function getHtml() {
		$markdown = new MarkdownExtra();
		$html = $markdown->transform($this->md);
		return $html;
	}

	public function getTitle() {
		$md = trim($this->md);
		$lines = explode(PHP_EOL, $md);
		$firstLine = $lines[0];
		$firstLine = trim($firstLine, ' #');
		return $firstLine;
	}
}